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

# Create log directory for PHP error logs
RUN mkdir -p /var/log && \
    touch /var/log/php_errors.log && \
    chmod 666 /var/log/php_errors.log

# Create the uploads directory and set its permissions
RUN mkdir -p /var/www/html/uploads && chmod -R 777 /var/www/html/uploads

# Set up custom php.ini file for error handling
COPY php.ini /usr/local/etc/php/php.ini

# Copy the application files to the working directory
COPY . /var/www/html

# Ensure the uploads directory retains 777 permissions
RUN chmod -R 777 /var/www/html/uploads

# Set permissions for the application files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Ensure the uploads directory is owned by www-data
RUN chown -R www-data:www-data /var/www/html/uploads

# Expose the port the application runs on
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
