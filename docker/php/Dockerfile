FROM alpine:3.7

RUN apk add --no-cache --upgrade \
    grep \
    php7 \  
    php7-fpm \
    php7-pdo_mysql \
    php7-intl \
    php7-mysqli \
    php7-gd \
    php7-exif \
    php7-mcrypt \
    php7-apcu \
    php7-curl \
    php7-json \
    php7-xml \
    php7-simplexml \
    php7-dom \
    php7-tokenizer \
    php7-session \
    php7-phar \
    php7-xmlwriter

COPY php-fpm.conf /etc/php7/php-fpm.conf

RUN echo "apc.enabled=1" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.shm_size=64M" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.ttl=7200" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.enable_cli=1" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.gc_ttl=3600" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.entries_hint=4096" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.slam_defense=1" >> /etc/php7/conf.d/apcu.ini
RUN echo "apc.serializer=php" >> /etc/php7/conf.d/apcu.ini

RUN echo "date.timezone = America/Sao_Paulo" > /etc/php7/conf.d/timezone.ini
RUN echo "memory_limit = -1" > /etc/php7/conf.d//memory_limit.ini
RUN echo "max_execution_time = 360" > /etc/php7/conf.d/max_execution_time.ini

CMD [ "php-fpm7", "-F" ]

EXPOSE 9000

# FROM php:7.1-fpm
# RUN apt-get update \
#     && apt-get install -y --no-install-recommends \
#         curl \
#         libzip-dev \
#         zip \
#         libicu-dev \
#         libmemcached-dev \
#         libz-dev \
#         libjpeg-dev \
#         libfreetype6-dev \
#         libssl-dev \        
#         libmcrypt-dev \
#         libxml2-dev \
#         libbz2-dev \
#         libjpeg62-turbo-dev \
#         curl \
#         git \
#     && rm -rf /var/lib/apt/lists/*
 
# RUN pecl install apcu apcu_bc-1.0.3
# # xdebug-2.5.3
# RUN docker-php-ext-configure zip --with-libzip
# RUN docker-php-ext-enable apcu apc
# # xdebug
# RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring gd mcrypt exif zip intl 

# # ICU - intl requirements for Symfony
# # Debian is out of date, and Symfony expects the latest - so build from source, unless a better alternative exists(?)
# # RUN curl -sS -o /tmp/icu.tar.gz -L http://download.icu-project.org/files/icu4c/58.2/icu4c-58_2-src.tgz \
# #     && tar -zxf /tmp/icu.tar.gz -C /tmp \
# #     && cd /tmp/icu/source \
# #     && ./configure --prefix=/usr/local \
# #     && make \
# #     && make install

# # RUN docker-php-ext-configure intl --with-icu-dir=/usr/local \
# #     && docker-php-ext-install intl

# # COPY 99-xdebug.ini /usr/local/etc/php/conf.d/
# RUN echo "date.timezone = America/Sao_Paulo" > /usr/local/etc/php/conf.d/timezone.ini
# RUN echo "memory_limit = -1" > /usr/local/etc/php/conf.d/memory_limit.ini
# RUN echo "max_execution_time = 360" > /usr/local/etc/php/conf.d/max_execution_time.ini



# # Install composer

RUN apk add --no-cache curl 

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp
ENV COMPOSER_VERSION 1.7.2

RUN curl --silent --fail --location --retry 3 --output /tmp/installer.php --url https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer \
 && php -r " \
    \$signature = '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5'; \
    \$hash = hash('sha384', file_get_contents('/tmp/installer.php')); \
    if (!hash_equals(\$signature, \$hash)) { \
      unlink('/tmp/installer.php'); \
      echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
      exit(1); \
    }" \
 && php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} \
 && composer --ansi --version --no-interaction \
 && rm -f /tmp/installer.php
