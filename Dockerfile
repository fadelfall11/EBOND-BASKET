FROM php:8.2-cli

# Install system dependencies including Node.js
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 18
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy project files
COPY . /app/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies  
RUN npm ci && npm run build

# Create necessary directories
RUN mkdir -p storage/logs storage/framework/cache bootstrap/cache && \
    chmod -R 755 storage bootstrap/cache

# Expose port (flexible for Railway)
EXPOSE 8000

# Start command
CMD ["bash", "start.sh"]
