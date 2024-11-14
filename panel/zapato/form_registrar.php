<?php
session_start();

// Incluir el archivo de la clase Zapatos con el namespace adecuado
require_once('../../src/Zapatos.php'); // Asegúrate de que la ruta sea correcta

// Usar el namespace de la clase Zapatos
use varishop\Zapatos;

// Crear una instancia de la clase Zapatos
$zapatos = new Zapatos();

// Verificar si se envió el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $nombre = $_POST['Nombre'];
    $talla = $_POST['Talla'];
    $marca = $_POST['Marca'];
    $categoria_id = $_POST['Categoria_id'];
    $foto = $_FILES['Foto'];
    $precio = $_POST['Precio'];

    // Subir la foto
    $foto_nombre = time() . '-' . $foto['name'];
    $foto_ruta = '../../upload/' . $foto_nombre;

    if (move_uploaded_file($foto['tmp_name'], $foto_ruta)) {
        // Registrar el nuevo zapato
        $params = [
            'Nombre' => $nombre,
            'Talla' => $talla,
            'Marca' => $marca,
            'Categoria_id' => $categoria_id,
            'Foto' => $foto_nombre,
            'Precio' => $precio,
            'Fecha' => date('Y-m-d H:i:s')
        ];

        $zapatos->registrar($params);
        header('Location: index.php'); // Redirigir al listado de zapatos después de registrar
        exit;
    } else {
        echo "Error al subir la foto.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Varishop</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Varishop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="../zapato/index.php" class="btn">Zapatos</a></li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Admin<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Enlace para hacer logout y redirigir al login -->
                            <li><a href="../logout.php">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container" id="main">
        <div class="row">
            <div class="col-md-5">
                <fieldset>
                    <legend>Registrar datos del zapato</legend>
                    <form action="form_registrar.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" class="form-control" name="Nombre" placeholder="Ingrese el nombre del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Talla</label>
                            <input type="number" class="form-control" name="Talla" placeholder="Ingrese las tallas del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Marca</label>
                            <input type="text" class="form-control" name="Marca" placeholder="Ingrese la marca del zapato" required>
                        </div>
                        <div class="form-group">
                            <label>Características</label>
                            <select class="form-control" name="Categoria_id" required>
                                <option value="0">---Seleccione---</option>
                                <option value="1">Zapatos formales</option>
                                <option value="2">Tenis deportivos</option>
                                <option value="3">Zapatos casuales</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" class="form-control" name="Foto" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control" name="Precio" placeholder="0.000 COP" required>
                            </div>
                        </div>
                        <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                        <a href="index.php" class="btn btn-primary">Cancelar</a>
                    </form>
                </fieldset>
            </div>
        </div>
    </div> 

    <!-- Bootstrap core JavaScript -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>
</html>
