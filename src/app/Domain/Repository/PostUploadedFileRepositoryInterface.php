<?php declare(strict_types=1);

namespace App\Domain\Repository;

use Illuminate\Http\UploadedFile;
use App\Domain\Dto\FileUploadDto;

interface PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return FileUploadResult
   */
  public function save(UploadedFile $thumbnail): FileUploadDto;

  /**
   * @param UploadedFile[] $image_list
   * @return FileUploadDto[]
   */
  public function saveList(array $image_list): array;
}
