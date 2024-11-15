<?php
class Alergeno {
    private $idAlergeno;
    private $nombre;
    

    public function __construct($nombre) {
        $this->nombre = $nombre;
    }

    // Métodos getter
    public function idAlergeno() {
        return $this->idAlergeno;
    }

    public function getNombre() {
        return $this->nombre;
    }


    // Métodos setter
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
?>