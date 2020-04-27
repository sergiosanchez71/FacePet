<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentario
 *
 * @author sergiosanchez
 */
class Comentario {
    private $id;
    private $contenido;
    private $fecha;
    private $post;
    private $usuario;
    
    function __construct($contenido, $fecha, $post, $usuario) {
        $this->contenido = $contenido;
        $this->fecha = $fecha;
        $this->post = $post;
        $this->usuario = $usuario;
    }
    
    function getId() {
        return $this->id;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getPost() {
        return $this->post;
    }

    function getUsuario() {
        return $this->usuario;
    }
    
    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setPost($post) {
        $this->post = $post;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function publicarComentario($comentario){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO comentarios (contenido,fecha,post,usuario) VALUES ('$comentario->contenido','$comentario->fecha','$comentario->post','$comentario->usuario')";
        $conexion->exec($sql);
    }
    
    function mostrarComentarios($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT c.id,c.contenido,c.fecha,c.post,c.usuario, u.nick, u.foto from comentarios c,usuarios u where c.post='$post' and c.usuario=u.id order by c.fecha desc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }

            $datos[$i] = array(
                'id' => $row['id'],
                'contenido' => $row['contenido'],
                'fecha' => $row['fecha'],
                'post' => $row['post'],
                'usuario' => $row['usuario'],
                'nick' => $row['nick'],
                'foto' => $foto
            );

            $i++;
        }
        unset($conexion);
        return $datos;
    }

    
}
