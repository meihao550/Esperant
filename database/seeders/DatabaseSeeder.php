<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 外部キー制約を一時的に無効化してトランケート（SQLite/MySQL 両対応）
        Schema::disableForeignKeyConstraints();
        Reply::truncate();
        Forum::truncate();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call([
            UserSeeder::class,
            ForumSeeder::class,
            ReplySeeder::class,
        ]);
    }
}
