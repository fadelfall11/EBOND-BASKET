#!/bin/bash
set -e

echo "🚀 Starting Ebond Basket application..."

# Set default port
PORT=${PORT:-8000}

# Ensure directories exist with proper permissions
mkdir -p storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run migrations only if database is available (with timeout)
if timeout 5 php artisan migrate:status &>/dev/null; then
    echo "📊 Running database migrations..."
    php artisan migrate --force --quiet || true
else
    echo "⚠️  Database not available yet, skipping migrations"
fi

# Clear caches
php artisan config:cache --quiet 2>/dev/null || true
php artisan route:cache --quiet 2>/dev/null || true

# Start the application
echo "✅ Starting PHP server on 0.0.0.0:$PORT"
php artisan serve --host=0.0.0.0 --port=$PORT
