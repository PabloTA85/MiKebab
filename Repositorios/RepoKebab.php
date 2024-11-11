<?php
require_once 'Helpers/gbd.php';
require_once 'Clases/kebab.php';

class RepoKebab {
    
    // Método para obtener todos los kebabs
    public static function obtenerTodos() {
        global $conexion;
        $consulta = $conexion->query("SELECT * FROM kebabs");
        $kebabs = [];
        
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $kebabs[] = new Kebab(
                $row['nombre'], 
                $row['foto'], 
                $row['tipo'], 
                $row['precio']
            );
        }
        
        return $kebabs;
    }

    // Método para obtener un kebab por su ID
    public static function obtenerPorId($idKebab) {
        global $conexion;
        $consulta = $conexion->prepare("SELECT * FROM kebabs WHERE idKebab = ?");
        $consulta->execute([$idKebab]);
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Kebab(
                $row['nombre'], 
                $row['foto'], 
                $row['tipo'], 
                $row['precio']
            );
        }
        return null; // Si no se encuentra el kebab
    }

    // Método para agregar un kebab a la base de datos
    public static function agregar(Kebab $kebab) {
        global $conexion;
        $consulta = $conexion->prepare("INSERT INTO kebabs (nombre, foto, tipo, precio) VALUES (?, ?, ?, ?)");
        $consulta->execute([
            $kebab->getNombre(),
            $kebab->getFoto(),
            $kebab->getTipo(),
            $kebab->getPrecio()
        ]);
    }

    // Método para actualizar un kebab en la base de datos
    public static function actualizar(Kebab $kebab, $idKebab) {
        global $conexion;
        $consulta = $conexion->prepare("UPDATE kebabs SET nombre = ?, foto = ?, tipo = ?, precio = ? WHERE idKebab = ?");
        $consulta->execute([
            $kebab->getNombre(),
            $kebab->getFoto(),
            $kebab->getTipo(),
            $kebab->getPrecio(),
            $idKebab
        ]);
    }

    // Método para eliminar un kebab de la base de datos
    public static function eliminar($idKebab) {
        global $conexion;
        $consulta = $conexion->prepare("DELETE FROM kebabs WHERE idKebab = ?");
        $consulta->execute([$idKebab]);
    }
}
?>
