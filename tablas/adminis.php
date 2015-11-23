<?php


class Adminis extends Insert_sql{


    // Función que insertará la tabla adminis y retorna valor del id_adminis insertado
    function insert_table_adminis($departamento, $user_id) {

        // Inserción tabla adminis
        $insert_admini = "INSERT INTO adminis (departamento) VALUES ( '". $departamento ."', '". $user_id ."' )";
        $admini_id = $this->insert_adminis($insert_admini); // A la vez que se insertan los campos se obtiene el id para introducirlo en usuarios

        return $admini_id;
    }


}