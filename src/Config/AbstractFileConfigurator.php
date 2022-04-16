<?php

declare(strict_types=1);

namespace MediaManager\Config;

use Illuminate\Database\Eloquent\Model;
use MediaManager\Storage\StorageInterface;

abstract class AbstractFileConfigurator implements ConfiguratorInterface
{
    private string $urlTemplate;
    private array $permittedMimes;
    private bool $clearable = true;
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return StorageInterface
     */
    public function getStorage(): StorageInterface
    {
        return $this->storage;
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
    public function setPermittedMimes(array $mimes): self
    {
        $this->permittedMimes = $mimes;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUrlTemplate(): string
    {
        return $this->urlTemplate;
    }

    /**
     * {@inheritDoc}
     */
    public function setUrlTemplate(string $urlTemplate): self
    {
        $this->urlTemplate = $urlTemplate;

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
    public function setClearable(bool $clearable): self
    {
        $this->clearable = $clearable;

        return $this;
    }
}
