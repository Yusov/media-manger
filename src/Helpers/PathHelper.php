<?php

declare(strict_types=1);

namespace MediaManager\Helpers;

final class PathHelper
{
    /**
     * @param  array|null  $imageData
     * @param  string  $dpi
     * @param  string|null  $root
     *
     * @return string
     */
    public static function prepareFullResourceUrl(
        ?array $imageData = null,
        string $dpi = 'mid',
        ?string $root = null
    ): string {
        if (!$imageData) {
            return '';
        }

        $path = $root ? $root.DIRECTORY_SEPARATOR : config('filesystems.disks.public.url').DIRECTORY_SEPARATOR;

        if (isset($imageData['entity_type'])) {
            $path .= $imageData['entity_type'].'s'.DIRECTORY_SEPARATOR;
        }

        if (isset($imageData['entity_id'])) {
            $path .= $imageData['entity_id'].DIRECTORY_SEPARATOR;
        }

        if ($imageData['type']) {
            $path .= $imageData['type'].'s'.DIRECTORY_SEPARATOR;
        }

        if (isset($imageData['filename'])) {
            $path .= $imageData['filename'];
        }

        $path .= '_'.$dpi;

        if (isset($imageData['extension'])) {
            $path .= '.'.$imageData['extension'];
        }

        return $path;
    }
}