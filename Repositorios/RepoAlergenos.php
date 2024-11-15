<?php
require_once __DIR__ . '/../Helpers/gbd.php';

class RepoAlergenos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para agregar un alérgeno
    public function agregarAlergeno($nombre) {
        $query = "INSERT INTO alergenos (nombre) VALUES (:nombre)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(":nombre", $nombre, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Método para obtener todos los alérgenos
    public function obtenerAlergenos() {
        $query = "SELECT * FROM alergenos";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para eliminar un alérgeno por ID
    public function eliminarAlergeno($idAlergeno) {
        $query = "DELETE FROM alergenos WHERE idAlergeno = :idAlergeno";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(":idAlergeno", $idAlergeno, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
