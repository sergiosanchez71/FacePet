<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chat
 *
 * @author sergiosanchez
 */
class Mensaje {

    private $id;
    private $user1;
    private $user2;
    private $mensaje;
    private $fecha;

    //Contructor dado el usuario emisor, el usuario receptor, el contenido del mensaje y la fecha
    function __construct($user1, $user2, $mensaje, $fecha) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
    }

    function getId() {
        return $this->id;
    }

    function getUser1() {
        return $this->user1;
    }

    function getUser2() {
        return $this->user2;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUser1($user1) {
        $this->user1 = $user1;
    }

    function setUser2($user2) {
        $this->user2 = $user2;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    //Creamos un mensaje dado un objeto mensaje
    static function enviarMensaje($mensaje) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO mensajes (user1,user2,mensaje,fecha) VALUES ('$mensaje->user1','$mensaje->user2','$mensaje->mensaje','$mensaje->fecha')";
        $conexion->exec($sql);
    }

    //Mostramos el chat dado ambos usuarios
    static function mostrarChat($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($user1 && $user2) { //Si existen ambos
            //Buscamos los mensajes dados ambos usuarios limitado a 15
            $consulta = $conexion->query("SELECT * from mensajes where (user1=$user1 and user2=$user2) or (user1=$user2 and user2=$user1) order by fecha asc limit 15");
            $i = 0;
            $datos = null;
            while ($row = $consulta->fetch()) {
                $datos[$i] = array(
                    'id' => $row['id'],
                    'user1' => $row['user1'],
                    'user2' => $row['user2'],
                    'mensaje' => $row['mensaje'],
                    'visto' => $row['visto'],
                    'fecha' => $row['fecha']
                );
                $i++;
            }
            unset($conexion);
        } else {
            $datos = null;
        }
        return $datos;
    }

    //Mensajes que no hemos visto dado un usuario
    static function mensajesNoVistos($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from mensajes where user2=$usuario and visto=0");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            $datos[$i] = array(
                'id' => $row['id'],
                'user1' => $row['user1'],
                'user2' => $row['user2'],
                'mensaje' => $row['mensaje'],
                'visto' => $row['visto'],
                'fecha' => $row['fecha']
            );
            $i++;
        }
        unset($conexion);
        return $datos;
    }

    //Mensajes que no hemos visto de un usuario en concreto
    static function mensajesUsuarioNoVistos($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($user1 && $user2) {
            $consulta = $conexion->query("SELECT * from mensajes where user1=$user1 and user2=$user2 and visto=0");
            $i = 0;
            $datos = null;
            while ($row = $consulta->fetch()) {
                $datos[$i] = array(
                    'id' => $row['id'],
                    'user1' => $row['user1'],
                    'user2' => $row['user2'],
                    'mensaje' => $row['mensaje'],
                    'visto' => $row['visto'],
                    'fecha' => $row['fecha']
                );
                $i++;
            }
        } else {
            $datos = null;
        }
        unset($conexion);
        return $datos;
    }

    //Mensajes que hemos visto
    static function mensajesLeidos($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE mensajes SET visto=1 where user1=$user1 and user2=$user2";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Eliminamos los mensajes de una conversación
    static function  eliminarMensajes($user1,$user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM mensajes WHERE (user1=$user1 and user2=$user2) or (user2=$user1 && user1=$user2)";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Eliminamos todos los mensajes que ha tenido un usuario (todos sus chats)
    static function eliminarMensajesUsuario($usuario){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM mensajes WHERE user1=$usuario or user2=$usuario";
        $conexion->exec($sql);
        unset($conexion);
    }

}
