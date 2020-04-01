<?php

include 'clases/Conexion.php';

if(isset($_REQUEST['registro'])){
    $usuario = new Usuario($_REQUEST['nick'], $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['nombre'], $_REQUEST['animal'], $_REQUEST['raza'], $_REQUEST['sexo'], $_REQUEST['foto'], $_REQUEST['localidad']);
    Usuario::crearUsuario($usuario);
    //header("Location: ../index.php");
}

?>

