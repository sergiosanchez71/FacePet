<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Provincia
 *
 * @author sergiosanchez
 */
class Provincia {

    private $id;
    private $provincia;

    //Contructor de provincia
    function __construct($id, $provincia) {
        $this->id = $id;
        $this->provincia = $provincia;
    }

    function getId() {
        return $this->id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    //Listamos las provincias
    function consultarProvincias() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Ordenadas por nombre
        $consulta = $conexion->query("SELECT * from provincias order by provincia asc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            $datos[$i] = array(
                'id' => $row['id'],
                'provincia' => utf8_encode($row['provincia']) //Almacenamos en utf8
            );
            $i++;
        }
        unset($conexion);
        return $datos;
    }
    
    //Accedemos al nombre de la provincia dada su id
    function getNombreProvincia($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from provincias where id='$id'");
        $provincia = null;
        while ($row = $consulta->fetch()) {
            $provincia = utf8_encode($row['provincia']); //Almacenamos en utf8
        }
        unset($conexion);
        return $provincia;
    }

}
