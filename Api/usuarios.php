<?php

require_once __DIR__ . '/../Repositorios/RepoUsuario.php';  // Incluye la clase RepoUsuarios 
require_once __DIR__ . '/../Helpers/gbd.php';  // Incluye la conexión

// Establecer encabezados para JSON y permitir CORS
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://www.mykebab.com");

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Crear instancia de RepoUsuarios con la conexión
$usuariosRepo = new RepoUsuarios($conexion);

// Detectar el método de solicitud HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Acción específica, como obtener, crear, actualizar, eliminar
$action = $_GET['action'] ?? '';

// Router para manejar las diferentes solicitudes
switch ($method) {
    case 'GET':
        if ($action === 'obtenerUsuarios') {
            // Obtener todos los usuarios
            echo json_encode($usuariosRepo->obtenerUsuarios());
        } elseif ($action === 'obtenerUsuarioPorId') {
            // Obtener un usuario por ID
            $idUsuario = $_GET['id_usuario'] ?? null;
            if ($idUsuario) {
                echo json_encode($usuariosRepo->obtenerUsuarioPorId($idUsuario));
            } else {
                echo json_encode(['error' => 'ID de usuario es requerido']);
            }
        }
        break;

    case 'POST':
        if ($action === 'loginUsuario') {
            // Verificar las credenciales de login
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data && isset($data['usuario'], $data['pass'])) {
                $usuario = $data['usuario'];
                $pass = $data['pass'];
                
                // Llamar al método para autenticar al usuario
                $respuesta = $usuariosRepo->autenticarUsuario($usuario, $pass);

                if (isset($respuesta['error'])) {
                    // Si hay un error (como usuario no encontrado o contraseña incorrecta)
                    echo json_encode(['error' => $respuesta['error']]);
                } else {
                    // Si la autenticación es exitosa
                    echo json_encode([
                        'message' => 'Autenticación exitosa',
                        'usuario' => [
                            'id' => $respuesta['id'],
                            'nombre' => $respuesta['nombre'],
                            'usuario' => $respuesta['usuario'],
                            'tipo' => $respuesta['tipo']
                        ]
                    ]);
                }
            } else {
                echo json_encode(['error' => 'Datos inválidos para el login']);
            }
        } elseif ($action === 'crearUsuario') {
            // Crear un nuevo usuario
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data) {
                $nombre = $data['nombre'];
                $apellidos = $data['apellidos'];
                $telefono = $data['telefono'];
                $usuario = $data['usuario'];
                $pass = $data['pass'];
                $tipo = $data['tipo'];
                $correo = $data['correo'];
                $direccion = $data['direccion'];

                // Llamar al método para crear un usuario
                $response = $usuariosRepo->crearUsuario($nombre, $apellidos, $telefono, $usuario, $pass, $tipo, $correo, $direccion);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos para crear el usuario']);
            }
        }
        break;

    case 'PUT':
        if ($action === 'actualizarUsuario') {
            // Actualizar un usuario existente
            $data = json_decode(file_get_contents("php://input"), true);
            if ($data) {
                $idUsuario = $data['id'];
                $nombre = $data['nombre'];
                $apellidos = $data['apellidos'];
                $telefono = $data['telefono'];
                $usuario = $data['usuario'];
                $pass = $data['pass'];
                $tipo = $data['tipo'];
                $correo = $data['correo'];
                $direccion = $data['direccion'];

                // Llamar al método para actualizar el usuario
                $response = $usuariosRepo->actualizarUsuario($idUsuario, $nombre, $apellidos, $telefono, $usuario, $pass, $tipo, $correo, $direccion);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'Datos inválidos para actualizar el usuario']);
            }
        }
        break;

    case 'DELETE':
        if ($action === 'eliminarUsuario') {
            // Eliminar un usuario
            $idUsuario = $_GET['id_usuario'] ?? null;
            if ($idUsuario) {
                $response = $usuariosRepo->eliminarUsuario($idUsuario);
                echo json_encode(['message' => $response]);
            } else {
                echo json_encode(['error' => 'ID de usuario es requerido']);
            }
        }
        break;

    default:
        echo json_encode(['error' => 'Método HTTP no soportado']);
        break;
}
?>

