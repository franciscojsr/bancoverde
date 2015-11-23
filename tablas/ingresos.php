<?php


class Ingresos extends Insert_sql{

    // Ingresos/traspasos, parte de operaciones
    private $importe;
    private $cuenta_destino;


    // Función para insertar datos de ingresos. Se pasará el saldo final del ingreso
    function insert_table_ingresos( $saldo_f_ingreso, $saldo_i_ingreso) {

        $this->importe = $_POST['importe'];
        $this->cuenta_destino = $_POST['destino'];

        // Obtenemos el idcuenta destino ingreso y su saldo actual a traves de su numero de cuenta y lo introducimos en la tabla ingresos
        $select_id_cuenta = new Selects();
        $sql = 'SELECT idcuenta FROM cuentas WHERE num_cuenta = "'. $this->cuenta_destino. '" ' ;
        $data_cuenta = $select_id_cuenta->select_idcuentas($sql);
        $idcuenta_ingreso = $data_cuenta;

        // Ejecutamos reg_transacciones a la vez que se inserta la tabla ingresos
        $reg_tras = new Reg_transacciones();
        $id_reg_tran = $reg_tras->inserts_table_reg_transacciones();

        // Inserción tabla ingresos
        // Habrá que obtener el id_cuenta al que pertenece la cuenta, para poder insertarlo en tabla ingresos
        $insert_ingresos = "INSERT INTO ingresos ( saldo_i, saldo_f, importe, idcuenta, idreg_transaccion )
                            VALUES ( '". $saldo_i_ingreso ."', '". $saldo_f_ingreso ."', '". $this->importe ."', '". $idcuenta_ingreso ."', '".$id_reg_tran."' )";
        $this->insert_ingresos($insert_ingresos);

        return null;
    }


}
