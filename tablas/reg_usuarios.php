<?php

class Reg_usuarios extends Insert_sql{

    // Función que insertará tabla reg_usuarios con lainformación, pasando por parametro variable id_usuario insertado. Retornará id de reg_usuario insertado
    function insert_table_reg_usuarios($tip_usuario, $user_id) {

        // Obtenemos la fecha y tiempo actual para guardar, a través de la funcién en forma de array, ya que devuelve un array
        $date_time_creation = new Date_time();
        $date_creation = $date_time_creation->date_time()[0];
        $time_creation = $date_time_creation->date_time()[1];

        // Inserción tabla reg_usuarios
        $insert_reg_usuario = "INSERT INTO reg_usuarios ( fecha, hora, tipo, idusuario )
                                               VALUES ( '".$date_creation."', '".$time_creation."', '".$tip_usuario."', '". $user_id ."')";
        $insert_user_id = $this->insert_reg_usuarios($insert_reg_usuario);

        return $insert_user_id;
    }


}