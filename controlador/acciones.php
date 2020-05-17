<?php

/**
 * Description of consultas
 *
 * @author sergiosanchez
 */
include 'clases/Conexion.php';
include 'clases/Animal.php';
include 'clases/Raza.php';
include 'clases/Usuario.php';
include 'clases/Post.php';
include 'clases/Comentario.php';
include 'clases/Evento.php';
include 'clases/Notificacion.php';
include 'clases/Amistades.php';
include 'clases/Mensaje.php';

session_start();
$accion = $_REQUEST['accion'];
if (isset($_SESSION['username'])) {
    $idusuario = Usuario::getIdUsuario($_SESSION['username']);
}

switch ($accion) {

    //Animales
    case "crearAnimal":
        if (!Animal::comprobarNombre($_REQUEST['nombre'])) {
            Animal::crearAnimal($_REQUEST['nombre']);
            echo "Animal creado correctamente";
        } else {
            echo "Ese animal ya existe";
        }
        break;

    case "borrarAnimales":
        $animales = $_REQUEST['animales'];
        for ($i = 0; $i < count($animales); $i++) {
            Animal::borrarAnimal($animales[$i]);
        }
        if (count($animales) > 1) {
            echo "Animales eliminados correctamente";
        } else {
            echo "Animal eliminado correctamente";
        }
        break;

    case "consultarAnimales":
        $data = array();
        $data['id'] = Animal::mostrarIdAnimales();
        $data['animal'] = Animal::mostrarAnimales();
        echo json_encode($data);
        break;

    //Razas
    case "crearRaza":
        if (!Raza::comprobarNombre($_REQUEST['nombre'], $_REQUEST['animal'])) {
            Raza::crearRaza($_REQUEST['nombre'], $_REQUEST['animal']);
            echo "Raza creada correctamente";
        } else {
            echo "Esa raza ya existe";
        }
        break;

    case "borrarRazas":
        //$animal = $_REQUEST['animalB'];
        $razas = $_REQUEST['razas'];
        for ($i = 0; $i < count($razas); $i++) {
            Raza::borrarRaza($razas[$i]);
        }
        if (count($razas) > 1) {
            echo "Razas eliminadas correctamente";
        } else {
            echo "Raza eliminada correctamente";
        }
        break;
    case "consultarRazas":
        $data = array();
        $data['id'] = Raza::mostrarIdRazas($_REQUEST['animal']);
        $data['raza'] = Raza::mostrarRazas($_REQUEST['animal']);
        echo json_encode($data);
        break;

    //Admin Usuarios

    case "sancionarUsuario":
        if (Usuario::sancionarUsuario($_REQUEST['tiempo'], $_REQUEST['usuario'])) {
            echo json_encode(Usuario::sancionarUsuario($_REQUEST['tiempo'], $_REQUEST['usuario']));
        } else {
            echo false;
        }
        break;

    case "eliminarSancion":
        if (Usuario::quitarSancion($_REQUEST['usuario'])) {
            echo Usuario::quitarSancion($_REQUEST['usuario']);
        } else {
            echo false;
        }
        break;

    case "eliminarUsuario":
        if (Usuario::eliminarUsuario($_REQUEST['usuario'])) {
            echo Usuario::eliminarUsuario($_REQUEST['usuario']);
        } else {
            echo false;
        }
        break;

    //Usuarios
    case "crearUsuario":
        include 'clases/Password.php';
        $password = Password::md5($_REQUEST['password']);
        $usuario = new Usuario($_REQUEST['nick'], $password, $_REQUEST['email'], $_REQUEST['animal'], $_REQUEST['raza'], $_REQUEST['sexo'], null, $_REQUEST['localidad']);

        if (!Usuario::existeUsuario($_REQUEST['nick'])) {
            if (!Usuario::existeEmail($usuario)) {
                Usuario::crearUsuario($usuario);
                echo "Usuario registrado correctamente";
            } else {
                echo "El correo electrónico ya está en uso";
            }
        } else {
            echo "El nombre de usuario ya está en uso";
        }
        break;

    case "entrar":
        include 'clases/Password.php';
        if (Usuario::existeUsuario($_REQUEST['username'])) {
            if (Password::verifymd5($_REQUEST['password'], Usuario::cifradaPassword($_REQUEST['username']))) {
                if (!Usuario::estaBaneado($_REQUEST['username'])) {
                    $_SESSION['operador'] = Usuario::comprobarOperador(Usuario::getIdUsuario($_REQUEST['username']));
                    $_SESSION['username'] = $_REQUEST['username'];
                    $_SESSION['password'] = Usuario::cifradaPassword($_REQUEST['username']);
                    echo $_SESSION['operador'];
                } else {
                    //$tiempo = Usuario::estaBaneado($_REQUEST['username']);
                    echo "Esta sancionado hasta " . Usuario::estaBaneado($_REQUEST['username']);
                }
            } else {
                echo "La contraseña no es correcta";
            }
        } else {
            echo "El usuario introducido no existe";
        }
        break;

    case "getFotoPerfil":
        if (Usuario::getFotoPerfil($_SESSION['username'])) {
            echo Usuario::getFotoPerfil($_SESSION['username']);
        } else {
            header("Location: ../index.php");
        }
        break;

    case "buscarUsuarios":
        if (Usuario::getDatosBuscar($_REQUEST['cadena'], $_SESSION['username'])) {
            echo json_encode(Usuario::getDatosBuscar($_REQUEST['cadena'], $_SESSION['username']));
        } else {
            echo false;
        }
        break;

    case "mostrarTodosNombresUsuarios":
        if (Usuario::mostrarTodosNombresUsuarios($_SESSION['username'])) {
            echo json_encode(Usuario::mostrarTodosNombresUsuarios($_SESSION['username']));
        } else {
            echo false;
        }
        break;

    case "mostrarMisAmigos":
        if (Usuario::mostrarAmigos($idusuario)) {
            $namigos = explode(",", Usuario::mostrarAmigos($idusuario));
            if (Usuario::getDatosAmigos($namigos)) {
                $amigos = Usuario::getDatosAmigos($namigos);
                foreach ($amigos as $clave => $amigo) {
                    $orden1[$clave] = $amigo['nick'];
                }

                array_multisort($orden1, SORT_ASC, $amigos);
                echo json_encode($amigos);
            } else {
                echo false;
            }
        }
        break;

    case "mostrarAmigos":
        if (Usuario::mostrarAmigos($_REQUEST['usuario'])) {
            $namigos = explode(",", Usuario::mostrarAmigos($_REQUEST['usuario']));
            $amigos = Usuario::getDatosAmigos($namigos);
            foreach ($amigos as $clave => $amigo) {
                $orden1[$clave] = $amigo['nick'];
            }

            array_multisort($orden1, SORT_ASC, $amigos);
            echo json_encode($amigos);
        }
        break;

    case "cambiarAvatar":
        echo $idusuario;
        break;

    case "eliminarAmigo":
        Usuario::eliminarAmigo($_REQUEST['amigo'], $idusuario);
        echo Usuario::eliminarAmigo($idusuario, $_REQUEST['amigo']);
        break;

    //Solicitud amistad

    case "mandarSolicitud":
        $fecha = date("Y-m-d H:i:s");
        $notificacion = new Notificacion($idusuario, $_REQUEST['usuario'], "amistad", 0, $fecha);
        Notificacion::crearNotificacion($notificacion);
        if (Amistades::mandarSolicitud($idusuario, $_REQUEST['usuario'])) {
            echo true;
        } else {
            echo false;
        }
        break;
    case "cancelarSolicitud":
        $fecha = date("Y-m-d H:i:s");
        $notificacion = new Notificacion($_REQUEST['usuario'], $idusuario, "amistad", 0, $fecha);
        Notificacion::borrarNotificacion($notificacion);
        if (Amistades::cancelarSolicitud($idusuario, $_REQUEST['usuario'])) {
            echo true;
        } else {
            echo false;
        }
        break;

    case "aceptarAmistad":
        $usu2 = $idusuario;
        agregarAmigo($_REQUEST['usuario'], $usu2);
        if (Amistades::aceptarSolicitud($_REQUEST['usuario'], $usu2)) {
            return true;
        } else {
            return false;
        }
        break;

    //Notificaciones
    case "mostrarNotificaciones":
        if (Notificacion::verNotificaciones($idusuario)) {
            echo json_encode(Notificacion::verNotificaciones($idusuario));
        } else {
            echo false;
        }
        break;

    case "notificacionesVistas":
        Notificacion::notificacionesVistas($idusuario);
        break;


    //Posts
    case "crearPost":
        $fecha = date("Y-m-d H:i:s");
        $post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $fecha, $idusuario);
        Post::crearPost($post);
        echo Post::consultarId($post);
        break;

    case "mostrarMisPosts":
        if (Post::getDatosPostsUsuario($idusuario, $_REQUEST['cantidad'], $_REQUEST['array'])) {
            echo json_encode(Post::getDatosPostsUsuario($idusuario, $_REQUEST['cantidad'], $_REQUEST['array']));
        } else {
            echo false;
        }
        break;

    case "mostrarMisPostsInicio":
        if (Post::getDatosPostsUsuarioInicio($idusuario, $_REQUEST['cantidad'])) {
            echo json_encode(Post::getDatosPostsUsuarioInicio($idusuario, $_REQUEST['cantidad']));
        } else {
            echo false;
        }
        break;

    case "mostrarPosts":
        if (Post::getDatosPostsUsuario($_REQUEST['usuario'], $_REQUEST['cantidad'], $_REQUEST['array'])) {
            echo json_encode(Post::getDatosPostsUsuario($_REQUEST['usuario'], $_REQUEST['cantidad'], $_REQUEST['array']));
        } else {
            echo false;
        }
        break;

    case "mostrarPost":
        if (Post::mostrarPost($_REQUEST['post'], $idusuario)) {
            echo json_encode(Post::mostrarPost($_REQUEST['post'], $idusuario));
        } else {
            echo false;
        }
        break;

    case "eliminarPost":
        Post::eliminarPost($_REQUEST['post']);
        break;

    case "mostrarPostsAmigos":
        $amigos = explode(",", Usuario::mostrarAmigos($idusuario));
        $posts = Post::mostrarPostsAmigos($amigos, $idusuario, $_REQUEST['cantidad'], $_REQUEST['array']);
        if ($posts) {
            foreach ($posts as $clave => $post) {
                $orden1[$clave] = $post['fecha_publicacion'];
            }

            array_multisort($orden1, SORT_DESC, $posts);

            echo json_encode($posts);
        } else {
            echo false;
        }
        break;

    case "mostrarPostsAmigosInicio":
        $amigos = explode(",", Usuario::mostrarAmigos($idusuario));
        $posts = Post::mostrarPostsAmigosInicio($amigos, $idusuario, $_REQUEST['cantidad']);
        if ($posts) {
            foreach ($posts as $clave => $post) {
                $orden1[$clave] = $post['fecha_publicacion'];
            }

            array_multisort($orden1, SORT_DESC, $posts);

            echo json_encode($posts);
        } else {
            echo false;
        }
        break;

    case "darLike":
        if (!Post::comprobarLike($_REQUEST['post'], $idusuario)) {
            echo Post::darLike($_REQUEST['post'], $idusuario);
        } else {
            echo false;
        }
        break;

    //Comentarios    
    case "publicarComentario":
        $fecha = date("Y-m-d H:i:s");
        $comentario = new Comentario($_REQUEST['contenido'], $fecha, $_REQUEST['post'], $idusuario);
        if ($idusuario != Post::getUsuarioPost($_REQUEST['post'])) {
            $notificacion = new Notificacion($idusuario, Post::getUsuarioPost($_REQUEST['post']), "comentarioP", $_REQUEST['post'], $fecha);
            Notificacion::crearNotificacion($notificacion);
        }
        if (Comentario::publicarComentario($comentario)) {
            echo true;
        } else {
            echo false;
        }
        break;

    case "mostrarComentarios":
        if (Comentario::mostrarComentarios($_REQUEST['post'])) {
            echo json_encode(Comentario::mostrarComentarios($_REQUEST['post']));
        } else {
            echo false;
        }
        break;

    case "eliminarComentario":
        echo Comentario::eliminarComentario($_REQUEST['comentario']);
        break;

    //Eventos

    case "getDateTime":
        $fecha = array(
            'day' => date('d'),
            'month' => date('m'),
            'year' => date("yy"),
            'hour' => date("H"),
            'minutes' => date("i")
        );
        echo json_encode($fecha);
        break;

    case "crearEvento":
        $fecha = date("Y-m-d H:i:s");
        $evento = new Evento($_REQUEST['titulo'], $_REQUEST['contenido'], $_REQUEST['tipo'], $fecha, $_REQUEST['fechai'], $_REQUEST['fechaf'], null, $_REQUEST['lat'], $_REQUEST['lng'], $_REQUEST['participable'], $idusuario);
        Evento::crearEvento($evento);
        echo Evento::consultarId($evento);
        break;

    case "mostrarEvento":
        if (Evento::mostrarEvento($_REQUEST['evento'], $idusuario)) {
            echo json_encode(Evento::mostrarEvento($_REQUEST['evento'], $idusuario));
        } else {
            echo false;
        }
        break;

    case "mostrarEventos":
        if (Evento::mostrarEventos($idusuario)) {
            echo json_encode(Evento::mostrarEventos($idusuario));
        } else {
            echo false;
        }
        break;

    case "mostrarEventosId":
        if (isset($_REQUEST['usuario'])) {
            $usu = $_REQUEST['usuario'];
        } else {
            $usu = $idusuario;
        }
        if (Evento::mostrarMisEventos($usu)) {
            echo json_encode(Evento::mostrarMisEventos($usu));
        } else {
            echo false;
        }
        break;

    case "participarEvento":
        if (Evento::participarEvento($_REQUEST['evento'], $idusuario)) {
            echo json_encode(Evento::participarEvento($_REQUEST['evento'], $idusuario));
        } else {
            echo false;
        }
        break;

    case "salirDeEvento":
        if (Evento::salirDeEvento($_REQUEST['evento'], $idusuario)) {
            echo json_encode(Evento::salirDeEvento($_REQUEST['evento'], $idusuario));
        } else {
            echo false;
        }
        break;
        
    case "eliminarEvento":
        Evento::eliminarEvento($_REQUEST['evento']);
        break;

    //Mensajes
    case "mostrarMisAmigosyMensajes":
        $namigos = explode(",", Usuario::mostrarAmigos($idusuario));
        if (Usuario::getDatosAmigosyMensajes($namigos, $_REQUEST['cadena'])) {
            $amigos = Usuario::getDatosAmigosyMensajes($namigos, $_REQUEST['cadena']);
            foreach ($amigos as $clave => $amigo) {
                $orden1[$clave] = $amigo['nick'];
            }

            array_multisort($orden1, SORT_ASC, $amigos);
            echo json_encode($amigos);
        } else {
            echo false;
        }
        break;

    case "mostrarCabeceraChat":
        echo json_encode(Usuario::getDatos($_REQUEST['usuario']));
        break;

    case "mostrarChat":
        if (Mensaje::mostrarChat($idusuario, $_REQUEST['usuario'])) {
            echo json_encode(Mensaje::mostrarChat($idusuario, $_REQUEST['usuario']));
        } else {
            echo false;
        }
        break;

    case "enviarMensaje":
        $fecha = date("Y-m-d H:i:s");
        $mensaje = new Mensaje($idusuario, $_REQUEST['usuario'], $_REQUEST['mensaje'], $fecha);
        if (Mensaje::enviarMensaje($mensaje)) {
            echo "true";
        } else {
            echo "false";
        }
        break;

    case "mensajesNoVistos":
        if (Mensaje::mensajesNoVistos($idusuario)) {
            echo json_encode(Mensaje::mensajesNoVistos($idusuario));
        } else {
            echo false;
        }
        break;

    case "mensajesUsuarioNoVistos":
        if (Mensaje::mensajesUsuarioNoVistos($_REQUEST['usuario'], $idusuario)) {
            echo json_encode(Mensaje::mensajesUsuarioNoVistos($_REQUEST['usuario'], $idusuario));
        } else {
            echo false;
        }
        break;

    case "mensajesLeidos":
        if (Mensaje::mensajesLeidos($_REQUEST['usuario'], $idusuario)) {
            echo true;
        } else {
            echo false;
        }
        break;

    case "comprobarMensajesNuevos":

        break;

    //Subir multimedia
    /*  case "cambiarImagen":
      $dir_subida = '../controlador/uploads/usuarios/';
      $allowed_ext = "jpg,png,jpeg";
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
      break; */

    //Más
    case "getDatosMiUsuario":
        echo json_encode(Usuario::getDatos($idusuario));
        break;

    case "getDatosUsuario":
        echo json_encode(Usuario::getDatos($_REQUEST['usuario']));
        break;
}

function agregarAmigo($user1, $user2) {
    Usuario::aceptarSolicitud($user1, $user2);
    Usuario::aceptarSolicitud($user2, $user1);
}

?>