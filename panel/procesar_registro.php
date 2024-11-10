<?php
session_start();
require '../vendor/autoload.php';

// Configuración de conexión a la base de datos
$config = parse_ini_file(__DIR__.'/../config.ini');
$pdo = new PDO($config['dns'], $config['usuario'], $config['clave'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos los datos del formulario
    $Nombre = $_POST['Nombre'] ?? null;
    $Apellidos = $_POST['Apellidos'] ?? null;
    $Email = $_POST['Email'] ?? null;
    $Telefono = $_POST['Telefono'] ?? null;

    if ($Nombre && $Apellidos && $Email && $Telefono) { 
        // Insertar los datos en la tabla 'cliente'
        $sql = "INSERT INTO cliente (Nombre, Apellidos, Email, Telefono) VALUES (:Nombre, :Apellidos, :Email, :Telefono)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute([':Nombre' => $Nombre, ':Apellidos' => $Apellidos, ':Email' => $Email, ':Telefono' => $Telefono])) {
            echo "¡Registro exitoso!";
            header('Location: index.php'); // Redirige al inicio de sesión después de registrarse
            exit;
        } else {
            echo "Error al registrar el usuario.";
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>
