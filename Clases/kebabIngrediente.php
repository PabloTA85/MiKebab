<?php
class KebabIngrediente {
    private $idKebab;
    private $idIngrediente;

    public function __construct($idKebab, $idIngrediente) {
        $this->idKebab = $idKebab;
        $this->idIngrediente = $idIngrediente;
    }

    // Métodos getter
    public function getIdKebab() {
        return $this->idKebab;
    }

    public function getIdIngrediente() {
        return $this->idIngrediente;
    }

    // Métodos setter
    public function setIdKebab($idKebab) {
        $this->idKebab = $idKebab;
    }

    public function setIdIngrediente($idIngrediente) {
        $this->idIngrediente = $idIngrediente;
    }
}
?>
