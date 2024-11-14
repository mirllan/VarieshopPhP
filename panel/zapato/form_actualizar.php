<?php
session_start();
require '../../vendor/autoload.php';

if (isset($_GET['Id']) && is_numeric($_GET['Id'])) {
    $Id = $_GET['Id'];
    $Zapatos = new varishop\Zapatos;
    $resultado = $Zapatos->mostrarPorId($Id);    
    if(!$resultado)
    header('Location: index.php');
} else {
    header('Location: index.php');
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
                    <li>
                        <a href="../pedidos/index.php" class="btn">Pedidos</a>
                    </li> 
                    <li>
                        <a href="../zapato/index.php" class="btn">Zapatos</a>
                    </li> 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            Admin<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Enlace para hacer logout y redirigir al login -->
                            <li><a href="../logout.php">Salir</a></li>
                        </ul>
                    </li>

            </div><!--/.nav-collapse -->
        </div>
    </nav>

        <!-- Formulario de Productos -->
        <div class="container" id="main">
            <div class="row">
                <div class="col-md-5">
                    <fieldset>
                        <legend>Actualizar datos del zapto</legend>
                        <form action="../acciones.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="Id" value="<?php print $resultado['Id'] ?>">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input value="<?php print $resultado['Nombre'] ?>" type="text" class="form-control" name="Nombre" placeholder="Ingrese el nombre del zapato" required>
                            </div>
                            <div class="form-group">
                                <label>Talla</label>
                                <input value="<?php print $resultado['Talla'] ?>" type="number" class="form-control" name="Talla" placeholder="Ingrese la talla del zapato" required>
                            </div>
                            <div class="form-group">
                                <label>Marca</label>
                                <input value="<?php print $resultado['Marca'] ?>" type="text" class="form-control" name="Marca" placeholder="Ingrese la marca del zapato" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Características</label>
                                <select class="form-control" name="Categoria_id" required>
                                <option value="1">Zapatos formales</option>
                                <option value="2">Tenis deportivos</option>
                                <option value="3">Zapatos casuales</option>
                                    <!-- Opciones adicionales aquí -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" name="Foto">
                                <input type="hidden" name="foto_temp" value="<?php print $resultado['Foto'] ?>">
                            </div>
                            <div>
                                <div class="form-group">
                                    <label>Precio</label>
                                    <input  value="<?php print $resultado['Precio'] ?>" type="text" class="form-control" name="Precio" placeholder="0.000 COP" required>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" name="accion"value= "Actualizar">
                            <a href="index.php" class="btn btn-primary">Cancelar</a>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>

</body>
</html>
