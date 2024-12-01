# Base image
FROM php:8.3-fpm-alpine

# Installing system dependencies and PHP extensions
RUN apk add --no-cache \
    zip \
    libzip-dev \
    freetype \
    libjpeg-turbo \
    libpng \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    oniguruma-dev \
    gettext-dev \
    bash \
    nginx \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip pdo pdo_mysql \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && docker-php-ext-install bcmath exif gettext opcache \
    && docker-php-ext-enable bcmath exif gettext opcache

# Install Composer
COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . .

# Permissions setup
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

# Install PHP and Node.js dependencies
RUN composer install --no-dev --prefer-dist \
    && composer require laravel/breeze --dev \
    && php artisan breeze:install blade --dark \
    && apk add --no-cache nodejs npm \
    && npm install \
    && npm run build

# Configurations for nginx and PHP
COPY ./deploy/nginx.conf /etc/nginx/http.d/default.conf
COPY ./deploy/php.ini "$PHP_INI_DIR/conf.d/app.ini"

# Ensure permissions
RUN chmod -R 777 storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Persistent storage (if required)
VOLUME ["/var/www/html/storage/app"]

CMD ["sh", "-c", "nginx && php-fpm"]
