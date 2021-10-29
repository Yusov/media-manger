<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

final class SquareImage extends AbstractImage
{
    protected function init(): self
    {
        $this->setDpiSizes(
            array_keys(config('media.image.square'))
        );
        $this->setPermittedMimes(config('media.image.allowed_types'));

        return $this;
    }
}