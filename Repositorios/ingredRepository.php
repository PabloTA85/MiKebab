<?php
class IngredienteRepository {
    private $ingredientes = [];

    public function agregarIngrediente($ingrediente) {
        $this->ingredientes[] = $ingrediente;
    }

    public function obtenerIngredientes() {
        return $this->ingredientes;
    }

    public function obtenerIngredientePorId($id) {
        foreach ($this->ingredientes as $ingrediente) {
            if ($ingrediente->getId() == $id) {
                return $ingrediente;
            }
        }
        return null; 
    }

    public function actualizarIngrediente($id, $nombre, $precio, $foto) {
        $ingrediente = $this->obtenerIngredientePorId($id);
        if ($ingrediente) {
            $ingrediente->setNombre($nombre);
            $ingrediente->setPrecio($precio);
            $ingrediente->setFoto($foto);
        }
    }

    public function eliminarIngrediente($id) {
        foreach ($this->ingredientes as $index => $ingrediente) {
            if ($ingrediente->getId() == $id) {
                unset($this->ingredientes[$index]);
                break;
            }
        }
    }
}
?>

