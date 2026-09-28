FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to Apache webroot
COPY . /var/www/html/

# Adjust permissions for SQLite database storage
RUN mkdir -p /var/www/html/data && chown -R www-data:www-data /var/www/html/data

EXPOSE 80
CMD ["apache2-foreground"]
