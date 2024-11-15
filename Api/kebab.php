<?php

require_once __DIR__ . '/../Repositorios/RepoKebab.php';  // Incluye la clase RepoKebab 
require_once __DIR__ . '/../Helpers/gbd.php';  // Incluye la conexión

// Establecer encabezados para JSON y permitir CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Crear instancia de RepoKebab con la conexión
$kebabRepo = new RepoKebab($conexion);

// Detectar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Acción específica, como obtener, crear, actualizar, eliminar
$action = $_GET['action'] ?? '';

// Router para manejar las diferentes solicitudes
switch ($method) {
    case 'GET':
        if ($action === 'obtenerKebabs') {
            // Obtener todos los kebabs
            echo json_encode($kebabRepo->obtenerKebabs());
        } elseif ($action === 'buscarPorIngrediente') {
            // Buscar kebabs por ingrediente
            $idIngrediente = $_GET['id_ingrediente'] ?? null;
            if ($idIngrediente) {
                echo json_encode($kebabRepo->buscarPorIngrediente($idIngrediente));
            } else {
                echo json_encode(['error' => 'ID de ingrediente es requerido']);
            }
        }
        break;

    case 'POST':
        if ($action === 'crearKebab') {
            // Crear un nuevo kebab
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data) {
                $nombre = $data['nombre'];
                $foto = $data['foto'];
                $tipo = $data['tipo'];
                $precio = $data['precio'];
                $ingredientes = $data['ingredientes'];
                $response = $kebabRepo->crearKebab(nombre: $nombre, foto: $foto, tipo: $tipo, precio: $precio, ingredientes: $ingredientes);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos para crear el kebab']);
            }
        }
        break;

    case 'PUT':
        if ($action === 'actualizarKebab') {
            // Actualizar un kebab existente
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data) {
                $idKebab = $data['id_kebab'];
                $nombre = $data['nombre'];
                $foto = $data['foto'];
                $tipo = $data['tipo'];
                $precio = $data['precio'];
                $ingredientes = $data['ingredientes'];
                $response = $kebabRepo->actualizarKebab($idKebab, nombre: $nombre, foto: $foto, tipo: $tipo, precio: $precio, ingredientes: $ingredientes);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos para actualizar el kebab']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarKebab') {
            // Eliminar un kebab
            $idKebab = $_GET['id_kebab'] ?? null;
            if ($idKebab) {
                $response = $kebabRepo->eliminarKebab($idKebab);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'ID de kebab es requerido']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
?>