<?php
// Credenciales exactas desde Aiven
define('dbhost', 'mysql-2f8d2d20-gomarc-7580.b.aivencloud.com');
define('dbport', '16189');
define('dbuser', 'avnadmin');
define('dbpass', 'AVNS_4M0Ce7IoLmFTuGHDU_R');
define('dbname', 'defaultdb');

try {
    $options = array(
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $connect = new PDO(
        "mysql:host=" . dbhost . ";port=" . dbport . ";dbname=" . dbname . ";charset=utf8mb4",
        dbuser,
        dbpass,
        $options
    );

    $db = $connect;
} catch (PDOException $e) {
    die("Error de conexión PDO: " . $e->getMessage());
}

// Conexión MYSQLI (por si algún archivo la usa)
$mysqli = mysqli_init();
$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
$mysqli->ssl_set(NULL, NULL, NULL, NULL, NULL);
$mysqli->real_connect(dbhost, dbuser, dbpass, dbname, dbport, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);

if ($mysqli->connect_error) {
    die("Error de conexión MySQLi: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>