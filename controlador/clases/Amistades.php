<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Solicitud
 *
 * @author sergiosanchez
 */
class Amistades {

    private $id;
    private $user1;
    private $user2;
    private $estado;
    private $mensaje;

    //Constructor dado el usuario emisor, el receptor, el estado de la petición y el mensaje si este lo tiene
    function __construct($user1, $user2, $estado,$mensaje) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->estado = $estado;
        $this->mensaje = $mensaje;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getUser1() {
        return $this->user1;
    }

    function getUser2() {
        return $this->user2;
    }

    function getEstado() {
        return $this->estado;
    }
    
    function getMensaje() {
        return $this->mensaje;
    }

    function setUser1($user1) {
        $this->user1 = $user1;
    }

    function setUser2($user2) {
        $this->user2 = $user2;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    //Comprobamos el estado de la solicitud dado el usuario emisor y receptor
    function comprobarSolicitud($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT estado from amistades where (user1=$user1 and user2=$user2) or (user1=$user2 and user2=$user1)");
        $estado = false;
        while ($row = $consulta->fetch()) {
            $estado = $row['estado'];
        }
        unset($conexion);
        return $estado;
    }
    
    //Cancelamos solicitud dado el usuario emisor y receptor
    function cancelarSolicitud($user1,$user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (Amistades::comprobarSolicitud($user1, $user2)) { //Comrpobamos que le han enviado la petición
            $sql = "DELETE FROM amistades where (user1='$user1' and user2='$user2') or (user1='$user2' and user2='$user1')";
            $conexion->exec($sql);
        }
        unset($conexion);
    }

    //Mandamos una solicitud dado el usuario emisor, receotir y el mensaje
    function mandarSolicitud($user1, $user2, $mensaje) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!Amistades::comprobarSolicitud($user1, $user2)) { //Si no son amigos se la envía
            $sql = "INSERT INTO amistades (user1,user2,estado,mensaje) VALUES ('$user1','$user2','pendiente','$mensaje')";
            $conexion->exec($sql);
        }
        unset($conexion);
    }
    
    //Aceptamos la solicitud
    function aceptarSolicitud($user1, $user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE amistades SET estado='aceptada' where user1='$user1' and user2='$user2'";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Borramos solicitudes dado un usuario
    function borrarSolicitudes($usuario){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM amistades WHERE user1=$usuario or user2=$usuario";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Accedemos al mensaje de solicitud de amistad
    function getMensajeSolicitud($user1, $user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT mensaje from amistades where (user1=$user1 and user2=$user2) or (user1=$user2 and user2=$user1)");
        $estado = false;
        while ($row = $consulta->fetch()) {
            $estado = $row['mensaje'];
        }
        unset($conexion);
        return $estado;
    }

}
