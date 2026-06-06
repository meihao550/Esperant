<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Forum;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'author' => 'Alice',
                'title' => 'Laravelの基本',
                'content' => 'LaravelはPHPのフレームワークで、Webアプリケーション開発を効率化します。',
            ],
            [
                'author' => 'Bob',
                'title' => 'Eloquent ORMの使い方',
                'content' => 'EloquentはLaravelのORMで、データベース操作を簡単に行えます。',
            ]
        ];

        foreach ($posts as $post) {
            Forum::create($post); 
        }
    }
}
