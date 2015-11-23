<?php

class Texto {

    private $cadena;

    // Obtiene el valor inicial de la cadena
    function entrar_cadena($cadena){
        $this->cadena = $cadena;
    }

    // Elimina espaciones existentes al inicio y fin de cadena
    function limpiar_espacios(){
        return trim($this->cadena);
    }

    // Inserta una cadena de caracteres delante o detrás de la cadena a trabajar
    function insertar_delante($textoDelante) {
        $this->cadena = $textoDelante . $this->cadena;
    }
    function insertar_detras($textoDetras) {
        $this->cadena = $this->cadena . $textoDetras;
    }

    // Escapa los caracteres especiales para evitar errores de SQL
    function preparar_SQL() {
        return addslashes($this->cadena);
    }
    // Escapa los caracteres especiales de una cadena para usarla en una sentencia SQL,
    // tomando en cuenta el conjunto de caracteres actual de la conexión
    function preparar_SQL2($con) {
//        $con = new Conexio_db();
        return $con->conexio->real_escape_string($this->cadena);
    }

    // Escribe en formato HTML los caracteres especiales, tales como los acentos
    function preparar_HTML() {
//        return htmlentities($this->cadena);
        return htmlspecialchars($this->cadena);
    }

    function mostrar_cadena() {
        return $this->cadena;
    }


}