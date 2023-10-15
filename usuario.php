<?php

//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();

//Crear una email y password
$email = "correo@correo.com";
$password = "123456";

$hash = password_hash($password, PASSWORD_DEFAULT);


//QUery para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$hash}');";

echo $query;

//Agregarlo a la base de datos
mysqli_query($db, $query);
