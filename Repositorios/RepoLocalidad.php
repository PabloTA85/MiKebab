<?php
require_once __DIR__ . '/../Helpers/gbd.php';


class RepoLocalidad {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear una nueva localidad
    public function crearLocalidad($nombreloc, $nombreprov) {
        $query = "INSERT INTO localidad (nombreloc, nombreprov) VALUES (:nombreloc, :nombreprov)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombreloc', $nombreloc, PDO::PARAM_STR);
        $stmt->bindValue(':nombreprov', $nombreprov, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Localidad creada con éxito.";
        } else {
            return "Error al crear la localidad: " . $stmt->errorInfo()[2];
        }
    }

    // Obtener todas las localidades
    public function obtenerLocalidades() {
        $query = "SELECT nombreloc, nombreprov FROM localidad";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar una localidad
    public function actualizarLocalidad($nombreloc, $nombreprov) {
        $query = "UPDATE localidad SET nombreprov = :nombreprov WHERE nombreloc = :nombreloc";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombreloc', $nombreloc, PDO::PARAM_STR);
        $stmt->bindValue(':nombreprov', $nombreprov, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Localidad actualizada con éxito.";
        } else {
            return "Error al actualizar la localidad: " . $stmt->errorInfo()[2];
        }
    }

    // Eliminar una localidad
    public function eliminarLocalidad($nombreloc) {
        $query = "DELETE FROM localidad WHERE nombreloc = :nombreloc";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombreloc', $nombreloc, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Localidad eliminada con éxito.";
        } else {
            return "Error al eliminar la localidad: " . $stmt->errorInfo()[2];
        }
    }
}
?>
