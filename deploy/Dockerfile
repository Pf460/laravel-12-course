FROM php:8.5-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libicu-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install intl pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

RUN echo "opcache.validate_timestamps=0" > /usr/local/etc/php/conf.d/zz-opcache.ini #создаёт файл opcache c настройкой времени валидации файлов = 0, что даёт скорость загрузке страницы

RUN a2enmod rewrite \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
