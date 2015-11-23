<?php


class Usuarios extends Insert_sql{

    // Función que insertará tabla usuarios con sus campos, pasando por parametro variable id_adminis. Retornará id de usuario insertado.
    // Se pasa por parámetro passrandom y el hashpass, tambien los demas valores
    function insert_table_usuarios($name, $ap1, $ap2, $dni, $mail, $dir, $passrand, $hashpass_rand) {

        // Inserión tabla usuarios
        $insert_usuario = "INSERT INTO usuarios (name, apellido1, apellido2, dni, email, direccion, pass, hash_pass)
                           VALUES ('" . $name . "', '" . $ap1 . "', '" . $ap2 . "' , '" . $dni . "' , '" . $mail . "', '" . $dir . "',
                                   '" . $passrand . "', '". $hashpass_rand ."')";
        $insert_user_id = $this->insert_usuarios($insert_usuario); // Se ejecutará la sentencia a la vez que se obtiene el ultimo id de usuario introducido automaticamente y se inserta en cuentas.

        return $insert_user_id;
    }

}