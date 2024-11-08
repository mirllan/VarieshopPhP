<?php
session_start();
require 'funciones.php';

$id = $_GET['id'];
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
$precio = isset($_GET['precio']) ? $_GET['precio'] : 0;

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$encontrado = false;
foreach ($_SESSION['carrito'] as &$item) {
    if ($item['Id'] == $id) {
        $item['Cantidad'] += 1;
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    $_SESSION['carrito'][] = [
        'Id' => $id,
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Cantidad' => 1
    ];
}

header("Location: carrito.php");
exit();
?>
