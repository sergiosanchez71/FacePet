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

    function __construct($user1, $user2, $estado) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->estado = $estado;
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

    function setUser1($user1) {
        $this->user1 = $user1;
    }

    function setUser2($user2) {
        $this->user2 = $user2;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

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
    
    function cancelarSolicitud($user1,$user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (Amistades::comprobarSolicitud($user1, $user2)) {
            $sql = "DELETE FROM amistades where (user1='$user1' and user2='$user2') or (user1='$user2' and user2='$user1')";
            $conexion->exec($sql);
        }
        unset($conexion);
    }

    function mandarSolicitud($user1, $user2) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!Amistades::comprobarSolicitud($user1, $user2)) {
            $sql = "INSERT INTO amistades (user1,user2,estado) VALUES ('$user1','$user2','pendiente')";
            $conexion->exec($sql);
        }
        unset($conexion);
    }
    
    function aceptarSolicitud($user1, $user2){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE amistades SET estado='aceptada' where user1='$user1' and user2='$user2'";
        $conexion->exec($sql);
        unset($conexion);
    }

}
