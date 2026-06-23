FROM php:8.2-apache

# 1. Install ekstensi PHP yang dibutuhkan CodeIgniter 4
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) intl gd zip mysqli pdo_mysql \
    && a2enmod rewrite

# 2. Arahkan DocumentRoot Apache ke folder 'public' milik CodeIgniter 4
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# 3. Copy source code ke dalam container
COPY . .

# 4. Install Composer & dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Sesuaikan hak akses folder writable agar web server bisa menulis log/cache
RUN chown -R www-data:www-data /var/www/html/writable

EXPOSE 80
