<?php


class Operaciones {

    public $error;

    function obtener_error() { return $this->error; }

    // Control si es valor numérico
    function control_numerico($val1, $val2){
        if(is_numeric($val1) && is_numeric($val2)){ return true; }
        else {
            $this->error = "Un valor no es numérico";
            return false;
        }
    }

    // Suma de valores
    function suma($val1, $val2) {
        if( self::control_numerico($val1, $val2) ){ return $val1 + $val2; }
        else{ return self::obtener_error(); }
    }

    // Resta de valores
    function resta($val1, $val2) {
        if( self::control_numerico($val1, $val2) ){ return $val1 - $val2; }
        else{ return self::obtener_error(); }
    }


}