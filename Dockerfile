# Use an official PHP runtime as a parent image
FROM php:8.1-cli

# Set the working directory
WORKDIR /var/www

# Install PHP extensions and Composer
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    && apt-get clean

# Copy the rest of your application
COPY . /var/www

# Install Laravel dependencies
RUN composer install

# Expose the port (optional, for use in the web service)
EXPOSE 80

# Start the PHP server
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
