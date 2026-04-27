# ============================================================================
# SIMPLE RENDER DEPLOYMENT - PHP 8.2 + Laravel
# ============================================================================
# Lightweight Dockerfile for Render free tier
# Uses php artisan serve for simplicity and low memory usage
# ============================================================================

FROM php:8.2-alpine

# Install essential system dependencies
RUN apk add --no-cache \
    curl \
    git \
    zip \
    unzip \
    postgresql-client \
    mysql-client \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    postgresql-dev \
    gettext-dev

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    gd \
    gettext \
    opcache \
    bcmath
# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application code
COPY . .

# Install PHP dependencies (no dev, optimized autoloader)
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --optimize-autoloader

# Build frontend assets
RUN npm install && npm run build

# Set proper permissions for Laravel (storage & bootstrap/cache)
RUN chmod -R 755 /app && \
    chmod -R 777 /app/storage && \
    chmod -R 777 /app/bootstrap/cache && \
    mkdir -p /app/database && \
    chmod -R 777 /app/database

# Expose port 10000 (required by Render)
EXPOSE 10000

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:10000/health || exit 1

# Run Laravel development server (simple & lightweight)
# In production, Render's load balancer handles routing
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
