<?php

require_once __DIR__ . '/../Helpers/gbd.php';

class RepoIngrediente {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerIngredientes() {
        try {
            $consulta = $this->conexion->prepare("SELECT i.*, a.nombre as alergeno FROM kebab.ingredientes i
                                                    INNER JOIN kebab.ingredientes_alergenos ia ON i.idIngrediente = ia.idIngrediente
                                                    INNER JOIN kebab.alergenos a ON ia.idAlergeno = a.idAlergeno");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Error al obtener los ingredientes: ' . $e->getMessage()];
        }
    }

    public function crearIngrediente($nombre, $imagen, $precio, $foto) {
        try {
            $query = "SELECT * FROM ingredientes WHERE nombre = :nombre";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return "El ingrediente con el nombre '$nombre' ya existe.";
            }

            $query = "INSERT INTO ingredientes (nombre, imagen, precio, foto) VALUES (:nombre, :imagen, :precio, :foto)";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':foto', $foto);
            $stmt->execute();

            return "Ingrediente '$nombre' creado exitosamente.";
        } catch (Exception $e) {
            return "Error al crear el ingrediente: " . $e->getMessage();
        }
    }

    public function actualizarIngrediente($idIngrediente, $nombre, $imagen, $precio, $foto) {
        try {
            $query = "SELECT * FROM ingredientes WHERE idIngrediente = :idIngrediente";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':idIngrediente', $idIngrediente);
            $stmt->execute();
            if ($stmt->rowCount() == 0) {
                return "El ingrediente con ID '$idIngrediente' no existe.";
            }

            $query = "UPDATE ingredientes SET nombre = :nombre, imagen = :imagen, precio = :precio, foto = :foto WHERE idIngrediente = :idIngrediente";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':idIngrediente', $idIngrediente);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':foto', $foto);
            $stmt->execute();

            return "Ingrediente actualizado exitosamente.";
        } catch (Exception $e) {
            return "Error al actualizar el ingrediente: " . $e->getMessage();
        }
    }

    public function eliminarIngrediente($idIngrediente) {
        try {
            $query = "DELETE FROM ingredientes WHERE idIngrediente = :idIngrediente";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':idIngrediente', $idIngrediente);
            $stmt->execute();

            return "Ingrediente eliminado exitosamente.";
        } catch (Exception $e) {
            return "Error al eliminar el ingrediente: " . $e->getMessage();
        }
    }

    public function buscarPorNombre($nombre) {
        try {
            $query = "SELECT * FROM ingredientes WHERE nombre LIKE :nombre";
            $stmt = $this->conexion->prepare($query);
            $nombre = "%$nombre%";
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al buscar ingredientes: " . $e->getMessage();
        }
    }

    public function buscarPorPrecio($precioMin, $precioMax) {
        try {
            $query = "SELECT * FROM ingredientes WHERE precio BETWEEN :precioMin AND :precioMax";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':precioMin', $precioMin);
            $stmt->bindParam(':precioMax', $precioMax);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al buscar ingredientes por precio: " . $e->getMessage();
        }
    }

    public function buscarPorId($idIngrediente) {
        try {
            $query = "SELECT * FROM ingredientes WHERE idIngrediente = :idIngrediente";
            $stmt = $this->conexion->prepare($query);
            $stmt->bindParam(':idIngrediente', $idIngrediente);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al buscar ingrediente por ID: " . $e->getMessage();
        }
    }
}
?>
