<?php
// Iniciar la sesión
session_start(); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiKebab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&display=swap" rel="stylesheet">
    <!-- Fuente caligráfica -->
    <link rel="stylesheet" href="css/estilos.css"> <!-- Ruta absoluta -->
</head>

<body>

<?php  
    include 'Controlador/router.php';
?>

</body>