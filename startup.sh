#!/bin/bash

echo "🚀 Laravel starting..."

# Clear old cache (important on deploy)
php artisan optimize:clear

# Rebuild cache (safe for production)
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# ✅ RUN SEEDERS (IMPORTANT FIX)
php artisan db:seed --force

# Start Apache
apache2-foreground
