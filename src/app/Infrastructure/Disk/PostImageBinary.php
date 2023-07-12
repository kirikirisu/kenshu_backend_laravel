<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostImageBinaryInterface;
use Illuminate\Http\UploadedFile;

class PostImageBinary implements PostImageBinaryInterface 
{
  public function saveThumbnail(UploadedFile $thumbnail): string 
  {
    return 'a';
  }

  /**
   * @param UploadedFile[]
   * @return string[]
   */
  public function saveMultiImage(array $image_list): array
  {
    return ['a', 'b'];
  }
}
