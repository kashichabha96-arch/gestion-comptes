#!/bin/bash

echo "🚀 Starting Laravel setup..."

# Fix permissions (important on Render/Docker)
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache

# Clear caches
php artisan optimize:clear

# Run migrations safely
php artisan migrate --force

# Cache config for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Laravel ready!"

# Start Apache
apache2-foreground
