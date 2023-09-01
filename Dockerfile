# Use the official PHP image with PostgreSQL support
FROM php:8.2-apache

# Install additional dependencies
RUN apt-get update && apt-get install -y libpq-dev

# Install PostgreSQL extension
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

# Copy the custom Apache configuration file
COPY my_apache.conf /etc/apache2/sites-available/000-default.conf