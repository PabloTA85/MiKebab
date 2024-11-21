<?php
require_once __DIR__ . '/../Repositorios/RepoLocalidad.php';
require_once __DIR__ . '/../Helpers/gbd.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$localidadRepo = new RepoLocalidad($conexion);
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch ($method) {
    case 'GET':
        if ($action === 'obtenerLocalidades') {
            echo json_encode($localidadRepo->obtenerLocalidades());
        } else {
            echo json_encode(['error' => 'Acción no especificada o incorrecta']);
        }
        break;

    case 'POST':
        if ($action === 'crearLocalidad') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nombreloc'], $data['nombreprov'])) {
                $response = $localidadRepo->crearLocalidad($data['nombreloc'], $data['nombreprov']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere nombreloc y nombreprov']);
            }
        }
        break;

    case 'PUT':
        if ($action === 'actualizarLocalidad') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nombreloc'], $data['nombreprov'])) {
                $response = $localidadRepo->actualizarLocalidad($data['nombreloc'], $data['nombreprov']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere nombreloc y nombreprov']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarLocalidad') {
            $data = json_decode(file_get_contents("php://input"), true);
            if (isset($data['nombreloc'])) {
                $response = $localidadRepo->eliminarLocalidad($data['nombreloc']);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos: se requiere nombreloc']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
?>
