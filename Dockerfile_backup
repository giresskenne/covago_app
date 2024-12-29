# Use an official PHP image as the base image
FROM php:8.1-fpm

# Set the working directory
WORKDIR /var/www/html

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Copy the application files to the working directory
COPY . /var/www/html

# Set permissions for the application files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose the port the application runs on
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
