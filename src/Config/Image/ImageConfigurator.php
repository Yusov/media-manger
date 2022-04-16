<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

use Illuminate\Support\Facades\Storage;
use MediaManager\Config\AbstractFileConfigurator;
use MediaManager\Config\ConfiguratorInterface;
use MediaManager\Config\UrlBuilderInterface;
use MediaManager\Storage\StorageInterface;

class ImageConfigurator extends AbstractFileConfigurator implements ImageConfiguratorInterface
{
    private array $dpiSizes = [];
    private bool $isMain = false;
    private bool $saveOriginal = false;
    private string $defaultDpi;
    private string $originalDpi;

    protected UrlBuilderInterface $urlBuilder;

    public function __construct(StorageInterface $storage, UrlBuilderInterface $urlBuilder)
    {
        parent::__construct($storage);
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * {@inheritDoc}
     */
    public function getDpiSizes(): array
    {
        return $this->dpiSizes;
    }

    /**
     * {@inheritDoc}
     */
    public function setDpiSizes(array $dpiSizes): self
    {
        $this->dpiSizes = $dpiSizes;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getWidth(string $dpi): int
    {
        return $this->dpiSizes[$dpi]['width'];
    }

    /**
     * {@inheritDoc}
     */
    public function getHeight(string $dpi): int
    {
        return $this->dpiSizes[$dpi]['height'];
    }

    /**
     * {@inheritDoc}
     */
    public function isMain(): bool
    {
        return $this->isMain;
    }

    /**
     * {@inheritDoc}
     */
    public function makeIsMain(): self
    {
        $this->isMain = true;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function disableMain(): self
    {
        $this->isMain = false;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isResizable(): bool
    {
        return !empty($this->dpiSizes);
    }

    /**
     * {@inheritDoc}
     */
    public function isSaveOriginal(): bool
    {
        return $this->saveOriginal;
    }

    /**
     * {@inheritDoc}
     */
    public function setSaveOriginal(bool $saveOriginal): self
    {
        $this->saveOriginal = $saveOriginal;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultDpi(): string
    {
        return $this->defaultDpi ?? $this->originalDpi;
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultDpi(string $defaultDpi): self
    {
        $this->defaultDpi = $defaultDpi;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getOriginalDpi(): string
    {
        return $this->originalDpi;
    }

    /**
     * {@inheritDoc}
     */
    public function setOriginalDpi(string $dpi): self
    {
        $this->originalDpi = $dpi;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function takePublicPath(): string
    {
        $path = $this->urlBuilder->getPublicUrl(
            $this->getDefaultDpi()
        );

        if (!$path) {
            throw new \LogicException("File with {$dpi} cannot be load.");
        }

        return $this->getStorage()->url($path);
    }
}
