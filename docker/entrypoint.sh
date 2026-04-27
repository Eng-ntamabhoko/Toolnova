#!/bin/sh
set -e

echo "=========================================="
echo "ToolNova - Render Deployment Starting"
echo "=========================================="

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "📝 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear cached configs
echo "🧹 Clearing application cache..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Cache application configuration for production
echo "⚙️  Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force --no-interaction

# Ensure storage directories have proper permissions
echo "🔐 Setting storage permissions..."
chmod -R 777 /app/storage
chmod -R 777 /app/bootstrap/cache
mkdir -p /app/database
chmod -R 777 /app/database

echo ""
echo "✅ Application initialization complete!"
echo "=========================================="

# Execute the main command
exec "$@"
