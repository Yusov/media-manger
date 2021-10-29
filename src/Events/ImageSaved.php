<?php

declare(strict_types=1);

namespace MediaManager\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MediaManager\Config\ConfiguratorInterface;

class ImageSaved
{
    use Dispatchable;
    use SerializesModels;

    public Model $contextModel;
    public ConfiguratorInterface $configurator;
    public string $filePath;
    public string $fileName;
    public string $extension;

    public function __construct(
        Model $contextModel,
        ConfiguratorInterface $configurator,
        string $filePath,
        string $fileName,
        string $extension
    ) {
        $this->contextModel = $contextModel;
        $this->configurator = $configurator;
        $this->filePath = $filePath;
        $this->fileName = $fileName;
        $this->extension = $extension;
    }
}