<?php

declare(strict_types=1);

namespace MediaManager\Storage;

use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FileNotFoundException;

class LocalStorage implements StorageInterface
{
    private FilesystemAdapter $filesystem;

    /**
     * @param string|null $name
     *
     * @return void
     */
    public function __construct(?string $name = null)
    {
        $this->filesystem = Storage::disk($name);
    }

    /**
     * @return \Illuminate\Contracts\Filesystem\Filesystem|FilesystemAdapter
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * {@inheritDoc}
     */
    public function save(string $path, $contents): bool
    {
        return (bool)Storage::put($path, $contents);
    }

    /**
     * {@inheritDoc}
     */
    public function bulkRemove(array $paths): bool
    {
        return (bool)Storage::delete($paths);
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $path): bool
    {
        return (bool)Storage::delete($path);
    }

    /**
     * {@inheritDoc}
     *
     * @throws FileNotFoundException
     */
    public function open(string $path): string
    {
        if (!Storage::exists($path)) {
            throw new FileNotFoundException($path);
        }

        return Storage::get($path);
    }

    /**
     * {@inheritDoc}
     */
    public function exist(string $path): bool
    {
        return (bool)Storage::exists($path);
    }

    /**
     * {@inheritDoc}
     */
    public function openStream(string $path)
    {
        return Storage::readStream($path);
    }

    /**
     * {@inheritDoc}
     */
    public function url(string $path): string
    {
        return $this->filesystem->url($path);
    }
}
