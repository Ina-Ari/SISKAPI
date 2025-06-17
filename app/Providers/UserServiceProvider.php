<?php

namespace App\Providers;

use App\Services\User\UserApiServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Services\User\UserApiService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        UserServiceInterface::class => UserService::class,
        UserApiServiceInterface::class => UserApiService::class,
    ];

    public function provides(): array
    {
        return [UserServiceInterface::class, UserApiServiceInterface::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
