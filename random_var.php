<?php


class Random_var {

    protected $num_rand; // Numérico
    protected $alf_rand; // Alfanumérico.

    // Random numérico. En este caso de 10 digitos.
    function random_numeric(){
        $this->num_rand = rand(0,9999999999);
        return $this->num_rand;
    }

    // Random alfanumérico. La longitud sependera del valor $long
    function random_alphanumeric($long) {
        $alpha = implode("",range('a','z')); // Se extrae los valores de la matriz con caracteres
        $ALPHA = implode("",range('A','Z')); // Se extrae los valores de la matriz con caracteres
        $nums = implode("",range('0','9')); // Se extrae los valores de la matriz con numeros
        $rand_charac = $alpha.$ALPHA.$nums; // Varibale con los caracteres alfanuméricos de las tres variables anteriores juntas
        $num_charac = strlen($rand_charac); // Develve el numero total de caracteres del string

        for($pos=0; $pos<$long; $pos++){
            $posi= rand(0,$num_charac); // Da al azar un numero de entre los caracteres totales, dando lugar a la posición a unsar en substr
            $this->alf_rand .= substr($rand_charac, $posi, 1); // Devuelve parte de una cadena, en este caso obtiene un caracter cada vez
        }

        return $this->alf_rand; // Retorna una cadena con caracteres al azar
    }
}

