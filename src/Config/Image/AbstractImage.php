<?php

declare(strict_types=1);

namespace MediaManager\Config\Image;

abstract class AbstractImage implements ImageConfiguratorInterface
{
    protected array $permittedMimes = [];
    protected bool $clearable = false;
    protected bool $resize = true;
    protected array $dpiSizes = [];
    protected string $type;
    protected string $category;
    protected bool $isMain = false;

    public function __construct(
        bool $clearable = false,
        bool $resize = true,
        string $category = '',
        string $type = self::MEDIA_TYPE_IMAGE
    ) {
        $this->clearable = $clearable;
        $this->resize = $resize;
        $this->category = $category;
        $this->type = $type;
        $this->init();
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
    public function getPermittedMimes(): array
    {
        return $this->permittedMimes;
    }

    /**
     * {@inheritDoc}
     */
    public function setPermittedMimes(array $permittedMimes): self
    {
        $this->permittedMimes = $permittedMimes;

        return $this;
    }

    /**
     * Should be clear after delete
     *
     * {@inheritDoc}
     */
    public function isClearable(): bool
    {
        return $this->clearable;
    }

    /**
     * {@inheritDoc}
     */
    public function getDpiSizes(): array
    {
        return array_keys($this->dpiSizes);
    }

    /**
     * {@inheritDoc}
     */
    public function setDpiSizes(array $dpi): self
    {
        $this->dpiSizes = $dpi;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * {@inheritDoc}
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory(): string
    {
        return $this->category;
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
        return $this->resize;
    }

    /**
     * @return $this
     */
    abstract protected function init(): self;
}