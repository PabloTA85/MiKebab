<?php

require_once __DIR__ . '/../Helpers/gbd.php'; // Asegúrate de que la ruta sea correcta

class RepoKebab {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion; // Asegúrate de que la conexión esté pasando correctamente
    }

    // Método para obtener todos los kebabs
    public function obtenerKebabs() {
        global $conexion;  // Usamos la conexión global desde gbd.php

        try {
            $consulta = $conexion->prepare("SELECT * FROM KEBABS");  
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error al obtener los kebabs: ' . $e->getMessage()]);
            exit;
        }
    }

    // Crear un nuevo kebab
    public function crearKebab($nombre, $foto, $tipo, $precio, $ingredientes) {
        global $conexion;  // Usamos la conexión global desde gbd.php

        try {
            // Verificar si el nombre del kebab ya existe
            $query = "SELECT * FROM KEBABS WHERE nombre = :nombre";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                throw new Exception("El kebab con el nombre '$nombre' ya existe.");
            }

            // Insertar el kebab en la tabla KEBABS
            $query = "INSERT INTO KEBABS (nombre, foto, tipo, precio) VALUES (:nombre, :foto, :tipo, :precio)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();

            // Obtener el ID del nuevo kebab
            $idKebab = $conexion->lastInsertId();

            // Insertar los ingredientes asociados utilizando el array de IDs de ingredientes
            $this->insertarIngredientes($idKebab, $ingredientes);

            return "Kebab '$nombre' creado exitosamente.";
        } catch (Exception $e) {
            return "Error al crear el kebab: " . $e->getMessage();
        }
    }

    // Insertar ingredientes en la relación KEBABS_INGREDIENTES
    private function insertarIngredientes($idKebab, $ingredientes) {
        global $conexion;  // Usamos la conexión global desde gbd.php
        foreach ($ingredientes as $ingrediente) {
            $query = "INSERT INTO KEBABS_INGREDIENTES (id_kebab, id_ingrediente) VALUES (:idKebab, :id_ingrediente)";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idKebab', $idKebab);
            $stmt->bindParam(':id_ingrediente', $ingrediente);
            $stmt->execute();
        }
    }

    // Actualizar un kebab
    public function actualizarKebab($idKebab, $nombre,  $foto, $tipo, $precio, $ingredientes) {
        global $conexion;  // Usamos la conexión global desde gbd.php
        try {
            // Verificar si el kebab existe
            $query = "SELECT * FROM KEBABS WHERE idKebab = :idKebab";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idKebab', $idKebab);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                throw new Exception("El kebab con ID '$idKebab' no existe.");
            }

            // Actualizar el kebab
            $query = "UPDATE KEBABS SET nombre = :nombre, foto = :foto, tipo = :tipo, precio = :precio WHERE idKebab = :idKebab";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idKebab', $idKebab);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':precio', $precio);
            $stmt->execute();

            // Actualizar los ingredientes
            $this->actualizarIngredientes($idKebab, $ingredientes);

            return "Kebab actualizado exitosamente.";
        } catch (Exception $e) {
            return "Error al actualizar el kebab: " . $e->getMessage();
        }
    }

    // Actualizar los ingredientes de un kebab
    private function actualizarIngredientes($idKebab, $ingredientes) {
        global $conexion;  // Usamos la conexión global desde gbd.php
        // Eliminar ingredientes anteriores
        $query = "DELETE FROM KEBABS_INGREDIENTES WHERE id_kebab = :idKebab";
        $stmt = $conexion->prepare($query);
        $stmt->bindParam(':idKebab', $idKebab);
        $stmt->execute();

        // Insertar los nuevos ingredientes
        $this->insertarIngredientes($idKebab, $ingredientes);
    }

    // Buscar kebabs por ingrediente
    public function buscarPorIngrediente($idIngrediente) {
        global $conexion;  // Usamos la conexión global desde gbd.php
        try {
            $query = "SELECT k.* FROM KEBABS k 
                      INNER JOIN KEBABS_INGREDIENTES ki ON k.idKebab = ki.id_kebab
                      WHERE ki.id_ingrediente = :id_ingrediente";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':id_ingrediente', $idIngrediente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al buscar kebabs por ingrediente: " . $e->getMessage();
        }
    }

    // Eliminar un kebab
    public function eliminarKebab($idKebab) {
        global $conexion;  // Usamos la conexión global desde gbd.php
        try {
            // Eliminar ingredientes relacionados
            $query = "DELETE FROM KEBABS_INGREDIENTES WHERE id_Kebab = :idKebab";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idKebab', $idKebab);
            $stmt->execute();

            // Eliminar el kebab
            $query = "DELETE FROM KEBABS WHERE idKebab = :idKebab";
            $stmt = $conexion->prepare($query);
            $stmt->bindParam(':idKebab', $idKebab);
            $stmt->execute();

            return "Kebab eliminado exitosamente.";
        } catch (Exception $e) {
            return "Error al eliminar el kebab: " . $e->getMessage();
        }
    }
}
?>





