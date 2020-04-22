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
        $sql = "INSERT INTO posts (titulo,contenido,fecha_publicacion,usuario) VALUES ('$post->titulo','$post->contenido','$post->fecha_publicacion','$post->usuario')";
        $conexion->exec($sql);
    }

    function eliminarMultimedia($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT multimedia from posts where id=$id");
        $borrado = false;
        while ($row = $consulta->fetch()) {
            $multimedia = $row['multimedia'];
            unlink("uploads/posts/".$multimedia);
            $borrado = true;
        }
        unset($conexion);
        return $borrado;
    }
    
    function eliminarPost($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Post::eliminarMultimedia($id);
        $sql = "DELETE FROM posts where id='$id'";
        $conexion->exec($sql);
    }

    function consultarId($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from posts where fecha_publicacion='$post->fecha_publicacion' and usuario='$post->usuario'");
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }

    function subirMultimedia($id, $multimedia) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE posts SET multimedia='$multimedia' where id='$id'";
        $conexion->exec($sql);
    }

    function buscarPosts($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from posts where usuario=$usuario");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $posts[$i] = $row['id'];
            $i++;
        }
        unset($conexion);
        return $posts;
    }

    function getDatosPostUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from posts where usuario='$usuario'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
            $datos = ['id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'multimedia' => $row['multimedia'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'likes' => $row['likes'],
                'usuario' => $row['usuario']
            ];
        }
        unset($conexion);
        return $datos;
    }

    function getDatosPostsUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT p.id,p.titulo,p.contenido,p.multimedia,p.fecha_publicacion, p.likes, p.usuario, u.nick, u.foto from posts p,usuarios u where usuario='$usuario' and p.usuario=u.id order by fecha_publicacion desc");
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
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'multimedia' => $row['multimedia'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'likes' => $row['likes'],
                'usuario' => $row['usuario'],
                'nick' => $row['nick'],
                'foto' => $foto
            );

            $i++;
        }
        unset($conexion);
        return $datos;
    }

    function mostrarPostsAmigos($amigos) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 0;
        $datos = null;
        for ($j = 0; $j < count($amigos); $j++) {
            $consulta = $conexion->query("SELECT p.id,p.titulo,p.contenido,p.multimedia,p.fecha_publicacion, p.likes, p.usuario, u.nick, u.foto from posts p,usuarios u where usuario='$amigos[$j]' and p.usuario=u.id order by fecha_publicacion desc");
            while ($row = $consulta->fetch()) {
                if ($row['foto'] == null) {
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }

                $datos[$i] = array(
                    'id' => $row['id'],
                    'titulo' => $row['titulo'],
                    'contenido' => $row['contenido'],
                    'multimedia' => $row['multimedia'],
                    'fecha_publicacion' => $row['fecha_publicacion'],
                    'likes' => $row['likes'],
                    'usuario' => $row['usuario'],
                    'nick' => $row['nick'],
                    'foto' => $foto
                );

                $i++;
            }
        }
        unset($conexion);
        return $datos;
    }

}
