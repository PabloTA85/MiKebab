<?php
require_once __DIR__ . '/../Helpers/gbd.php';

class RepoIngredientesAlergenos {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para agregar una relación entre ingrediente y alérgeno
    public function agregarIngredienteAlergeno($idIngrediente, $idAlergeno) {
        $query = "INSERT INTO ingredientes_alergenos (idIngrediente, idAlergeno) VALUES (:idIngrediente, :idAlergeno)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(":idIngrediente", $idIngrediente, PDO::PARAM_INT);
        $stmt->bindValue(":idAlergeno", $idAlergeno, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Método para obtener todos los alérgenos de un ingrediente específico
    public function obtenerAlergenosPorIngrediente($idIngrediente) {
        $query = "SELECT a.idAlergeno, a.nombre
                  FROM alergenos a
                  JOIN ingredientes_alergenos ia ON a.idAlergeno = ia.idAlergeno
                  WHERE ia.idIngrediente = :idIngrediente";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(":idIngrediente", $idIngrediente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para eliminar una relación entre un ingrediente y un alérgeno
    public function eliminarIngredienteAlergeno($idIngrediente, $idAlergeno) {
        $query = "DELETE FROM ingredientes_alergenos WHERE idIngrediente = :idIngrediente AND idAlergeno = :idAlergeno";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(":idIngrediente", $idIngrediente, PDO::PARAM_INT);
        $stmt->bindValue(":idAlergeno", $idAlergeno, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
