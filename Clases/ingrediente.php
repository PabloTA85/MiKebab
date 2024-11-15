<?php
class Ingrediente {
    private $idIngrediente;
    private $nombre;
    private $imagen;
    private $precio;
    private $foto;

    public function __construct($idIngrediente, $nombre, $imagen, $precio, $foto) {
        $this->idIngrediente = $idIngrediente;
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->precio = $precio;
        $this->foto = $foto;
    }


    // Métodos getter
    public function getidIngrediente() {
        return $this->idIngrediente;
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function getImagen() {
        return $this->imagen;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getFoto() {
        return $this->foto;
    }

    // Métodos setter
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setImagen($imagen) {
        $this->nombre = $imagen;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }
}
?>
