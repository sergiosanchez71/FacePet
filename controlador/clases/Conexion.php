<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexion
 *
 * @author Sergio Sánchez
 */
class Conexion {

    //Clase para acceder a la base de datos
    //Nuestro fichero con el que nos conectaremos a la base de datos
    function conectar() {
        try {
            $gbd = new PDO('mysql:host=localhost;dbname=facepet', 'root', 'Alfonso11');
            return $gbd;
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
 
}
