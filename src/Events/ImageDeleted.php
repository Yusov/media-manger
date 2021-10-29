<?php

declare(strict_types=1);

namespace MediaManager\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use MediaManager\Config\ConfiguratorInterface;

class ImageDeleted
{
    use Dispatchable;
    use SerializesModels;

    public Model $imageModel;
    public ConfiguratorInterface $configurator;

    public function __construct(Model $contextModel, ConfiguratorInterface $configurator)
    {
        $this->imageModel = $contextModel;
        $this->configurator = $configurator;
    }
}