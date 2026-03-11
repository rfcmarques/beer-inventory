<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class BackupFileNotFoundException extends Exception
{
    public function __construct(string $filePath)
    {
        parent::__construct("Backup file not found: {$filePath}");
    }
}
