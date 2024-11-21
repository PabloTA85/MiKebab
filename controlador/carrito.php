<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

function agregarProducto($producto) {
    $_SESSION['carrito'][] = $producto;
}

function quitarProducto($indice) {
    unset($_SESSION['carrito'][$indice]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']);
}
