<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Municipio
 *
 * @author sergiosanchez
 */
class Municipio {

    private $id;
    private $provincia;
    private $municipio;

    function __construct($id, $provincia, $municipio) {
        $this->id = $id;
        $this->provincia = $provincia;
        $this->municipio = $municipio;
    }

    function getId() {
        return $this->id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getMunicipio() {
        return $this->municipio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function setMunicipio($municipio) {
        $this->municipio = $municipio;
    }
    
    function consultarMunicipios($provincia) {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from municipios where provincia='$provincia' order by municipio asc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            $datos[$i] = array(
                'id' => $row['id'],
                'provincia' => $row['provincia'],
                'municipio' => utf8_encode($row['municipio'])
            );
            $i++;
        }
        unset($conexion);
        return $datos;
    }
    
    function getNombreMunicipio($id){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT municipio from municipios where id='$id'");
        $municipio = null;
        while ($row = $consulta->fetch()) {
            $municipio = utf8_encode($row['municipio']);
        }
        unset($conexion);
        return $municipio;
    }
    
    function buscarMunicipioId($municipio){
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $municipioutf8 = utf8_encode($municipio);
        $consulta = $conexion->query("SELECT id from municipios where municipio='$municipioutf8'");
        $id = null;
        while ($row = $consulta->fetch()) {
            $id = $row['id'];
        }
        unset($conexion);
        return $id;
    }

}
