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

    //Contructor de post
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

    //Creamos un post dado un objeto
    function crearPost($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO posts (titulo,contenido,fecha_publicacion,usuario) VALUES ('$post->titulo','$post->contenido','$post->fecha_publicacion','$post->usuario')";
        $conexion->exec($sql);
    }

    //Eliminamos la imagen dado un id de post
    function eliminarMultimedia($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT multimedia from posts where id=$id");
        $borrado = false;
        while ($row = $consulta->fetch()) {
            if ($row['multimedia']) {
                $multimedia = $row['multimedia'];
                unlink("uploads/posts/" . $multimedia);
            }
            $borrado = true;
        }
        unset($conexion);
        return $borrado;
    }

    //Eliminamos TODA la multimedia dada un usuario
    function eliminarMultimediaUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT multimedia from posts where usuario=$usuario");
        $borrado = false;
        while ($row = $consulta->fetch()) {
            if ($row['multimedia']) {
                $multimedia = $row['multimedia'];
                unlink("uploads/posts/" . $multimedia);
            }
            $borrado = true;
        }
        unset($conexion);
        return $borrado;
    }

    //Eliminamos un post dado un id de post
    function eliminarPost($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Comentario::eliminarComentarioConIdPost($id); //Borramos los comentarios de dicho post
        Post::eliminarMultimedia($id); //Eliminamos la multimedia de dicho post
        $sql = "DELETE FROM posts where id='$id'";
        $conexion->exec($sql);
    }

    //Eliminamos todos los posts de un usuario dada su id
    function eliminarPostsUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Comentario::eliminarComentariosUsuario($id); //Eliminamos los comentarios que ha hecho nuestro usuario
        Comentario::eliminarComentariosDeMisPosts($id); //Eliminamos los comentarios de todos sus posts
        Post::eliminarMultimediaUsuario($id); //Eliminamos toda su multimedia
        $sql = "DELETE FROM posts where usuario='$id'"; //Eliminamos el usuario
        $conexion->exec($sql);
    }

    //Buscamos la id de nuestro post dado un objeto post
    function consultarId($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from posts where fecha_publicacion='$post->fecha_publicacion' and usuario='$post->usuario'");
        $id = null;
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }

    //Buscamos el autor de un post dado su id de post
    function buscarCreador($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT usuario from posts where id='$post'");
        $usuario = null;
        while ($row = $consulta->fetch()) {
            $usuario = $row['usuario'];
        }
        unset($conexion);
        return $usuario;
    }

    //Subimos foto a nuestro post dado su id y la foto que queremos subir
    function subirMultimedia($id, $multimedia) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE posts SET multimedia='$multimedia' where id='$id'";
        $conexion->exec($sql);
    }

    //Buscamos los posts dado un usuario
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

    //Buscamos el autor de un usuario dado un id post
    function getUsuarioPost($post) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT usuario from posts where id=$post");
        while ($row = $consulta->fetch()) {
            $usuario = $row['usuario'];
        }
        unset($conexion);
        return $usuario;
    }

    //Sacamos los datos de sus posts dada su id de usuario
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

    //Sacamos los datos de los posts de usuarios y posts 
    function getDatosPostsUsuario($usuario, $cantidad) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Sacamos los datos de posts y usuario
        $consulta = $conexion->query("SELECT p.id,p.titulo,p.contenido,p.multimedia,p.fecha_publicacion, p.likes, p.usuario, u.nick, u.foto from posts p,usuarios u where usuario='$usuario' and p.usuario=u.id order by fecha_publicacion desc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {

            if ($i < $cantidad) {

                $idusuario = Usuario::getIdUsuario($_SESSION['username']);
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
                    'like' => Post::comprobarLike($row['id'], $idusuario),
                    'usuario' => $row['usuario'],
                    'nick' => $row['nick'],
                    'foto' => $foto,
                    'loginOperador' => $_SESSION['operador'],
                    'login' => $idusuario,
                    'comentarios' => Comentario::contarComentarios($row['id'])
                );
            }

            $i++;
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos un post dado un post y un usuario
    function mostrarPost($post, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT p.id,p.titulo,p.contenido,p.multimedia,p.fecha_publicacion, p.likes, p.usuario, u.nick, u.foto from posts p,usuarios u where p.id='$post' and p.usuario=u.id");
        $datos = null;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
            $datos = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'multimedia' => $row['multimedia'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'likes' => $row['likes'],
                'like' => Post::comprobarLike($row['id'], $usuario),
                'usuario' => $row['usuario'],
                'nick' => $row['nick'],
                'foto' => $foto,
                'amigo' => Usuario::esAmigo($usuario, $row['usuario']),
                'login' => Usuario::getIdUsuario($_SESSION['username']),
                'loginOperador' => $_SESSION['operador']
            );
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos los posts de nuestros amigos
    function mostrarPostsAmigos($amigos, $usuario, $cantidad, $array) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 0;
        $datos = null;
        //Recorremos el array de amigos
        for ($j = 0; $j < count($amigos); $j++) {
            //Busca los posts de nuestros amigos
            $consulta = $conexion->query("SELECT p.id,p.titulo,p.contenido,p.multimedia,p.fecha_publicacion, p.likes, p.usuario, u.nick, u.foto from posts p,usuarios u where usuario='$amigos[$j]' and p.usuario=u.id order by fecha_publicacion desc");

            while ($row = $consulta->fetch()) {

                if ($i < $cantidad && !Post::esMostrado($array, $row['id'])) { //Si no ha sido mostrado

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
                        'like' => Post::comprobarLike($row['id'], $usuario),
                        'usuario' => $row['usuario'],
                        'nick' => $row['nick'],
                        'foto' => $foto,
                        'posts' => $array,
                        'comentarios' => Comentario::contarComentarios($row['id'])
                    );
                }

                $i++;
            }
        }
        unset($conexion);
        return $datos;
    }

    //Comprueba si ha sido mostrado
    function esMostrado($array, $id) {
        $mostrados = explode(",", $array); //Array de posts ya mostrados

        $mostrado = false;
        for ($i = 0; $i < count($mostrados); $i++) {
            if ($id == $mostrados[$i]) { //Comprueba si el post que va a pintar ya ha sido mostrado
                $mostrado = true;
            }
        }
        return $mostrado;
    }

    //Comprueba si le hemos dado like a un post dado el id de post y nuestro usuario
    function comprobarLike($post, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT likes from posts where id='$post'");
        $cadLikes = null;
        $existe = false;
        while ($row = $consulta->fetch()) {
            $cadLikes = $row['likes']; //Guardamos nuestros likes
        }
        if (isset($cadLikes)) {
            if (strpos($cadLikes, ",")) {
                $likes = explode(",", $cadLikes); //Creamos un array de likes
                for ($i = 0; $i < count($likes); $i++) {
                    if ($likes[$i] == $usuario) { //Si nuestro like se encuentra ahí
                        $existe = true; 
                    }
                }
            } else {
                $likes = $cadLikes; //Si solo hay un like
                if ($likes == $usuario) { //Comprueba si le hemos dado like
                    $existe = true;
                }
            }
        }
        unset($conexion);
        return $existe;
    }

    //Le damos like a un post dado su id y el usuario
    function darLike($post, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT likes from posts where id='$post'");
        $likes = null;
        $valor = false;
        while ($row = $consulta->fetch()) {
            $likes = $row['likes']; //Mostramos sus likes
            if ($likes != null) { //Si ya hay datos lo concatenamos con coma
                $sql = "UPDATE posts SET likes='$likes,$usuario' where id='$post'";
                $valor = true;
            } else { //Si no almacenamos nuestro like
                $sql = "UPDATE posts SET likes='$usuario' where id='$post'";
                $valor = true;
            }
        }
        $conexion->exec($sql);
        unset($conexion);
        return $valor;
    }

    //Eliminamos likes de usuario 
    function quitarLikesUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id,likes from posts");
        $cadLikes = null;
        while ($row = $consulta->fetch()) {
            $post = $row['id'];
            $cadLikes = $row['likes'];
            if (isset($cadLikes)) {
                if (strpos($cadLikes, ",")) { 
                    $likes = explode(",", $cadLikes); //Array de likes
                    for ($i = 0; $i < count($likes); $i++) {
                        if ($likes[$i] == $usuario) { //Si le hemos dado like
                            unset($likes[$i]); //Borramos nuestro like
                        }
                    }
                    $cadLikes = implode(",", $likes); //Volvemos a almacenar la cadena
                } else {
                    $likes = $cadLikes;
                    if ($likes == $usuario) { //Comprobamos el like con el usuario
                        $cadLikes = "";
                    }
                }
            }
            $sql = "UPDATE posts SET likes='$cadLikes' where id='$post'";
            $conexion->exec($sql);
        }


        unset($conexion);
    }

}
