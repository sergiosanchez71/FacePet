<?php

/**
 * Description of Animal
 *
 * @author sergiosanchez
 */
class Animal {

    private $id;
    private $nombre;

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
    
    function buscarConId($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT nombre from animales where id=$id");
        while ($row = $consulta->fetch()) {
            $animal = $row['nombre'];
        }
        unset($conexion);
        return $animal;
    }

    function mostrarIdAnimales() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT id from animales order by nombre");
        $i = 0;
        while ($row = $consulta->fetch()) {
            $animal = $row['id'];
            $animales[$i] = $animal;
            $i++;
        }
        unset($conexion);
        return $animales;
    }

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

    function crearAnimal($animal) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO animales (nombre) VALUES ('$animal')";
        $conexion->exec($sql);
    }
    
    function borrarAnimal($animal){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM animales where id='$animal'";
        $conexion->exec($sql);
    }
    
}
