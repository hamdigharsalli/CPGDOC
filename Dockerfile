FROM php:7.4-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Copy project files to the container
COPY . /var/www/html/

# Set permissions for Apache
RUN chown -R www-data:www-data /var/www/html/

