<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $user_id
 * @property string $title
 * @property string $body
 * @property string $thumbnail
 */
class Post extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'user_id', 'title', 'body', 'thumbnail'];
}
