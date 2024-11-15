<?php
class Provincia {
    private $nombre;
    private $codprov;

    // Constructor
    public function __construct($nombre, $codprov) {
        $this->nombre = $nombre;
        $this->codprov = $codprov;
    }

    // Getters
    public function getNombre() {
        return $this->nombre;
    }

    public function getCodprov() {
        return $this->codprov;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCodprov($codprov) {
        $this->codprov = $codprov;
    }
}
?>
