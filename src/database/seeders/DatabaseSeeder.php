<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
