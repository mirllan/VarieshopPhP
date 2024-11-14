<?php
session_start(); // Inicia la sesión
session_destroy(); // Destruye todos los datos de la sesión

// Evitar que la página se almacene en caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

header('Location: login.php'); // Redirige al inicio de sesión
exit; // Termina el script después de redirigir
?>
