<?php
class Localidad {
    private $nombreloc;
    private $nombreprov;

    // Constructor
    public function __construct($nombreloc, $nombreprov) {
        $this->nombreloc = $nombreloc;
        $this->nombreprov = $nombreprov;
    }

    // Getters
    public function getNombreloc() {
        return $this->nombreloc;
    }

    public function getNombreprov() {
        return $this->nombreprov;
    }

    // Setters
    public function setNombreloc($nombreloc) {
        $this->nombreloc = $nombreloc;
    }

    public function setNombreprov($nombreprov) {
        $this->nombreprov = $nombreprov;
    }
}
?>
