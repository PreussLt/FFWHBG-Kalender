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

# Copy application files
COPY . .

# Install Node.js dependencies
RUN npm install

# Create ical directory if it doesn't exist and set permissions
RUN mkdir -p ical && chown -R www-data:www-data ical

# Enable Apache mod_rewrite (optional but recommended)
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
