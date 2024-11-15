<?php
class LineaPedidoRepository {
    private $lineasPedido = [];

    public function agregarLineaPedido($lineaPedido) {
        $this->lineasPedido[] = $lineaPedido;
    }

    public function obtenerLineasPedido() {
        return $this->lineasPedido;
    }

    public function obtenerLineaPedidoPorId($id) {
        foreach ($this->lineasPedido as $linea) {
            if ($linea->getId() == $id) {
                return $linea;
            }
        }
        return null; // Si no se encuentra
    }

    public function actualizarLineaPedido($id, $id_usuario, $id_kebab, $cantidad, $nombre_kebab) {
        $linea = $this->obtenerLineaPedidoPorId($id);
        if ($linea) {
            $linea->setIdUsuario($id_usuario);
            $linea->setIdKebab($id_kebab);
            $linea->setCantidad($cantidad);
            $linea->setNombreKebab($nombre_kebab);
        }
    }

    public function eliminarLineaPedido($id) {
        foreach ($this->lineasPedido as $index => $linea) {
            if ($linea->getId() == $id) {
                unset($this->lineasPedido[$index]);
                break;
            }
        }
    }
}
?>
