# Dockerfile for Laravel 12 API
FROM php:8.3-cli

# تثبيت Dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpng-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# تحديد مجلد العمل
WORKDIR /app

# نسخ المشروع
COPY . .

# تثبيت dependencies
RUN composer install --no-dev --optimize-autoloader

# إنشاء المجلدات المطلوبة (تأكد انها موجودة)
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache

# تعديل الصلاحيات (Docker/Linux)
RUN chmod -R 777 storage bootstrap/cache

# تنظيف أي كاش
RUN php artisan config:clear \
 && php artisan view:clear \
 && php artisan route:clear

# تعيين البورت
EXPOSE 8080

# تشغيل Laravel
CMD php -S 0.0.0.0:8080 -t public
