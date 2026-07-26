FROM php:8.1-apache

# 1. Habilitar mod_rewrite de Apache (para que funcionen rutas sin .php y .htaccess como en XAMPP)
RUN a2enmod rewrite

# 2. Instalar extensiones de PHP que usa tu proyecto (mysqli y pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. Copiar todo el código de tu proyecto al servidor Apache
COPY . /var/www/html/

# 4. TRUCO DE BD: Crear un script de inicio que redirige "localhost" en el servidor hacia la URL de Aiven
CMD bash -c "echo '127.0.0.1 mysql-2f8d2d20-gomarc-7580.b.aivencloud.com' >> /etc/hosts && apache2-foreground"