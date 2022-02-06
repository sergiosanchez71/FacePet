<?php

/**
 * Description of consultas
 *
 * @author sergiosanchez
 */

//Incluimos las clases
include 'clases/Conexion.php';
include 'clases/Password.php';
include 'clases/Animal.php';
include 'clases/Raza.php';
include 'clases/Usuario.php';
include 'clases/Post.php';
include 'clases/Comentario.php';
include 'clases/Evento.php';
include 'clases/Notificacion.php';
include 'clases/Amistades.php';
include 'clases/Mensaje.php';
include 'clases/Provincia.php';
include 'clases/Municipio.php';

session_start(); 
$accion = $_REQUEST['accion']; //En esta variable almacenas la acción que se va a realizar
if (isset($_SESSION['username'])) {
    $idusuario = Usuario::getIdUsuario($_SESSION['username']); //Nuestra id de usuario
}

switch ($accion) { //Acce3demos al valor de $accion

    //Animales
    case "crearAnimal": //Creamos un animal
        if (!Animal::comprobarNombre($_REQUEST['nombre'])) { //Si este no existe
            Animal::crearAnimal(ucfirst($_REQUEST['nombre'])); //Creamos el animal con la primera letra mayúscula
            echo "Animal creado correctamente";
        } else {
            echo "Ese animal ya existe";
        }
        break;

    case "borrarAnimales": //Borramos un/varios animales
        $animales = $_REQUEST['animales']; //Almacenamos todos los animeles
        for ($i = 0; $i < count($animales); $i++) { //Recorremos cada uno de ellos
            Animal::borrarAnimal($animales[$i]); //Borrado
        }
        if (count($animales) > 1) { 
            echo "Animales eliminados correctamente";
        } else {
            echo "Animal eliminado correctamente";
        }
        break;

    case "consultarAnimales": //Consultamos animales
        $data = array(); //Creamos un array
        $data['id'] = Animal::mostrarIdAnimales(); //Id del animal
        $data['animal'] = Animal::mostrarAnimales(); //Nombre del animal
        echo json_encode($data); //Lo mandamos
        break;

    //Razas
    case "crearRaza": 
        if (!Raza::comprobarNombre($_REQUEST['nombre'], $_REQUEST['animal'])) { //Si el nombre de la raza no existe
            Raza::crearRaza(ucfirst($_REQUEST['nombre']), $_REQUEST['animal']); //Se crea la raza con la primera letra mayúscula
            echo "Raza creada correctamente";
        } else {
            echo "Esa raza ya existe";
        }
        break;

    case "borrarRazas":
        $razas = $_REQUEST['razas']; //Almacenamos las razas seleccionadas
        for ($i = 0; $i < count($razas); $i++) { //Recorremos cada una
            Raza::borrarRaza($razas[$i]); //Las vamos eliminando
        }
        if (count($razas) > 1) {
            echo "Razas eliminadas correctamente";
        } else {
            echo "Raza eliminada correctamente";
        }
        break;
    case "consultarRazas":
        $data = array(); //Creamos un array
        $data['id'] = Raza::mostrarIdRazas($_REQUEST['animal']); //Almacenamos su id
        $data['raza'] = Raza::mostrarRazas($_REQUEST['animal']); //Almacenamos su nombre
        echo json_encode($data); //la enviamos
        break;

    //Provincias
    case "consultarProvincias": 
        if (Provincia::consultarProvincias()) { //Si la consulta se hace con éxito
            echo json_encode(Provincia::consultarProvincias(), JSON_UNESCAPED_UNICODE); //Enviamos la provincia formateada
        } else {
            echo false;
        }
        break;

    //Municipios
    case "consultarMunicipios":
        if (Municipio::consultarMunicipios($_REQUEST['provincia'])) { //Si la consulta se hace con éxito
            echo json_encode(Municipio::consultarMunicipios($_REQUEST['provincia']), JSON_UNESCAPED_UNICODE); //Enviamos la ciudad formateada
        } else {
            echo false;
        }
        break;

    //Admin Usuarios

    case "sancionarUsuario":
        if (Usuario::sancionarUsuario($_REQUEST['tiempo'], $_REQUEST['mensaje'], $_REQUEST['usuario'])) { //Si la consulta se hace con éxito
            echo json_encode(Usuario::sancionarUsuario($_REQUEST['tiempo'], $_REQUEST['mensaje'], $_REQUEST['usuario'])); //Sancionamos dado el tiempo a un usuario
        } else {
            echo false;
        }
        break;

    case "eliminarSancion":
        if (Usuario::quitarSancion($_REQUEST['usuario'])) { //Si la consulta se hace con éxito
            echo Usuario::quitarSancion($_REQUEST['usuario']); //Quitamos la sanción dado el id de usuario
        } else {
            echo false;
        }
        break;

    case "eliminarUsuario":
        if (Usuario::eliminarUsuario($_REQUEST['usuario'])) { //Si la consulta se hace con éxito
            echo Usuario::eliminarUsuario($_REQUEST['usuario']); //Eliminamos un usuario dado su id
        } else {
            echo false;
        }
        break;

    //Usuarios
    case "crearUsuario":
        $password = Password::md5($_REQUEST['password']); //Encriptamos la contraseña a md5
        //Creamos un objeto  usuario
        $usuario = new Usuario($_REQUEST['nick'], $password, $_REQUEST['email'], $_REQUEST['animal'], $_REQUEST['raza'], $_REQUEST['sexo'], null, $_REQUEST['provincia'], $_REQUEST['municipio']);
        

        if (!Usuario::existeUsuario($_REQUEST['nick'])) { //Si no existe
            Usuario::crearUsuario($usuario); //lo creamos
            echo "Usuario registrado correctamente";
        } else {
            echo "El nombre de usuario ya está en uso";
        }
        break;

    case "entrar":
        if (Usuario::existeUsuario($_REQUEST['username'])) { //Si existe el usuario
            if (Password::verifymd5($_REQUEST['password'], Usuario::cifradaPassword($_REQUEST['username']))) { //Comprobamos la contraseña
                if (!Usuario::estaBaneado($_REQUEST['username'])) { //Si no está baneado
                    $_SESSION['operador'] = Usuario::comprobarOperador(Usuario::getIdUsuario($_REQUEST['username']));  //Guardamos si es operador
                    $_SESSION['username'] = $_REQUEST['username']; //Guardamos el nombre de usuario
                    $_SESSION['password'] = Usuario::cifradaPassword($_REQUEST['username']); //Guardamos la contraseña cifrada
                    echo $_SESSION['operador']; //Devolvemos el operador
                } else {
                    //$tiempo = Usuario::estaBaneado($_REQUEST['username']);
                    if(Usuario::estaBaneado($_REQUEST['username'])[1] != ""){ //Si hay mensaje de ban
                    echo "Esta sancionado hasta " . Usuario::estaBaneado($_REQUEST['username'])[0]." por el motivo: '".Usuario::estaBaneado($_REQUEST['username'])[1]."'"; //Si está baneado devolvemos el siguiente mensaje seguido el tiempo cuando acaba
                    } else {
                        echo "Esta sancionado hasta " . Usuario::estaBaneado($_REQUEST['username'])[0]." por motivo no especificado"; //Si el mensaje está en blanco
                    }
                }
            } else {
                echo "La contraseña no es correcta"; //Si la contraseña no es correcta mostramos el siguiente mensaje
            }
        } else {
            echo "El usuario introducido no existe"; //Si el usuario no existe mostramos el siguiente mensaje
        }
        break;

    case "getFotoPerfil":
        if (Usuario::getFotoPerfil($_SESSION['username'])) { //Si la consulta se hace con éxito
            echo Usuario::getFotoPerfil($_SESSION['username']); //Mandamos la foto de perfil
        } else {
            header("Location: ../index.php"); //Si no encuentra la foto de perfil nos manda al inicio, porque hasta los usuarios que no tienen foto de perfil tienen una por defecto
            //por lo cual si no la encuentra ese usuario no existe
        }
        break;

        case "buscarUsuariosSancion":
        if (Usuario::getDatosBuscarSancion($_REQUEST['cadena'], $_SESSION['username'])) { //Si la consulta se hace con éxito
            echo json_encode(Usuario::getDatosBuscarSancion($_REQUEST['cadena'], $_SESSION['username'])); //Mandamos los datos de los usuarios que hemos buscado
        } else {
            echo false;
        }
        break;
        
    case "buscarUsuarios":
        if (Usuario::getDatosBuscar2($_REQUEST['cadena'], $_SESSION['username'], $_REQUEST['ciudad'], $_REQUEST['animal'])) { //Si la consulta se hace con éxito
            echo json_encode(Usuario::getDatosBuscar2($_REQUEST['cadena'], $_SESSION['username'],$_REQUEST['ciudad'], $_REQUEST['animal'])); //Mandamos los datos de los usuarios
        } else {
            echo false;
        }
        break;

    case "mostrarTodosNombresUsuarios":
        if (Usuario::mostrarTodosNombresUsuarios($_SESSION['username'])) { //Si la consulta se hace con éxito
            echo json_encode(Usuario::mostrarTodosNombresUsuarios($_SESSION['username'])); //Todos los nombres de usuario que existen en la BD
        } else {
            echo false;
        }
        break;

    case "mostrarMisAmigos":
        if (Usuario::mostrarAmigos($idusuario)) { //Si la consulta se hace con éxito
            $namigos = explode(",", Usuario::mostrarAmigos($idusuario)); //Creamos un array amigos separado por comas
            if (Usuario::getDatosAmigos($namigos)) { //Si la consulta de datos se hace con éxito
                $amigos = Usuario::getDatosAmigos($namigos); //Seleccionamos los datos de los amigos
                foreach ($amigos as $clave => $amigo) { //Recorremos todos los amigos
                    $orden1[$clave] = $amigo['nick']; //Seleccionamos el nick de cada usuario
                }

                array_multisort($orden1, SORT_ASC, $amigos); //Ordenamos el array por nick
                echo json_encode($amigos); //Devolvemos los amigos
            } else {
                echo false;
            }
        }
        break;

    case "mostrarAmigos":
        if (Usuario::mostrarAmigos($_REQUEST['usuario'])) { //Si la consulta se hace con éxito
            $namigos = explode(",", Usuario::mostrarAmigos($_REQUEST['usuario'])); //Creamos un array de amigos
            $amigos = Usuario::getDatosAmigos($namigos); //Cogemos los datos de los amigos
            foreach ($amigos as $clave => $amigo) { //Recorremos el array
                $orden1[$clave] = $amigo['nick']; //Seleccionamos el nick de cada usuario
            }

            array_multisort($orden1, SORT_ASC, $amigos); //Ordenamos el array por nick
            echo json_encode($amigos); //Devolvemos los amigos
        } else {
            echo false;
        }
        break;

    case "cambiarAvatar":
        echo $idusuario; //Nos da el id de usuario para que podamos almacenar su avatar
        break;

    case "eliminarAmigo":
        Usuario::eliminarAmigo($_REQUEST['amigo'], $idusuario); //Eliminamos un amigo dado un usuario y un amigo
        echo Usuario::eliminarAmigo($idusuario, $_REQUEST['amigo']); 
        break;

    //Solicitud amistad

    case "mandarSolicitud":
        $fecha = date("Y-m-d H:i:s"); //Creamos una fecha actual
        $notificacion = new Notificacion($idusuario, $_REQUEST['usuario'], "amistad", 0, $fecha); //Creamos un objeto notificación
        Notificacion::crearNotificacion($notificacion); //La almacenamos en la base de datos
        if (Amistades::mandarSolicitud($idusuario, $_REQUEST['usuario'], $_REQUEST['mensaje'])) { //Mandamos la solicitud de amistad
            echo true;
        } else {
            echo false;
        }
        break;
    case "cancelarSolicitud":
        $fecha = date("Y-m-d H:i:s"); //Creamos una fecha actual
        $notificacion = new Notificacion($_REQUEST['usuario'], $idusuario, "amistad", 0, $fecha); //Creamos un objecto notificación
        Notificacion::borrarNotificacion($notificacion); //Borramos la notificación
        if (Amistades::cancelarSolicitud($idusuario, $_REQUEST['usuario'])) { //Cancelamnos la solicitud de amistad
            echo true;
        } else {
            echo false;
        }
        break;

    case "aceptarAmistad":
        $usu2 = $idusuario; //El usuario logueado es usuario2
        agregarAmigo($_REQUEST['usuario'], $usu2); //Lo añade como amigo
        if (Amistades::aceptarSolicitud($_REQUEST['usuario'], $usu2)) { //La solicitud pasa a ser "aceptada"
            return true;
        } else {
            return false;
        }
        break;

    //Notificaciones
    case "mostrarNotificaciones":
        if (Notificacion::verNotificaciones($idusuario)) { //Si la consulta se hace con éxito
            echo json_encode(Notificacion::verNotificaciones($idusuario)); //Muestra las notificaciones
        } else {
            echo false;
        }
        break;

    case "notificacionesVistas":
        Notificacion::notificacionesVistas($idusuario); //Marcamos como vistas las notificaciones dada un usuario
        break;


    //Posts
    case "crearPost":
        $fecha = date("Y-m-d H:i:s"); //Creamos un date
        $post = new Post($_REQUEST['titulo'], $_REQUEST['contenido'], $fecha, $idusuario); //Creamos un objeto post
        Post::crearPost($post); //Lo almacenamos en la base de datos
        echo Post::consultarId($post); //Devolvemos su id
        break;

    case "mostrarMisPosts":
        if (Post::getDatosPostsUsuario($idusuario, $_REQUEST['cantidad'])) { //Si la consulta se hace con éxito
            echo json_encode(Post::getDatosPostsUsuario($idusuario, $_REQUEST['cantidad'])); //Devolvemos los datos de los posts dados un suuario
        } else {
            echo false;
        }
        break;

    case "mostrarPosts":
        if (Post::getDatosPostsUsuario($_REQUEST['usuario'], $_REQUEST['cantidad'], $_REQUEST['array'])) { //Si la consulta se hace con éxito
            echo json_encode(Post::getDatosPostsUsuario($_REQUEST['usuario'], $_REQUEST['cantidad'], $_REQUEST['array'])); //Mandamos los datos de los posts del usuario
        } else {
            echo false;
        }
        break;

    case "mostrarPost":
        if (Post::mostrarPost($_REQUEST['post'], $idusuario)) { //Si la consulta se hace con éxito
            echo json_encode(Post::mostrarPost($_REQUEST['post'], $idusuario)); //Mostramos un post
        } else {
            echo false;
        }
        break;

    case "eliminarPost":
        Post::eliminarPost($_REQUEST['post']); //Eliminamos un post
        break;

    case "mostrarPostsAmigos":
        $amigos = explode(",", Usuario::mostrarAmigos($idusuario)); //Seleccionamos los amigos dado un idusuario
        $posts = Post::mostrarPostsAmigos($amigos, $idusuario, $_REQUEST['cantidad'], $_REQUEST['array']); //Mostramos los posts de nuestros amigos
        if ($posts) {
            foreach ($posts as $clave => $post) { //Recorremos los posts
                $orden1[$clave] = $post['fecha_publicacion']; //Seleccionamos la fecha de publicacion
            }

            array_multisort($orden1, SORT_DESC, $posts); //Ordenamos los posts por la fecha

            echo json_encode($posts); //Devolvemos los posts
        } else {
            echo false;
        }
        break;

    case "darLike":
        if (!Post::comprobarLike($_REQUEST['post'], $idusuario)) { //Comprobamos si no hemos dado like 
            echo Post::darLike($_REQUEST['post'], $idusuario); //Damos like
        } else {
            echo false;
        }
        break;

    //Comentarios    
    case "publicarComentario":
        $fecha = date("Y-m-d H:i:s"); //Creamos un date
        $comentario = new Comentario($_REQUEST['contenido'], $fecha, $_REQUEST['post'], $idusuario); //Creamos un objeto comentario
        if ($idusuario != Post::getUsuarioPost($_REQUEST['post'])) { //Si el usuario no es dueño del post
            $notificacion = new Notificacion($idusuario, Post::getUsuarioPost($_REQUEST['post']), "comentarioP", $_REQUEST['post'], $fecha); //Creamos un objeto notificación
            Notificacion::crearNotificacion($notificacion); //Lo introducimos en la base de datos
        }
        if (Comentario::publicarComentario($comentario)) { //Publicamos el comentario
            echo true;
        } else {
            echo false;
        }
        break;

    case "mostrarComentarios":
        if (Comentario::mostrarComentarios($_REQUEST['post'])) { //Si la consulta se hace con éxito
            echo json_encode(Comentario::mostrarComentarios($_REQUEST['post'])); //Mostramos los comentarios dados un post
        } else {
            echo false;
        }
        break;

    case "eliminarComentario":
        echo Comentario::eliminarComentario($_REQUEST['comentario']);  //Eliminamos un comentario dado su id
        break;

    //Eventos

    case "getDateTime": //Creamos una fecha formateada
        $fecha = array(
            'day' => date('d'), //dias
            'month' => date('m'), //mes
            'year' => date("20y"), //año
            'hour' => date("H"), //hora
            'minutes' => date("i"), //minutos
            'seconds' => date("s") //segundos
        );
        echo json_encode($fecha); //Devolvemos la fecha
        break;

    case "crearEvento":
        $fecha = date("Y-m-d H:i:s"); //Creamos una fecha actual
        //Creamos un objeto evento
        $evento = new Evento($_REQUEST['titulo'], $_REQUEST['contenido'], $_REQUEST['tipo'], $fecha, $_REQUEST['fechai'], $_REQUEST['fechaf'], null, $_REQUEST['direccion'], $_REQUEST['cp'], $_REQUEST['ciudad'], $_REQUEST['provincia'], $_REQUEST['lat'], $_REQUEST['lng'], $_REQUEST['participable'], $idusuario);
        Evento::crearEvento($evento); //Lo introducimos en la base de datos
        echo Evento::consultarId($evento); //Devolvemos su id
        break;

    case "mostrarEvento":
        if (Evento::mostrarEvento($_REQUEST['evento'], $idusuario)) { //Si la consulta se hace con éxito
            echo json_encode(Evento::mostrarEvento($_REQUEST['evento'], $idusuario)); //Mostramos los eventos dado su id 
        } else {
            echo false;
        }
        break;

    case "mostrarEventos":
        if (Evento::mostrarEventos($idusuario,$_REQUEST['cantidad'])) { //Si la consulta se hace con éxito
            echo json_encode(Evento::mostrarEventos($idusuario,$_REQUEST['cantidad'])); //Mostramos los eventos dada el id de usuario y una cantidad
        } else {
            echo false;
        }
        break;

    case "mostrarEventosCantidad":
        if(Evento::mostrarEventosCantidad($idusuario,$_REQUEST['cantidad'],$_REQUEST['checkLugar'],$_REQUEST['rdFecha'])){ //Si la consulta se hace con éxito
            echo json_encode(Evento::mostrarEventosCantidad($idusuario,$_REQUEST['cantidad'],$_REQUEST['checkLugar'],$_REQUEST['rdFecha'])); //Mostramos los eventos dada una cantidad y los requisitos
        } else{
            echo false;
        }
        break;
        
    case "mostrarEventosId":
        if (isset($_REQUEST['usuario'])) { //Si existe usuario
            $usu = $_REQUEST['usuario'];  //usu es el usuario seleccionado
        } else {
            $usu = $idusuario; //si no el usuario somos nosotros
        }
        if (Evento::mostrarMisEventos($usu,$_REQUEST['cantidad'])) { 
            echo json_encode(Evento::mostrarMisEventos($usu,$_REQUEST['cantidad'])); //Mostramos los eventos de ese usuario
        } else {
            echo false;
        }
        break;

    case "participarEvento":
        if (Evento::participarEvento($_REQUEST['evento'], $idusuario)) {
            echo json_encode(Evento::participarEvento($_REQUEST['evento'], $idusuario)); //Participamos en el evento
        } else {
            echo false;
        }
        break;

    case "salirDeEvento":
        if (Evento::salirDeEvento($_REQUEST['evento'], $idusuario)) {
            echo json_encode(Evento::salirDeEvento($_REQUEST['evento'], $idusuario)); //Salimos del evento
        } else {
            echo false;
        }
        break;

    case "eliminarEvento":
        Evento::eliminarEvento($_REQUEST['evento']); //Eliminamos un evento
        break;

    //Mensajes
    case "mostrarMisAmigosyMensajes":
        $namigos = explode(",", Usuario::mostrarAmigos($idusuario)); //Array de amigos
        if (Usuario::getDatosAmigosyMensajes($namigos, $_REQUEST['cadena'])) { 
            $amigos = Usuario::getDatosAmigosyMensajes($namigos, $_REQUEST['cadena']); //Almacenamos todos los amigos y mensajes
            foreach ($amigos as $clave => $amigo) {
                $orden1[$clave] = $amigo['nick']; //Seleccionamos nick
            }

            array_multisort($orden1, SORT_ASC, $amigos); //Ordenamos por nick
            echo json_encode($amigos); //Devolvemos 
        } else {
            echo false;
        }
        break;

    case "mostrarCabeceraChat":
        echo json_encode(Usuario::getDatos($_REQUEST['usuario'])); //Mostramos la cabecera de nuestro chat
        break;

    case "mostrarChat":
        if (Mensaje::mostrarChat($idusuario, $_REQUEST['usuario'])) {
            echo json_encode(Mensaje::mostrarChat($idusuario, $_REQUEST['usuario'])); //Mostramos el contenido de nuestro chat
        } else {
            echo false;
        }
        break;

    case "enviarMensaje":
        $fecha = date("Y-m-d H:i:s"); //Creamos una fecha actual
        $mensaje = new Mensaje($idusuario, $_REQUEST['usuario'], $_REQUEST['mensaje'], $fecha); //Creamos un objeto mensaje
        if (Mensaje::enviarMensaje($mensaje)) {  //Insertamos en la base de datos el mensaje
            echo "true"; //Enviado correctamente
        } else {
            echo "false";
        }
        break;

    case "mensajesNoVistos":
        if (Mensaje::mensajesNoVistos($idusuario)) {
            echo json_encode(Mensaje::mensajesNoVistos($idusuario)); //Mensajes que no hemos visto
        } else {
            echo false;
        }
        break;

    case "mensajesUsuarioNoVistos":
        if (Mensaje::mensajesUsuarioNoVistos($_REQUEST['usuario'], $idusuario)) {
            echo json_encode(Mensaje::mensajesUsuarioNoVistos($_REQUEST['usuario'], $idusuario));  //Mensajes de un usuario en específico que no hemos visto
        } else {
            echo false;
        }
        break;

    case "mensajesLeidos":
        if (Mensaje::mensajesLeidos($_REQUEST['usuario'], $idusuario)) { //Marcamos como leídos los mensajes
            echo true;
        } else {
            echo false;
        }
        break;
        
    //Más
    case "getDatosMiUsuario":
        if (Usuario::getDatos($idusuario)) {
            echo json_encode(Usuario::getDatos($idusuario)); //Accedemos a los datos de mi usuario
        } else {
            echo false;
        }
        break;

    case "getDatosUsuario":
        echo json_encode(Usuario::getDatos($_REQUEST['usuario'])); //Accedemos a los datos de un usuario
        break;
}

function agregarAmigo($user1, $user2) { //Agragamos un amigo
    Usuario::aceptarSolicitud($user1, $user2); //Aceptamos la solicitud desde los dos sitios
    Usuario::aceptarSolicitud($user2, $user1);
}

?>