FROM php:8.1-apache

# Activar módulo de reescritura de Apache para .htaccess
RUN a2enmod rewrite

# Instalar extensiones de base de datos
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Permitir lectura de .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

COPY . /var/www/html/