FROM php:7.4-fpm

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    curl \
    nano \
    wget \
    software-properties-common \
    libonig-dev \
    sudo \
 && git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
 && apt-get autoremove && apt-get autoclean \
 && rm -rf /var/lib/apt/lists/*

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install NodeJS and NPM
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | sudo -E bash -
RUN sudo apt-get install -y nodejs
RUN echo "NODE Version:" && node --version
RUN echo "NPM Version:" && npm --version

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

#RUN composer install --ignore-platform-reqs && npm install --legacy-peer-deps

# Laravel Settings and DB migrations
#RUN php artisan key:generate && \
#    php artisan config:cache

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
