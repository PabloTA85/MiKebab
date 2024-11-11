<?php
class Usuarios {
    private $id;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $usuario;
    private $pass;
    private $tipo;
    private $correo;

    public function __construct($nombre, $apellidos, $telefono, $usuario, $pass, $tipo, $correo, $id = null) {
        $this->id = $id; // Aquí asignamos el ID, que puede ser nulo si no se pasa.
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->usuario = $usuario;
        $this->pass = $pass;
        $this->tipo = $tipo;
        $this->correo = $correo;
    }
    

    // Métodos getter
    public function getId() {
        return $this->id; 
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCorreo() {
        return $this->correo;
    }

    // Métodos setter con validación básica
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setPass($pass) {
        $this->pass = $pass;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setId($id) {
        $this->id = $id;
    }
    

    public function setCorreo($correo) {
        // Validación simple del correo
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->correo = $correo;
        } else {
            throw new Exception("El formato del correo es inválido");
        }
    }
}
?>
