FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Support dynamic port binding (e.g. Render uses $PORT)
ENV PORT=80
RUN sed -ri -e 's!80!${PORT}!g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

# Copy project files to Apache webroot
COPY . /var/www/html/

# Adjust permissions for SQLite database storage and Apache
RUN mkdir -p /var/www/html/data \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/data

EXPOSE 80
CMD ["apache2-foreground"]
