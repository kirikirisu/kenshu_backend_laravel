<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $body
 * @property string $thumbnail_url
 */
class Post extends Model
{
    use HasUuids, HasFactory;

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    protected $fillable = ['id', 'user_id', 'title', 'body', 'thumbnail_url'];
}
