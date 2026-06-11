<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Reply;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    public function run(): void
    {
        // forum_id は ForumSeeder 実行後の挿入順に依存するため title で引く
        $replies = [
            'Laravelの基本' => [
                ['author' => 'Dave Sato',    'content' => 'artisan コマンドも便利ですよね。`php artisan make:model` 一発でモデルが作れるのは助かります。'],
                ['author' => 'Eve Watanabe', 'content' => 'ミドルウェアの仕組みも分かりやすくて、認証チェックを一か所にまとめられるのが気に入っています。'],
            ],
            'Eloquent ORMの使い方' => [
                ['author' => 'Carol Yamada', 'content' => 'with() でイーガーロードを忘れると N+1 問題が起きやすいので注意が必要ですね。'],
                ['author' => 'Alice Tanaka', 'content' => 'スコープ（local scope）を使うとクエリの再利用がしやすくなっておすすめです。'],
            ],
            'Viteでフロントエンドをビルドする' => [
                ['author' => 'Bob Suzuki',   'content' => '`@vite` ディレクティブを Blade に書くだけで自動的に HMR が効くのは便利ですね。'],
                ['author' => 'Dave Sato',    'content' => 'ビルド後の manifest.json を確認するとアセットのハッシュが分かって、キャッシュバスティングも自動化されています。'],
            ],
            'GitHub OAuthでソーシャルログインを実装' => [
                ['author' => 'Eve Watanabe', 'content' => '初回ログイン時にユーザーを DB に upsert するパターンが実用的ですね。`updateOrCreate` が便利です。'],
                ['author' => 'Carol Yamada', 'content' => 'avatar URL を保存しておくとプロフィール画像をすぐ表示できて UX が上がりますよ。'],
            ],
            'Tailwind CSS のユーティリティクラスまとめ' => [
                ['author' => 'Alice Tanaka', 'content' => '`group` と `group-hover:` の組み合わせで親要素にホバーしたときの子要素スタイル変更が楽になります。'],
                ['author' => 'Bob Suzuki',   'content' => 'JIT モードが常時有効になったので、任意の値（`w-[123px]` など）も使えて便利です。'],
            ],
            'AIを使った日本語文体チェックの実装' => [
                ['author' => 'Dave Sato',    'content' => 'プロンプトに「敬体と常体が混在している箇所を指摘してください」と入れると精度が上がりました。'],
                ['author' => 'Eve Watanabe', 'content' => 'ストリーミングで少しずつ結果が表示されると体感速度が上がりますね。SSE の実装も試してみたいです。'],
            ],
            'Pest でテストを書こう' => [
                ['author' => 'Carol Yamada', 'content' => '`RefreshDatabase` トレイトと組み合わせると各テストが独立したデータで動くので安心です。'],
                ['author' => 'Alice Tanaka', 'content' => 'データセットを使うと同じテストを複数パターンで一気に回せて便利ですよ。'],
            ],
            'SQLite を開発 DB として使う利点と注意点' => [
                ['author' => 'Bob Suzuki',   'content' => 'テスト時は `:memory:` を使うとファイルへの書き込みなしで高速に回せます。'],
                ['author' => 'Dave Sato',    'content' => '`PRAGMA foreign_keys = ON` を忘れると外部キー制約が効かないのでマイグレーション後に確認するようにしています。'],
            ],
        ];

        foreach ($replies as $forumTitle => $posts) {
            $forum = Forum::where('title', $forumTitle)->first();
            if (! $forum) {
                continue;
            }
            foreach ($posts as $post) {
                Reply::create([...$post, 'forum_id' => $forum->id]);
            }
        }
    }
}
