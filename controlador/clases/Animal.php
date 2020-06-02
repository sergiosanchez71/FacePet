<?php

/**
 * Description of Animal
 *
 * @author sergiosanchez
 */
class Animal {

    private $id;
    private $nombre;

    //Contructor con nombre
    function __construct($nombre) {
        $this->nombre = $nombre;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    //Buscamos dado un id de un animal
    function buscarConId($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from animales where id=$id");
        $i=0;
        while ($row = $consulta->fetch()) {
            $animal = $row['nombre'];
            $i++;
        }
        if($i==0){
            $animal = "No especificado";
        }
        unset($conexion);
        return $animal;
    }

    //Buscamos el id de los animales
    function mostrarIdAnimales() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from animales order by nombre"); //Ordenados por nombre
        $i = 0;
        while ($row = $consulta->fetch()) {
            $animal = $row['id'];
            $animales[$i] = $animal;
            $i++;
        }
        unset($conexion);
        return $animales;
    }

    //Mostramos el nombre de todos los animales
    function mostrarAnimales() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from animales");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $animal = $row['nombre'];
            $animales[$i] = $animal;
            $i++;
        }
        unset($conexion);
        return $animales;
    }

    //Comprobar nombre de animal para saber si existe
    function comprobarNombre($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from animales where lower(nombre)=lower('$animal')");
        $existe = false;
        while ($row = $consulta->fetch()) {
            $existe = true;
        }
        unset($conexion);
        return $existe;
    }

    //Creamos un animal dado su nombre
    function crearAnimal($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO animales (nombre) VALUES ('$animal')";
        $conexion->exec($sql);
    }
    
    //Borramos un animal dada su id
    function borrarAnimal($animal){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM animales where id='$animal'";
        $conexion->exec($sql);
    }
    
}
