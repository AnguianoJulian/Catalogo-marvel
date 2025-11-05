# Usa PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto
COPY . .

# Instalar Composer (gestor de dependencias PHP)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear archivo .env si no existe
RUN cp .env.example .env

# Generar la clave de la aplicación
RUN php artisan key:generate

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
