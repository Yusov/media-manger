<?php

declare(strict_types=1);

namespace MediaManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use MediaManager\Config\ConfiguratorInterface;

interface MediaServiceInterface
{
    /**
     * @param  ConfiguratorInterface  $configurator
     * @param  Model  $model
     * @param  UploadedFile  $file
     *
     * @return string|null
     */
    public function upload(ConfiguratorInterface $configurator, Model $model, UploadedFile $file): ?string;

    /**
     * @param  ConfiguratorInterface  $configurator
     * @param  Model  $model
     *
     * @return void
     */
    public function delete(ConfiguratorInterface $configurator, Model $model): void;
}