<?php

/**
 * Description of Raza
 *
 * @author sergiosanchez
 */
class Raza {

    private $id;
    private $animal;
    private $raza;

    function __construct($animal, $raza) {
        $this->animal = $animal;
        $this->raza = $raza;
    }

    function getId() {
        return $this->id;
    }

    function getAnimal() {
        return $this->animal;
    }

    function getRaza() {
        return $this->raza;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAnimal($animal) {
        $this->animal = $animal;
    }

    function setRaza($raza) {
        $this->raza = $raza;
    }
    
    function comprobarRazas($animal){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from razas where animal='$animal'");
        $existen = false;
        while ($row = $consulta->fetch()) {
            $existen = true;
        }
        unset($conexion);
        return $existen;
    }

    function mostrarIdRazas($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from razas where animal='$animal'");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $raza = $row['id'];
            $razas[$i] = $raza;
            $i++;
        }
        if($i==0){
            $razas[$i]=0;
        }
        unset($conexion);
        return $razas;
    }

    function mostrarRazas($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from razas where animal='$animal' order by nombre");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $raza = $row['nombre'];
            $razas[$i] = $raza;
            $i++;
        }
        if($i==0){
            $razas[$i]="Otro";
        }
        unset($conexion);
        return $razas;
    }
    
    function comprobarNombre($raza) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from razas where lower(nombre)=lower('$raza')");
        $existe = false;
        while ($row = $consulta->fetch()) {
            $existe = true;
        }
        unset($conexion);
        return $existe;
    }
    
    function crearRaza($raza,$animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO razas (nombre,animal) VALUES ('$raza','$animal')";
        $conexion->exec($sql);
    }
    
    function borrarRaza($raza, $animal){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM animales where id='$raza' and animal='$animal'";
        $conexion->exec($sql);
    }

}
