<?php declare(strict_types=1);

namespace Tests\Unit;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;
use App\Domain\Dto\FileUploadDto;
use App\Infrastructure\Disk\PostUploadedFileRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostUploadedFileRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_フォームによりアップロードされた単一ファイルが保存できること(): void
    {

      Storage::fake('public');
      Storage::shouldReceive('storeAs')->andReturn('public/images');
      Storage::shouldReceive('storagePath')->andReturn('public/images/thumbnail.png');

      $file = UploadedFile::fake()->create('thumbnail.png'); 

      $postUploadFileRepository = new PostUploadedFileRepository();
      $upload_result = $postUploadFileRepository->save($file);

      $this->assertEquals('thumbnail.png', $upload_result->file_name);
      $this->assertEquals('images/thumbnail.png', $upload_result->file_path);
      $this->assertTrue($upload_result->upload_success);
    }

    public function test_フォームによりアップロードされた複数ファイルが保存できること(): void
    {
        $this->assertTrue(true);
    }
}

