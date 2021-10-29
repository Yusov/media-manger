<?php

declare(strict_types=1);

namespace MediaManager;

use Illuminate\Database\Eloquent\Model;

trait WithPreparingFile
{
    /**
     * Prepare file name from dpi and name if exists.
     *
     * @param  string|null  $name
     *
     * @return string
     */
    private function createFileName(?string $name = null): string
    {
        if (!$name) {
            return uniqid('', true);
        }

        return md5($name . time());
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    private function getExtensionFromName(string $fileName): string
    {
        return substr($fileName, strpos($fileName, '.'.'') + 1);
    }

    /**
     * @param  string  $fileName
     * @param  string  $start
     * @param  string  $end
     *
     * @return string
     */
    private function getDpiFromName(string $fileName, string $start = '_', string $end = '.'): string
    {
        $subStringStart = strpos($fileName, $start);
        $subStringStart += \strlen($start);
        $size = strpos($fileName, $end, $subStringStart) - $subStringStart;

        return substr($fileName, $subStringStart, $size);
    }

    /**
     * @param  string  $fileName
     *
     * @return string
     */
    private function getFileName(string $fileName): string
    {
        return  substr($fileName, 0,  strpos($fileName, '_'));
    }

    /**
     * Prepare the full path likewise public/concerns/{id}/{type(images/videos)/?{category(banner/thumb etc.)}/file.
     *
     * @param  Model  $model
     * @param  string  $type
     * @param  string|null  $category
     * @param  string  $storage public or storage
     *
     * @return string
     */
    private function preparedPath(Model $model, string $type, ?string $category = null, string $storage = 'public'): string
    {
        $nameSpaceContext = explode("\\", \get_class($model));
        $root = $storage.'/'.strtolower(array_pop($nameSpaceContext));
        $path = $root.'s/'.(string)$model->id.'/'.$type.'s/';

        return $category ? $path.$category.'/' : $path;
    }

    /**
     * @param  string  $name
     * @param  string  $dpiSize
     * @param  string  $extension
     *
     * @return string
     */
    private function buildFileName(string $name, string $dpiSize, string $extension): string
    {
        return $name.'_'.$dpiSize.'.'.$extension;
    }
}