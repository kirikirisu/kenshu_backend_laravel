<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    use HasUuids;

    protected $fillable = ['post_id', 'tag_id'];

    /**
     * @param string $post_id
     * @param string[] $tag_id_list
     */
    public static function bulkInsert(string $post_id, array $tag_id_list): void
    {
        $tag_payload_list = [];
        foreach($$tag_id_list as $tag_id) {
            $tag_payload_list[] = [
                'post_id' => $post_id,
                'tag_id' => $tag_id
            ];
        }

        PostTag::insert($tag_payload_list);
    }
}
