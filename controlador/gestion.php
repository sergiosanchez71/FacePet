<?php

include 'clases/Conexion.php';
include 'clases/Post.php';
include 'clases/Usuario.php';

function comprobarLogin() {
    if (isset($_SESSION['username'])) {
        //echo $_SESSION['username'];
    } else {
        header("Location: ../index.php");
    }
}

function comprobarLoginOp() {
    if (isset($_SESSION['username']) && $_SESSION['operador'] == 1) {
        //echo $_SESSION['username'];
    } else {
        header("Location: ../index.php");
    }
}

if (isset($_REQUEST['registro'])) {
    $usuario = new Usuario($_REQUEST['nick'], $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['nombre'], $_REQUEST['animal'], $_REQUEST['raza'], $_REQUEST['sexo'], $_REQUEST['foto'], $_REQUEST['localidad']);
    Usuario::crearUsuario($usuario);
}

if (isset($_REQUEST['subirImagen'])) {
    //$post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $_REQUEST['multimedia']);
    //Post::crearPost($post);
    $dir_subida = '../controlador/uploads/posts/';
    $allowed_ext = "jpg,png,jpeg,avi,mp4,mpeg-4";
    $file_ext = preg_split("/\./", $_FILES['userfile']['name']);
    $allowed_ext = preg_split("/\,/", $allowed_ext);
    foreach ($allowed_ext as $ext) {
        $tam = count($file_ext);
        if (strtolower($ext) == strtolower($file_ext[$tam - 1])) {
            $match = true; // Permite el archivo
        }
    }
    if (isset($match)) {
        $fichero_subido = $dir_subida . basename($_FILES['userfile']['name']);
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido);
        rename($fichero_subido, $dir_subida . $_REQUEST['idpost'] . "." . $file_ext[1]);
        Post::subirMultimedia($_REQUEST['idpost'], $_REQUEST['idpost'] . "." . $file_ext[1]);
        header("Location: ../vista/miPerfil.php");
    }
}

if (isset($_REQUEST['cambiarAvatar'])) {
    //$post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $_REQUEST['multimedia']);
    //Post::crearPost($post);

    $dir_subida = '../controlador/uploads/usuarios/';
    $allowed_ext = "jpg,png,jpeg";
    $file_ext = preg_split("/\./", $_FILES['userfile']['name']);
    $allowed_ext = preg_split("/\,/", $allowed_ext);
    foreach ($allowed_ext as $ext) {
        $tam = count($file_ext);
        if (strtolower($ext) == strtolower($file_ext[$tam - 1])) {
            $match = true; // Permite el archivo
        }
    }
    if (isset($match)) {
        foreach ($allowed_ext as $ext) {
            $imagen = $dir_subida . $_REQUEST['idusu'] . "." . $ext;
            if (isset($imagen)) {
                unlink($imagen);
            }
        }
        $fichero_subido = $dir_subida . basename($_FILES['userfile']['name']);
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero_subido);
        rename($fichero_subido, $dir_subida . $_REQUEST['idusu'] . "." . $file_ext[1]);
        Usuario::cambiarAvatar($_REQUEST['idusu'], $_REQUEST['idusu'] . "." . $file_ext[1]);
        header("Location: ../vista/miPerfil.php");
    }
}
?>

