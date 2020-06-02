<?php

/**
 * Description of Usuario
 *
 * @author sergiosanchez
 */
class Usuario {

    private $id;
    private $nick;
    private $password;
    private $email;
    private $animal;
    private $raza;
    private $sexo;
    private $foto;
    private $provincia;
    private $municipio;
    private $amigos;
    private $baneado;
    private $operador;

    //Constructor de usuario
    function __construct($nick, $password, $email, $animal, $raza, $sexo, $foto, $provincia, $municipio) {
        $this->nick = $nick;
        $this->password = $password;
        $this->email = $email;
        $this->animal = $animal;
        $this->raza = $raza;
        $this->sexo = $sexo;
        $this->foto = $foto;
        $this->provincia = $provincia;
        $this->municipio = $municipio;
        $this->amigos = null;
        $this->nombre = null;
        $this->operador = 0;
    }

    function getId() {
        return $this->id;
    }

    function getNick() {
        return $this->nick;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getAnimal() {
        return $this->animal;
    }

    function getRaza() {
        return $this->raza;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getFoto() {
        return $this->foto;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function getAmigos() {
        return $this->amigos;
    }

    function getBaneado() {
        return $this->baneado;
    }

    function getOperador() {
        return $this->operador;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNick($nick) {
        $this->nick = $nick;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setAnimal($animal) {
        $this->animal = $animal;
    }

    function setRaza($raza) {
        $this->raza = $raza;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }

    function setAmigos($amigos) {
        $this->amigos = $amigos;
    }

    function setBaneado($baneado) {
        $this->baneado = $baneado;
    }

    function setOperador($operador) {
        $this->operador = $operador;
    }

    //Comprobamos si el usuario dado su nick existe
    function existeUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nick from usuarios where lower(nick)='$usuario'");
        $existe = false;
        while ($row = $consulta->fetch()) {
            $existe = true;
        }
        unset($conexion);
        return $existe;
    }

    //Comprobamos si existe el email dado un objeto usuario
    function existeEmail($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT email from usuarios where lower(email)='$usuario->email'");
        $existe = false;
        while ($row = $consulta->fetch()) {
            $existe = true;
        }
        unset($conexion);
        return $existe;
    }

    //Creamos un usuario dado un objeto usuario
    function crearUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (nick,password,email,animal,raza,sexo,foto,provincia,municipio,amigos,operador) VALUES (lower('$usuario->nick'),'$usuario->password','$usuario->email','$usuario->animal','$usuario->raza','$usuario->sexo','$usuario->foto','$usuario->provincia','$usuario->municipio',' ',0)";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Mostramos la contraseña cifrada dado un nick
    function cifradaPassword($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT password from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            $pass = $row['password'];
        }
        unset($conexion);
        return $pass;
    }

    //Comprobamos si un usuario es operador dado su id de usuario
    function comprobarOperador($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT operador from usuarios where id='$usuario'");
        while ($row = $consulta->fetch()) {
            $op = $row['operador'];
        }
        unset($conexion);
        return $op;
    }

    //Accedemos al id de usuario dado su nick
    function getIdUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from usuarios where nick='$usuario'");
        $id = null;
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }

    //Buscamos los amigos de un usuario dado su id
    function getAmigosId($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT amigos from usuarios where id='$id'");
        while ($row = $consulta->fetch()) {
            $id = $row['amigos'];
        }
        unset($conexion);
        return $id;
    }

    //Buscamos la foto de perfil de un usuario dado su id
    function getFotoPerfilconId($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where id='$id'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) { //Si no tiene foto
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
        }
        unset($conexion);
        return $foto;
    }

    //Buscamos el nick de usuario dado su id
    function getNickName($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nick from usuarios where id='$id'");
        $nick = null;
        while ($row = $consulta->fetch()) {
            $nick = $row['nick'];
        }
        unset($conexion);
        return $nick;
    }

    //Buscamos la foto de perfil dado el nick de usuario
    function getFotoPerfil($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) { //Si no tiene foto
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
        }
        unset($conexion);
        return $foto;
    }

