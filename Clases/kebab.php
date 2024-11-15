<?php
class Kebab {
    private $idKebab;
    private $nombre;
    private $foto;
    private $tipo;
    private $precio;

    // Constructor
    public function __construct($nombre, $foto = null, $tipo = null, $precio = 0.0, $idKebab = null) {
        $this->nombre = $nombre;
        $this->foto = $foto;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->idKebab = $idKebab; // Asignamos el ID si se pasa como argumento
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
    public function setIdKebab($idKebab) {
        $this->idKebab = $idKebab;
    }

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

