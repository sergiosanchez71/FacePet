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
include 'clases/Notificacion.php';
include 'clases/Amistades.php';

session_start();
$accion = $_REQUEST['accion'];

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
        if (!Raza::comprobarNombre($_REQUEST['nombre'])) {
            Raza::crearRaza($_REQUEST['nombre'], $_REQUEST['animal']);
            echo "Raza creada correctamente";
        } else {
            echo "Esa raza ya existe";
        }
        break;

    case "borrarRaza":
        $animal = $_REQUEST['animalB'];
        $razas = $_REQUEST['razas'];
        for ($i = 0; $i < count($razas); $i++) {
            Raza::borrarRaza($razas[$i], $animal);
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
                $_SESSION['operador'] = Usuario::comprobarOperador($_REQUEST['username']);
                $_SESSION['username'] = $_REQUEST['username'];
                $_SESSION['password'] = Usuario::cifradaPassword($_REQUEST['username']);
                echo $_SESSION['operador'];
            } else {
                echo "La contraseña no es correcta";
            }
        } else {
            echo "El usuario introducido no existe";
        }
        break;

    case "getFotoPerfil":
        echo Usuario::getFotoPerfil($_SESSION['username']);
        break;

    case "buscarUsuarios":
        if (Usuario::getDatosBuscar($_REQUEST['cadena'], $_SESSION['username'])) {
            echo json_encode(Usuario::getDatosBuscar($_REQUEST['cadena'], $_SESSION['username']));
        } else {
            echo "null";
        }
        break;

    case "mostrarMisAmigos":
        $usuario = Usuario::getIdUsuario($_SESSION['username']);
        $amigos = explode(",", Usuario::mostrarMisAmigos($usuario));
        echo json_encode(Usuario::getDatosAmigos($amigos));
        break;
    
    case "cambiarAvatar":
        echo Usuario::getIdUsuario($_SESSION['username']);
        break;

    //Solicitud amistad

    case "mandarSolicitud":
        $fecha = date("Y-m-d H:i:s");
        $notificacion = new Notificacion(Usuario::getIdUsuario($_SESSION['username']), $_REQUEST['usuario'], "amistad", $fecha);
        Notificacion::crearNotificacion($notificacion);
        if (Amistades::mandarSolicitud(Usuario::getIdUsuario($_SESSION['username']), $_REQUEST['usuario'])) {
            echo true;
        } else {
            echo false;
        }
        break;
    case "cancelarSolicitud":
        $fecha = date("Y-m-d H:i:s");
        $notificacion = new Notificacion(Usuario::getIdUsuario($_SESSION['username']), $_REQUEST['usuario'], "amistad", $fecha);
        Notificacion::borrarNotificacion($notificacion);
        if (Amistades::cancelarSolicitud(Usuario::getIdUsuario($_SESSION['username']), $_REQUEST['usuario'])) {
            echo true;
        } else {
            echo false;
        }
        break;

    case "aceptarAmistad":
        $usu2 = Usuario::getIdUsuario($_SESSION['username']);
        agregarAmigo($_REQUEST['usuario'], $usu2);
        if (Amistades::aceptarSolicitud($_REQUEST['usuario'], $usu2)) {
            return true;
        } else {
            return false;
        }
        break;

    //Notificaciones
    case "mostrarNotificaciones":
        if (Notificacion::verNotificaciones(Usuario::getIdUsuario($_SESSION['username']))) {
            echo json_encode(Notificacion::verNotificaciones(Usuario::getIdUsuario($_SESSION['username'])));
        } else {
            echo false;
        }
        break;

    case "notificacionesVistas":
        Notificacion::notificacionesVistas(Usuario::getIdUsuario($_SESSION['username']));
        break;


    //Posts
    case "crearPost":
        $fecha = date("Y-m-d H:i:s");
        $post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $fecha, Usuario::getIdUsuario($_SESSION['username']));
        Post::crearPost($post);
        echo Post::consultarId($post);
        break;

    case "mostrarMisPosts":
        //Post::buscarPosts(Usuario::getIdUsuario($_SESSION['username']))
        
        if (Post::getDatosPostsUsuario(Usuario::getIdUsuario($_SESSION['username']))) {
            echo json_encode(Post::getDatosPostsUsuario(Usuario::getIdUsuario($_SESSION['username'])));
        } else {
            echo false;
        }
        break;
        
    case "eliminarPost":
        Post::eliminarPost($_REQUEST['post']);
        break;
    
    case "mostrarPostsAmigos":
        $usuario = Usuario::getIdUsuario($_SESSION['username']);
        $amigos = explode(",", Usuario::mostrarMisAmigos($usuario));
        if(Post::mostrarPostsAmigos($amigos)){
        echo json_encode(Post::mostrarPostsAmigos($amigos));
        } else {
            echo false;
        }
        break;

    //Subir multimedia
    case "cambiarImagen":
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
        break;

    //Más
    case "getDatosUsuario":
        echo json_encode(Usuario::getDatos($_SESSION['username']));
        break;
}

function agregarAmigo($user1, $user2) {
    Usuario::aceptarSolicitud($user1, $user2);
    Usuario::aceptarSolicitud($user2, $user1);
}

?>