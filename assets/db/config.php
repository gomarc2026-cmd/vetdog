<?php
session_start();

// Define database
define('dbhost', 'mysql-2f8d2d20-gomarc-7580.b.aivencloud.com');
define('dbport', '16189');
define('dbuser', 'avnadmin');
define('dbpass', 'AVNS_4M0Ce7IoLmFTuGHDU_R');
define('dbname', 'defaultdb');

// Connecting database
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

?>