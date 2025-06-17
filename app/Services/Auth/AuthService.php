<?php

namespace App\Services\Auth;

use App\Exceptions\MailException;
use App\Exceptions\UserException;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserRegistrationNotification;
use App\Services\Auth\AuthServiceInterface;
use App\Services\User\UserApiServiceInterface;
use App\Services\User\UserServiceInterface;
use App\Support\Helpers\TokenHelper;
use App\Support\Resolvers\UserRelationResolver;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private UserServiceInterface $userService,
        private UserApiServiceInterface $userApiService
    ) {}

    public function register(string $credential, string $email, string $type): bool
    {
        $url = match ($type) {
            'student' => $this->registerStudent($credential, $email),
            default => $this->registerEmployee($credential, $email),
        };

        Notification::route('mail', $email)
            ->notify(new UserRegistrationNotification($url));

        return true;
    }

    private function registerStudent(string $nim, string $email): string
    {
        $exist = $this->userService->findUserFromDatabase(['username' => $nim]);

        if ($exist) {
            throw new UserException(__('auth.register.already_registered'));
        }

        $this->throwIfEmailExist($email);

        $user = $this->userApiService->getMahasiswa(['nim' => $nim, 'email' => $email]);

        if (!$user) {
            throw new UserException(__('exceptions.user.not_found'));
        }

        $user['role_id'] = Role::getId(Role::MAHASISWA);

        $token = TokenHelper::generateToken();

        DB::transaction(function() use($user, $token) {
            DB::table('registration_tokens')->where('username', $user['nim'])->delete();

            DB::table('registration_tokens')
                ->insert([
                    'username' => $user['nim'],
                    'email'=> $user['email'],
                    'type'=> Role::MAHASISWA,
                    'token' => $token,
                    'expires_at' => now()->addMinutes(config('auth.registration_token.expire')),
                    'created_at' => now(),
                ]);
        });

        return url(route('account.setup.form', [
            'token' => $token,
            'username' => $user['nim']
        ], false));
    }

    private function registerEmployee(string $token, string $email): string
    {
        $registration = $this->validateRegistrationToken($token);

        $this->throwIfEmailExist($email);

        $user = $registration->type === Role::KEPALA_PRODI
            ? $this->userApiService->getDosen(['nip' => $registration->username])
            : $this->userApiService->getPegawai(['nip' => $registration->username]);

        if (!$user) {
            throw new UserException(__('exceptions.user.not_found'));
        }

        $newToken = TokenHelper::generateToken();

        DB::table('registration_tokens')
            ->where('token', $token)
            ->update([
                'email' => $email,
                'token' => $newToken,
                'expires_at' => now()->addMinutes(config('auth.registration_token.expire')),
                'created_at' => now(),
            ]);

        return url(route('account.setup.form', [
            'token' => $newToken,
            'username' => $user['nip']
        ], false));
    }

    public function accountSetup(string $token, string $password): bool
    {
        $registration = $this->validateRegistrationToken($token);

        $user = match ($registration->type) {
            Role::MAHASISWA => $this->userApiService->getUserByRoleName($registration->type, ['nim' => $registration->username]),
            Role::KEPALA_PRODI, Role::BAAK, Role::UPAPKK => $this->userApiService->getUserByRoleName($registration->type, ['nip' => $registration->username]),
            default => null
        };

        if (!$user) {
            throw new UserException(__('exceptions.user.not_found'));
        }

        $user['email'] = $registration->email;
        $user['password'] = $password;
        $user['is_active'] = true;
        $user['role_id'] = Role::getId($registration->type);
        $user = $this->userService->create($user);

        DB::table('registration_tokens')->where('token', $token)->delete();

        return true;
    }

    private function throwIfEmailExist(string $email): void
    {
        if ($this->userService->findUserFromDatabase(['email' => $email])) {
            throw new UserException(__('auth.register.email_already_registered'));
        }
    }

    private function validateRegistrationToken(string $token): object
    {
        if (!TokenHelper::validateToken($token)) {
            throw new UserException(__('auth.register.registration_token_invalid'));
        }

        $registration = DB::table('registration_tokens')->where('token', $token)->first();

        if (!$registration || $registration->expires_at < now()) {
            DB::table('registration_tokens')->where('token', $token)->delete();
            throw new UserException(__('auth.register.registration_token_invalid'));
        }

        return $registration;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        $field = filter_var($credentials['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = $this->userService->findUserFromDatabase([$field => $credentials['username']], true);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        $relation = UserRelationResolver::getRelationData($user);

        if (!$relation || !$relation->is_active) {
            throw new UserException(__('exceptions.user.inactive'));
        }

        Auth::login($user, $remember);
        Session::regenerate();

        return true;
    }

    public function logout(): void
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
    }

    public function forgotPassword(string $email): string
    {
        $user = $this->userService->findUserFromDatabase(['email' => $email]);

        if (!$user) {
            throw new MailException(__('passwords.user'));
        }

        $status = Password::sendResetLink(['email' => $user->email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw new MailException(__($status));
        }

        return __($status);
    }

    public function resetPassword(array $credentials): string
    {
        $user = $this->userService->findUserFromDatabase(['email' => $credentials['email']]);

        if (!$user) {
            throw new UserException(__('passwords.user'));
        }

        $status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
            event(new PasswordReset($user));
        });

        if ($status !== Password::PASSWORD_RESET) {
            throw new UserException(__($status));
        }

        return __($status);
    }
}
