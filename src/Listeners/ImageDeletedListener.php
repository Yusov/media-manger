<?php

declare(strict_types=1);

namespace MediaManager\Listeners;

use App\Admin\Controllers\Helpers\MediaHelper;
use MediaManager\Events\ImageDeleted;
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
            $paths[] = MediaHelper::prepareFullResourceUrl($event->imageModel->toArray(), $dpiSize, $event->configurator::STORAGE);
        }
        $paths[] = MediaHelper::prepareFullResourceUrl($event->imageModel->toArray(), 'original', $event->configurator::STORAGE);

        if (empty($paths)) {
            return;
        }

        if (!$this->storage->bulkRemove($paths)) {
            throw new \RuntimeException('Cannot remove files: ' . implode(',', $paths));
        }
    }
}