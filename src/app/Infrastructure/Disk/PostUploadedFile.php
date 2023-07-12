<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use Illuminate\Http\UploadedFile;

class PostUploadedFile implements PostUploadedFileRepositoryInterface
{
  public function saveThumbnail(UploadedFile $thumbnail): string 
  {
    return 'a';
  }

  /**
   * @param UploadedFile[] $image_list
   * @return string[]
   */
  public function saveMultiImage(array $image_list): array
  {
    return ['a', 'b'];
  }
}
