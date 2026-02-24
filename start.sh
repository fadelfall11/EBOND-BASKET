#!/bin/sh

echo "🚀 Starting Ebond Basket on Railway..."

set +e  # Don't exit on errors

# Set default port
PORT=${PORT:-8000}

# Parse DATABASE_URL if provided (Railway PostgreSQL/MySQL)
if [ -n "$DATABASE_URL" ]; then
    echo "📊 DATABASE_URL detected, parsing connection details..."
    # The RailwayServiceProvider will handle this
fi

# Create necessary directories
mkdir -p storage/logs storage/framework/cache bootstrap/cache
chmod -R 755 storage bootstrap/cache

# Try to run migrations if database is available
echo "🔄 Running migrations..."
php artisan migrate --force --quiet 2>/dev/null

if [ $? -eq 0 ]; then
    echo "✅ Migrations completed successfully"
else
    echo "⚠️  Migrations failed or database not available - starting anyway"
fi

# Clear caches (non-critical)
php artisan config:cache --quiet 2>/dev/null || true
php artisan route:cache --quiet 2>/dev/null || true

# Start the application
echo "✅ Starting PHP server on 0.0.0.0:$PORT"
php artisan serve --host=0.0.0.0 --port=$PORT
