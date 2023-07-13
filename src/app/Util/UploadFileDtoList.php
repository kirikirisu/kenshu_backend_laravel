<?php declare(strict_types=1);

namespace App\Util;

use App\Domain\Dto\FileUploadDto;

class UploadFileDtoList
{
    /**
     * @param FileUploadDto[] $upload_file_result_list 
     */
    public function __construct(
        public array $upload_file_result_list)
    {
    }

    public function isAllSuccess(): bool
    {
        foreach($this->upload_file_result_list as $file)
        {
            if ($file->upload_success) return false;
        }

        return true;
    }

    /**
     * @return FileUploadDto[]
     */
    public function getUploadedFile(): array
    {
        $uploaded_file = [];

        foreach($this->upload_file_result_list as $file)
        {
            if ($file->upload_success) $uploaded_file[] = $file;
        }

        return $uploaded_file;
    }
}
