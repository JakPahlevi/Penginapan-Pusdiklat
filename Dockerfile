# Gunakan base image PHP dengan ekstensi yang dibutuhkan Laravel
FROM php:8.3-fpm

# Install dependencies yang dibutuhkan
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    nginx \
    supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install gd pdo pdo_mysql zip bcmath intl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files first
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-dev --no-scripts --no-autoloader

# Copy seluruh file project Laravel ke dalam container
COPY . .

# Copy environment file
COPY .env.production .env

# Generate autoload files
RUN composer dump-autoload --optimize

# Clear and cache Laravel config
CMD php artisan config:clear \
    && php artisan cache:clear \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan serve

# Buat directory cache dan set permissions
RUN mkdir -p /var/www/html/storage/framework/{cache,sessions,views} \
    && mkdir -p /var/www/html/storage/framework/cache/data \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/public

# Copy konfigurasi Nginx dan Supervisor
COPY ./deploy/nginx.conf /etc/nginx/sites-available/default
COPY ./deploy/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port untuk Nginx
EXPOSE 8080

# Jalankan Supervisor untuk menjalankan Nginx dan PHP-FPM
CMD ["/usr/bin/supervisord"]
