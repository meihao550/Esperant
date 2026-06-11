<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 外部キー制約を一時的に無効化してトランケート（SQLite/MySQL 両対応）
        DB::statement('PRAGMA foreign_keys = OFF');
        Reply::truncate();
        Forum::truncate();
        User::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        $this->call([
            UserSeeder::class,
            ForumSeeder::class,
            ReplySeeder::class,
        ]);
    }
}
