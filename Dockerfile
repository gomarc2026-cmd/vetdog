FROM php:8.1-apache

# 1. Habilitar mod_rewrite
RUN a2enmod rewrite

# 2. Instalar socat y extensiones MySQL
RUN apt-get update && apt-get install -y socat && docker-php-ext-install mysqli pdo pdo_mysql

# 3. Copiar el proyecto
COPY . /var/www/html/

# 4. TRUCO DEL SOCKET:
# Creamos la carpeta del socket de MySQL y usamos socat para vincular el Socket UNIX de Linux 
# hacia la BD de Aiven en el puerto 16189.
CMD mkdir -p /var/run/mysqld && \
    socat UNIX-LISTEN:/var/run/mysqld/mysqld.sock,fork,mode=777 TCP:mysql-2f8d2d20-gomarc-7580.b.aivencloud.com:16189 & \
    apache2-foreground