<?php

declare(strict_types=1);

namespace MediaManager\Listeners;

use MediaManager\Events\ImageDeleted;
use MediaManager\Helpers\PathHelper;
use MediaManager\Storage\StorageInterface;

class ImageDeletedListener
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param  ImageDeleted  $event
     */
    public function handle(ImageDeleted $event): void
    {
        $paths = [];
        foreach ($event->configurator->getDpiSizes() as $dpiSize) {
            $paths[] = PathHelper::prepareFullResourceUrl($event->imageModel->toArray(), $dpiSize, $event->configurator::STORAGE);
        }
        $paths[] = PathHelper::prepareFullResourceUrl($event->imageModel->toArray(), 'original', $event->configurator::STORAGE);

        if (empty($paths)) {
            return;
        }

        if (!$this->storage->bulkRemove($paths)) {
            throw new \RuntimeException('Cannot remove files: ' . implode(',', $paths));
        }
    }
}