<?php

Class Insert_sql extends Conexio_db{

//    function __construct(){}

    protected $id_last;

    // Función para la inserción de campos
    function insert_sql1($sql){
        $con = new Conexio_db();

        if($con->conexio->query($sql)){
//            echo "insert ok</br>";
        }else {
//            echo "insert error</br>";
//            echo "<h2>".$con->conexio->error."</h2>";
        }

        $id_last = $con->conexio->insert_id; // Se retornará el id insertado para introducirlo en otras tablas si es necesario

        return $id_last;
    }

    function insert_adminis($sql) { return self::insert_sql1($sql); }

    function insert_usuarios($sql) { return self::insert_sql1($sql); }
    function insert_reg_usuarios($sql) { return self::insert_sql1($sql); }

    function insert_cuentas($sql) { self::insert_sql1($sql); return null; }

    function insert_reg_transacciones($sql) { return self::insert_sql1($sql); }
    function insert_ingresos($sql) { return self::insert_sql1($sql); }
    function insert_sql_traspasos($sql) { return self::insert_sql1($sql); }


    function __destruct(){}


}