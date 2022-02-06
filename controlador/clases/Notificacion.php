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
    private $idelemento;
    private $visto;
    private $fecha;

    //Constructor de notificación
    function __construct($user1, $user2, $tipo, $idelemento, $fecha) {
        $this->user1 = $user1;
        $this->user2 = $user2;
        $this->tipo = $tipo;
        $this->idelemento = $idelemento;
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

    //Creamos una notificación dada un objeto
    static function crearNotificacion($notificacion) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO notificaciones (user1,user2,tipo,idelemento,visto,fecha) VALUES ('$notificacion->user1','$notificacion->user2','$notificacion->tipo','$notificacion->idelemento','$notificacion->visto','$notificacion->fecha')";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Borramos una notificación dada un objeto notificación
    static function borrarNotificacion($notificacion) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM notificaciones where (user1='$notificacion->user1' and user2='$notificacion->user2') or (user1='$notificacion->user2' and user2='$notificacion->user1') and tipo='$notificacion->tipo' and fecha='$notificacion->fecha'";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Borramos una notificación dado un idelemento
    static function borrarNotificacionIdElemento($idelemento){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM notificaciones where idelemento='$idelemento'";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Vemos todas las notificaciones de un usuario
    static function verNotificaciones($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Ordenado por fecha de notificación
        $consulta = $conexion->query("SELECT * from notificaciones where user2='$usuario' order by fecha desc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            
            $identificacionElemento = null;
            if($row['tipo']=="comentarioP"){ //Si es de tiempo Comentario Post
                $idusuario=Usuario::getIdUsuario($_SESSION['username']);
                $idcomentario = Comentario::buscarIdComentario($row['idelemento'],$row['user1'],$row['fecha']);
                $identificacionElemento[0] = Post::mostrarPost($row['idelemento'],$idusuario); //Le pasamos como parámentos el id usuario
                $identificacionElemento[1] = Comentario::mostrarComentariosConId($idcomentario); //Y el comentario
            } else if($row['tipo'] == "amistad"){ //Si es de tipo amistad
                $identificacionElemento = Amistades::getMensajeSolicitud($row['user1'],$row['user2']); //Le pasamos como parámetro el mensaje de solicitud
            }
            
            $datos[$i] = ['id' => $row['id'],
                'user1' => $row['user1'],
                'user2' => $row['user2'],
                'tipo' => $row['tipo'],
                'elemento'=> $identificacionElemento, //Si es un comentario de post 
                'visto' => $row['visto'],
                'fecha' => $row['fecha'],
                'fotoAmigo' => Usuario::getFotoPerfilconId($row['user1']), //Foto de nuestro amigo
                'nickAmigo' => Usuario::getNickName($row['user1']), //Nombre de amigo
                'amigosAmigo' => Usuario::getAmigosId($row['user1']) //Amigos del usuario 
            ];
            $i++;
        }
        unset($conexion);

        if ($i == 0) {
            return false;
        }

        return $datos;
    }
    
    //Si las hemos visto convertimos visto a 1
    static function notificacionesVistas($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE notificaciones SET visto=1 where user2='$id'";
        $conexion->exec($sql);
        unset($conexion);
    }
    
    //Borramos las notificaciones de un usuario
    static function borrarNotificacionesUsuario($usuario){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM notificaciones WHERE user1=$usuario or user2=$usuario";
        $conexion->exec($sql);
        unset($conexion);
    }

}
