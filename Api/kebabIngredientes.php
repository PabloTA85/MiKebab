<?php

require_once __DIR__ . '/../Repositorios/RepoKebabIngrediente.php';  // Incluye la clase RepoKebabsIngredientes
require_once __DIR__ . '/../Helpers/gbd.php';  // Incluye la conexión a la base de datos

// Configurar encabezados para JSON y permitir CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Crear instancia de RepoKebabsIngredientes con la conexión
$kebabsIngredientesRepo = new RepoKebabsIngredientes($conexion);

// Detectar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Acción específica para manejar diferentes solicitudes
$action = $_GET['action'] ?? '';

// Enrutador para manejar cada método
switch ($method) {
    case 'GET':
        if ($action === 'obtenerIngredientesPorKebab') {
            // Obtener ingredientes de un kebab específico
            $idKebab = $_GET['id_kebab'] ?? null;
            if ($idKebab) {
                echo json_encode($kebabsIngredientesRepo->obtenerIngredientesDeKebab($idKebab));
            } else {
                echo json_encode(['error' => 'ID de kebab es requerido']);
            }
        } elseif ($action === 'obtenerKebabsPorIngrediente') {
            // Obtener kebabs que contienen un ingrediente específico
            $idIngrediente = $_GET['id_ingrediente'] ?? null;
            if ($idIngrediente) {
                echo json_encode($kebabsIngredientesRepo->obtenerKebabsConIngrediente($idIngrediente));
            } else {
                echo json_encode(['error' => 'ID de ingrediente es requerido']);
            }
        }
        break;

    case 'POST':
        if ($action === 'agregarIngredienteAKebab') {
            // Agregar un ingrediente a un kebab
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id_kebab']) && isset($data['id_ingrediente'])) {
                $idKebab = $data['id_kebab'];
                $idIngrediente = $data['id_ingrediente'];
                $response = $kebabsIngredientesRepo->agregarIngredienteAKebab($idKebab, $idIngrediente);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere id_kebab y id_ingrediente']);
            }
        }
        break;

        case 'DELETE':
            if ($action === 'eliminarIngredienteDeKebab') {
                // Eliminar un ingrediente de un kebab
                $data = json_decode(file_get_contents("php://input"), true);
                if (isset($data['id_kebab']) && isset($data['id_ingrediente'])) {
                    $idKebab = $data['id_kebab'];
                    $idIngrediente = $data['id_ingrediente'];
                    $response = $kebabsIngredientesRepo->eliminarIngredienteDeKebab($idKebab, $idIngrediente);
                    echo json_encode(['message' => $response]);
                } else {
                    echo json_encode(['error' => 'Datos inválidos: se requiere id_kebab y id_ingrediente']);
                }
            }
            break;
    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}

?>
