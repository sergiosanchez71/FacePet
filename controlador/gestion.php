<?php

//Incluimos las clases necesarias
include 'clases/Conexion.php';
include 'clases/Post.php';
include 'clases/Evento.php';
include 'clases/Usuario.php';

//Comprobamos el login de usuario
function comprobarLogin() {
    if (!isset($_SESSION['username'])) { //Si NO existe la sesión de usuario
        header("Location: ../index.php"); //Volvemos al inicio
    }
}
//Comprobamos el login de operador
function comprobarLoginOp() {
    if (isset($_SESSION['username']) && $_SESSION['operador'] == 0) { //Si existe la sesión de usuario pero no es admin
        header("Location: vistaUsuario.php"); //Volvemos a la vista usuario
    } else if (!isset($_SESSION['username'])) { //Si NO existe la sesión de usuario
        header("Location: ../index.php"); //Volvemos al inicio
    } 
}

// Si pulsamos el botón de registro
if (isset($_REQUEST['registro'])) { 
    //Creamos un objecto usuario
    $usuario = new Usuario($_REQUEST['nick'], $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['nombre'], $_REQUEST['animal'], $_REQUEST['raza'], $_REQUEST['sexo'], $_REQUEST['foto'], $_REQUEST['localidad']);
    Usuario::crearUsuario($usuario); //Lo creamos
}

//Subimos una imagen para nuestro post
if (isset($_REQUEST['subirImagenP'])) {
    $dir_subida = '../controlador/uploads/posts/'; //Ubicación
    $allowed_ext = "jpg,png,jpeg"; //Extensiones disponibles
    $file_ext = preg_split("/\./", $_FILES['userfile']['name']); //Nombre de archivo 
    $allowed_ext = preg_split("/\,/", $allowed_ext);
    foreach ($allowed_ext as $ext) {
        $tam = count($file_ext); //Vemos cuantas extensiones disponibles hay
        if (strtolower($ext) == strtolower($file_ext[$tam - 1])) { //Miramos el último punto de la imagen para saber su extensión y comparamos
            $match = true; // Permite el archivo
        }
    }
    if (isset($match)) { //Si ha sido permitido
        $fichero_subido = $dir_subida . basename($_FILES['userfile']['name']); //Directorio
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido); //Lo mueven
        rename($fichero_subido, $dir_subida . $_REQUEST['idpost'] . "." . $file_ext[1]); //Cambia nombre
        Post::subirMultimedia($_REQUEST['idpost'], $_REQUEST['idpost'] . "." . $file_ext[1]); //Es subido
        header("Location: ../vista/miPerfil.php"); //Redirigido al perfil
    }
}

//Subir imagen evento
if (isset($_REQUEST['subirImagenE'])) {
    $dir_subida = '../controlador/uploads/eventos/'; //Directorio
    $allowed_ext = "jpg,png,jpeg"; //Extensiones disponibles
    $file_ext = preg_split("/\./", $_FILES['userfile']['name']); //nombre
    $allowed_ext = preg_split("/\,/", $allowed_ext); 
    foreach ($allowed_ext as $ext) { //Recorremos las extensiones
        $tam = count($file_ext); //Contamos las posiciones
        if (strtolower($ext) == strtolower($file_ext[$tam - 1])) { //Cogemos la última y comparamos para ver si tienen la misma
            $match = true; // Permite el archivo
        }
    }
    if (isset($match)) { //Si es permitido
        $fichero_subido = $dir_subida . basename($_FILES['userfile']['name']); //Cogemos el archivo
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido);
        rename($fichero_subido, $dir_subida . $_REQUEST['idevento'] . "." . $file_ext[1]); //Le cambiamos el nombre
        Evento::subirMultimedia($_REQUEST['idevento'], $_REQUEST['idevento'] . "." . $file_ext[1]); //Lo subimos
        header("Location: ../vista/miPerfil.php"); //Redirigidos al perfil
    }
}

//Cambiar imagen o subir de avatar
if (isset($_REQUEST['cambiarAvatar'])) { 
    $dir_subida = '../controlador/uploads/usuarios/'; //Directorio
    $allowed_ext = "jpg,png,jpeg"; //Extensiones permitidas
    $file_ext = preg_split("/\./", $_FILES['userfile']['name']); //Imagen
    $allowed_ext = preg_split("/\,/", $allowed_ext); //Array de extensiones
    foreach ($allowed_ext as $ext) { //Recorremos
        $tam = count($file_ext); //Contamos todos los puntos
        if (strtolower($ext) == strtolower($file_ext[$tam - 1])) { //Comparamos con el último punto
            $match = true; // Permite el archivo
        }
    }
    if (isset($match)) { //Si es permitido
        foreach ($allowed_ext as $ext) {
            $imagen = $dir_subida . $_REQUEST['idusu'] . "." . $ext; //Cambiamos nombre
            if (isset($imagen)) { //Si ya existe
                unlink($imagen); //Borramos imagen
            }
        }
        $fichero_subido = $dir_subida . basename($_FILES['userfile']['name']); //Fichero nombre
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido); //Movemos el fichero
        rename($fichero_subido, $dir_subida . $_REQUEST['idusu'] . "." . $file_ext[1]); //Cambiamos el nombre
        Usuario::cambiarAvatar($_REQUEST['idusu'], $_REQUEST['idusu'] . "." . $file_ext[1]); //Cambiamos el avatar
        header("Location: ../vista/miPerfil.php"); //Redirigimos a mi perfil
    }
}
?>

