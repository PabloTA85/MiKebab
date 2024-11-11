<?php

// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';        
$contraseña = 'root';      
$nombre_base_datos = 'kebab';  

// Conectamos a la base de datos usando PDO
try {
    $conexion = new PDO("mysql:host=$host;dbname=$nombre_base_datos;charset=utf8", $usuario, $contraseña);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit;
}
?>
