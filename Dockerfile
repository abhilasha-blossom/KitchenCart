FROM php:8.2-apache

# Install required PHP extensions for MySQL and modern apps
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite for routing
RUN a2enmod rewrite

# Copy project files into the Apache document root
COPY . /var/www/html/

# Update permissions
RUN chown -R www-data:www-data /var/www/html/

EXPOSE 80
