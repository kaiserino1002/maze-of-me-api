Maze Of Me API
概要

Laravel + Sanctum + Socialite を使ったバックエンド。
Googleログインを含むセッションベース認証とノード管理のAPIを提供。

技術スタック

Laravel 12.x

Sanctum（セッション認証）

Socialite（Google OAuth）

MySQL（Docker）

phpMyAdmin（Docker）

セットアップ
git clone git@github.com:kaiserino1002/maze-of-me-api.git
cd maze-of-me-api
cp .env.example .env
docker compose up -d
composer install
php artisan key:generate
php artisan migrate

今後

デモ用ルートの追加（認証不要でノード作成・取得）

APIテスト用Seederの導入