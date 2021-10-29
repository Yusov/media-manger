<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

final class ProportionalImage extends AbstractImage
{
    protected function init(): self
    {
        $this->setDpiSizes(config('media.image.proportional'));
        $this->setPermittedMimes(config('media.image.allowed_types.image'));

        return $this;
    }
}