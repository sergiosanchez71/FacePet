<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Post {

    private $id;
    private $titulo;
    private $contenido;
    private $multimedia;
    private $fecha_publicacion;
    private $likes;
    private $usuario;

    function __construct($titulo, $contenido, $fecha_publicacion, $usuario) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->usuario = $usuario;
    }

    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getMultimedia() {
        return $this->multimedia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setMultimedia($multimedia) {
        $this->multimedia = $multimedia;
    }

    function getFecha_publicacion() {
        return $this->fecha_publicacion;
    }

    function getLikes() {
        return $this->likes;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setFecha_publicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    function setLikes($likes) {
        $this->likes = $likes;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function crearPost($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $sql = "INSERT INTO posts (titulo,contenido,fecha_publicacion,usuario) VALUES ('$post->titulo','$post->contenido','$fecha','$post->usuario')";
        $conexion->exec($sql);
    }
    
    function consultarId($post){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from posts where titulo='$post->titulo' and contenido='$post->contenido' and fecha_publicacion='$post->fecha_publicacion' and usuario='$post->usuario'");
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    
    }
    
    function subirMultimedia($id,$multimedia){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE posts SET multimedia='$multimedia' where id='$id'";
        $conexion->exec($sql);
    }

    function comprobarExtension($archivo) {
        $extension = end(explode(".", $archivo));
        $extensiones = array("jpg", "png", "jpeg", "avi", "mp4", "mpeg-4");
        for ($i = 0; $i < count($extensiones); $i++) {
            if ($extension == $extensiones[$i]) {
                return true;
            }
        }
        return false;
    }

}
