<?php declare(strict_types=1);

namespace App\Domain\Dto;

readonly class FileUploadDto
{
    public function __construct(
        public string $file_name,
        public ?string $file_path,
        public bool $upload_success)
    {
    }
}
