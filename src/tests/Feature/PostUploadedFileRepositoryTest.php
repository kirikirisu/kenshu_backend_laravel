<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Infrastructure\Disk\PostUploadedFileRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostUploadedFileRepositoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
    }

    public function test_フォームによりアップロードされた単一ファイルが保存できること(): void
    {
      $file = UploadedFile::fake()->image('thumbnail.png');
      $postUploadFileRepository = new PostUploadedFileRepository();
      $upload_result = $postUploadFileRepository->save($file);

      Storage::disk('local')->exists('thumbnail.png');
      $this->assertEquals('thumbnail.png', $upload_result->file_name);
      $this->assertEquals('images/thumbnail.png', $upload_result->file_path);
      $this->assertTrue($upload_result->upload_success);
    }

    public function test_フォームによりアップロードされた複数ファイルが保存できること(): void
    {
      $files = [
        UploadedFile::fake()->image('thumbnail1.png'),
        UploadedFile::fake()->image('thumbnail2.png'),
        UploadedFile::fake()->image('thumbnail3.png'),
      ];
      $postUploadFileRepository = new PostUploadedFileRepository();
      $upload_result_list = $postUploadFileRepository->saveList($files);

      foreach($upload_result_list as $i => $upload_result) {
        $file_name = 'thumbnail'. $i + 1 . '.png';

        Storage::disk('local')->exists($file_name);
        $this->assertEquals($file_name, $upload_result->file_name);
        $this->assertEquals('images/'.$file_name, $upload_result->file_path);
        $this->assertTrue($upload_result->upload_success);
      }
    }
}
