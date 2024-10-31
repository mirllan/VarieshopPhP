<?php
namespace varishop;

class Zapatos {
    private $config;
    private $cn = null;


    #esta es la primer funcion que se ejecuta
    public function __construct(){
        $this->config = parse_ini_file(__DIR__.'/../config.ini');
        $this->cn = new \PDO($this->config['dns'],$this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMAND => 'SET NAMES utf8'
        ));
    }


    public function registrar($_params){

        $sql = "INSERT INTO `zapato`(`Nombre`, `Marca`, `Foto`, `Precio`, `Categoria_id`, `Fecha`) VALUES (:Nombre, :Marca, :Foto, :Precio, :Categoria_id, :Fecha)";
        
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Nombre" => $_params['Nombre'], 
            ":Marca"=> $_params['Marca'], 
            ":Foto"=> $_params['Foto'], 
            ":Precio"=> $_params['Precio'], 
            ":Categoria_id"=> $_params['Categoria_id'], 
            ":Fecha"=> $_params['Fecha']
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }


    public function actualizar($_params){

        $sql = "UPDATE `zapato` SET `Nombre`=:Nombre,`Marca`=:Marca,`Foto`=:Foto,`Precio`=:Precio,`Categoria_id`=:Categoria_id,`Fecha`=:Fecha, WHERE `Id`=:Id";
        
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Nombre" => $_params['Nombre'], 
            ":Marca"=> $_params['Marca'], 
            ":Foto"=> $_params['Foto'], 
            ":Precio"=> $_params['Precio'], 
            ":Categoria_id"=> $_params['Categoria_id'], 
            ":Fecha"=> $_params['Fecha'],
            ":Id"=> $_params['Id']
        );
        if ($resultado->execute($_array))
            return true;

        return false;
    }


    public function eliminar($Id){

        $sql = "DELETE FROM `zapato` WHERE `Id`=:Id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":Id"=> $_params['Id']
        );

        if ($resultado->execute($_array))
            return true;

        return false;   
    }


    public function mostrar(){

        $sql = "SELECT zapato.Id, zapato.Nombre, zapato.Marca, zapato.Foto, zapato.Precio, zapato.Fecha, zapato.Estado FROM zapato INNER JOIN categoria ON zapato.Categoria_id = categoria.Id ORDER BY zapato.Id DESC;";

        $resultado = $this->cn->prepare($sql);  

        if ($resultado->execute())
            return $resultado->fetchAll();

        return false;
    }


    public function mostrarPorId($Id){

        $sql = "SELECT * FROM `zapato` WHERE `zapato`=:Id";

        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":Id"=> $_params['Id']
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
}