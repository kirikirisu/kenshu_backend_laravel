<?php declare(strict_types=1);

namespace App\Domain\Dto;

use Illuminate\Http\UploadedFile;

readonly class CreatePostDto 
{
    /**
     * @param string $user_id 
     * @param string $title
     * @param string $body
     * @param UploadedFile $thumbnail
     * @param UploadedFile[] $images
     */
    public function __construct(
        public string $user_id,
        public string $title,
        public string $body,
        public UploadedFile $thumbnail,
        public array $images)
    {
    }
}
