<?php

// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';        
$contraseña = 'root';      
$nombre_base_datos = 'kebab';  

// Función para obtener la conexión a la base de datos con parámetros
function gbd($host, $usuario, $contraseña, $nombre_base_datos) {
    try {
        // Conectamos a la base de datos usando PDO
        $conexion = new PDO("mysql:host=$host;dbname=$nombre_base_datos;charset=utf8", $usuario, $contraseña);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion; // Devuelve la conexión
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
        exit;
    }
}

// Llamar la función y asignar la conexión a la variable global $conexion
$conexion = gbd($host, $usuario, $contraseña, $nombre_base_datos);

?>
