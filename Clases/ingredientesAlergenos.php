<?php
class IngredienteAlergeno {
    private $idIngrediente;
    private $idAlergeno;

    // Constructor
    public function __construct($idIngrediente, $idAlergeno) {
        $this->idIngrediente = $idIngrediente;
        $this->idAlergeno = $idAlergeno;
    }

    // Métodos getters y setters
    public function getIdIngrediente() {
        return $this->idIngrediente;
    }

    public function setIdIngrediente($idIngrediente) {
        $this->idIngrediente = $idIngrediente;
    }

    public function getIdAlergeno() {
        return $this->idAlergeno;
    }

    public function setIdAlergeno($idAlergeno) {
        $this->idAlergeno = $idAlergeno;
    }
}
?>
