<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Domain\Shared\UploadFileResultList;
use App\Domain\Dto\FileUploadDto;

class UploadFileResultListTest extends TestCase
{
    public function test_一つでもアップロードが失敗しているとfalseを返すこと(): void
    {
        $result = UploadFileResultList::isSuccess([
           new FileUploadDto(file_name: 'thumbnail.png', file_path: 'public/images/thumbnail.png', upload_success: true),
           new FileUploadDto(file_name: 'thumbnail1.png', file_path: 'public/images/thumbnail1.png', upload_success: true),
           new FileUploadDto(file_name: 'thumbnail2.png', file_path: 'public/images/thumbnail2.png', upload_success: true),
           new FileUploadDto(file_name: 'thumbnail3.png', file_path: 'public/images/thumbnail3.png', upload_success: false),
        ]);

        $this->assertFalse($result);
    }

    public function test_アップロードに成功したファイルのみ返すこと(): void
    {
        $result = UploadFileResultList::getUploadedFile([
           new FileUploadDto(file_name: 'thumbnail1.png', file_path: 'public/images/thumbnail1.png', upload_success: false),
           new FileUploadDto(file_name: 'thumbnail2.png', file_path: 'public/images/thumbnail2.png', upload_success: true),
           new FileUploadDto(file_name: 'thumbnail3.png', file_path: 'public/images/thumbnail3.png', upload_success: false),
           new FileUploadDto(file_name: 'thumbnail4.png', file_path: 'public/images/thumbnail4.png', upload_success: true),
           new FileUploadDto(file_name: 'thumbnail5.png', file_path: 'public/images/thumbnail5.png', upload_success: true),
        ]);

        $this->assertEquals(count($result), 3);
    }
}
