<?php
class Direccion {
    private $id;
    private $calle;
    private $numero;
    private $nombreloc;

    // Constructor
    public function __construct($id, $calle, $numero, $nombreloc) {
        $this->id = $id;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->nombreloc = $nombreloc;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getCalle() {
        return $this->calle;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getNombreloc() {
        return $this->nombreloc;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setCalle($calle) {
        $this->calle = $calle;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setNombreloc($nombreloc) {
        $this->nombreloc = $nombreloc;
    }
}
?>
