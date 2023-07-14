<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use Illuminate\Http\UploadedFile;
use App\Domain\Dto\UploadFileDto;
use App\Util\UploadFileDtoList;

class PostUploadedFileRepository implements PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return UploadFileDto
   */
  public function save(UploadedFile $thumbnail): UploadFileDto
  {
    $file_name = $thumbnail->getClientOriginalName();
    $saved_success = $thumbnail->storeAs('public/images', $file_name);

    $saved_file_path = 'images/' . $file_name;
    if ($saved_success) return new UploadFileDto(file_name: $file_name, file_path: $saved_file_path, upload_success: true);
    return new UploadFileDto(file_name: $file_name, file_path: null, upload_success: false);
  }

  /**
   * @param UploadedFile[] $image_list
   * @return UploadFileDtoList
   */
  public function saveList(array $image_list): UploadFileDtoList
  {
    $save_result_list = [];
    foreach($image_list as $image){
      $file_name = $image->getClientOriginalName();
      $saved_success = $image->storeAs('public/images', $file_name);

      $saved_file_path = 'images/' . $file_name;
      if ($saved_success) {
        $save_result_list[] = new UploadFileDto(file_name: $file_name, file_path: $saved_file_path, upload_success: true);
      } else {
        $save_result_list[] = new UploadFileDto(file_name: $file_name, file_path: null, upload_success: false);
      }
    }

    return new UploadFileDtoList($save_result_list);
  }
}
