<?php

namespace App\Services\User;

use App\Exceptions\UserException;
use App\Support\Resolvers\UserRelationResolver;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserService implements UserServiceInterface
{
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = new User();

            $user->fill($data);
            $user->username = $data['nim'] ?? $data['nip'];
            $user->save();

            UserRelationResolver::getRelationObject($user)->create($data);
            return $user;
        });
    }

    public function getCurrent(): User
    {
        $user = Auth::user();

        if (!$user) {
            throw new UserException(__('exceptions.user.unauthorized'));
        }

        return UserRelationResolver::getUserWithRelation($user);
    }

    public function findUserFromDatabase(array $column, bool $withTrashed = false): User|null
    {
        return User::withTrashed($withTrashed)->where($column)->first();
    }

    public function updateCurrent(array $data): User
    {
        $user = Auth::user() ?? throw new UserException(__('exceptions.user.unauthorized'));

        DB::transaction(function () use ($user, $data) {
            $userUpdated = $user->update([
                'nama' => $data['nama'],
                'username' => $data['nim'] ?? $data['nip'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            if (!$userUpdated) {
                throw new UserException(__('exceptions.user.update_failed'));
            }

            $relation = UserRelationResolver::getRelationData($user);

            if (!$relation) {
                throw new UserException(__('exceptions.user.related_data_not_found'));
            }

            if (!$relation->update($data)) {
                throw new UserException(__('exceptions.user.update_failed'));
            }
        });

        return $this->getCurrent();
    }

    public function updateUserEmail(User $user, string $email): User
    {
        return DB::transaction(function () use ($user, $email) {
            $user->email = $email;
            $user->email_verified_at = null;
            if (!$user->save()) {
                throw new UserException(__('exceptions.user.update_failed'));
            }

            return $user;
        });
    }

    public function delete(string $userId): bool
    {
        return DB::transaction(function () use ($userId) {
            $user = User::find($userId);

            if (!$user) {
                throw new UserException(__('exceptions.user.not_found'));
            }

            $user->delete();
            UserRelationResolver::getRelationObject($user)->update(['is_active' => false]);

            return true;
        });
    }
}
