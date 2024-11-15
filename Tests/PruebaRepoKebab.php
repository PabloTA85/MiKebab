<?php
require_once __DIR__ . '/../Helpers/gbd.php'; // Este archivo debe incluir la conexión a la base de datos
require_once __DIR__ . '/../Clases/Kebab.php';
require_once __DIR__ . '/../Repositorios/RepoKebab.php';

try {
    // Verificamos la conexión antes de crear RepoKebab
    echo "Conexión exitosa.<br>";

    // Instanciamos RepoKebab (ya tiene la conexión disponible por el global $conexion)
    $repoKebab = new RepoKebab();

    // Prueba de obtener todos los kebabs
    echo "Lista de todos los kebabs:<br>";
    $kebabs = $repoKebab->obtenerTodos();
    foreach ($kebabs as $kebab) {
        echo "ID: " . $kebab->getIdKebab() . ", Nombre: " . $kebab->getNombre() . ", Tipo: " . $kebab->getTipo() . ", Precio: " . $kebab->getPrecio() . "<br>";
    }    

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

