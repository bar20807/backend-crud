<?php

$servidor = "localhost";
$db ="products";
$username = "root";
$password = "";

try {

    $conexion = new PDO("mysql:host=$servidor;dbname=$db", $username, $password);

} catch (Exception $e) {
    echo $e -> getMessage();    
}




?>