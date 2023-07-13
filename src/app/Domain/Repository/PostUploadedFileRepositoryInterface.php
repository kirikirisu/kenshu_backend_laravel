<?php declare(strict_types=1);

namespace App\Domain\Repository;

use Illuminate\Http\UploadedFile;

interface PostUploadedFileRepositoryInterface
{
  public function save(UploadedFile $thumbnail): string;

  /**
   * @param UploadedFile[] $image_list
   * @return string[]
   */
  public function saveList(array $image_list): array;
}
