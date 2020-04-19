<?php

include 'clases/Conexion.php';
include 'clases/Post.php';

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
        if (strtolower($ext) == strtolower($file_ext[1])) {
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
?>

