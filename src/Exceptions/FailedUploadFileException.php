<?php

declare(strict_types=1);

namespace MediaManager\Exceptions;

class FailedUploadFileException extends \RuntimeException
{
    protected $message = 'Failed uploading file';
}