    //Accedemos al animal de usuario dado su id
    function getAnimalUsuarioId($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT animal from usuarios where id='$usuario'");
        while ($row = $consulta->fetch()) {
            $animal = $row['animal'];
        }
        unset($conexion);
        return $animal;
    }

    //Accedemos al animal de usuario dado su nick
    function getAnimalUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT animal from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            $animal = $row['animal'];
        }
        unset($conexion);
        return $animal;
    }

    //Accedemos a la raza de usuario dado su id
    function getRazaUsuarioId($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT raza from usuarios where id='$usuario'");
        while ($row = $consulta->fetch()) {
            $raza = $row['raza'];
        }
        unset($conexion);
        return $raza;
    }

    //Accedemos a la raza de usuario dado su nick
    function getRazaUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT raza from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            $raza = $row['raza'];
        }
        unset($conexion);
        return $raza;
    }

    //Eliminamos un amigo dado su id de usuario y el de amigo
    function eliminarAmigo($idusuario, $amigo) {
        $fecha = date("Y-m-d H:i:s"); //Fecha actual
        $notificacion = new Notificacion($idusuario, $amigo, "amistad", 0, $fecha); //Creamos una notificacion
        Notificacion::borrarNotificacion($notificacion); //Borramos la notificacion
        Amistades::cancelarSolicitud($idusuario, $amigo); //Cancelamos la solicitud de amistad
        Mensaje::eliminarMensajes($idusuario, $amigo); //Eliminamos los mensajes que hemos tenido con él
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT amigos from usuarios where id='$idusuario'");
        while ($row = $consulta->fetch()) {
            $amigoscad = $row['amigos']; //Sacamos el id de sus amigos
        }
        $amigos = explode(",", $amigoscad);
        for ($i = 0; $i < count($amigos); $i++) {
            if ($amigos[$i] == $amigo) { //Cuando lo encontremos
                unset($amigos[$i]); //Lo eliminamos
            }
        }
        $amigosNewCad = implode(",", $amigos);
        $sql = "UPDATE usuarios SET amigos='$amigosNewCad' where id='$idusuario'"; //Actualizamos
        $conexion->exec($sql);
        unset($conexion);
    }

    //Eliminamos los amigos dado un id de usuario
    function eliminarAmigosUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id,amigos from usuarios");
        while ($row = $consulta->fetch()) {
            $amigoscad = $row['amigos'];
            $id = $row['id'];
            $amigos = explode(",", $amigoscad);
            for ($i = 0; $i < count($amigos); $i++) {
                if ($amigos[$i] == $usuario) { //Recorremos cada usuario para ver si los tenían como amigo
                    unset($amigos[$i]); //Lo eliminamos
                }
            }
            $amigosNewCad = implode(",", $amigos);
            $sql = "UPDATE usuarios SET amigos='$amigosNewCad' where id='$id'"; //Actualizamos
            $conexion->exec($sql);
        }

        unset($conexion);
    }

    //Sacamos los datos de nuestro usuario
    function getDatos($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where id='$usuario'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) { //Si no tiene foto
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
            $datos = ['id' => $row['id'],
                'nick' => $row['nick'],
                'password' => $row['password'],
                'email' => $row['email'],
                'animal' => Animal::buscarConId($row['animal']), //Nombre animal usuario
                'raza' => Raza::buscarConId($row['raza']), //Nombre raza usuario
                'sexo' => $row['sexo'],
                'foto' => $foto,
                'provincia' => Provincia::getNombreProvincia($row['provincia']), //Nombre provincia usuario
                'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Nombre municipio usuario
                'amigos' => $row['amigos'],
                'baneado' => $row['baneado'],
                'operador' => $row['operador']
            ];
        }
        unset($conexion);
        return $datos;
    }

    //Sacamos los datos de nuestros amigos
    function getDatosAmigos($amigos) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $datos = null;
        for ($i = 0; $i < count($amigos); $i++) { //Recorremos cada uno de nuestros amigos
            $consulta = $conexion->query("SELECT * from usuarios where id='$amigos[$i]'");
            while ($row = $consulta->fetch()) {
                if ($row['foto'] == null) { //Si no tiene foto
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }
                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']), //Nombre animal usuario
                    'raza' => Raza::buscarConId($row['raza']), //Nombre raza usuario
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']), //Nombre provincia usuario
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Nombre municipio usuario
                    'amigos' => $row['amigos'],
                    'baneado' => $row['baneado'],
                    'operador' => $row['operador'],
                    'loginOperador' => $_SESSION['operador'],
                    'login' => Usuario::getIdUsuario($_SESSION['username'])
                ];
            }
        }
        unset($conexion);
        return $datos;
    }

    //Accedemos a los amigos y los mensajes que nos han dejado
    function getDatosAmigosyMensajes($amigos, $cadena) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $datos = null;
        for ($i = 0; $i < count($amigos); $i++) {
            $consulta = $conexion->query("SELECT * from usuarios where id='$amigos[$i]' and nick like '$cadena%'");
            while ($row = $consulta->fetch()) {
                if ($row['foto'] == null) { //Si no tiene foto
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }
                $mensajes = 0; //Por defecto 0
                if (Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username']))) { //si no los ha visto
                    $mensajes = count(Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username']))); //Los suma
                    if ($mensajes < 9) { //Si son menos de 9
                        $mensajes = count(Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username'])));
                    } else { //Si son más de 9 se muestra 9 como límite
                        $mensajes = 9;
                    }
                }
                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']), //Nombre animal usuario
                    'raza' => Raza::buscarConId($row['raza']), //Nombre raza usuario
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']), //Nombre provincia usuario
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Nombre municipio usuario
                    'amigos' => $row['amigos'],
                    'baneado' => $row['baneado'],
                    'operador' => $row['operador'],
                    'mensajes' => $mensajes,
                    'loginOperador' => $_SESSION['operador'],
                    'login' => Usuario::getIdUsuario($_SESSION['username'])
                ];
            }
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos todos los usuarios
    function mostrarTodosNombresUsuarios($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where nick!='$usuario' order by nick asc");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
            if ($solicitud != "aceptada") { //Si no tienen la solicitud aceptada
                $datos[$i] = $row['nick'];
                $i++;
            }
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }
        return $datos;
    }

    //Buscamos amigos dado mi usuario, la cadena introducida, y si quiere que sea de la misma ciudad y animal
    function getDatosBuscar2($cadena, $usuario, $checkCiudad, $checkAnimal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $provincia = Usuario::getProvinciaNumUsuario(Usuario::getIdUsuario($usuario)); //Mi provincia
        $municipio = Usuario::getMunicipioNumUsuario(Usuario::getIdUsuario($usuario)); //Mi municipio
        $animal = Usuario::getAnimalUsuarioId(Usuario::getIdUsuario($usuario)); //Mi animal
        $raza = Usuario::getRazaUsuarioId(Usuario::getIdUsuario($usuario)); //Mi raza
        if ($checkCiudad == "true" && $checkAnimal == "true") { //Si quiere que esté ordenado por localidad y animal
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' and animal='$animal' and raza='$raza' order by nick asc");
        } else if ($checkAnimal == "true") { //Ordenado por animal
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal='$animal' and raza='$raza' order by nick asc");
        } else if ($checkCiudad == "true") {//Ordenado por localidad
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' order by nick asc");
        } else { //Sin ordenar
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' order by nick asc");
        }
        $limite = 5; //Muestra 5 usuarios
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($i < $limite) {
                $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                $fecha = date("Y-m-d H:i:s"); //Fecha actual
                if ($solicitud != "aceptada") { //Si no está aceptada la petición
                    if ($row['foto'] == null) { //si no tiene foto
                        $foto = "0.jpg";
                    } else {
                        $foto = $row['foto'];
                    }

                    $datos[$i] = ['id' => $row['id'],
                        'nick' => $row['nick'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                        'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                        'sexo' => $row['sexo'],
                        'foto' => $foto,
                        'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                        'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                        'amigos' => $row['amigos'],
                        'baneado' => $row['baneado'],
                        'fechaH' => $fecha,
                        'operador' => $row['operador'],
                        'solicitud' => $solicitud,
                        'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                    ];
                    $i++;
                }
            }
        }
        if ($checkAnimal == "true" || $checkCiudad == "true") { //Si alguno de los dos está marcado
            if ($checkCiudad == "true" && $checkAnimal == "true") { //Si están los dos marcados
                //Muestra los usuarios que tengan la misma provincia, la misma ciudad, el mismo animal pero distinta raza
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkAnimal == "true") { //Si está el check animal marcado
                //Muestra los usuarios que tengan el mismo animal pero distinta raza
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkCiudad == "true") { //Si está el check ciudad marcado
                //Muestra los usuarios que tengan la misma provincia pero distinta ciudad
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' order by nick asc");
            }

            while ($row = $consulta2->fetch()) {
                if ($i < $limite) {
                    $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                    $fecha = date("Y-m-d H:i:s"); //Fecha actual
                    if ($solicitud != "aceptada") { //Si no está aceptada la petición
                        if ($row['foto'] == null) { //si no tiene foto
                            $foto = "0.jpg";
                        } else {
                            $foto = $row['foto'];
                        }

                        $datos[$i] = ['id' => $row['id'],
                            'nick' => $row['nick'],
                            'password' => $row['password'],
                            'email' => $row['email'],
                            'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                            'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                            'sexo' => $row['sexo'],
                            'foto' => $foto,
                            'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                            'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                            'amigos' => $row['amigos'],
                            'baneado' => $row['baneado'],
                            'fechaH' => $fecha,
                            'operador' => $row['operador'],
                            'solicitud' => $solicitud,
                            'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                        ];
                        $i++;
                    }
                }
            }
            if ($checkCiudad == "true" && $checkAnimal == "true") { //Si están los dos marcados
                //Muestran los usuarios que tienen la misma provincia, animal y raza pero distinto municipio
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal='$animal' and raza='$raza' order by nick asc");
            } else if ($checkAnimal == "true") { //Si está marcado solo el check animal
                //Muestran todos los usuarios que no tengan el mismo animal ni misma raza
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal!='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkCiudad == "true") { //Si está marcado solo el check ciudad
                //Muestran todos los usuarios que no tengan la misma provincia ni el mismo municipio
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' order by nick asc");
            } while ($row = $consulta3->fetch()) {
                if ($i < $limite) {
                    $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                    $fecha = date("Y-m-d H:i:s"); //Fecha actual
                    if ($solicitud != "aceptada") { //Si no está aceptada la petición
                        if ($row['foto'] == null) { //si no tiene foto
                            $foto = "0.jpg";
                        } else {
                            $foto = $row['foto'];
                        }

                        $datos[$i] = ['id' => $row['id'],
                            'nick' => $row['nick'],
                            'password' => $row['password'],
                            'email' => $row['email'],
                            'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                            'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                            'sexo' => $row['sexo'],
                            'foto' => $foto,
                            'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                            'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                            'amigos' => $row['amigos'],
                            'baneado' => $row['baneado'],
                            'fechaH' => $fecha,
                            'operador' => $row['operador'],
                            'solicitud' => $solicitud,
                            'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                        ];
                        $i++;
                    }
                }
            }
            if ($checkCiudad == "true" && $checkAnimal == "true") { //Si ambos están marcados
                //Muestran los usuarios que tienen la misma provincia el mismo animal pero distinto municipio y raza
                $consulta4 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta4->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                        $fecha = date("Y-m-d H:i:s"); //Fecha actual
                        if ($solicitud != "aceptada") { //Si no está aceptada la petición
                            if ($row['foto'] == null) { //si no tiene foto
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                                'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                            ];
                            $i++;
                        }
                    }
                }
                //Muestran los usuarios que tienen el mismo animal pero distinta provincia,municipio y raza
                $consulta5 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta5->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                        $fecha = date("Y-m-d H:i:s"); //Fecha actual
                        if ($solicitud != "aceptada") { //Si no está aceptada la petición
                            if ($row['foto'] == null) { //si no tiene foto
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                                'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                            ];
                            $i++;
                        }
                    }
                }
                //Muestran los usuarios que tienen la misma provincia pero distinto animal,municipio y raza
                $consulta6 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal!='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta6->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                        $fecha = date("Y-m-d H:i:s"); //Fecha actual
                        if ($solicitud != "aceptada") { //Si no está aceptada la petición
                            if ($row['foto'] == null) { //si no tiene foto
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                                'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                            ];
                            $i++;
                        }
                    }
                }
                //Muestran todos los usuarios que no tienen la misma provincia, municipio, animal y raza
                $consulta7 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' and animal!='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta7->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']); //Estado de la solicitud
                        $fecha = date("Y-m-d H:i:s"); //Fecha actual
                        if ($solicitud != "aceptada") { //Si no está aceptada la petición
                            if ($row['foto'] == null) { //si no tiene foto
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                                'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario) //El usuario que está buscando
                            ];
                            $i++;
                        }
                    }
                }
            }
        }
        unset($conexion);

        if ($i == 0) { //Si no se encuentra ningún usuario
            return false;
        }
        return $datos;
    }

    //Sancionamos usuarios
    function getDatosBuscarSancion($cadena, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $provincia = Usuario::getProvinciaNumUsuario(Usuario::getIdUsuario($usuario)); //Mi provincia
        $municipio = Usuario::getMunicipioNumUsuario(Usuario::getIdUsuario($usuario)); //Mi municipio
        //Mostramos los usuarios 
        $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' order by nick asc");
        $limite = 5;
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($i < $limite) {
                $fecha = date("Y-m-d H:i:s"); //Fecha actual
                if ($row['foto'] == null) { //Si no tiene foto
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }

                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                    'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                    'amigos' => $row['amigos'],
                    'baneado' => $row['baneado'],
                    'fechaH' => $fecha,
                    'operador' => $row['operador'],
                    'buscador' => Usuario::getIdUsuario($usuario), //El usuario que busca
                ];
                $i++;
            }
        }
        $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' order by nick asc");
        while ($row = $consulta2->fetch()) {
            if ($i < $limite) {
                $fecha = date("Y-m-d H:i:s"); //Fecha actual
                if ($row['foto'] == null) { //Si no tiene foto
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }

                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                    'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                    'amigos' => $row['amigos'],
                    'baneado' => $row['baneado'],
                    'fechaH' => $fecha,
                    'operador' => $row['operador'],
                    'buscador' => Usuario::getIdUsuario($usuario), //El usuario que busca
                ];
                $i++;
            }
        }
        $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' order by nick asc");
        while ($row = $consulta3->fetch()) {
            if ($i < $limite) {
                $fecha = date("Y-m-d H:i:s"); //Fecha actual
                if ($row['foto'] == null) { //Si no tiene foto
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }

                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']), //Animal usuario
                    'raza' => Raza::buscarConId($row['raza']), //Raza usuario
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']), //Provincia usuario
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']), //Municipio usuario
                    'amigos' => $row['amigos'],
                    'baneado' => $row['baneado'],
                    'fechaH' => $fecha,
                    'operador' => $row['operador'],
                    'buscador' => Usuario::getIdUsuario($usuario), //El usuario que busca
                ];
                $i++;
            }
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }
        return $datos; //Devolvemos usuarios
    }

    //Aceptamos la solicitud de amistad dado dos usuarios
    function aceptarSolicitud($user1, $user2) {

        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where id='$user1'"); 
        $amigos = null;
        while ($row = $consulta->fetch()) {
            $amigos = $row['amigos'];
            if ($amigos != null) { //Actualizamos sus amigos
                $sql = "UPDATE usuarios SET amigos='$amigos,$user2' where id='$user1'";
            } else {
                $sql = "UPDATE usuarios SET amigos='$user2' where id='$user1'";
            }
        }
        $conexion->exec($sql);
        unset($conexion);
    }

    //Mostramos amigos dados un id de usuario
    function mostrarAmigos($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT amigos from usuarios where id='$id'");
        $amigos = null;
        while ($row = $consulta->fetch()) {
            $amigos = $row['amigos'];
        }
        unset($conexion);
        return $amigos;
    }

    //Boolean para saber si son usuarios son amigos
    function esAmigo($user1, $user2) {
        $amigos = explode(",", Usuario::mostrarAmigos($user1)); //array de amigos
        $amigo = false;
        if ($user1 == $user2) { //Si es él mismo true
            $amigo = true;
        } else {
            for ($i = 0; $i < count($amigos); $i++) {
                if ($user2 == $amigos[$i]) { //Si está dentro true
                    $amigo = true;
                }
            }
        }
        return $amigo;
    }

    //Cambiamos la imagen de perfil
    function cambiarAvatar($usuario, $imagen) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET foto='$imagen' where id='$usuario'";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Sancionamos un usuario dado el tiempo y su id
    function sancionarUsuario($tiempo, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET baneado='$tiempo' where id='$usuario'";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Función saber si está baneado dado un nick
    function estaBaneado($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT baneado from usuarios where nick='$usuario'");
        $baneado = null;
        while ($row = $consulta->fetch()) {
            $fecha = date("Y-m-d H:i:s");
            if ($fecha < $row['baneado']) { //Si la fecha de baneo se ha superado
                $baneado = $row['baneado'];
            } else {
                $baneado = null;
            }
        }
        unset($conexion);
        return $baneado;
    }

    //Quitamos la sanción dado una id de usuario
    function quitarSancion($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET baneado='' where id='$id'";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Eliminamos la foto de perfil dado un id de usuario
    function eliminarFotoDePerfil($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where id='$id'");
        $foto = null;
        while ($row = $consulta->fetch()) { //Si la encuentra la elimina
            unlink("uploads/usuarios/" . $row['foto']);
            $foto = true;
            $sql = "UPDATE usuarios SET foto='0.jpg' where id='$id'";
            $conexion->exec($sql);
        }
        unset($conexion);
    }

    //Eliminar usuario dado su id
    function eliminarUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Post::eliminarPostsUsuario($id); //Borramos sus posts
        Post::quitarLikesUsuario($id); //Quitamos todos sus likes
        Mensaje::eliminarMensajesUsuario($id); //Eliminamos sus mensajes
        Evento::eliminarEventosUsuario($id); //Eliminamos los eventos de ese usuario
        Amistades::borrarSolicitudes($id); //Borramos las solicitudes que este ha enviado
        Notificacion::borrarNotificacionesUsuario($id); //Borramos todas las notificaciones en las que esté inculcado
        Evento::salirDeEventosUsuario($id); //Salimos de todos los eventos
        Usuario::eliminarAmigosUsuario($id); //Lo eliminamos de sus amigos
        Usuario::eliminarFotoDePerfil($id); //Borramos su imagen de perfil
        $sql = "DELETE FROM usuarios where id='$id'"; //Eliminamos el usuario
        $conexion->exec($sql);
    }

    //
    function getLocalidadUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT provincia,municipio from usuarios where id='$id'");
        $data = null;
        while ($row = $consulta->fetch()) {
            $data = ['provincia' => Provincia::getNombreProvincia($row['provincia']),
                'municipio' => Municipio::getNombreMunicipio($row['municipio'])
            ];
        }
        unset($conexion);
        return $data;
    }

    function getProvinciaUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT provincia from usuarios where id='$id'");
        $provincia = null;
        while ($row = $consulta->fetch()) {
            $provincia = Provincia::getNombreProvincia($row['provincia']);
        }
        unset($conexion);
        return $provincia;
    }

    function getMunicipioUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT municipio from usuarios where id='$id'");
        $municipio = null;
        while ($row = $consulta->fetch()) {
            $municipio = Municipio::getNombreMunicipio($row['municipio']);
        }
        unset($conexion);
        return $municipio;
    }

    function getProvinciaNumUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT provincia from usuarios where id='$id'");
        $provincia = null;
        while ($row = $consulta->fetch()) {
            $provincia = $row['provincia'];
        }
        unset($conexion);
        return $provincia;
    }

    function getMunicipioNumUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT municipio from usuarios where id='$id'");
        $municipio = null;
        while ($row = $consulta->fetch()) {
            $municipio = $row['municipio'];
        }
        unset($conexion);
        return $municipio;
    }

}
