FROM php:8.2-apache

# Install dependencies for Node.js
RUN apt-get update && apt-get install -y \
    curl \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy application files and set ownership
COPY --chown=www-data:www-data . .

# Install Node.js dependencies as root (to have permissions for global npm cache)
RUN npm install

# Ensure permissions after npm install
RUN chown -R www-data:www-data /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
