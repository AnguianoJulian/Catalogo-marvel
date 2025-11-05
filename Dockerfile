# Usa PHP con Apache
FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN a2enmod rewrite

# Establecer el directorio de trabajo en /var/www/html
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Copiar configuración de Apache (para que apunte a /public)
RUN echo "<VirtualHost *:80> \
    DocumentRoot /var/www/html/public \
    <Directory /var/www/html/public> \
        AllowOverride All \
        Require all granted \
    </Directory> \
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Crear archivo .env si no existe
RUN cp .env.example .env || true

# Generar clave
RUN php artisan key:generate || true

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["apache2-foreground"]
