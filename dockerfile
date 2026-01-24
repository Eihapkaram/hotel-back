FROM php:8.2-fpm

# ===============================
# System packages
# ===============================
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        mbstring \
        bcmath \
        gd \
        zip \
    && apt-get clean

# ===============================
# Composer
# ===============================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===============================
# App directory
# ===============================
WORKDIR /var/www

# ===============================
# Copy project
# ===============================
COPY . .

# ===============================
# Install dependencies
# ===============================
RUN composer install --no-dev --optimize-autoloader

# ===============================
# Permissions
# ===============================
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 storage bootstrap/cache

# ===============================
# NGINX CONFIG (INLINE)
# ===============================
RUN rm /etc/nginx/sites-enabled/default && \
echo 'events {} \
http { \
  server { \
    listen 8080; \
    root /var/www/public; \
    index index.php index.html; \
    location / { \
      try_files $uri $uri/ /index.php?$query_string; \
    } \
    location ~ \.php$ { \
      fastcgi_pass 127.0.0.1:9000; \
      fastcgi_index index.php; \
      include fastcgi_params; \
      fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name; \
    } \
  } \
}' > /etc/nginx/nginx.conf

# ===============================
# Railway port
# ===============================
EXPOSE 8080

# ===============================
# Start PHP-FPM + NGINX
# ===============================
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"
