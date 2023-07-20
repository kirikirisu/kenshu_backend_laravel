<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Dto\UploadFileDto;
use Illuminate\Support\Str;

/**
 * @property string $post_id
 * @property string $url
 */
class Image extends Model
{
    use HasUuids;

    protected $fillable = ['post_id', 'url'];

    /**
     * @return BelongsTo<Post, Image>
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @param string $post_id 
     * @param UploadFileDto[] $uploaded_image_list
     */
    public static function bulkInsert(string $post_id, array $uploaded_image_list): void 
    {
        $image_payload_list = [];
        foreach($uploaded_image_list as $image_result) {
            $image_payload_list[] = [
                'id' => Str::uuid(),
                'post_id' => $post_id,
                'url' => (string)$image_result->file_path
            ]; 
        }

        Image::insert($image_payload_list);
    }
}
