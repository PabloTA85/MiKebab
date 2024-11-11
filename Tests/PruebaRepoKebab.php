<?php
require_once __DIR__ . '/../Helpers/gbd.php';
require_once __DIR__ . '/../Clases/kebab.php';
require_once __DIR__ . '/../Repositorios/RepoKebab.php';

// Código de prueba para RepoKebab
try {
    // Prueba de conexión
    $conexion = new PDO("mysql:host=localhost;dbname=kebab", "root", "root"); // Cambia "nombre_base_datos", "usuario", y "contraseña" por los valores correctos.
    echo "Conexión exitosa.<br>";

    // Instancia de prueba para RepoKebab
    $repoKebab = new RepoKebab();

    // Prueba de agregar un kebab
    $kebab = new Kebab("Kebab Mixto", "foto.jpg", "Mixto", 7.5);
    $repoKebab->agregar($kebab);
    echo "Kebab agregado exitosamente.<br>";

    // Prueba de obtener todos los kebabs
    $kebabs = $repoKebab->obtenerTodos();
    foreach ($kebabs as $kebab) {
        echo "Nombre: " . $kebab->getNombre() . ", Precio: " . $kebab->getPrecio() . "<br>";
    }

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
