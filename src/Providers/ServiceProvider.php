<?php

declare(strict_types=1);

namespace MediaManager\Providers;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use MediaManager\Config\AbstractFileConfigurator;
use MediaManager\Config\Image\ImageConfigurator;
use MediaManager\Config\Image\UrlBuilder;
use MediaManager\Config\UrlBuilderInterface;
use MediaManager\Listeners\ImageDeletedListener;
use MediaManager\Listeners\ImageSavedListener;
use MediaManager\Services\ImageMediaService;
use MediaManager\Storage\LocalStorage;
use MediaManager\Storage\StorageInterface;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot(): void
    {
        $this->publishes([__DIR__ . '/../../config/media.php' => config_path('media.php')]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(StorageInterface::class, LocalStorage::class);
        $this->app->bind(UrlBuilderInterface::class, UrlBuilder::class);

        $this->app
            ->when(ImageMediaService::class)
            ->needs(StorageInterface::class)
            ->give(LocalStorage::class);

        $this->app
            ->when(ImageSavedListener::class)
            ->needs(StorageInterface::class)
            ->give(LocalStorage::class);

        $this->app
            ->when(ImageDeletedListener::class)
            ->needs(StorageInterface::class)
            ->give(LocalStorage::class);

        $this->app->register(EventServiceProvider::class);

        $this->app->make(LocalStorage::class, ['name' => config('filesystems.default')]);

        $this->app->resolving(ImageConfigurator::class, function (ImageConfigurator $configurator, Container $container) {
            return $configurator
                ->setPermittedMimes(config('media.allowed_types.image'))
                ->setSaveOriginal(config('media.images.save_original'))
                ->setOriginalDpi(config('media.images.original_dpi'));
        });

        parent::register();
    }
}
