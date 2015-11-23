<?php

class Reg_transacciones extends Insert_sql{

    // Reg_transacciones
    private $tipo_transaccion;
    private $concepto;

    // Funcion insercion tabla reg_transacciones, que se usará tano para ingresos como para traspasos.
    // Retornará el valor del idreg_transacciones
    function inserts_table_reg_transacciones() {

        $this->tipo_transaccion = $_POST['tipo_radio'];
        $this->concepto = $_POST['concepto'];

        // Obtenemos la fecha y tiempo actual para guardar, a través de la funcién en forma de array, ya que devuelve un array
        $date_time_creation = new Date_time();
        $fecha = $date_time_creation->date_time()[0];
        $hora = $date_time_creation->date_time()[1];

        // Inserción tabla reg_transacciones
        $insert_reg_transacciones = "INSERT INTO reg_transacciones ( fecha, hora, tipo, concepto)
                                     VALUES ( '".$fecha."', '".$hora."', '".$this->tipo_transaccion."', '".$this->concepto."' )";
        $insert_reg_tran_id = $this->insert_reg_transacciones($insert_reg_transacciones);

        return $insert_reg_tran_id;
    }




}