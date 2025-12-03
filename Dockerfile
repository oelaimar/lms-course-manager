FROM php:8.2-fpm

# Install important PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copy project files
WORKDIR /var/www/html
COPY ./src /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html