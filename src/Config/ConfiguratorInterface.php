<?php

declare(strict_types=1);

namespace MediaManager\Config;

interface ConfiguratorInterface
{
    public const STORAGE = 'public';
    public const MEDIA_TYPE_IMAGE = 'image';
    public const MEDIA_TYPE_IMAGE_BANNER = 'banner';
    public const MEDIA_TYPE_VIDEO = 'video';
    public const MEDIA_ORIGINAL_DPI = 'original';

    /**
     * @return array
     */
    public function getPermittedMimes(): array;

    /**
     * @param  array  $permittedMimes
     *
     * @return $this
     */
    public function setPermittedMimes(array $permittedMimes): self;

    /**
     * @return bool
     */
    public function isClearable(): bool;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param  string  $type
     *
     * @return $this
     */
    public function setType(string $type): self;

    /**
     * @return bool
     */
    public function isMain(): bool;

    /**
     * @return $this
     */
    public function makeIsMain(): self;
}