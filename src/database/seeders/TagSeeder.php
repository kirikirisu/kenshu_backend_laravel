<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tagList = ['総合', 'テクノロジー', 'モバイル', 'アプリ', 'エンタメ', 'ビューティー', 'ファッション', 'ライフスタイル', 'ビジネス', 'グルメ', 'スポーツ'];

        foreach ($tagList as $tag){
           Tag::create([
                'name' => $tag
            ]);
        }
    }
}
