<?php

require_once __DIR__ . '/../Helpers/gbd.php';  // Asegúrate de que la ruta sea correcta

class RepoUsuarios
{

    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion; // Asegúrate de que la conexión esté pasando correctamente
    }

    // Método para obtener todos los usuarios
    public function obtenerUsuarios()
    {
        try {
            $query = "SELECT * FROM usuarios";
            $stmt = $this->conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener los usuarios: ' . $e->getMessage()];
        }
    }

    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorId($idUsuario)
    {
        try {
            $query = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener el usuario: ' . $e->getMessage()];
        }
    }

    public function autenticarUsuario($usuario, $pass)
    {
        try {
            // Consulta para buscar el usuario por su nombre
            $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            // Verifica si se encontró el usuario
            $usuarioEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioEncontrado) {
                // Verificar la contraseña usando password_verify
                if (($pass == $usuarioEncontrado['pass'])) {
                    return $usuarioEncontrado; // Contraseña correcta
                } else {
                    return ['error' => 'Contraseña incorrecta'];
                }
            } else {
                return ['error' => 'Usuario no encontrado'];
            }
        } catch (PDOException $e) {
            error_log('Error en la autenticación: ' . $e->getMessage());
            return ['error' => 'Error al autenticar el usuario'];
        }
    }






    // Método para crear un nuevo usuario
    public function crearUsuario($nombre, $apellidos, $telefono, $usuario, $pass, $tipo, $correo, $direccion)
    {
        try {
            // Comprobar si el nombre de usuario ya existe
            $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                throw new Exception("El nombre de usuario '$usuario' ya está en uso.");
            }

            // Insertar el nuevo usuario
            $query = "INSERT INTO usuarios (nombre, apellidos, telefono, usuario, pass, tipo, correo, direccion) 
                      VALUES (:nombre, :apellidos, :telefono, :usuario, :pass, :tipo, :correo, :direccion)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();

            return "Usuario '$usuario' creado exitosamente.";
        } catch (Exception $e) {
            return "Error al crear el usuario: " . $e->getMessage();
        }
    }


    // Método para actualizar un usuario
    public function actualizarUsuario($idUsuario, $nombre, $apellidos, $telefono, $usuario, $pass, $tipo, $correo, $direccion)
    {
        try {
            // Verificar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE id = :id_usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                throw new Exception("El usuario con ID '$idUsuario' no existe.");
            }

            // Si la contraseña es nueva, encriptarla

            // Actualizar el usuario
            $query = "UPDATE usuarios SET 
                      nombre = :nombre, 
                      apellidos = :apellidos, 
                      telefono = :telefono, 
                      usuario = :usuario, 
                      pass = COALESCE(:pass, pass), 
                      tipo = :tipo, 
                      correo = :correo, 
                      direccion = :direccion 
                      WHERE id = :id_usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':pass', $pass);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->execute();

            return "Usuario actualizado exitosamente.";
        } catch (Exception $e) {
            return "Error al actualizar el usuario: " . $e->getMessage();
        }
    }

    // Método para eliminar un usuario
    public function eliminarUsuario($idUsuario)
    {
        try {
            // Eliminar el usuario
            $query = "DELETE FROM usuarios WHERE id = :id_usuario";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':id_usuario', $idUsuario);
            $stmt->execute();

            return "Usuario eliminado exitosamente.";
        } catch (Exception $e) {
            return "Error al eliminar el usuario: " . $e->getMessage();
        }
    }
}
?>