<?php declare(strict_types=1);

namespace App\Domain\Repository;

use Illuminate\Http\UploadedFile;
use App\Domain\Dto\UploadFileDto;
use App\Util\UploadFileDtoList;

interface PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return UploadFileDto
   */
  public function save(UploadedFile $thumbnail): UploadFileDto;

  /**
   * @param UploadedFile[] $image_list
   * @return UploloadFileDtoList
   */
  public function saveList(array $image_list): UploadFileDtoList;
}
