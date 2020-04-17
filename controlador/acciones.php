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
                session_start();
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
        session_start();
        echo Usuario::getFotoPerfil($_SESSION['username']);
        break;

    //Posts
    case "crearPost":
        session_start();
        $fecha = date("Y-m-d H:i:s");
        $post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $fecha, Usuario::getIdUsuario($_SESSION['username']));
        Post::crearPost($post);
        echo Post::consultarId($post);
        break;
    
    case "mostrarMisPosts":
        session_start();
        //Post::buscarPosts(Usuario::getIdUsuario($_SESSION['username']));
        echo json_encode(Post::getDatosPostsUsuario(Usuario::getIdUsuario($_SESSION['username'])));
        break;

    //Más
    case "getDatosUsuario":
        session_start();
        echo json_encode(Usuario::getDatos($_SESSION['username']));
        break;
}
?>