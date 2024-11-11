<?php
require_once '../Helpers/gbd.php'; // Asegúrate de que la ruta es correcta
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProyectoKebab/Helpers/gbd.php';


class UsuarioRepository {
    private $usuarios = [];
    private $conexion;

    public function __construct() {
        $this->conexion = $conexion; // Asigna la conexión
        $this->cargarUsuarios(); // Carga los usuarios desde la base de datos
    }

    private function cargarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conexion->query($sql);

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuarios(
                $fila['nombre'],
                $fila['apellidos'],
                $fila['telefono'],
                $fila['usuario'],
                $fila['pass'],
                $fila['tipo'],
                $fila['correo'],
                $fila['id'] // Pasa el ID aquí
            );
            $this->usuarios[] = $usuario; // Agrega el usuario a la lista
        }
    }

    public function obtenerUsuarios() {
        return $this->usuarios; // Devuelve la lista de usuarios
    }
}
?>


