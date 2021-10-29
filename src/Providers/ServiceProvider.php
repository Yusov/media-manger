<?php

declare(strict_types=1);

namespace MediaManager\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use MediaManager\Storage\LocalStorage;
use MediaManager\Storage\StorageInterface;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot(): void
    {
        $this->publishes([__DIR__ .'/../../config/media.php' => config_path('media.php')]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(StorageInterface::class, LocalStorage::class);

        parent::register();
    }
}