<?php declare(strict_types=1);

namespace App\Domain\Shared;

use App\Domain\Dto\FileUploadDto;

class UploadFileResultList
{
    /**
     * @param FileUploadDto[] $file_list
     * @return bool
     */
    public static function isSuccess(array $file_list): bool
    {
        foreach($file_list as $file)
        {
            if ($file->upload_success) return false;
        }

        return true;
    }

    /**
     * @param FileUploadDto[] $file_list
     * @return FileUploadDto[]
     */
    public static function getUploadedFile(array $file_list): array
    {
        $uploaded_file = [];

        foreach($file_list as $file)
        {
            if ($file->upload_success) $uploaded_file[] = $file;
        }

        return $uploaded_file;
    }
}
