<?php
require '../vendor/autoload.php';
$zapatos = new varishop\Zapatos();

// Seguridad
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] == 'Registrar') {

        if (empty($_POST['Nombre'])) exit('Completar Nombre');
        if (empty($_POST['Talla'])) exit('Completar Talla');
        if (empty($_POST['Marca'])) exit('Completar Marca');
        if (empty($_POST['Categoria_id'])) exit('Seleccionar una categoría válida');
        if (!is_numeric($_POST['Categoria_id'])) exit('Seleccionar una categoría válida');
        if (empty($_POST['Precio'])) exit('Completar Precio');

        $_params = array(
            'Nombre' => $_POST['Nombre'],
            'Marca' => $_POST['Marca'],
            'Talla' => $_POST['Talla'],
            'Foto' => subirFoto(),
            'Precio' => $_POST['Precio'],
            'Categoria_id' => $_POST['Categoria_id'],
            'Fecha' => date('Y-m-d')
        );

        $rpt = $zapatos->registrar($_params);

        // Función que se encarga de mostrar el tipo de dato y la longitud
        if($rpt)
        header('Location: zapato/index.php');
        else
        print'Error al registrar el articulo';
    }

    if ($_POST['accion'] == 'Actualizar') {
        // Validaciones...
        
        $_params = array(
            'Nombre' => $_POST['Nombre'],
            'Marca' => $_POST['Marca'],
            'Talla' => $_POST['Talla'],
            'Precio' => $_POST['Precio'],
            'Categoria_id' => $_POST['Categoria_id'],
            'Fecha' => date('Y-m-d'),
            'Id' => $_POST['Id'] // Asegúrate de que este es un valor válido
        );
    
        // Revisar si hay una nueva foto
        if (!empty($_FILES['Foto']['name'])) {
            $_params['Foto'] = subirFoto();
        } else {
            $_params['Foto'] = $_POST['foto_temp'];
        }
    
        // Llamar al método de actualización
        $rpt = $zapatos->actualizar($_params); // Cambia a 'actualizar'
        if ($rpt) {
            header('Location: zapato/index.php');
            exit; // Asegúrate de usar exit después de header
        } else {
            print 'Error al actualizar el artículo';
            // Puedes imprimir más información de error aquí
        }
    }

}

#Funcion que guarda las fotos en upload
function subirFoto() {
    $carpeta = __DIR__.'../../upload/';

    $archivo = $carpeta.$_FILES['Foto']['name'];

    move_uploaded_file($_FILES['Foto']['tmp_name'],$archivo);

    return $_FILES['Foto']['name'];

}
?>