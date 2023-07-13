<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use Illuminate\Http\UploadedFile;
use App\Domain\Dto\FileUploadDto;

class PostUploadedFileRepository implements PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return FileUploadDto
   */
  public function save(UploadedFile $thumbnail): FileUploadDto 
  {
    $file_name = $thumbnail->getClientOriginalName();
    $saved_success = $thumbnail->storeAs('public/images', $file_name);

    $saved_file_path = 'images/' . $file_name;
    if (!$saved_success) $save_result_list[] = new FileUploadDto(file_name: $file_name, saved_file_path: null, status: false);
    return new FileUploadDto(file_name: $file_name, saved_file_path: $saved_file_path, status: true);
  }

  /**
   * @param UploadedFile[] $image_list
   * @return FileUploadDto[]
   */
  public function saveList(array $image_list): array
  {
    $save_result_list = [];
    foreach($image_list as $image){
      $file_name = $image->getClientOriginalName();
      $saved_success = $image->storeAs('public/images', $file_name);

      $saved_file_path = 'images/' . $file_name;
      if (!$saved_success) $save_result_list[] = new FileUploadDto(file_name: $file_name, saved_file_path: null, status: false);
      $save_result_list[] = new FileUploadDto(file_name: $file_name, saved_file_path: $saved_file_path, status: true);
    }

    return $save_result_list;
  }
}
