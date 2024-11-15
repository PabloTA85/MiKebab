<?php

require_once __DIR__ . '/../Repositorios/RepoIngrediente.php';  // Incluye la clase RepoIngrediente 
require_once __DIR__ . '/../Helpers/gbd.php';  // Incluye la conexión

// Establecer encabezados para JSON y permitir CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Crear instancia de RepoIngrediente con la conexión
$ingredienteRepo = new RepoIngrediente($conexion);

// Detectar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Acción específica, como obtener, crear, actualizar, eliminar
$action = $_GET['action'] ?? '';

// Router para manejar las diferentes solicitudes
switch ($method) {
    case 'GET':
        if ($action === 'obtenerIngredientes') {
            // Obtener todos los ingredientes
            echo json_encode($ingredienteRepo->obtenerIngredientes());
        } elseif ($action === 'buscarPorNombre') {
            // Buscar ingredientes por nombre
            $nombre = $_GET['nombre'] ?? null;
            if ($nombre) {
                echo json_encode($ingredienteRepo->buscarPorNombre($nombre));
            } else {
                echo json_encode(['error' => 'Nombre de ingrediente es requerido']);
            }
        } elseif ($action === 'buscarPorId') {
            // Buscar ingrediente por ID
            $idIngrediente = $_GET['id_ingrediente'] ?? null;
            if ($idIngrediente) {
                echo json_encode($ingredienteRepo->buscarPorId($idIngrediente));
            } else {
                echo json_encode(['error' => 'ID de ingrediente es requerido']);
            }
        } 
        break;

    case 'POST':
        if ($action === 'crearIngrediente') {
            // Crear un nuevo ingrediente
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data) {
                $nombre = $data['nombre'];
                $imagen = $data['imagen'];
                $precio = $data['precio'];
                $foto = $data['foto'];
                $response = $ingredienteRepo->crearIngrediente($nombre, $imagen, $precio, $foto);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos para crear el ingrediente']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarIngrediente') {
            // Eliminar un ingrediente
            $idIngrediente = $_GET['id_ingrediente'] ?? null;
            if ($idIngrediente) {
                $response = $ingredienteRepo->eliminarIngrediente($idIngrediente);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'ID de ingrediente es requerido']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
?>
