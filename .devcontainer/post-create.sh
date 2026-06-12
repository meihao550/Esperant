#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env
fi

composer install --no-interaction --prefer-dist

if ! grep -q "^APP_KEY=base64:" .env; then
  php artisan key:generate
fi

npm install
php artisan migrate --force || true

echo "Devcontainer ready. Run 'composer dev' to start the app."
