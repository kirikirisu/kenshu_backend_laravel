<?php declare(strict_types=1);

namespace App\Domain\Repository;

use Illuminate\Http\UploadedFile;

interface PostImageBinaryInterface
{
  public function saveThumbnail(UploadedFile $thumbnail): string;

  /**
   * @param UploadedFile[]
   * @return string[]
   */
  public function saveMultiImage(array $image_list): array;
}
