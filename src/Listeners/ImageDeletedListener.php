<?php

declare(strict_types=1);

namespace MediaManager\Listeners;

use MediaManager\Events\ImageDeleted;
use MediaManager\Helpers\PathHelper;
use MediaManager\Storage\StorageInterface;

class ImageDeletedListener
{
    /**
     * @param  ImageDeleted  $event
     */
    public function handle(ImageDeleted $event): void
    {
        $paths = [];
        foreach ($event->configurator->getDpiSizes() as $dpiSize) {
            $paths[] = $event->configurator->getPath();
        }
        $paths[] = $event->configurator->getPath();

        if (empty($paths)) {
            return;
        }

        if (!$event->configurator->getStorage()->bulkRemove($paths)) {
            throw new \RuntimeException('Cannot remove files: ' . implode(',', $paths));
        }
    }
}
