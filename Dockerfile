# Base image
FROM php:8.0-apache

# Install dependencies
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files to the web root directory
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite
