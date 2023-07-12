<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use Illuminate\Http\UploadedFile;

class PostUploadedFile implements PostUploadedFileRepositoryInterface
{
  public function save(UploadedFile $thumbnail): string 
  {
    return 'a';
  }

  /**
   * @param UploadedFile[] $image_list
   * @return string[]
   */
  public function saveList(array $image_list): array
  {
    return ['a', 'b'];
  }
}
