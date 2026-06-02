#!/bin/bash

echo "🚀 Laravel starting..."

php artisan optimize:clear

php artisan migrate --force || true

apache2-foreground
