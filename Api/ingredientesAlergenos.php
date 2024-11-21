<?php

require_once __DIR__ . '/../Repositorios/RepoIngredientesAlergenos.php';  // Incluye la clase RepoIngredientesAlergenos
require_once __DIR__ . '/../Helpers/gbd.php';  // Incluye la conexión a la base de datos

// Configurar encabezados para JSON y permitir CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Crear instancia de RepoIngredientesAlergenos con la conexión
$ingredientesAlergenosRepo = new RepoIngredientesAlergenos($conexion);

// Detectar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Acción específica para manejar diferentes solicitudes
$action = $_GET['action'] ?? '';

// Enrutador para manejar cada método
switch ($method) {
    case 'GET':
        if ($action === 'obtenerAlergenosPorIngrediente') {
            // Obtener alérgenos de un ingrediente específico
            $idIngrediente = $_GET['id_ingrediente'] ?? null;
            if ($idIngrediente) {
                echo json_encode($ingredientesAlergenosRepo->obtenerAlergenosPorIngrediente($idIngrediente));
            } else {
                echo json_encode(['error' => 'ID de ingrediente es requerido']);
            }
        }
        break;

    case 'POST':
        if ($action === 'agregarIngredienteAlergeno') {
            // Agregar relación entre ingrediente y alérgeno
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id_ingrediente']) && isset($data['id_alergeno'])) {
                $idIngrediente = $data['id_ingrediente'];
                $idAlergeno = $data['id_alergeno'];
                $success = $ingredientesAlergenosRepo->agregarIngredienteAlergeno($idIngrediente, $idAlergeno);
                if ($success) {
                    echo json_encode(['message' => 'Relación ingrediente-alérgeno agregada con éxito.']);
                } else {
                    echo json_encode(['error' => 'Error al agregar la relación ingrediente-alérgeno.']);
                }
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere id_ingrediente y id_alergeno']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarIngredienteAlergeno') {
            // Eliminar relación entre ingrediente y alérgeno
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['id_ingrediente']) && isset($data['id_alergeno'])) {
                $idIngrediente = $data['id_ingrediente'];
                $idAlergeno = $data['id_alergeno'];
                $success = $ingredientesAlergenosRepo->eliminarIngredienteAlergeno($idIngrediente, $idAlergeno);
                if ($success) {
                    echo json_encode(['message' => 'Relación ingrediente-alérgeno eliminada con éxito.']);
                } else {
                    echo json_encode(['error' => 'Error al eliminar la relación ingrediente-alérgeno.']);
                }
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere id_ingrediente y id_alergeno']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
