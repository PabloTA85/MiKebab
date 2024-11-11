<?php

// Conexión a la base de datos
require_once '../Helpers/gbd.php';  // Ruta correcta hacia gbd.php

// Establecer la cabecera para indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Obtener el método de la solicitud HTTP (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Enrutamiento de las solicitudes
switch ($method) {
    case 'GET':
        // Lógica para obtener kebabs
        try {
            $consulta = $conexion->query("SELECT * FROM kebabs");
            $kebabs = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($kebabs);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al consultar los kebabs: ' . $e->getMessage()]);
        }
        break;

    case 'POST':
        // Lógica para crear un nuevo kebab (recibir datos y guardarlos)
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'] ?? '';
        $precio = $input['precio'] ?? '';

        if ($nombre && $precio) {
            try {
                $consulta = $conexion->prepare("INSERT INTO kebabs (nombre, precio) VALUES (:nombre, :precio)");
                $consulta->execute([':nombre' => $nombre, ':precio' => $precio]);
                echo json_encode(['message' => 'Kebab creado exitosamente']);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Error al crear el kebab: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
        break;

    case 'PUT':
        // Lógica para actualizar un kebab
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? '';
        $nombre = $input['nombre'] ?? '';
        $precio = $input['precio'] ?? '';

        if ($id && ($nombre || $precio)) {
            try {
                $consulta = $conexion->prepare("UPDATE kebabs SET nombre = :nombre, precio = :precio WHERE id = :id");
                $consulta->execute([':nombre' => $nombre, ':precio' => $precio, ':id' => $id]);
                echo json_encode(['message' => 'Kebab actualizado']);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Error al actualizar el kebab: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'Datos incompletos']);
        }
        break;

    case 'DELETE':
        // Lógica para eliminar un kebab
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? '';

        if ($id) {
            try {
                $consulta = $conexion->prepare("DELETE FROM kebabs WHERE id = :id");
                $consulta->execute([':id' => $id]);
                echo json_encode(['message' => 'Kebab eliminado']);
            } catch (PDOException $e) {
                echo json_encode(['error' => 'Error al eliminar el kebab: ' . $e->getMessage()]);
            }
        } else {
            echo json_encode(['error' => 'ID no proporcionado']);
        }
        break;

    default:
        // Si el método HTTP no es soportado
        echo json_encode(['error' => 'Método no soportado']);
        break;
}
?>
