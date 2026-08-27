#!/bin/bash
set -e

# Generate .env dari environment variables yang diset di docker-compose
cat > /var/www/html/.env <<EOF
APP_NAME="${APP_NAME:-Sistem Pengadaan Tender}"
APP_ENV="${APP_ENV:-production}"
APP_KEY="${APP_KEY:-base64:1VIN5iPRtHZuwHY0XA8x+IuYjtZAjZtBWY7PrZfQ3As=}"
APP_DEBUG="${APP_DEBUG:-false}"
APP_URL="${APP_URL:-http://localhost:8100}"

DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-pengadaan2}"
DB_USERNAME="${DB_USERNAME:-e_shop}"
DB_PASSWORD="${DB_PASSWORD:-e_shop_pass}"

CACHE_DRIVER="${CACHE_DRIVER:-file}"
QUEUE_CONNECTION="${QUEUE_CONNECTION:-sync}"
SESSION_DRIVER="${SESSION_DRIVER:-file}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"

MAIL_MAILER="${MAIL_MAILER:-log}"
MAIL_HOST="${MAIL_HOST:-mailhog}"
MAIL_PORT="${MAIL_PORT:-1025}"
MAIL_USERNAME="${MAIL_USERNAME:-null}"
MAIL_PASSWORD="${MAIL_PASSWORD:-null}"
MAIL_ENCRYPTION="${MAIL_ENCRYPTION:-null}"
MAIL_FROM_ADDRESS="${MAIL_FROM_ADDRESS:-no-reply@pbj.go.id}"
MAIL_FROM_NAME="${MAIL_FROM_NAME:-Sistem Pengadaan}"
EOF

# Tunggu DB siap
echo "Menunggu database..."
until php -r "new PDO('mysql:host=${DB_HOST:-db};dbname=${DB_DATABASE:-pengadaan2}', '${DB_USERNAME:-e_shop}', '${DB_PASSWORD:-e_shop_pass}', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);" 2>/dev/null; do
    sleep 2
done
echo "Database siap."

# Migrate & seed (fresh setiap restart — untuk development)
php artisan migrate:fresh --seed --force --no-interaction 2>&1 || echo "WARNING: migrate seed gagal, lanjut..."
php artisan key:generate --force --no-interaction 2>/dev/null || true

# Start Apache foreground
exec apache2-foreground
