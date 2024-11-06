<?php
session_start();
require 'funciones.php';

if (isset($_GET['id'])) {
    eliminarDelCarrito($_GET['id']);
}

header('Location: carrito.php');
exit();
?>
