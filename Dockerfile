FROM php:8.0-fpm
RUN apt-get update && apt-get install -y libicu-dev && docker-php-ext-install intl
RUN apt install -y libpng-dev libjpeg-dev libfreetype6-dev libwebp-dev
# PHP extensionleri yükle
RUN docker-php-ext-install mysqli pdo pdo_mysql
# libmysqlclient-dev paketini yükle
RUN apt-get update
# MySQLi sürücüsünü yeniden yükle
RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd && \
    docker-php-ext-install mysqli
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && \
    docker-php-ext-install pdo_mysql
RUN docker-php-ext-install pdo
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install -j$(nproc) gd