FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libsqlite3-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_sqlite pdo_mysql mbstring exif pcntl bcmath gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www

CMD ["php-fpm"]