<?php
// Definir las rutas para cada página
$rutas = [
    'inicio'   => 'Templates/Vistas/inicio.php',
    'menu'     => 'Templates/Vistas/menu.php',
    'contacto' => 'Templates/Vistas/contacto.php',
    'carrito'  => 'Templates/Vistas/carrito.php',
    'login'    => 'Templates/Vistas/login.php',  
    'registro' => 'Templates/Vistas/registro.php', 
    'kebabsCasa' => 'Templates/Vistas/kebabsCasa.php',
    'kebabGusto' => 'Templates/Vistas/kebabGusto.php'
];

// Obtener la ruta solicitada o por defecto 'inicio'
$ruta = isset($_GET['ruta']) ? $_GET['ruta'] : 'inicio';

// Verificar si la ruta existe en el array de rutas
if (array_key_exists($ruta, $rutas)) {
    // Definir la ruta completa para la vista
    $vista = $rutas[$ruta];
    
    // Cargar el layout y la vista correspondiente
    include_once 'Templates/Parciales/layout.php';
} else {
    // Si la ruta no existe, mostrar un error 404
    echo "404 - Página no encontrada";
}
?>
