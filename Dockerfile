FROM php:8.2-apache

# Install curl extension (php-curl package)
RUN apt-get update && apt-get install -y libcurl4-openssl-dev && \
    docker-php-ext-install -j$(nproc) curl && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite and mod_remoteip (for proxy headers)
RUN a2enmod rewrite remoteip

# Set working directory
WORKDIR /var/www/html

# Copy Apache configuration
COPY apache-config.conf /etc/apache2/conf-available/afvalkalender.conf
RUN a2enconf afvalkalender

# Copy application files
COPY . /var/www/html/

# Create cache directory and set permissions
RUN mkdir -p /var/www/html/cache && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 775 /var/www/html/cache

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

