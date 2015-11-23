<?php

class Secure_sql extends Conexio_db{

    private $cadena;

    function entrar_cadena($cadena){
        $this->cadena = $cadena;
        return null;
    }


    function __destruct(){

    }


}