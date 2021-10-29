<?php

declare(strict_types=1);

namespace MediaManager\Exceptions;

use Throwable;

class ExtensionFileException extends \RuntimeException
{
    protected $message = 'Unsupported file extension: {e}';

    public function __construct(string $extension, $message = '', $code = 0, Throwable $previous = null)
    {
        $message = $message ?? strtr($this->message, '{e}', $extension);

        parent::__construct($message, $code, $previous);
    }
}