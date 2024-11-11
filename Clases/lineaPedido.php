<?php
class LineaPedido {
    private $id;
    private $id_usuario;
    private $id_kebab;
    private $cantidad;
    private $orden_linea;
    private $nombre_kebab;

    public function __construct($id_usuario, $id_kebab, $cantidad, $nombre_kebab = 'al gusto') {
        $this->id_usuario = $id_usuario;
        $this->id_kebab = $id_kebab;
        $this->cantidad = $cantidad;
        $this->nombre_kebab = $nombre_kebab;
    }

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getIdKebab() {
        return $this->id_kebab;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getOrdenLinea() {
        return $this->orden_linea;
    }

    public function getNombreKebab() {
        return $this->nombre_kebab;
    }

    // Métodos setter
    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setIdKebab($id_kebab) {
        $this->id_kebab = $id_kebab;
    }

    public function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    public function setOrdenLinea($orden_linea) {
        $this->orden_linea = $orden_linea;
    }

    public function setNombreKebab($nombre_kebab) {
        $this->nombre_kebab = $nombre_kebab;
    }
}
?>
