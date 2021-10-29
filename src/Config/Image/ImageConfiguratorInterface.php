<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

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
     * @return array
     */
    public function getDpiSizes(): array;

    /**
     * @param  array  $dpi
     *
     * @return $this
     */
    public function setDpiSizes(array $dpi): self;

    /**
     * @return string
     */
    public function getCategory(): string;
}