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
    private $direccion;
    private $cp;
    private $ciudad;
    private $provincia;
    private $lat;
    private $lng;
    private $participantes;
    private $usuario;

    //Constructor de evento
    function __construct($titulo, $contenido, $tipo, $fecha_publicacion, $fechai, $fechaf, $foto, $direccion, $cp, $ciudad, $provincia, $lat, $lng, $participantes, $usuario) {
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->tipo = $tipo;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->fechai = $fechai;
        $this->fechaf = $fechaf;
        $this->foto = $foto;
        $this->direccion = $direccion;
        $this->cp = $cp;
        $this->ciudad = $ciudad;
        $this->provincia = $provincia;
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

    function getDireccion() {
        return $this->direccion;
    }

    function getCp() {
        return $this->cp;
    }

    function getCiudad() {
        return $this->ciudad;
    }

    function getProvincia() {
        return $this->provincia;
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

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
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

    //Creamos un evento dado un objeto evento
    static function crearEvento($evento) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO eventos (titulo,contenido,tipo,fecha_publicacion,fechai,fechaf,foto,direccion,cp,ciudad,provincia,lat,lng,participantes,usuario) VALUES ('$evento->titulo','$evento->contenido','$evento->tipo','$evento->fecha_publicacion','$evento->fechai','$evento->fechaf','$evento->foto','$evento->direccion','$evento->cp','$evento->ciudad','$evento->provincia','$evento->lat','$evento->lng','$evento->participantes','$evento->usuario')";
        $conexion->exec($sql);
    }

    //Buscamos la id de un evento
    static function consultarId($evento) {
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

    //Subimos una imagen para nuestro evento
    static function subirMultimedia($id, $multimedia) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE eventos SET foto='$multimedia' where id='$id'";
        $conexion->exec($sql);
    }

    //Mostramos eventos dada una cantidad, ordenados por lugar y fecha
    static function mostrarEventosCantidad($usuario, $limite, $checkLugar, $rdFecha) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s"); //Fecha actual
        $provincia = Usuario::getProvinciaUsuario($usuario); //Provincia de nuestro usuario
        $municipio = Usuario::getMunicipioUsuario($usuario); //Municipio de nuestro usuario
        if ($checkLugar == "true" && $rdFecha == "fechai") { //Ordenado por provincia,ciudad y fecha inicial
            $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad LIKE '%$municipio%' order by fechai asc");
        } else if ($checkLugar == "true" && $rdFecha == "fechaf") { //Ordenado por provincia,ciudad y fecha final
            $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad LIKE '%$municipio%' order by fechaf asc");
        } else if ($checkLugar == "false" && $rdFecha == "fechai") { //Ordenado por fecha inicial
            $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' order by fechai asc");
        } else if ($checkLugar == "false" && $rdFecha == "fechaf") { //Ordenado por fecha final
            $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' order by fechaf asc");
        }
        $datos = null; //Array vacio
        $i = 0; //contador
        while ($row = $consulta->fetch()) {
            if ($i < $limite) { //Si nuestro contador es inferior a la cantidad indicada
                if ($row['foto'] == null) { //Si no hay foto
                    $foto = false;
                } else {
                    $foto = $row['foto'];
                }

                if ($row['lat'] == 0 && $row['lng'] == 0) { //Si no hay mapa
                    $lat = false;
                    $lng = false;
                } else {
                    $lat = $row['lat'];
                    $lng = $row['lng'];
                }

                $participantes = explode(",", $row['participantes']); //Miramos los participantes

                $datos[$i] = array( //Array de datos
                    'id' => $row['id'],
                    'titulo' => $row['titulo'],
                    'contenido' => $row['contenido'],
                    'tipo' => $row['tipo'],
                    'fecha_publicacion' => $row['fecha_publicacion'],
                    'fechai' => $row['fechai'],
                    'fechaf' => $row['fechaf'],
                    'empezado' => Evento::empezado($row['fechai'], $fecha), //Función que dada la fecha de inicio y actual indica si ha empezado
                    'foto' => $foto,
                    'direccion' => $row['direccion'],
                    'cp' => $row['cp'],
                    'ciudad' => $row['ciudad'],
                    'provincia' => $row['provincia'],
                    'lat' => $lat,
                    'lng' => $lng,
                    'participable' => $row['participantes'],
                    'participantes' => $participantes,
                    'usuario' => $row['usuario'],
                    'autor' => Usuario::getNickName($row['usuario']) //Nombre del autor
                );
                $i++;
            }
        }
        
        if ($checkLugar == "true") { //Si el check de ordenar por lugar está activo
            if ($checkLugar == "true" && $rdFecha == "fechai") { //Ordena por provincia fecha inicio
                $consulta2 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechai asc");
            } else if ($checkLugar == "true" && $rdFecha == "fechaf") { //Ordena por provincia y fecha fin
                $consulta2 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechaf asc");
            }
            while ($row = $consulta2->fetch()) {
                if ($i < $limite) { //Si nuestro contador es menor a la cantidad
                    //repetimos proceso
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
                        'direccion' => $row['direccion'],
                        'cp' => $row['cp'],
                        'ciudad' => $row['ciudad'],
                        'provincia' => $row['provincia'],
                        'lat' => $lat,
                        'lng' => $lng,
                        'participable' => $row['participantes'],
                        'participantes' => $participantes,
                        'usuario' => $row['usuario'],
                        'autor' => Usuario::getNickName($row['usuario'])
                    );
                    $i++;
                }
            }
            if ($checkLugar == "true" && $rdFecha == "fechai") { //Ordenados por fecha inicio
                $consulta3 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia NOT LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechai asc");
            } else if ($checkLugar == "true" && $rdFecha == "fechaf") { //Ordenamos por fecha fin
                $consulta3 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia NOT LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechaf asc");
            }
            while ($row = $consulta3->fetch()) {
                //repetimos
                if ($i < $limite) {
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
                        'direccion' => $row['direccion'],
                        'cp' => $row['cp'],
                        'ciudad' => $row['ciudad'],
                        'provincia' => $row['provincia'],
                        'lat' => $lat,
                        'lng' => $lng,
                        'participable' => $row['participantes'],
                        'participantes' => $participantes,
                        'usuario' => $row['usuario'],
                        'autor' => Usuario::getNickName($row['usuario']),
                        'miProvincia' => $provincia
                    );
                    $i++;
                }
            }
        }
        unset($conexion);
        return $datos; //Devolvemos los datos
    }

    //Imprimimos los eventos dado el usuario y el un límite
    static function mostrarEventos($usuario, $limite) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $provincia = Usuario::getProvinciaUsuario($usuario); //mi provincia
        $municipio = Usuario::getMunicipioUsuario($usuario); //mi municipio
        //Los mostramos ordenados por provincia, municipio y fecha fin
        $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad LIKE '%$municipio%' order by fechaf asc");
        $datos = null;
        $i = 0;
        while ($row = $consulta->fetch()) {
            //mostramos eventos
            if ($i < $limite) {
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
                    'direccion' => $row['direccion'],
                    'cp' => $row['cp'],
                    'ciudad' => $row['ciudad'],
                    'provincia' => $row['provincia'],
                    'lat' => $lat,
                    'lng' => $lng,
                    'participable' => $row['participantes'],
                    'participantes' => $participantes,
                    'usuario' => $row['usuario'],
                    'autor' => Usuario::getNickName($row['usuario'])
                );
                $i++;
            }
        }
        //Ordenados por provincia y fecha fin
        $consulta2 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechaf asc");
        while ($row = $consulta2->fetch()) {
            if ($i < $limite) {
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
                    'direccion' => $row['direccion'],
                    'cp' => $row['cp'],
                    'ciudad' => $row['ciudad'],
                    'provincia' => $row['provincia'],
                    'lat' => $lat,
                    'lng' => $lng,
                    'participable' => $row['participantes'],
                    'participantes' => $participantes,
                    'usuario' => $row['usuario'],
                    'autor' => Usuario::getNickName($row['usuario'])
                );
                $i++;
            }
        }
        
        //Ordenados por fecha fin
        $consulta3 = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario!='$usuario' and provincia NOT LIKE '%$provincia%' and ciudad NOT LIKE '%$municipio%' order by fechaf asc");
        while ($row = $consulta3->fetch()) {
            if ($i < $limite) {
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
                    'direccion' => $row['direccion'],
                    'cp' => $row['cp'],
                    'ciudad' => $row['ciudad'],
                    'provincia' => $row['provincia'],
                    'lat' => $lat,
                    'lng' => $lng,
                    'participable' => $row['participantes'],
                    'participantes' => $participantes,
                    'usuario' => $row['usuario'],
                    'autor' => Usuario::getNickName($row['usuario']),
                    'miProvincia' => $provincia
                );
                $i++;
            }
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos nuestros eventos
    static function mostrarMisEventos($usuario,$limite) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        //Ordenados por fecha fin
        $consulta = $conexion->query("SELECT * from eventos where fechaf>'$fecha' and usuario='$usuario' order by fechaf asc");
        $datos = null;
        $i = 0;
        while ($row = $consulta->fetch()) {
            if($i < $limite){
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
                'direccion' => $row['direccion'],
                'cp' => $row['cp'],
                'ciudad' => $row['ciudad'],
                'provincia' => $row['provincia'],
                'lat' => $lat,
                'lng' => $lng,
                'participable' => $row['participantes'],
                'participantes' => $participantes,
                'usuario' => $row['usuario'],
                'autor' => Usuario::getNickName($row['usuario']), //Nombre autor
                'login' => Usuario::getIdUsuario($_SESSION['username']), //Usuario con el que estamos logueados
                'loginOperador' => $_SESSION['operador']
            );
            $i++;
            }
        }
        unset($conexion);
        return $datos;
    }

    //Mostramos un evento dado su id y el usuario con el que nos logueamos
    static function mostrarEvento($evento, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fecha = date("Y-m-d H:i:s");
        $consulta = $conexion->query("SELECT * from eventos where id='$evento'");
        $datos = null;
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

            $datos = array(
                'id' => $row['id'],
                'titulo' => $row['titulo'],
                'contenido' => $row['contenido'],
                'tipo' => $row['tipo'],
                'fecha_publicacion' => $row['fecha_publicacion'],
                'fechai' => $row['fechai'],
                'fechaf' => $row['fechaf'],
                'empezado' => Evento::empezado($row['fechai'], $fecha),
                'foto' => $foto,
                'direccion' => $row['direccion'],
                'cp' => $row['cp'],
                'ciudad' => $row['ciudad'],
                'provincia' => $row['provincia'],
                'lat' => $lat,
                'lng' => $lng,
                'participable' => $row['participantes'],
                'participantes' => $participantes,
                'participa' => Evento::esParticipante($evento, $usuario),
                'usuario' => $row['usuario'],
                'autor' => Usuario::getNickName($row['usuario'])
            );
        }
        unset($conexion);
        return $datos;
    }

    //Función para ver si está empezado un evento dada la fecha de inicio y la actual
    static function empezado($inicio, $actual) {
        if ($actual > $inicio) {
            return true;
        } else {
            return false;
        }
    }

    //Mostramos los participantes que tiene un evento
    static function mostrarParticipantes($id) {
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

    //Comprobamos dado un evento y un usuario si es participante o no
    static function esParticipante($id, $usuario) {
        $participantes = explode(",", Evento::mostrarParticipantes($id));
        $participante = false;
        for ($i = 0; $i < count($participantes); $i++) {
            if ($usuario == $participantes[$i]) {
                $participante = true;
            }
        }
        
        return $participante;
    }

    
    //Participamos dentro de un evento
    static function participarEvento($id, $usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!Evento::esParticipante($id, $usuario)) {
            $consulta = $conexion->query("SELECT * from eventos where id='$id'");
            $participantes = null;
            while ($row = $consulta->fetch()) {
                $participantes = $row['participantes'];
                if ($participantes == "t") { //Si participantes es "t" ("true")
                    $sql = "UPDATE eventos SET participantes='$usuario' where id='$id'"; //Introducimos usuario
                } else if ($participantes != null) { //Si no está vacío, es decir hay mas usuarios
                    $sql = "UPDATE eventos SET participantes='$participantes,$usuario' where id='$id'"; //Introducimos
                }
            }
            if ($participantes == "t" || $participantes != null) {
                $conexion->exec($sql);
            }
        }

        unset($conexion);
    }

    //Salimos de un evento
    static function salirDeEvento($id, $participante) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT participantes from eventos where id='$id'"); //Buscamos participantes
        while ($row = $consulta->fetch()) {
            $participantescad = $row['participantes'];
        }
        $participantes = explode(",", $participantescad); //Los guardamos en un array
        for ($i = 0; $i < count($participantes); $i++) {
            if ($participantes[$i] == $participante) { //Si coincide con nuestra id
                unset($participantes[$i]); //Lo quitamos
            }
        }
        $participantesNewCad = implode(",", $participantes); //Volvemos a crear la cadena
        if ($participantesNewCad != "") { //La volvemos a introducir
            $sql = "UPDATE eventos SET participantes='$participantesNewCad' where id='$id'";
        } else { //Si queda vacía escribimos t
            $sql = "UPDATE eventos SET participantes='t' where id='$id'";
        }
        $conexion->exec($sql);
        unset($conexion);
    }

    //Borramos a un usuario de todos los eventos
    static function salirDeEventosUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id,participantes from eventos");
        while ($row = $consulta->fetch()) {
            $participantescad = $row['participantes'];
            $id = $row['id'];
            $participantes = explode(",", $participantescad); //Convertimos cada cadena a array
            for ($i = 0; $i < count($participantes); $i++) {
                if ($participantes[$i] == $usuario) { //Si en ella está nuestro usuario 
                    unset($participantes[$i]); //Lo eliminamos
                }
            }
            $participantesNewCad = implode(",", $participantes);//Volvemos a crear cadena
            if ($participantesNewCad != "") { //Lo introducimos
                $sql = "UPDATE eventos SET participantes='$participantesNewCad' where id='$id'";
            } else {
                $sql = "UPDATE eventos SET participantes='t' where id='$id'";
            }
            $conexion->exec($sql);
        }
        unset($conexion);
    }

    //Eliminamos todos los eventos de un usuario
    static function eliminarEventosUsuario($usuario) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM eventos WHERE usuario=$usuario";
        $conexion->exec($sql);
        unset($conexion);
    }

    //Eliminamos un evento dado su id
    static function eliminarEvento($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Evento::eliminarMultimedia($id);
        $sql = "DELETE FROM eventos where id='$id'";
        $conexion->exec($sql);
    }

    //Eliminamos la img de un evento
    static function eliminarMultimedia($id) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT foto from eventos where id=$id");
        $borrado = false;
        while ($row = $consulta->fetch()) {
            if ($row['foto']) {
                $multimedia = $row['foto'];
                unlink("uploads/eventos/" . $multimedia);
            }
            $borrado = true;
        }
        unset($conexion);
        return $borrado;
    }

}
