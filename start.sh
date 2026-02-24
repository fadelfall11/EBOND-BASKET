#!/bin/sh

echo "🚀 Starting Ebond Basket on Railway..."

set +e  # Don't exit on errors

# Force session driver to file to avoid DB at startup
export SESSION_DRIVER=file

# Debug: show DATABASE_URL (masked)
if [ -n "$DATABASE_URL" ]; then
    echo "🔗 DATABASE_URL detected: ${DATABASE_URL%%:*}://***:***@${DATABASE_URL##*@}"
else
    echo "⚠️ DATABASE_URL not set"
fi

# Set default port
PORT=${PORT:-8000}

# Parse DATABASE_URL if provided (Railway PostgreSQL/MySQL)
if [ -n "$DATABASE_URL" ]; then
    echo "📊 DATABASE_URL detected, parsing connection details..."
    # The RailwayServiceProvider will handle this
fi

# Create necessary directories
mkdir -p storage/logs storage/framework/cache bootstrap/cache storage/app/public
chmod -R 755 storage bootstrap/cache

# Create storage symbolic link for public files (photos)
if [ ! -L "public/storage" ]; then
    echo "🔗 Creating storage symbolic link..."
    php artisan storage:link
fi

# Clear caches to avoid stale config pointing to localhost
php artisan optimize:clear --quiet 2>/dev/null || true
php artisan config:clear --quiet 2>/dev/null || true
php artisan cache:clear --quiet 2>/dev/null || true

# Try to run migrations if database is available
echo "🔄 Running migrations..."
php artisan migrate --force --quiet 2>/dev/null
migrate_status=$?

if [ $migrate_status -eq 0 ]; then
    echo "✅ Migrations completed successfully"
    echo "🌱 Seeding database..."
    php artisan db:seed --force --quiet 2>/dev/null || true
else
    echo "⚠️  Migrations failed or database not available - starting anyway"
fi

# If migrations failed, fallback to SQLite to allow the site to run
if [ $migrate_status -ne 0 ]; then
    echo "🛠️ Falling back to SQLite to avoid DB connection errors..."
    export DB_CONNECTION=sqlite
    export DB_DATABASE=database/database.sqlite
    mkdir -p database
    touch database/database.sqlite
    php artisan migrate --force --quiet 2>/dev/null || true
fi


# Avoid caching config/routes here; Railway env can differ and caching can freeze a bad DB host

# Start the application
echo "✅ Starting PHP server on 0.0.0.0:$PORT"
php artisan serve --host=0.0.0.0 --port=$PORT
