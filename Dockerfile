# Use an official PHP runtime as a parent image
FROM php:8.1-cli

# Set working directory
WORKDIR /var/www

# Install required PHP extensions and Composer
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin && \
    apt-get clean

# Copy the current directory contents into the container
COPY . /var/www

# Install dependencies with Composer
RUN composer install

# Expose port 80
EXPOSE 80

# Command to run your application
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
