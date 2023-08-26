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


require_once(__DIR__ . "/../../conf/define.php");

$servername = DB_HOST;
$username = USER;
$password = PASS;
$database = DATABASE;

class Conexion {

    //Clase para acceder a la base de datos
    //Nuestro fichero con el que nos conectaremos a la base de datos
    public static function conectar() {
        try {
            $gbd = new PDO('mysql:host='.DB_HOST.';dbname='.DATABASE, USER, PASS);
            return $gbd;
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
 
}
