<?php

declare(strict_types=1);

namespace MediaManager\Config;

use MediaManager\Storage\StorageInterface;

interface ConfiguratorInterface
{
    /**
     * @return array
     */
    public function getPermittedMimes(): array;

    /**
     * @param array $mimes
     *
     * @return self
     */
    public function setPermittedMimes(array $mimes): self;

    /**
     * @return string
     */
    public function getUrlTemplate(): string;

    /**
     * @param string $filePath
     *
     * @return $this
     */
    public function setUrlTemplate(string $filePath): self;

    /**
     * @return bool
     */
    public function isClearable(): bool;

    /**
     * @param bool $isClearable
     *
     * @return $this
     */
    public function setClearable(bool $isClearable): self;
}
