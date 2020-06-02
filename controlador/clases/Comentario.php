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

    //Contructor dado el contenido, una fecha, el id de post y el id de usuario
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

    //Publicar comentario dado un objeto comentario
    function publicarComentario($comentario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO comentarios (contenido,fecha,post,usuario) VALUES ('$comentario->contenido','$comentario->fecha','$comentario->post','$comentario->usuario')";
        $conexion->exec($sql);
    }

    //Eliminamos el comentario dado un objeto comentario
    function eliminarComentario($comentario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios where id='$comentario'");
        while ($row = $consulta->fetch()) {
            //Creamos un objeto notificación
            $notificacion = new Notificacion($row['usuario'], Post::buscarCreador($row['post']), "comentarioP", $row['post'], $row['fecha']);
            Notificacion::borrarNotificacion($notificacion); //Borramos la notificación
        }
        $sql = "DELETE FROM comentarios WHERE id='$comentario'";
        $conexion->exec($sql);
    }

    //Eliminamos los comentarios dado el id de un post
    function eliminarComentarioConIdPost($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios where post='$post'");
        while ($row = $consulta->fetch()) {
            //Creamos un objeto notificación
            $notificacion = new Notificacion($row['usuario'], Post::buscarCreador($row['post']), "comentarioP", $row['post'], $row['fecha']);
            Notificacion::borrarNotificacion($notificacion); //Borramos la notificación
        }
        $sql = "DELETE FROM comentarios WHERE post='$post'";
        $conexion->exec($sql);
    }

    //Eliminamos los comentarios dado el id de usuario
    function eliminarComentariosUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios where usuario='$usuario'");
        while ($row = $consulta->fetch()) {
            //Creamos un objeto notificación
            $notificacion = new Notificacion($row['usuario'], Post::buscarCreador($row['post']), "comentarioP", $row['post'], $row['fecha']);
            Notificacion::borrarNotificacion($notificacion);
        }
        $sql = "DELETE FROM comentarios WHERE usuario='$usuario'";
        $conexion->exec($sql);
    }

    //Mostramos los comentarios dado el id de un post
    function mostrarComentarios($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT c.id,c.contenido,c.fecha,c.post,c.usuario, u.nick, u.foto from comentarios c,usuarios u where c.post='$post' and c.usuario=u.id order by c.fecha desc");
        //I es 0 
        $i = 0;
        //Los datos son null
        $datos = null;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) { //Si no hay imagen
                $foto = "0.jpg"; //Imagen por defecto
            } else {
                $foto = $row['foto'];
            }

            $datos[$i] = array(
                'id' => $row['id'],
                'contenido' => $row['contenido'],
                'fecha' => $row['fecha'],
                'post' => $row['post'],
                'usuario' => $row['usuario'],
                'nick' => $row['nick'], //Nick usuario
                'foto' => $foto,
                'login' => Usuario::getIdUsuario($_SESSION['username']), //Usuario logueado
                'loginOperador' => $_SESSION['operador'] //Operador de usuario logueado
            );

            $i++;
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos los comentarios dada una id de comentario
    function mostrarComentariosConId($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios where id='$id'");
        //El array de datos es nulo
        $datos = null;
        while ($row = $consulta->fetch()) {

            $datos = array(
                'id' => $row['id'],
                'contenido' => $row['contenido'],
                'fecha' => $row['fecha'],
                'post' => $row['post'],
                'usuario' => $row['usuario']
            );
        }
        unset($conexion);
        return $datos;
    }

    //Buscamos un comentario dado el post, el usuario y la fecha en la que se ha hecho
    function buscarIdComentario($post, $usuario, $fecha) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from comentarios where post='$post' and usuario='$usuario' and fecha='$fecha'");
        $id = null;
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }

    //Contamos los comentarios dados un post
    function contarComentarios($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios c where post='$post'");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $i++;
        }
        unset($conexion);
        return $i;
    }

    //Eliminamos comentarios de un usuario
    function eliminarComentariosDeMisPosts($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from comentarios");
        while ($row = $consulta->fetch()) {
            if (Post::buscarCreador($row['post']) == $usuario) { //Buscammoz los posts del usuario
                //Creamos un objeto notificacion
                $notificacion = new Notificacion($row['usuario'], Post::buscarCreador($row['post']), "comentarioP", $row['post'], $row['fecha']);
                Notificacion::borrarNotificacion($notificacion); //Borramos notificaciones
                $comentario = $row['id'];
                $sql = "DELETE FROM comentarios WHERE id='$comentario'"; //Borramos comentarios
                $conexion->exec($sql);
            }
        }
            unset($conexion);

    }

}
