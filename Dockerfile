FROM nginx:alpine as web-server

FROM bitnami/mariadb:latest as mariadb

# FROM php:7.2-fpm AS app
# ENV ACCEPT_EULA=Y
# # Microsoft SQL Server Prerequisites
# RUN apt-get update --fix-missing\
#     && apt-get install -y gnupg wget \
# #     && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
# #     && curl https://packages.microsoft.com/config/debian/9/prod.list \
# #         > /etc/apt/sources.list.d/mssql-release.list \
#     && apt-get install -y --no-install-recommends \
#         locales \
#         apt-transport-https \
#     && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
#     && locale-gen \
# #     && apt-get update \
#     # && apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev mssql-tools \
#     && apt-get update\
#     && apt-get -y --no-install-recommends install curl libxml2-dev libssl-dev zlib1g-dev apt-transport-https apt-utils lsb-release ca-certificates \
#     && apt-get -y --no-install-recommends install libpng-dev libturbojpeg0 libjpeg-dev cron vim \
#     && apt-get -y --no-install-recommends install  php-mysql \
#     && wget https://getcomposer.org/download/1.9.1/composer.phar -O /usr/local/bin/composer \
#     && chmod a+rx /usr/local/bin/composer

# RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/ \
#     && docker-php-ext-install mbstring pdo pdo_mysql iconv mbstring phar zip gd xml \
#     #&& pecl install sqlsrv pdo_sqlsrv \
#     && docker-php-ext-enable
#     # sqlsrv pdo_sqlsrv
# COPY crontab /var/spool/cron/crontabs/root
# RUN chmod 0644 /var/spool/cron/crontabs/root

FROM php:7.2-fpm AS app
LABEL maintainer="Faisal Abdul Hamid <faisal.abdulhamid@gmail.com>"
# Set Environment Variables
ENV DEBIAN_FRONTEND noninteractive
#
#--------------------------------------------------------------------------
# Software's Installation
#--------------------------------------------------------------------------
#
# Installing tools and PHP extentions using "apt", "docker-php", "pecl",
#

# Install "curl", "libmemcached-dev", "libpq-dev", "libjpeg-dev",
#         "libpng12-dev", "libfreetype6-dev", "libssl-dev", "libmcrypt-dev",
RUN set -xe && \
  apt-get update --fix-missing && \
  apt-get upgrade -y && \
  apt-get install -y --no-install-recommends \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    wget \
  && rm -rf /var/lib/apt/lists/*

RUN set -xe; \
    apt-get update --fix-missing -yqq && \
    pecl channel-update pecl.php.net && \
    apt-get install -yqq \
      apt-utils \
      #
      #--------------------------------------------------------------------------
      # Mandatory Software's Installation
      #--------------------------------------------------------------------------
      #
      # Mandatory Software's such as ("mcrypt", "pdo_mysql", "libssl-dev", ....)
      # are installed on the base image 'laradock/php-fpm' image. If you want
      # to add more Software's or remove existing one, you need to edit the
      # base image (https://github.com/Laradock/php-fpm).
      #
      # next lines are here becase there is no auto build on dockerhub see https://github.com/laradock/laradock/pull/1903#issuecomment-463142846
      libzip-dev zip unzip && \
      docker-php-ext-configure zip --with-libzip && \
      # Install the zip extension
      docker-php-ext-install zip && \
      php -m | grep -q 'zip'

RUN apt-get update --fix-missing -yqq && \
    apt-get -y install default-mysql-client

RUN apt-get install -y openssl

RUN docker-php-ext-install pdo_mysql \
  # Install the PHP pdo_pgsql extention
  && docker-php-ext-install pdo_pgsql \
  # Install the PHP gd library
  && docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd


RUN wget https://getcomposer.org/download/1.9.1/composer.phar -O /usr/local/bin/composer \
    && chmod a+rx /usr/local/bin/composer


WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000