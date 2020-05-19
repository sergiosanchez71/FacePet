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

    function consultarProvincias() {
        $conexion = Conexion::conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $consulta = $conexion->query("SELECT * from provincias order by provincia asc");
        $i = 0;
        $datos = null;
        while ($row = $consulta->fetch()) {
            //$datos[$i]=1;
            $datos[$i] = array(
                'id' => $row['id'],
                'provincia' => utf8_encode($row['provincia']),
            );
            $i++;
        }
        unset($conexion);
        return $datos;
    }

}
