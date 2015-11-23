<?php

class Conexio_db extends Conexio_dades_db {

    protected $conexio;
    protected $saldo;

    function __construct(){
        // Se realiza la conexion con los datos del array para la conexión a la base de datos
        $this->conexio = mysqli_connect($this->dades_DB()[0],
                                        $this->dades_DB()[1],
                                        $this->dades_DB()[2],
                                        $this->dades_DB()[3]) or DIE(" Error connection database");

//        echo "Conexion a la base de datos -->[". $this->dades_DB()[3] ."] establecida!!!</br>";
        
        // UTF-8 /* cambiar el conjunto de caracteres a utf8 */
        $this->conexio->set_charset('utf8'); // or mysqli_set_charset($this->conexio, 'utf8');

    }

    function __destruct(){
        // Se cierra la conexion a la base de datos
        if(mysqli_close($this->conexio)){
//            echo "Conexion a la base de datos -->[". $this->dades_DB()[3] ."] cerrada!!!</br>";
        }
    }

}