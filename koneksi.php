<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=db_silsilah_keluarga;host=localhost';
$user = 'root';
$password = '';

try {
    $connect = new PDO($dsn, $user, $password);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connect->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,TRUE);    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
