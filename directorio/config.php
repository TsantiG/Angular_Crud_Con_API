<?php

$dbServidor = 'localhost';
$dbNombre = 'usuario';
$dbUser ='root';
$dbPassword = '';

try{
    $conn = new PDO("mysql:host=$dbServidor;dbname=$dbNombre;charset=utf8", $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}catch (Exception $e){
    error_log($e->getMessage(), 3, 'error_log.log'); // Registra el error en un archivo log
    echo "Error de conexión a la base de datos.";
    exit(); 
}

