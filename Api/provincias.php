<?php
require_once __DIR__ . '/../Repositorios/RepoProvincia.php';
require_once __DIR__ . '/../Helpers/gbd.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$provinciaRepo = new RepoProvincia($conexion);
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch ($method) {
    case 'GET':
        if ($action === 'obtenerProvincias') {
            echo json_encode($provinciaRepo->obtenerProvincias());
        } else {
            echo json_encode(['error' => 'Acción no especificada o incorrecta']);
        }
        break;

    case 'POST':
        if ($action === 'crearProvincia') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nombre'], $data['codprov'])) {
                $response = $provinciaRepo->crearProvincia($data['nombre'], $data['codprov']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere nombre y codprov']);
            }
        }
        break;

    case 'PUT':
        if ($action === 'actualizarProvincia') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nombre'], $data['codprov'])) {
                $response = $provinciaRepo->actualizarProvincia($data['nombre'], $data['codprov']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere nombre y codprov']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarProvincia') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['codprov'])) {
                $response = $provinciaRepo->eliminarProvincia($data['codprov']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere codprov']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
?>
