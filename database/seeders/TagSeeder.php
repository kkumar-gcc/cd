<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \Cviebrock\EloquentSluggable\Services\SlugService;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'javascript' => 'theme-rose',
            'python' => 'theme-rose',
            'java' => 'theme-rose',
            'c#' => 'theme-rose',
            'php' => 'theme-rose',
            'android' => 'theme-rose',
            'html' => 'theme-rose',
            'jquery' => 'theme-rose',
            'laravel' => 'theme-rose',
            'c++' => 'theme-rose',
            'css' => 'theme-rose',
            'ios' => 'theme-rose',
            'mysql' => 'theme-rose',
            'sql' => 'theme-rose',
            'node.js' => 'theme-rose',
            'reactjs' => 'theme-rose',
            'arrays' => 'theme-rose'
        ];

        foreach ($tags as $key => $value) {
            $tag = new Tag(
                [
                    'title' => $key,
                    'color' => $value,
                    'slug'=>SlugService::createSlug(Tag::class, 'slug', $key),
                ]
            );
            $tag->save();
        }
    }
}
