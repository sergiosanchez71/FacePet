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

    function crearUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (nick,password,email,animal,raza,sexo,foto,provincia,municipio,amigos,operador) VALUES (lower('$usuario->nick'),'$usuario->password','$usuario->email','$usuario->animal','$usuario->raza','$usuario->sexo','$usuario->foto','$usuario->provincia','$usuario->municipio',' ',0)";
        $conexion->exec($sql);
        unset($conexion);
    }

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

    function getFotoPerfilconId($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where id='$id'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
        }
        unset($conexion);
        return $foto;
    }

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

    function getFotoPerfil($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
        }
        unset($conexion);
        return $foto;
    }

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

    function eliminarAmigo($idusuario, $amigo) {
        $fecha = date("Y-m-d H:i:s");
        $notificacion = new Notificacion($idusuario, $amigo, "amistad", 0, $fecha);
        Notificacion::borrarNotificacion($notificacion);
        Amistades::cancelarSolicitud($idusuario, $amigo);
        Mensaje::eliminarMensajes($idusuario, $amigo);
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT amigos from usuarios where id='$idusuario'");
        while ($row = $consulta->fetch()) {
            $amigoscad = $row['amigos'];
        }
        $amigos = explode(",", $amigoscad);
        for ($i = 0; $i < count($amigos); $i++) {
            if ($amigos[$i] == $amigo) {
                unset($amigos[$i]);
            }
        }
        $amigosNewCad = implode(",", $amigos);
        $sql = "UPDATE usuarios SET amigos='$amigosNewCad' where id='$idusuario'";
        $conexion->exec($sql);
        unset($conexion);
    }

    function eliminarAmigosUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id,amigos from usuarios");
        while ($row = $consulta->fetch()) {
            $amigoscad = $row['amigos'];
            $id = $row['id'];
            $amigos = explode(",", $amigoscad);
            for ($i = 0; $i < count($amigos); $i++) {
                if ($amigos[$i] == $usuario) {
                    unset($amigos[$i]);
                }
            }
            $amigosNewCad = implode(",", $amigos);
            $sql = "UPDATE usuarios SET amigos='$amigosNewCad' where id='$id'";
            $conexion->exec($sql);
        }

        unset($conexion);
    }

    function getDatos($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where id='$usuario'");
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
            $datos = ['id' => $row['id'],
                'nick' => $row['nick'],
                'password' => $row['password'],
                'email' => $row['email'],
                'animal' => Animal::buscarConId($row['animal']),
                'raza' => Raza::buscarConId($row['raza']),
                'sexo' => $row['sexo'],
                'foto' => $foto,
                'provincia' => Provincia::getNombreProvincia($row['provincia']),
                'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                'amigos' => $row['amigos'],
                'baneado' => $row['baneado'],
                'operador' => $row['operador']
            ];
        }
        unset($conexion);
        return $datos;
    }

    function getDatosAmigos($amigos) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $datos = null;
        for ($i = 0; $i < count($amigos); $i++) {
            $consulta = $conexion->query("SELECT * from usuarios where id='$amigos[$i]'");
            while ($row = $consulta->fetch()) {
                if ($row['foto'] == null) {
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }
                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']),
                    'raza' => Raza::buscarConId($row['raza']),
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']),
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']),
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

    function getDatosAmigosyMensajes($amigos, $cadena) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $datos = null;
        for ($i = 0; $i < count($amigos); $i++) {
            $consulta = $conexion->query("SELECT * from usuarios where id='$amigos[$i]' and nick like '$cadena%'");
            while ($row = $consulta->fetch()) {
                /* if (isset($datos)) {
                  if (count($datos) > 2) {
                  if ($datos[0] == $datos[1]) {
                  unset($conexion);
                  return $datos;
                  }
                  }
                  } */
                if ($row['foto'] == null) {
                    $foto = "0.jpg";
                } else {
                    $foto = $row['foto'];
                }
                $mensajes = 0;
                if (Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username']))) {
                     $mensajes = count(Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username'])));
                    if ($mensajes < 9) {
                        $mensajes = count(Mensaje::mensajesUsuarioNoVistos($row['id'], Usuario::getIdUsuario($_SESSION['username'])));
                    } else {
                        $mensajes = 9;
                    }
                }
                $datos[$i] = ['id' => $row['id'],
                    'nick' => $row['nick'],
                    'password' => $row['password'],
                    'email' => $row['email'],
                    'animal' => Animal::buscarConId($row['animal']),
                    'raza' => Raza::buscarConId($row['raza']),
                    'sexo' => $row['sexo'],
                    'foto' => $foto,
                    'provincia' => Provincia::getNombreProvincia($row['provincia']),
                    'municipio' => Municipio::getNombreMunicipio($row['municipio']),
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

    function mostrarTodosNombresUsuarios($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where nick!='$usuario' order by nick asc");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
            if ($solicitud != "aceptada") {
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

    function getDatosBuscar2($cadena, $usuario, $checkCiudad, $checkAnimal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $provincia = Usuario::getProvinciaNumUsuario(Usuario::getIdUsuario($usuario));
        $municipio = Usuario::getMunicipioNumUsuario(Usuario::getIdUsuario($usuario));
        $animal = Usuario::getAnimalUsuarioId(Usuario::getIdUsuario($usuario));
        $raza = Usuario::getRazaUsuarioId(Usuario::getIdUsuario($usuario));
        if ($checkCiudad == "true" && $checkAnimal == "true") {
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' and animal='$animal' and raza='$raza' order by nick asc");
        } else if ($checkAnimal == "true") {
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal='$animal' and raza='$raza' order by nick asc");
        } else if ($checkCiudad == "true") {
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' order by nick asc");
        } else {
            $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' order by nick asc");
        }
        //$consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' order by nick asc");
        $limite = 5;
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($i < $limite) {
                $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                $fecha = date("Y-m-d H:i:s");
                if ($solicitud != "aceptada") {
                    if ($row['foto'] == null) {
                        $foto = "0.jpg";
                    } else {
                        $foto = $row['foto'];
                    }

                    $datos[$i] = ['id' => $row['id'],
                        'nick' => $row['nick'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'animal' => Animal::buscarConId($row['animal']),
                        'raza' => Raza::buscarConId($row['raza']),
                        'sexo' => $row['sexo'],
                        'foto' => $foto,
                        'provincia' => Provincia::getNombreProvincia($row['provincia']),
                        'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                        'amigos' => $row['amigos'],
                        'baneado' => $row['baneado'],
                        'fechaH' => $fecha,
                        'operador' => $row['operador'],
                        'solicitud' => $solicitud,
                        'buscador' => Usuario::getIdUsuario($usuario),
                        'a' => $animal
                    ];
                    $i++;
                }
            }
        }
        if ($checkAnimal == "true" || $checkCiudad == "true") {
            if ($checkCiudad == "true" && $checkAnimal == "true") {
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkAnimal == "true") {
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkCiudad == "true") {
                $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' order by nick asc");
            } /* else {
              $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' order by nick asc");
              } */
            //$consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' order by nick asc");
            while ($row = $consulta2->fetch()) {
                if ($i < $limite) {

                    $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                    $fecha = date("Y-m-d H:i:s");
                    if ($solicitud != "aceptada") {
                        if ($row['foto'] == null) {
                            $foto = "0.jpg";
                        } else {
                            $foto = $row['foto'];
                        }

                        $datos[$i] = ['id' => $row['id'],
                            'nick' => $row['nick'],
                            'password' => $row['password'],
                            'email' => $row['email'],
                            'animal' => Animal::buscarConId($row['animal']),
                            'raza' => Raza::buscarConId($row['raza']),
                            'sexo' => $row['sexo'],
                            'foto' => $foto,
                            'provincia' => Provincia::getNombreProvincia($row['provincia']),
                            'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                            'amigos' => $row['amigos'],
                            'baneado' => $row['baneado'],
                            'fechaH' => $fecha,
                            'operador' => $row['operador'],
                            'solicitud' => $solicitud,
                            'buscador' => Usuario::getIdUsuario($usuario),
                        ];
                        $i++;
                    }
                }
            }
            if ($checkCiudad == "true" && $checkAnimal == "true") {
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal='$animal' and raza='$raza' order by nick asc");
            } else if ($checkAnimal == "true") {
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and animal!='$animal' and raza!='$raza' order by nick asc");
            } else if ($checkCiudad == "true") {
                $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' order by nick asc");
            } while ($row = $consulta3->fetch()) {
                if ($i < $limite) {
                    $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                    $fecha = date("Y-m-d H:i:s");
                    if ($solicitud != "aceptada") {
                        if ($row['foto'] == null) {
                            $foto = "0.jpg";
                        } else {
                            $foto = $row['foto'];
                        }

                        $datos[$i] = ['id' => $row['id'],
                            'nick' => $row['nick'],
                            'password' => $row['password'],
                            'email' => $row['email'],
                            'animal' => Animal::buscarConId($row['animal']),
                            'raza' => Raza::buscarConId($row['raza']),
                            'sexo' => $row['sexo'],
                            'foto' => $foto,
                            'provincia' => Provincia::getNombreProvincia($row['provincia']),
                            'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                            'amigos' => $row['amigos'],
                            'baneado' => $row['baneado'],
                            'fechaH' => $fecha,
                            'operador' => $row['operador'],
                            'solicitud' => $solicitud,
                            'buscador' => Usuario::getIdUsuario($usuario),
                        ];
                        $i++;
                    }
                }
            }
            if ($checkCiudad == "true" && $checkAnimal == "true") {
                $consulta4 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta4->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                        $fecha = date("Y-m-d H:i:s");
                        if ($solicitud != "aceptada") {
                            if ($row['foto'] == null) {
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']),
                                'raza' => Raza::buscarConId($row['raza']),
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']),
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario),
                            ];
                            $i++;
                        }
                    }
                }
                $consulta5 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' and animal='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta5->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                        $fecha = date("Y-m-d H:i:s");
                        if ($solicitud != "aceptada") {
                            if ($row['foto'] == null) {
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']),
                                'raza' => Raza::buscarConId($row['raza']),
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']),
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario),
                            ];
                            $i++;
                        }
                    }
                }
                $consulta6 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' and animal!='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta6->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                        $fecha = date("Y-m-d H:i:s");
                        if ($solicitud != "aceptada") {
                            if ($row['foto'] == null) {
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']),
                                'raza' => Raza::buscarConId($row['raza']),
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']),
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario),
                            ];
                            $i++;
                        }
                    }
                }
                $consulta7 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' and animal!='$animal' and raza!='$raza' order by nick asc");
                while ($row = $consulta7->fetch()) {
                    if ($i < $limite) {
                        $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                        $fecha = date("Y-m-d H:i:s");
                        if ($solicitud != "aceptada") {
                            if ($row['foto'] == null) {
                                $foto = "0.jpg";
                            } else {
                                $foto = $row['foto'];
                            }

                            $datos[$i] = ['id' => $row['id'],
                                'nick' => $row['nick'],
                                'password' => $row['password'],
                                'email' => $row['email'],
                                'animal' => Animal::buscarConId($row['animal']),
                                'raza' => Raza::buscarConId($row['raza']),
                                'sexo' => $row['sexo'],
                                'foto' => $foto,
                                'provincia' => Provincia::getNombreProvincia($row['provincia']),
                                'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                                'amigos' => $row['amigos'],
                                'baneado' => $row['baneado'],
                                'fechaH' => $fecha,
                                'operador' => $row['operador'],
                                'solicitud' => $solicitud,
                                'buscador' => Usuario::getIdUsuario($usuario),
                            ];
                            $i++;
                        }
                    }
                }
            }
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }
        return $datos;
    }

    function getDatosBuscar($cadena, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $provincia = Usuario::getProvinciaNumUsuario(Usuario::getIdUsuario($usuario));
        $municipio = Usuario::getMunicipioNumUsuario(Usuario::getIdUsuario($usuario));
        $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio='$municipio' order by nick asc");
        $limite = 5;
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($i < $limite) {
                $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                $fecha = date("Y-m-d H:i:s");
                if ($solicitud != "aceptada") {
                    if ($row['foto'] == null) {
                        $foto = "0.jpg";
                    } else {
                        $foto = $row['foto'];
                    }

                    $datos[$i] = ['id' => $row['id'],
                        'nick' => $row['nick'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'animal' => Animal::buscarConId($row['animal']),
                        'raza' => Raza::buscarConId($row['raza']),
                        'sexo' => $row['sexo'],
                        'foto' => $foto,
                        'provincia' => Provincia::getNombreProvincia($row['provincia']),
                        'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                        'amigos' => $row['amigos'],
                        'baneado' => $row['baneado'],
                        'fechaH' => $fecha,
                        'operador' => $row['operador'],
                        'solicitud' => $solicitud,
                        'buscador' => Usuario::getIdUsuario($usuario),
                    ];
                    $i++;
                }
            }
        }
        $consulta2 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia='$provincia' and municipio!='$municipio' order by nick asc");
        while ($row = $consulta2->fetch()) {
            if ($i < $limite) {

                $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                $fecha = date("Y-m-d H:i:s");
                if ($solicitud != "aceptada") {
                    if ($row['foto'] == null) {
                        $foto = "0.jpg";
                    } else {
                        $foto = $row['foto'];
                    }

                    $datos[$i] = ['id' => $row['id'],
                        'nick' => $row['nick'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'animal' => Animal::buscarConId($row['animal']),
                        'raza' => Raza::buscarConId($row['raza']),
                        'sexo' => $row['sexo'],
                        'foto' => $foto,
                        'provincia' => Provincia::getNombreProvincia($row['provincia']),
                        'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                        'amigos' => $row['amigos'],
                        'baneado' => $row['baneado'],
                        'fechaH' => $fecha,
                        'operador' => $row['operador'],
                        'solicitud' => $solicitud,
                        'buscador' => Usuario::getIdUsuario($usuario),
                    ];
                    $i++;
                }
            }
        }
        $consulta3 = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario' and provincia!='$provincia' and municipio!='$municipio' order by nick asc");
        while ($row = $consulta3->fetch()) {
            if ($i < $limite) {
                $solicitud = Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario), $row['id']);
                $fecha = date("Y-m-d H:i:s");
                if ($solicitud != "aceptada") {
                    if ($row['foto'] == null) {
                        $foto = "0.jpg";
                    } else {
                        $foto = $row['foto'];
                    }

                    $datos[$i] = ['id' => $row['id'],
                        'nick' => $row['nick'],
                        'password' => $row['password'],
                        'email' => $row['email'],
                        'animal' => Animal::buscarConId($row['animal']),
                        'raza' => Raza::buscarConId($row['raza']),
                        'sexo' => $row['sexo'],
                        'foto' => $foto,
                        'provincia' => Provincia::getNombreProvincia($row['provincia']),
                        'municipio' => Municipio::getNombreMunicipio($row['municipio']),
                        'amigos' => $row['amigos'],
                        'baneado' => $row['baneado'],
                        'fechaH' => $fecha,
                        'operador' => $row['operador'],
                        'solicitud' => $solicitud,
                        'buscador' => Usuario::getIdUsuario($usuario),
                    ];
                    $i++;
                }
            }
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }
        return $datos;
    }

    function aceptarSolicitud($user1, $user2) {

        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where id='$user1'");
        $amigos = null;
        while ($row = $consulta->fetch()) {
            $amigos = $row['amigos'];
            if ($amigos != null) {
                $sql = "UPDATE usuarios SET amigos='$amigos,$user2' where id='$user1'";
            } else {
                $sql = "UPDATE usuarios SET amigos='$user2' where id='$user1'";
            }
        }
        $conexion->exec($sql);
        unset($conexion);
    }

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

    function esAmigo($user1, $user2) {
        $amigos = explode(",", Usuario::mostrarAmigos($user1));


        $amigo = false;
        if ($user1 == $user2) {
            $amigo = true;
        } else {
            for ($i = 0; $i < count($amigos); $i++) {
                if ($user2 == $amigos[$i]) {
                    $amigo = true;
                }
            }
        }
        return $amigo;
    }

    function cambiarAvatar($usuario, $imagen) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET foto='$imagen' where id='$usuario'";
        $conexion->exec($sql);
        unset($conexion);
    }

    function sancionarUsuario($tiempo, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET baneado='$tiempo' where id='$usuario'";
        $conexion->exec($sql);
        unset($conexion);
    }

    function estaBaneado($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT baneado from usuarios where nick='$usuario'");
        $baneado = null;
        while ($row = $consulta->fetch()) {
            $fecha = date("Y-m-d H:i:s");
            if ($fecha < $row['baneado']) {
                $baneado = $row['baneado'];
            } else {
                $baneado = null;
            }
        }
        unset($conexion);
        return $baneado;
    }

    function quitarSancion($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE usuarios SET baneado='' where id='$id'";
        $conexion->exec($sql);
        unset($conexion);
    }

    function eliminarFotoDePerfil($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from usuarios where id='$id'");
        $foto = null;
        while ($row = $consulta->fetch()) {
            unlink("uploads/usuarios/" . $row['foto']);
            $foto = true;
            $sql = "UPDATE usuarios SET foto='0.jpg' where id='$id'";
            $conexion->exec($sql);
        }
        unset($conexion);
    }

    function eliminarUsuario($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Post::eliminarPostsUsuario($id);
        Post::quitarLikesUsuario($id);
        Mensaje::eliminarMensajesUsuario($id);
        Evento::eliminarEventosUsuario($id);
        Amistades::borrarSolicitudes($id);
        Notificacion::borrarNotificacionesUsuario($id);
        Evento::salirDeEventosUsuario($id);
        Usuario::eliminarAmigosUsuario($id);
        Usuario::eliminarFotoDePerfil($id);
        $sql = "DELETE FROM usuarios where id='$id'";
        $conexion->exec($sql);
    }

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
