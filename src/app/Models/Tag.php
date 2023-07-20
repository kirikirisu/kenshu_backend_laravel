<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasUuids;

    /**
     * @return BelongsToMany<Post>
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tag) 
        {
            $tag->posts()->detach();
        });
    }

    protected $fillable = ['name'];
}
