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

## Devcontainer での環境構築（推奨）

[Dev Container](https://containers.dev/) を使うと、PHP 8.4 / Node.js 22 / Composer / MySQL / Redis がすべてコンテナ内に揃った状態で開発を始められます。OS を問わず（Mac / Windows / Linux）同じ環境を再現でき、`pcntl` などの拡張も最初から有効です。

### 必要なもの

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)（Windows / Mac）または Docker Engine（Linux）
- [Visual Studio Code](https://code.visualstudio.com/)
- VS Code 拡張機能 [Dev Containers](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers)（`ms-vscode-remote.remote-containers`）

### 手順

1. **リポジトリをクローンして VS Code で開く**

   ```bash
   git clone <リポジトリURL>
   cd <クローンしたディレクトリ>
   code .
   ```

2. **コンテナで再オープン**

   VS Code 右下に表示される **「Reopen in Container」** をクリックします。表示されない場合はコマンドパレット（`F1` / `Ctrl+Shift+P`）から **Dev Containers: Reopen in Container** を実行してください。

   初回はイメージのビルドが走ります（数分）。完了すると `.devcontainer/post-create.sh` が自動で以下を実行します。

   - `.env` が無ければ `.env.example` からコピー
   - `composer install`
   - `APP_KEY` が無ければ `php artisan key:generate`
   - `npm install`
   - `php artisan migrate --force`

3. **API キーを設定**

   フォーラム以外の機能（GitHub ログイン・文体チェッカー）を使う場合は、生成された `.env` に下記を設定します（取得方法は後述の「[4. GitHub OAuth アプリを作成](#4-github-oauth-アプリを作成)」「[5. Gemini API キーを取得](#5-gemini-api-キーを取得)」を参照）。

   ```env
   GITHUB_CLIENT_ID=your_client_id
   GITHUB_CLIENT_SECRET=your_client_secret
   GITHUB_REDIRECT_URL=http://localhost:8000/auth/callback
   GEMINI_API_KEY=your_api_key
   ```

4. **起動**

   ```bash
   composer run dev
   ```

   ホスト側の `http://localhost:8000` でアクセスできます。`8000`（Laravel）・`5173`（Vite）・`3306`（MySQL）・`6379`（Redis）のポートは自動でフォワードされます。

### 構成について

| サービス | 内容 |
|----------|------|
| `app` | PHP 8.4 + Composer + Node.js 22。Xdebug・Redis 拡張入り |
| `mysql` | MySQL 8.0（DB: `laravel` / ユーザー: `laravel` / パスワード: `secret` / root: `root`） |
| `redis` | Redis 7 |

> **データベースについて**
> 既定の `.env`（`.env.example` 由来）は `DB_CONNECTION=sqlite` で、SQLite を使います。MySQL / Redis コンテナも併せて起動しているので、利用する場合は `.env` の `DB_CONNECTION=mysql` と `DB_HOST=mysql`、`REDIS_HOST=redis` などを設定し直してから `php artisan migrate` を実行してください。

VS Code には Intelephense・Laravel Blade・PHP Debug などの拡張機能が自動でインストールされ、保存時フォーマットも有効になります。

---

## セットアップ（ローカル環境）

> Devcontainer を使わず、ホスト環境に直接構築する場合の手順です。

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