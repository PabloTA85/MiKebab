<?php
require_once __DIR__ . '/../Helpers/gbd.php';


class RepoProvincia {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Crear una nueva provincia
    public function crearProvincia($nombre, $codprov) {
        $query = "INSERT INTO provincias (nombre, codprov) VALUES (:nombre, :codprov)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':codprov', $codprov, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Provincia creada con éxito.";
        } else {
            return "Error al crear la provincia: " . $stmt->errorInfo()[2];
        }
    }

    // Obtener todas las provincias
    public function obtenerProvincias() {
        $query = "SELECT nombre, codprov FROM provincia";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar una provincia
    public function actualizarProvincia($nombre, $codprov) {
        $query = "UPDATE provincia SET nombre = :nombre WHERE codprov = :codprov";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindValue(':codprov', $codprov, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Provincia actualizada con éxito.";
        } else {
            return "Error al actualizar la provincia: " . $stmt->errorInfo()[2];
        }
    }

    // Eliminar una provincia
    public function eliminarProvincia($codprov) {
        $query = "DELETE FROM provincia WHERE codprov = :codprov";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':codprov', $codprov, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return "Provincia eliminada con éxito.";
        } else {
            return "Error al eliminar la provincia: " . $stmt->errorInfo()[2];
        }
    }
}
?>
