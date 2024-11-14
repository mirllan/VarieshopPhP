<?php
session_start(); // Asegurarte de que la sesión esté iniciada

// Incluir las funciones necesarias
require 'funciones.php';
require '../../vendor/autoload.php';

if(isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    // Instanciar la clase Zapatos
    $Zapatos = new varishop\Zapatos;

    // Llamar al metodo de eliminar zapato
    if ($Zapatos->eliminar($Id)) {
        // Si la eliminación es exitosa redirigir al listado de zapatos
        header("Location: index.php");
        exit;
    } else {
        // Si ocurre un error al eliminar redirigir de nuevo con un mensaje
        echo "Error al eliminar el zapato.";
    }
} else {
    // Si no se pasa el ID redirigir al listado
    header("Location: index.php");
    exit;
}
?>
