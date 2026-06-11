# myFirstWeb

大学生向けコミュニティサイト。フォーラム機能とAIを使った日本語文体チェッカーを備えたLaravelアプリケーション。

## 機能

- **フォーラム** — 投稿・返信・編集・削除（投稿者本人のみ）
- **GitHub認証** — Laravel Socialite を使ったOAuthログイン
- **文体チェッカー** — レポートの日本語文体をAIが分析・修正提案

## 使用技術

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?logo=tailwindcss&logoColor=white)

| カテゴリ | 技術 |
|----------|------|
| バックエンド | PHP 8.3 / Laravel 13 |
| フロントエンド | Blade / Tailwind CSS / Vite |
| 認証 | Laravel Socialite (GitHub OAuth) |
| AI | Laravel AI (`laravel/ai`) / Gemini |
| テスト | Pest |

## セットアップ

### 必要な環境

- PHP 8.3 以上
- Composer
- Node.js 18 以上
- Git
- プロジェクトリーダーはHerdを使用してセットアップしている。

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

### 7. フロントエンドをビルド

```bash
npm run build
```

### 8. 起動

```bash
composer run dev
```

`http://localhost:8000` でアクセスできます。

## テスト

```bash
composer run test
```
