<?php declare(strict_types=1);

namespace App\Domain\Repository;

use Illuminate\Http\UploadedFile;
use App\Domain\Result\FileUploadResult;

interface PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return FileUploadResult
   */
  public function save(UploadedFile $thumbnail): FileUploadResult;

  /**
   * @param UploadedFile[] $image_list
   * @return FileUploadResult[]
   */
  public function saveList(array $image_list): array;
}
