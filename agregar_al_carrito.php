<?php
session_start();
require 'funciones.php';

// Aquí se asume que los datos del producto a agregar están en $_GET o $_POST
$id = $_GET['id'];
$nombre = $_GET['nombre'];
$precio = $_GET['precio'];

// Si el carrito no existe, lo inicializamos como un array vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Verificamos si el producto ya está en el carrito
$encontrado = false;
foreach ($_SESSION['carrito'] as &$item) {
    if ($item['Id'] == $id) {
        $item['Cantidad'] += 1; // Aumenta la cantidad si ya está en el carrito
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    // Si el producto no está en el carrito, lo agregamos
    $_SESSION['carrito'][] = [
        'Id' => $id,
        'Nombre' => $nombre,
        'Precio' => $precio,
        'Cantidad' => 1
    ];
}

// Redirigir de nuevo al carrito o a otra página
header("Location: carrito.php");
exit();

?>
