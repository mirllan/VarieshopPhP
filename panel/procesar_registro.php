<?php
require 'funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $email = $_POST['Email'];
    $telefono = $_POST['Telefono'];
    $direccion = $_POST['Direccion'];
    $password = $_POST['Contrasenia']; // Guardar contraseña sin encriptar


    // Conexión a la base de datos
    $conn = new PDO("mysql:host=localhost;dbname=varishop", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar nuevo usuario sin 'tipo_usuario'
    $stmt = $conn->prepare("INSERT INTO cliente (Nombre, Apellidos, Email, Telefono, Direccion, Contrasenia) 
                            VALUES (:nombre, :apellidos, :email, :telefono, :direccion, :contrasenia)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':contrasenia', $password);

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirige al inicio de sesión después de registrarse
    } else {
        echo "Error al registrar el usuario.";
    }
}
