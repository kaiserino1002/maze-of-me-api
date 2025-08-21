🌀 Maze Of Me API

思考の迷路を旅して、自分自身を知る

Laravel + Sanctum + Socialite を用いたバックエンド API サーバーです。
思考・感情・気づきを「ノード」として記録・可視化する Web アプリ Maze Of Me の API を提供します。

📖 プロジェクト概要

認証：Google OAuth + Laravel Sanctum（セッションベース）

提供機能：ユーザー認証、ノード CRUD API

利用 DB：MySQL（Docker コンテナ）

⚙️ 技術スタック

Laravel 12.x

Sanctum（セッションベース認証）

Socialite（Google OAuth）

MySQL 8.x

Docker / docker-compose

🚀 セットアップ手順
1. リポジトリをクローン
git clone https://github.com/kaiserino1002/maze-of-me-api.git
cd maze-of-me-api

2. 環境変数を設定
cp .env.example .env


修正が必要な主な項目:

APP_URL=http://localhost:3000

DB_* （ユーザー名/パスワード）

GOOGLE_CLIENT_ID / GOOGLE_CLIENT_SECRET

GOOGLE_REDIRECT_URI=http://localhost:3000/api/auth/callback/google

3. Docker 起動
docker compose up -d --build

4. Laravel セットアップ
docker exec -it api bash
composer install
php artisan key:generate
php artisan migrate

🔑 認証フロー

Google ログイン開始

GET /api/auth/redirect/google


Google コールバック

GET /api/auth/callback/google


認証済みユーザー取得

GET /api/user


（auth:sanctum ミドルウェア）

🌐 開発環境

API: http://localhost:3000

MySQL: localhost:3307 → 3306

phpMyAdmin: http://localhost:8080

🎨 デザインプロトタイプ

Figma 上で UI デザインを確認できます。

👉 Maze Of Me プロトタイプ (Figma)
