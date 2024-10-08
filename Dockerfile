# Imagen para php 8.2
FROM php:8.2-fpm

# Directorio de trabajo
WORKDIR /app

# Updates y pdo de sqlite
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    unzip\
    git \
    libzip-dev \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo pdo_sqlite

# Composer \
RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

# Establecer variables de entorno
ENV COMPOSER_ALLOW_SUPERUSER=1