#!/bin/sh

echo "🚀 Starting Ebond Basket..."

# Set default port
PORT=${PORT:-8000}

# Create necessary directories 
mkdir -p storage/logs storage/framework/cache bootstrap/cache
chmod -R 755 storage bootstrap/cache

# Clear caches (non-critical, don't fail if they error)
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true

# Start the application
php artisan serve --host=0.0.0.0 --port=$PORT
