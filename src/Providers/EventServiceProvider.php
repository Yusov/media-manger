<?php

declare(strict_types=1);

namespace MediaManager\Providers;

use MediaManager\Events\ImageDeleted;
use MediaManager\Events\ImageSaved;
use MediaManager\Listeners\ImageDeletedListener;
use MediaManager\Listeners\ImageSavedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as IlluminateEventServiceProvider;

class EventServiceProvider extends IlluminateEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        ImageSaved::class => [
            ImageSavedListener::class,
        ],
        ImageDeleted::class => [
            ImageDeletedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        parent::boot();
    }
}