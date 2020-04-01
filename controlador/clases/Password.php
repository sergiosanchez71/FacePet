<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Password
 *
 * @author Sergio Sánchez
 */
class Password {

    const SALT = 'EstoEsUnSalt';

    public static function md5($password) {
        return hash('md5', self::SALT . $password);
    }

    public static function verifymd5($password, $hash) {
        return ($hash == self::md5($password));
    }

}
