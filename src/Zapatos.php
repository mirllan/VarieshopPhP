<?php
namespace varishop;

class Zapatos {
    private $config;
    private $cn = null;

    // Constructor para iniciar la conexión
    public function __construct() {
        $this->config = parse_ini_file(__DIR__.'/../config.ini');
        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    // Método para registrar un nuevo zapato
    public function registrar($_params) {
        $sql = "INSERT INTO `zapato` (`Nombre`, `Marca`, `Talla`, `Foto`, `Precio`, `Categoria_id`, `Fecha`) VALUES (:Nombre, :Marca, :Talla, :Foto, :Precio, :Categoria_id, :Fecha)";
        
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Nombre" => $_params['Nombre'], 
            ":Marca" => $_params['Marca'], 
            ":Talla" => $_params['Talla'],
            ":Foto" => $_params['Foto'], 
            ":Precio" => $_params['Precio'], 
            ":Categoria_id" => $_params['Categoria_id'], 
            ":Fecha" => $_params['Fecha']
        );

        return $resultado->execute($_array);
    }

    // Método para actualizar un zapato existente
    public function actualizar($_params) {
        $sql = "UPDATE zapato SET Nombre = :Nombre, Marca = :Marca, Talla = :Talla, Foto = :Foto, Precio = :Precio, Categoria_id = :Categoria_id, Fecha = :Fecha WHERE Id = :Id";
        
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Nombre" => $_params['Nombre'], 
            ":Marca" => $_params['Marca'], 
            ":Talla" => $_params['Talla'],
            ":Foto" => $_params['Foto'], 
            ":Precio" => $_params['Precio'], 
            ":Categoria_id" => $_params['Categoria_id'], 
            ":Fecha" => $_params['Fecha'],
            ":Id" => $_params['Id']
        );

        return $resultado->execute($_array);
    }
    

    // Método para eliminar un zapato
    public function eliminar($Id) {
        $sql = "DELETE FROM `zapato` WHERE `Id` = :Id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(":Id" => $Id);

        return $resultado->execute($_array);
    }

    // Método para mostrar todos los zapatos
    public function mostrar() {
        $sql = "SELECT zapato.Id, zapato.Nombre, zapato.Marca, zapato.Talla, zapato.Foto, zapato.Precio, zapato.Fecha, zapato.Estado, categoria.Nombre1 AS NombreCategoria
                FROM zapato 
                INNER JOIN categoria ON zapato.Categoria_id = categoria.Id 
                ORDER BY zapato.Id DESC";
        
        $resultado = $this->cn->prepare($sql);
    
        if ($resultado->execute()) {
            return $resultado->fetchAll(\PDO::FETCH_ASSOC);
        }
    
        return false;
    }
    

    // Método para mostrar un zapato por su Id
    public function mostrarPorId($Id) {
        $sql = "SELECT * FROM `zapato` WHERE `Id` = :Id";

        $resultado = $this->cn->prepare($sql);
        $_array = array(":Id" => $Id);

        if ($resultado->execute($_array)) {
            return $resultado->fetch();
        }

        return false;
    }
}
