# Esperant

大学生向けコミュニティサイト。フォーラム機能とAIを使った日本語文体チェッカーを備えたLaravelアプリケーション。

## 機能

- **フォーラム** — 投稿・返信・編集・削除（投稿者本人のみ）
- **GitHub認証** — Laravel Socialite を使ったOAuthログイン
- **文体チェッカー** — レポートの日本語文体をAIが分析・修正提案

## 使用技術

### バックエンド
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-2-885630?logo=composer&logoColor=white)

### フロントエンド
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwindcss&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?logo=vite&logoColor=white)
![Node.js](https://img.shields.io/badge/Node.js-24-5FA04E?logo=nodedotjs&logoColor=white)

### 認証・AI・DB
![GitHub OAuth](https://img.shields.io/badge/GitHub_OAuth-181717?logo=github&logoColor=white)
![Gemini](https://img.shields.io/badge/Gemini_AI-8E75B2?logo=googlegemini&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-003B57?logo=sqlite&logoColor=white)

### 開発ツール
![Herd](https://img.shields.io/badge/Laravel_Herd-FF2D20?logo=laravel&logoColor=white)
![Pest](https://img.shields.io/badge/Pest-PHP_Testing-F19D38?logo=php&logoColor=white)
![Pint](https://img.shields.io/badge/Laravel_Pint-Linter-FF2D20?logo=laravel&logoColor=white)

---

| カテゴリ | 技術・ライブラリ | 用途 |
|----------|----------------|------|
| バックエンド | PHP 8.3 / Laravel 13 | アプリケーション本体 |
| フロントエンド | Blade / Tailwind CSS / Vite | UIテンプレート・スタイリング・バンドル |
| 認証 | Laravel Socialite 5 | GitHub OAuthログイン |
| AI | Laravel AI 0.7 / Gemini | 日本語文体チェック |
| DB | SQLite | データ永続化 |
| ローカル開発 | Laravel Herd | ローカルサーバー・PHP管理 |
| コード品質 | Laravel Pint | コードフォーマッター |
| テスト | Pest 4 / Faker | 自動テスト・ダミーデータ生成 |

## セットアップ

Laravel Herdをインストールすれば、以下のComposer、PHPなどインストールしてくれるのでおすすめ。
### 必要な環境

- PHP 8.3 以上
- Composer
- Node.js 18 以上
- Git

### 1. リポジトリをクローン

```bash
git clone <リポジトリURL>
cd myFirstWeb
```

### 2. 依存パッケージをインストール

```bash
composer install
npm install
```

### 3. 環境設定ファイルを作成

```bash
cp .env.example .env
php artisan key:generate
```

### 4. GitHub OAuth アプリを作成

1. [GitHub Developer Settings](https://github.com/settings/developers) を開く
2. **New OAuth App** をクリック
3. 以下を入力：
   - **Homepage URL**: `http://localhost:8000`
   - **Authorization callback URL**: `http://localhost:8000/auth/callback`
4. 発行された **Client ID** と **Client Secret** を `.env` に設定：

```env
GITHUB_CLIENT_ID=your_client_id
GITHUB_CLIENT_SECRET=your_client_secret
GITHUB_REDIRECT_URL=http://localhost:8000/auth/callback
```

### 5. Gemini API キーを取得

1. [Google AI Studio](https://aistudio.google.com/apikey) でAPIキーを発行
2. `.env` に設定：

```env
GEMINI_API_KEY=your_api_key
```

### 6. データベースをセットアップ

```bash
touch database/database.sqlite
php artisan migrate
```

### 8. 起動

```bash
composer run dev
```

`http://localhost:8000` でアクセスできます。

> **Windows ユーザーへ**
> このプロジェクトは Mac 環境で開発されています。`composer run dev` は内部で Laravel Pail を使用しており、Pail が依存する `pcntl` PHP 拡張が Windows では利用できないためエラーが発生します。
> Windows の場合は以下のコマンドをそれぞれ別のターミナルで実行してください。
>
> ```bash
> php artisan serve
> php artisan queue:listen --tries=1 --timeout=0
> ```
>
> または [WSL2](https://learn.microsoft.com/ja-jp/windows/wsl/install) 上で実行することを推奨します。

## テスト

```bash
composer run test
```

## シードデータ
php artisan db:seed
このコマンド一つでアカウント情報、掲示板の投稿、返信のシーダーを実行できる。