<?php

declare(strict_types=1);

namespace MediaManager\Listeners;

use Illuminate\Http\File;
use MediaManager\Events\ImageSaved;
use MediaManager\Exceptions\FailedUploadFileException;
use MediaManager\Media\WithPreparingFile;
use MediaManager\Processors\ImageProcessor;
use MediaManager\Storage\StorageInterface;

class ImageSavedListener
{
    use WithPreparingFile;

    private StorageInterface $storage;
    private ImageProcessor $processor;

    public function __construct(StorageInterface $storage, ImageProcessor $processor)
    {
        $this->storage = $storage;
        $this->processor = $processor;
    }

    /**
     * @param  ImageSaved  $event
     */
    public function handle(ImageSaved $event): void
    {
        //Start cropping files
        $file = $this->initFile(
            $event->filePath,
            $event->fileName,
            $event->configurator::MEDIA_ORIGINAL_DPI,
            $event->extension
        );

        foreach ($event->configurator->getDpiSizes() as $dpiSize) {
            if (!
                $this->storage->save(
                    $event->filePath.'/'.$this->buildFileName($event->fileName, $dpiSize, $event->extension),
                    $this->processor->resize($file, $event->configurator, $dpiSize)
                )
            ) {
                throw new FailedUploadFileException();
            }
        }
    }

    /**
     * @param  string  $path
     * @param  string  $fileName
     * @param  string  $dpi
     * @param  string  $ext
     *
     * @return File
     */
    private function initFile(string $path, string $fileName, string $dpi, string $ext): File
    {
        $originalFilePath = $path.$fileName.'_'.$dpi.'.'.$ext;

        if (!$this->storage->exist($originalFilePath)) {
            throw new \RuntimeException('File not found in path: '.$originalFilePath);
        }

        return $this->processor->fileFromStream(
            $this->storage->openStream($originalFilePath)
        );
    }
}