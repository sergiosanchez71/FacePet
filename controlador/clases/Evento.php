<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Evento
 *
 * @author sergiosanchez
 */
class Evento {
    private $id;
    private $titulo;
    private $contenido;
    private $tipo;
    private $fecha_publicacion;
    private $fecha;
    private $foto;
    private $lat;
    private $lng;
    private $participantes;
    private $usuario;
    
    function __construct($titulo, $contenido, $tipo, $fecha_publicacion, $fecha, $foto, $lat, $lng, $usuario) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->fecha = $fecha;
        $this->foto = $foto;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->participantes = null;
        $this->usuario = $usuario;
    }
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getTipo() {
        return $this->tipo;
    }
    
    function getFecha_publicacion() {
        return $this->fecha_publicacion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getFoto() {
        return $this->foto;
    }

    function getLat() {
        return $this->lat;
    }

    function getLng() {
        return $this->lng;
    }

    function getParticipantes() {
        return $this->participantes;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    
    function setFecha_publicacion($fecha_publicacion) {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setLat($lat) {
        $this->lat = $lat;
    }

    function setLng($lng) {
        $this->lng = $lng;
    }

    function setParticipantes($participantes) {
        $this->participantes = $participantes;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function crearEvento($evento) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO eventos (titulo,contenido,tipo,fecha_publicacion,fecha,foto,lat,lng,usuario) VALUES ('$evento->titulo','$evento->contenido','$evento->tipo','$evento->fecha_publicacion','$evento->fecha','$evento->foto','$evento->lat','$evento->lng','$evento->usuario')";
        $conexion->exec($sql);
    }
    
    function consultarId($evento) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from eventos where fecha_publicacion='$evento->fecha_publicacion' and usuario='$evento->usuario'");
        $id = null;
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }
    
    function subirMultimedia($id, $multimedia) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE eventos SET foto='$multimedia' where id='$id'";
        $conexion->exec($sql);
    }
    
    function mostrarEventos() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $consulta = $conexion->query("SELECT * from eventos where fecha>'$fecha' order by fecha asc");
        $datos = null;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = false;
            } else {
                $foto = $row['foto'];
            }
            
            if($row['lat'] == 0 && $row['lng'] == 0){
                $lat = false;
                $lng = false;
            } else {
                $lat = $row['lat'];
                $lng = $row['lng'];
            }
            
            $datos = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'tipo' => $row['tipo'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'fecha' => $row['fecha'],
                'foto' => $foto,
                'lat' => $lat,
                'lng' => $lng,
                'participantes' => $row['participantes'],
                'usuario' => $row['usuario']
            );
        }
        unset($conexion);
        return $datos;
    }

    
}
