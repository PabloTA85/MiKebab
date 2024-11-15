<?php
require_once __DIR__ . '/../Helpers/gbd.php';

class RepoKebabsIngredientes {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    // Método para agregar un ingrediente a un kebab
    public function agregarIngredienteAKebab($idKebab, $idIngrediente) {
        $query = "INSERT INTO kebabs_ingredientes (id_kebab, id_ingrediente) VALUES (?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(1, $idKebab, PDO::PARAM_INT);
        $stmt->bindValue(2, $idIngrediente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "Ingrediente agregado al kebab con éxito.";
        } else {
            return "Error al agregar el ingrediente al kebab: " . $stmt->errorInfo()[2];
        }
    }

    // Método para eliminar un ingrediente de un kebab
    public function eliminarIngredienteDeKebab($idKebab, $idIngrediente) {
        $query = "DELETE FROM kebabs_ingredientes WHERE id_kebab = ? AND id_ingrediente = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(1, $idKebab, PDO::PARAM_INT);
        $stmt->bindValue(2, $idIngrediente, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "Ingrediente eliminado del kebab con éxito.";
        } else {
            return "Error al eliminar el ingrediente del kebab: " . $stmt->errorInfo()[2];
        }
    }

    // Método para obtener todos los ingredientes de un kebab específico
    public function obtenerIngredientesDeKebab($idKebab) {
        $query = "SELECT i.idingrediente, i.nombre, i.precio, i.foto 
                  FROM ingredientes i
                  JOIN kebabs_ingredientes ki ON i.idingrediente = ki.id_ingrediente
                  WHERE ki.id_kebab = :id_kebab";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':id_kebab', $idKebab, PDO::PARAM_INT);
        $stmt->execute();
        
        // Obtener todos los resultados como un array asociativo
        $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $ingredientes;
    }

    // Método para obtener todos los kebabs que contienen un ingrediente específico
    public function obtenerKebabsConIngrediente($idIngrediente) {
        $query = "SELECT k.idKebab, k.nombre, k.precio
                  FROM kebabs k
                  JOIN kebabs_ingredientes ki ON k.idKebab = ki.id_kebab
                  WHERE ki.id_ingrediente = :id_ingrediente";
        
        $stmt = $this->conexion->prepare($query);
        $stmt->bindValue(':id_ingrediente', $idIngrediente, PDO::PARAM_INT);
        $stmt->execute();
        
        $kebabs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $kebabs;
    }
}
?>
