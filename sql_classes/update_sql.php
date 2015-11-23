<?php


Class Update_sql extends Conexio_db{

//    function __construct(){}

    // Actualiza saldo
    function update_sql_saldo($sql){
        $con = new Conexio_db();

        if($con->conexio->query($sql)){
//            echo "Update ok!!</br>";
            $status="ok";
        }else {
//            echo "Update error!!</br>";
//            echo "<h2>".$con->conexio->error."</h2>";
            $status = "nok";
        }

        return $status;
    }



    function __destruct(){}


}