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
    private $fechai;
    private $fechaf;
    private $foto;
    private $lat;
    private $lng;
    private $participantes;
    private $usuario;

    function __construct($titulo, $contenido, $tipo, $fecha_publicacion, $fechai, $fechaf, $foto, $lat, $lng, $participantes, $usuario) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
        $this->foto = $foto;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->participantes = $participantes;
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

    function getFechai() {
        return $this->fechai;
    }

    function getFechaf() {
        return $this->fechaf;
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

    function setFechai($fechai) {
        $this->fechai = $fechai;
    }

    function setFechaf($fechaf) {
        $this->fechaf = $fechaf;
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
        $sql = "INSERT INTO eventos (titulo,contenido,tipo,fecha_publicacion,fechai,fechaf,foto,lat,lng,participantes,usuario) VALUES ('$evento->titulo','$evento->contenido','$evento->tipo','$evento->fecha_publicacion','$evento->fechai','$evento->fechaf','$evento->foto','$evento->lat','$evento->lng','$evento->participantes','$evento->usuario')";
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

    function mostrarEventos($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' order by fechaf asc");
        $datos = null;
        $i = 0;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = false;
            } else {
                $foto = $row['foto'];
            }

            if ($row['lat'] == 0 && $row['lng'] == 0) {
                $lat = false;
                $lng = false;
            } else {
                $lat = $row['lat'];
                $lng = $row['lng'];
            }

            $participantes = explode(",", $row['participantes']);

            $datos[$i] = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'tipo' => $row['tipo'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'fechai' => $row['fechai'],
                'fechaf' => $row['fechaf'],
                'empezado' => Evento::empezado($row['fechai'], $fecha),
                'foto' => $foto,
                'lat' => $lat,
                'lng' => $lng,
                'participable' => $row['participantes'],
                'participantes' => $participantes,
                'usuario' => $row['usuario'],
                'autor' => Usuario::getNickName($row['usuario'])
            );
            $i++;
        }
        unset($conexion);
        return $datos;
    }

    function mostrarEvento($evento, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $consulta = $conexion->query("SELECT * from eventos where id='$evento'");
        $datos = null;
        //$i=0;
        while ($row = $consulta->fetch()) {
            if ($row['foto'] == null) {
                $foto = false;
            } else {
                $foto = $row['foto'];
            }

            if ($row['lat'] == 0 && $row['lng'] == 0) {
                $lat = false;
                $lng = false;
            } else {
                $lat = $row['lat'];
                $lng = $row['lng'];
            }

            $participantes = explode(",", $row['participantes']);

            $datos/* [$i] */ = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'tipo' => $row['tipo'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'fechai' => $row['fechai'],
                'fechaf' => $row['fechaf'],
                'empezado' => Evento::empezado($row['fechai'], $fecha),
                'foto' => $foto,
                'lat' => $lat,
                'lng' => $lng,
                'participable' => $row['participantes'],
                'participantes' => $participantes,
                'participa' => Evento::esParticipante($evento,$usuario),
                'usuario' => $row['usuario'],
                'autor' => Usuario::getNickName($row['usuario'])
            );
            //$i++;
        }
        unset($conexion);
        return $datos;
    }

    function empezado($inicio, $actual) {
        if ($actual > $inicio) {
            return true;
        } else {
            return false;
        }
    }

    function mostrarParticipantes($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT participantes from eventos where id='$id'");
        $participantes = null;
        while ($row = $consulta->fetch()) {
            $participantes = $row['participantes'];
        }
        unset($conexion);
        return $participantes;
    }

    function esParticipante($id, $usuario) {
        $participantes = explode(",", Evento::mostrarParticipantes($id));


        $participante = false;
        /* if ($user1 == $user2) {
          $participante = true;
          } else { */
        for ($i = 0; $i < count($participantes); $i++) {
            if ($usuario == $participantes[$i]) {
                $participante = true;
            }
        }
        //}
        return $participante;
    }

    function participarEvento($id, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!Evento::esParticipante($id, $usuario)) {
            $consulta = $conexion->query("SELECT * from eventos where id='$id'");
            $participantes = null;
            while ($row = $consulta->fetch()) {
                $participantes = $row['participantes'];
                if ($participantes == "t") {
                    $sql = "UPDATE eventos SET participantes='$usuario' where id='$id'";
                } else if ($participantes != null) {
                    $sql = "UPDATE eventos SET participantes='$participantes,$usuario' where id='$id'";
                }
            }
            if ($participantes == "t" || $participantes != null) {
                $conexion->exec($sql);
            }
        }

        unset($conexion);
    }
    
    function salirDeEvento($id, $participante) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT participantes from eventos where id='$id'");
        while ($row = $consulta->fetch()) {
            $participantescad = $row['participantes'];
        }
        $participantes = explode(",", $participantescad);
        for ($i = 0; $i < count($participantes); $i++) {
            if ($participantes[$i] == $participante) {
                unset($participantes[$i]);
            }
        }
        $participantesNewCad = implode(",", $participantes);
        $sql = "UPDATE eventos SET participantes='$participantesNewCad' where id='$id'";
        $conexion->exec($sql);
        unset($conexion);
    }

}
