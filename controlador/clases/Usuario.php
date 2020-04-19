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
    private $localidad;
    private $amigos;
    private $baneado;
    private $operador;

    function __construct($nick, $password, $email, $animal, $raza, $sexo, $foto, $localidad) {
        $this->nick = $nick;
        $this->password = $password;
        $this->email = $email;
        $this->animal = $animal;
        $this->raza = $raza;
        $this->sexo = $sexo;
        $this->foto = $foto;
        $this->localidad = $localidad;
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

    function getLocalidad() {
        return $this->localidad;
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

    function setLocalidad($localidad) {
        $this->localidad = $localidad;
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
        $sql = "INSERT INTO usuarios (nick,password,email,animal,raza,sexo,foto,localidad,amigos,operador) VALUES ('$usuario->nick','$usuario->password','$usuario->email','$usuario->animal','$usuario->raza','$usuario->sexo','$usuario->foto','$usuario->localidad',' ',0)";
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
        $consulta = $conexion->query("SELECT operador from usuarios where nick='$usuario'");
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
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
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

    function getLocalidadUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT raza from usuarios where nick='$usuario'");
        while ($row = $consulta->fetch()) {
            $raza = $row['raza'];
        }
        unset($conexion);
        return $raza;
    }

    function getDatos($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where nick='$usuario'");
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
                'localidad' => $row['localidad'],
                'amigos' => $row['amigos'],
                'baneado' => $row['baneado'],
                'operador' => $row['operador']
            ];
        }
        unset($conexion);
        return $datos;
    }

    function getDatosBuscar($cadena, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from usuarios where nick like '$cadena%' and nick!='$usuario'");
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = "0.jpg";
            } else {
                $foto = $row['foto'];
            }
                        
            if(Amistades::comprobarSolicitud(Usuario::getIdUsuario($usuario),$row['id'])){
                $solicitud = true;
            } else {
                $solicitud = false;
            }
            
            $datos[$i] = ['id' => $row['id'],
                'nick' => $row['nick'],
                'password' => $row['password'],
                'email' => $row['email'],
                'animal' => Animal::buscarConId($row['animal']),
                'raza' => Raza::buscarConId($row['raza']),
                'sexo' => $row['sexo'],
                'foto' => $foto,
                'localidad' => $row['localidad'],
                'amigos' => $row['amigos'],
                'baneado' => $row['baneado'],
                'operador' => $row['operador'],
                'solicitud' => $solicitud
            ];
            $i++;
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }
        return $datos;
    }

}
