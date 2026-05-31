#!/usr/bin/env bash
set -euo pipefail

echo "==> Preparing Laravel for production..."

if [ -z "${APP_KEY:-}" ]; then
  echo "ERROR: APP_KEY is not set. Add it in Railway service variables."
  exit 1
fi

php artisan migrate --force
php artisan storage:link --force 2>/dev/null || true

if php artisan tinker --execute="echo \\App\\Models\\User::query()->count();" 2>/dev/null | tail -1 | grep -qx '0'; then
  echo "==> Empty database detected — running initial seeders..."
  php artisan db:seed --class=SiteContentSeeder --force
  php artisan db:seed --class=AdminUserSeeder --force
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Starting web server on port ${PORT:-8080}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
