#!/bin/bash

# Render Build Script for Laravel Application
set -e

echo "🚀 Starting Render build process..."

# Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm ci

# Build assets
echo "🏗️  Building assets..."
npm run build

# Cache configuration
echo "⚙️  Caching configuration..."
php artisan config:cache
php artisan route:cache
# تم إزالة view:cache لأنه يسبب خطأ "View path not found" في بعض الحالات
# php artisan view:cache

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Run migrations (only if needed - uncomment if you want auto-migrate)
# echo "🗄️  Running migrations..."
# php artisan migrate --force

echo "✅ Build completed successfully!"

