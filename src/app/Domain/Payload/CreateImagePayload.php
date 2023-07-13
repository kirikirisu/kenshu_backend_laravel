<?php declare(strict_types=1);

namespace App\Domain\Payload;

readonly class CreateImagePayload
{
    /**
     * @param string $post_id
     * @param string $url
     */
    public function __construct(
        public string $post_id,
        public string $url)
    {
    }
}
