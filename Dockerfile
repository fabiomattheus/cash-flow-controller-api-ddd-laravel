FROM php:8.1.5-fpm-alpine as backend

# Import extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install extensions
RUN install-php-extensions pdo_mysql bcmath opcache redis gd

RUN echo 'memory_limit = 2048M' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini;

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install Bash
RUN apk --no-cache add bash

# Configure PHP
COPY .docker/php.ini $PHP_INI_DIR/conf.d/opcache.ini

# Use the default development configuration
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# Install extra packages
RUN apk --no-cache add bash mysql-client mariadb-connector-c-dev

# Create user based on provided user ID
ARG HOST_UID
RUN adduser --disabled-password --gecos "" --uid $HOST_UID mttechne-test

# Switch to that user
USER mttechne-test


#FROM backend as worker

# Start worker
#CMD ["php", "/var/www/backend/artisan", "queue:work"]