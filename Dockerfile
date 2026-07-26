FROM php:8.1-apache

# 1. Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# 2. Instalar extensiones de PHP y la herramienta socat
RUN apt-get update && apt-get install -y socat && docker-php-ext-install mysqli pdo pdo_mysql

# 3. Copiar todo el código del proyecto
COPY . /var/www/html/

# 4. EL TRUCO DEFINITIVO:
# Escucha en el puerto local 3306 (donde apunta tu localhost sin puerto) 
# y reenvía todo el tráfico al puerto 16189 de Aiven, luego inicia Apache.
CMD socat TCP-LISTEN:3306,fork TCP:mysql-2f8d2d20-gomarc-7580.b.aivencloud.com:16189 & apache2-foreground