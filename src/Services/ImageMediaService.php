<?php

declare(strict_types=1);

namespace MediaManager\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use MediaManager\Config\ConfiguratorInterface;
use MediaManager\Events\ImageDeleted;
use MediaManager\Events\ImageSaved;
use MediaManager\Exceptions\ExtensionFileException;
use MediaManager\WithPreparingFile;
use MediaManager\MediaServiceInterface;
use MediaManager\Processors\ImageProcessor;
use MediaManager\Storage\StorageInterface;

class ImageMediaService implements MediaServiceInterface
{
    use WithPreparingFile;

    private ImageProcessor $processor;
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->processor = new ImageProcessor();
    }

    /**
     * {@inheritdoc}
     */
    public function upload(ConfiguratorInterface $configurator, Model $model, UploadedFile $file): ?string
    {
        if (!\in_array($file->getMimeType(), $configurator->getPermittedMimes(), true)) {
            throw new ExtensionFileException($file->getMimeType());
        }
        //TODO refactor

        $fileName = $this->createFileName((string)$model->id);

        $fileName = $configurator->prepareFilePath();


        //Store original file
        $stored = $this->storage->save(
            $pathToSave
            .
            $this->buildFileName($fileName, ConfiguratorInterface::MEDIA_ORIGINAL_DPI, $file->guessExtension()),
            $this->processor->encodeFromFile($file)
        );

        if (!$stored) {
            return null;
        }

        ImageSaved::dispatch(
            $model,
            $configurator,
            $pathToSave,
            $fileName,
            $file->guessExtension(),
        );

        return $fileName;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ConfiguratorInterface $configurator, Model $model): void
    {
        ImageDeleted::dispatch($model, $configurator);
    }
}
