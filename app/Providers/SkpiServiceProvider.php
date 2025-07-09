<?php

namespace App\Providers;

use App\Services\Skpi\SkpiDocumentService;
use App\Services\Skpi\SkpiDocumentServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SkpiServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public $singletons = [
        SkpiDocumentServiceInterface::class => SkpiDocumentService::class
    ];

    public function provides(): array
    {
        return [SkpiDocumentServiceInterface::class];
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
