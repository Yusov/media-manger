<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

use Illuminate\Database\Eloquent\Model;
use MediaManager\Config\ConfiguratorInterface;

interface ImageConfiguratorInterface extends ConfiguratorInterface
{
    /**
     * @param  string  $dpi
     *
     * @return int
     */
    public function getWidth(string $dpi): int;

    /**
     * @param  string  $dpi
     *
     * @return int
     */
    public function getHeight(string $dpi): int;

    /**
     * Skip resizing images
     *
     * @return bool
     */
    public function isResizable(): bool;

    /**
     * @return bool
     */
    public function isMain(): bool;

    /**
     * @return $this
     */
    public function makeIsMain(): self;

    /**
     * @return $this
     */
    public function disableMain(): self;

    /**
     * @return array
     */
    public function getDpiSizes(): array;

    /**
     * @param array $dpiSizes
     *
     * @return $this
     */
    public function setDpiSizes(array $dpiSizes): self;

    /**
     * Indicates that we should save original file.
     *
     * @return bool
     */
    public function isSaveOriginal(): bool;

    /**
     * Set save original file indicator.
     *
     * @param bool $saveOriginal
     *
     * @return $this
     */
    public function setSaveOriginal(bool $saveOriginal): self;

    /**
     * @return string
     */
    public function getDefaultDpi(): string;

    /**
     * @param string $defaultDpi
     *
     * @return $this
     */
    public function setDefaultDpi(string $defaultDpi): self;

    /**
     * @return string
     */
    public function getOriginalDpi(): string;

    /**
     * @param string $dpi
     *
     * @return $this
     */
    public function setOriginalDpi(string $dpi): self;

    /**
     * @return string
     */
    public function takePublicPath(): string;
}
