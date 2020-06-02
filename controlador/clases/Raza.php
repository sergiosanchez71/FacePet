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

    //Constructor de raza
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
    
    //Buscamos una raza dada su id
    function buscarConId($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from razas where id=$id");
        $i=0;
        while ($row = $consulta->fetch()) {
            $raza = $row['nombre'];
            $i++;
        }
        
        if($i == 0){ //Si no se encuentra
            $raza = "No especificada";
        }
        
        unset($conexion);
        return $raza;
    }
    
    //Comprobamos si existe la razas dado un animal
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

    //Mostramos el id de las razas dado un animal
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
        if($i==0){ //Si no encuentra ninguna id
            $razas[$i]=0; //0 por defecto
        }
        unset($conexion);
        return $razas;
    }

    //Mostramos todos los nombres de las razas dado un animal
    function mostrarRazas($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Ordenado por nombre
        $consulta = $conexion->query("SELECT nombre from razas where animal='$animal' order by nombre");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $raza = $row['nombre'];
            $razas[$i] = $raza;
            $i++;
        }
        if($i==0){ //Si no encuentra razas
            $razas[$i]="Otro";
        }
        unset($conexion);
        return $razas;
    }
    
    //Comprobamos el nombre dada una raza y un animal
    function comprobarNombre($raza, $animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from razas where lower(nombre)=lower('$raza') and animal='$animal'");
        $existe = false;
        while ($row = $consulta->fetch()) {
            $existe = true;
        }
        unset($conexion);
        return $existe;
    }
    
    //Creamos una raza dada la raza introducida y un animal
    function crearRaza($raza,$animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO razas (nombre,animal) VALUES ('$raza','$animal')";
        $conexion->exec($sql);
    }
    
    //Borramos raza dada su id
    function borrarRaza($raza){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM razas where id='$raza'";
        $conexion->exec($sql);
    }

}
