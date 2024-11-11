<?php
class Kebab {
    private $idKebab;
    private $nombre;
    private $foto;
    private $tipo;
    private $precio;

    public function __construct($nombre, $foto = null, $tipo = null, $precio = 0.0) {
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->tipo = $tipo;
        $this->precio = $precio;
    }

    // Métodos getter
    public function getIdKebab() {
        return $this->idKebab;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getPrecio() {
        return $this->precio;
    }

    // Métodos setter
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
}
?>
