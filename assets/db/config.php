<?php
// Define database
define('dbhost', 'mysql-2f8d2d20-gomarc-7580.b.aivencloud.com');
define('dbport', '16189');
define('dbuser', 'avnadmin');
define('dbpass', 'AVNS_4M0Ce7IoLmFTuGHDU_R');
define('dbname', 'defaultdb');

// 1. Conexión PDO (para Login y otros formularios)
try {
    $options = array(
        PDO::MYSQL_ATTR_SSL_CA => true,
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    $connect = new PDO("mysql:host=" . dbhost . ";port=" . dbport . ";dbname=" . dbname, dbuser, dbpass, $options);
} catch(PDOException $e) {
    echo $e->getMessage();
}

// 2. Conexión MYSQLI (para administrador.php, data.php y drap.php)
$mysqli = mysqli_connect(dbhost, dbuser, dbpass, dbname, dbport);
?>