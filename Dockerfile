# Imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto al contenedor
COPY . .

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Generar la clave de la aplicación
RUN php artisan key:generate

# Establecer permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configurar Apache
COPY ./.docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Exponer el puerto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
