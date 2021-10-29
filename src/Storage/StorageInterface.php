<?php

declare(strict_types=1);

namespace MediaManager\Storage;

interface StorageInterface
{
    /**
     * @param  string|resource $path
     * @param $contents
     *
     * @return bool
     */
    public function save(string $path, $contents): bool;

    /**
     * @param  array  $paths
     *
     * @return bool
     */
    public function bulkRemove(array $paths): bool;

    /**
     * @param  string  $path
     *
     * @return bool
     */
    public function remove(string $path): bool;

    /**
     * Return file context
     *
     * @param  string  $path
     *
     * @return string
     */
    public function open(string $path): string;

    /**
     * @param  string  $path
     *
     * @return bool
     */
    public function exist(string $path) : bool;

    /**
     * @param  string  $path
     *
     * @return resource|null
     */
    public function openStream(string $path);
}