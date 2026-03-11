<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class InvalidBackupFormatException extends Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("Invalid JSON format in backup file: {$filePath}");
    }
}
