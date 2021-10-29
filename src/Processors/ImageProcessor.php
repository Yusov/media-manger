<?php

declare(strict_types=1);

namespace MediaManager\Processors;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Intervention\Image\Image as IImage;
use MediaManager\Config\ConfiguratorInterface;
use Ramsey\Uuid\Uuid;

class ImageProcessor
{
    /**
     * @param  File  $file
     * @param  ConfiguratorInterface  $configurator
     * @param  string  $dpi
     *
     * @return IImage
     */
    public function resize(File $file, ConfiguratorInterface $configurator, string $dpi): IImage
    {
        return Image::make($file->getPathname())
            ->resize(
                $configurator->getWidth($dpi),
                $configurator->getHeight($dpi)
            )->encode(
                $file->extension()
            );
    }

    /**
     * @param UploadedFile $file
     *
     * @return IImage
     */
    public function encodeFromFile(UploadedFile $file): IImage
    {
        return Image::make($file->getRealPath())
            ->encode($file->extension());
    }

    /**
     * Hydrate base64 image into the File object.
     *
     * @param  string  $base64File
     *
     * @return File
     * @throws \Exception
     */
    public function fromBase64toFile(string $base64File): File
    {
        $tmpFilePath = sys_get_temp_dir().'/'.Uuid::uuid4()->toString();

        $fileParts = explode(';base64,', $base64File);
        $fileTypeAux = explode('image/', $fileParts[0]);
        $fileType = $fileTypeAux[1];
        $fileData = base64_decode($fileParts[1]);

        $tmpFilename = "{$tmpFilePath}.{$fileType}";

        file_put_contents($tmpFilename, $fileData);

        return new File($tmpFilename);
    }

    /**
     * @param resource $stream
     *
     * @return File
     */
    public function fileFromStream($stream): File
    {
        return new File(stream_get_meta_data($stream)['uri']);
    }
}