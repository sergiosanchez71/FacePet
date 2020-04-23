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
    
    function enviarMensaje($mensaje){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO mensajes (user1,user2,mensaje,fecha) VALUES ('$mensaje->user1','$mensaje->user2','$mensaje->mensaje','$mensaje->fecha')";
        $conexion->exec($sql);
    }

    function mostrarChat($user1,$user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from mensajes where (user1=$user1 and user2=$user2) or (user1=$user2 and user2=$user1) order by fecha asc");
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
    
    function mensajesNoVistos($usuario){
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
    
    function mensajesUsuarioNoVistos($user1,$user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        unset($conexion);
        return $datos;
    }
    
    function mensajesLeidos($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE mensajes SET visto=1 where user1=$user1 and user2=$user2";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    


    
    
}
