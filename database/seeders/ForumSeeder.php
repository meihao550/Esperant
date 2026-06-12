<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'author' => 'Alice Tanaka',
                'title' => 'Laravelの基本',
                'content' => 'LaravelはPHPのフレームワークで、MVCアーキテクチャに基づいたWebアプリケーション開発を効率化します。ルーティング、Eloquent ORM、Bladeテンプレートなど豊富な機能が揃っています。',
            ],
            [
                'author' => 'Bob Suzuki',
                'title' => 'Eloquent ORMの使い方',
                'content' => 'EloquentはLaravelのORMで、データベース操作をオブジェクト指向で簡単に行えます。リレーション（hasMany、belongsTo など）を定義するだけで JOIN を意識せずにデータを取得できます。',
            ],
            [
                'author' => 'Carol Yamada',
                'title' => 'Viteでフロントエンドをビルドする',
                'content' => 'Laravel 9 以降は Vite が標準バンドラーになりました。HMR（ホットモジュールリプレースメント）が高速で、Tailwind CSS との組み合わせも快適です。vite.config.js の設定ポイントをまとめました。',
            ],
            [
                'author' => 'Dave Sato',
                'title' => 'GitHub OAuthでソーシャルログインを実装',
                'content' => 'Laravel Socialite を使うと GitHub などの OAuth プロバイダーを数行で組み込めます。コールバック URL の設定や `user()` から取得できる情報（name, email, avatar）についてまとめます。',
            ],
            [
                'author' => 'Eve Watanabe',
                'title' => 'Tailwind CSS のユーティリティクラスまとめ',
                'content' => 'flex、grid、spacing、typography など頻出クラスを整理しました。dark: プレフィックスによるダークモード対応や @apply を使ったコンポーネント抽出も実用的です。',
            ],
            [
                'author' => 'Alice Tanaka',
                'title' => 'AIを使った日本語文体チェックの実装',
                'content' => 'Gemini API を Laravel から呼び出して、レポートの文体を自動チェックする機能を作りました。プロンプト設計のコツと、ストリーミングレスポンスの扱い方を共有します。',
            ],
            [
                'author' => 'Bob Suzuki',
                'title' => 'Pest でテストを書こう',
                'content' => 'Pest は PHPUnit ラッパーで、シンプルな記法でテストが書けます。`it()` / `expect()` の組み合わせが直感的で、Feature テストと Unit テストの使い分けについても解説します。',
            ],
            [
                'author' => 'Carol Yamada',
                'title' => 'SQLite を開発 DB として使う利点と注意点',
                'content' => 'SQLite はファイル1つで動くため CI やローカル開発に便利です。ただし PRAGMA foreign_keys や一部の ALTER TABLE は MySQL と挙動が異なるため、本番 MySQL との差異に注意が必要です。',
            ],
        ];

        foreach ($posts as $post) {
            Forum::create($post);
        }
    }
}
