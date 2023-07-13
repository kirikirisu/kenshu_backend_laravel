<?php declare(strict_types=1);

namespace App\Domain\Result;

readonly class FileUploadResult
{
    public function __construct(
        public string $file_name,
        public ?string $saved_file_path,
        public bool $status)
    {
    }
}
