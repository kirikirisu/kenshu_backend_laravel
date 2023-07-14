<?php declare(strict_types=1);
/** @noinspection NonAsciiCharacters */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Util\UploadFileDtoList;
use App\Domain\Dto\UploadFileDto;
use GuzzleHttp\Psr7\UploadedFile;

class UploadFileResultListTest extends TestCase
{
    public function test_一つでもアップロードが失敗しているとfalseを返すこと(): void
    {
        $uploadFileDtoList = new UploadFileDtoList([
           new UploadFileDto(file_name: 'thumbnail.png', file_path: 'public/images/thumbnail.png', upload_success: true),
           new UploadFileDto(file_name: 'thumbnail1.png', file_path: 'public/images/thumbnail1.png', upload_success: true),
           new UploadFileDto(file_name: 'thumbnail2.png', file_path: 'public/images/thumbnail2.png', upload_success: true),
           new UploadFileDto(file_name: 'thumbnail3.png', file_path: 'public/images/thumbnail3.png', upload_success: false),
        ]);

        $this->assertFalse($uploadFileDtoList->isAllSuccess());
    }

    public function test_アップロードに成功したファイルのみ返すこと(): void
    {
        $uploadFileDtoList = new UploadFileDtoList([
           new UploadFileDto(file_name: 'thumbnail1.png', file_path: 'public/images/thumbnail1.png', upload_success: false),
           new UploadFileDto(file_name: 'thumbnail2.png', file_path: 'public/images/thumbnail2.png', upload_success: true),
           new UploadFileDto(file_name: 'thumbnail3.png', file_path: 'public/images/thumbnail3.png', upload_success: false),
           new UploadFileDto(file_name: 'thumbnail4.png', file_path: 'public/images/thumbnail4.png', upload_success: true),
           new UploadFileDto(file_name: 'thumbnail5.png', file_path: 'public/images/thumbnail5.png', upload_success: true),
        ]);

        $result = $uploadFileDtoList->getUploadedFile();

        $this->assertEquals(count($result), 3);
    }
}
