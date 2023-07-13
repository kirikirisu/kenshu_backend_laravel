<?php declare(strict_types=1);

namespace App\Infrastructure\Disk;

use App\Domain\Repository\PostUploadedFileRepositoryInterface;
use Illuminate\Http\UploadedFile;
use App\Domain\Result\FileUploadResult;

class PostUploadedFileRepository implements PostUploadedFileRepositoryInterface
{
  /**
   * @param UploadedFile $thumbnail
   * @return FileUploadResult
   */
  public function save(UploadedFile $thumbnail): FileUploadResult
  {
    $file_name = $thumbnail->getClientOriginalName();
    $saved_file_path = $thumbnail->storeAs('', $file_name);

    if (!$saved_file_path) $save_result_list[] = new FileUploadResult(file_name: $file_name, saved_file_path: null, status: false);
    return new FileUploadResult(file_name: $file_name, saved_file_path: $saved_file_path, status: true);
  }

  /**
   * @param UploadedFile[] $image_list
   * @return FileUploadResult[]
   */
  public function saveList(array $image_list): array
  {
    $save_result_list = [];
    foreach($image_list as $image){
      $file_name = $image->getClientOriginalName();
      $saved_file_path = $image->storeAs('', $file_name);

      if (!$saved_file_path) $save_result_list[] = new FileUploadResult(file_name: $file_name, saved_file_path: null, status: false);
      $save_result_list[] = new FileUploadResult(file_name: $file_name, saved_file_path: $saved_file_path, status: true);
    }

    return $save_result_list;
  }
}
