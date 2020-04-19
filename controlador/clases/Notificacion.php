<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notificacion
 *
 * @author sergiosanchez
 */
class Notificacion {

    private $id;
    private $user1;
    private $user2;
    private $tipo;
    private $visto;
    private $fecha;

    function __construct($user1, $user2, $tipo, $fecha) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->tipo = $tipo;
        $this->visto = false;
        $this->fecha = $fecha;
    }

    function getUser1() {
        return $this->user1;
    }

    function getUser2() {
        return $this->user2;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getVisto() {
        return $this->visto;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setUser1($user1) {
        $this->user1 = $user1;
    }

    function setUser2($user2) {
        $this->user2 = $user2;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setVisto($visto) {
        $this->visto = $visto;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function crearNotificacion($notificacion) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO notificaciones (user1,user2,tipo,visto,fecha) VALUES ('$notificacion->user1','$notificacion->user2','$notificacion->tipo','$notificacion->visto','$notificacion->fecha')";
        $conexion->exec($sql);
        unset($conexion);
    }

    function borrarNotificacion($notificacion) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM notificaciones where (user1='$notificacion->user1' and user2='$notificacion->user2') or (user1='$notificacion->user2' and user2='$notificacion->user1') and tipo='$notificacion->tipo'";
        $conexion->exec($sql);
        unset($conexion);
    }

    function verNotificaciones($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from notificaciones where user2='$usuario'");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $datos[$i] = ['id' => $row['id'],
                'user1' => $row['user1'],
                'user2' => $row['user2'],
                'tipo' => $row['tipo'],
                'visto' => $row['visto'],
                'fecha' => $row['fecha']
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
