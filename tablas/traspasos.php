<?php


class Traspasos extends Insert_sql{

    // Ingresos/traspasos, parte de operaciones
    private $importe;
    private $cuenta_origen;
    private $cuenta_destino;

    // Función para insertar datos de traspasos. Se pasara saldos finales del traspaso
    function insert_table_traspasos( $saldo_f_origen, $saldo_f_destino, $saldo_i_origen, $saldo_i_destino) {

        $this->importe = $_POST['importe'];
        $this->cuenta_origen = $_POST['origen'];
        $this->cuenta_destino = $_POST['destino'];

        // Obtenemos los idcuenta destino y origen y sus saldos iniciales a traves de sus numeros de cuentas y los introducimos en la tabla traspasos
        $select_id_cuenta = new Selects();

        $sql = 'SELECT idcuenta FROM cuentas WHERE num_cuenta = "'. $this->cuenta_origen. '" ' ;
        $data_origen = $select_id_cuenta->select_idcuentas($sql);
        $idcuenta_origen = $data_origen;

        $sql2 = 'SELECT idcuenta FROM cuentas WHERE num_cuenta = "'. $this->cuenta_destino. '" ' ;
        $data_destino = $select_id_cuenta->select_idcuentas($sql2);
        $idcuenta_destino = $data_destino;

        // Ejecutamos reg_transacciones a la vez que se inserta la tabla traspasos
        $reg_tras = new Reg_transacciones();
        $id_reg_tran = $reg_tras->inserts_table_reg_transacciones();

        // Inserción tabla traspasos
        $insert_traspasos = "INSERT INTO traspasos ( saldo_A_i, saldo_A_f, saldo_B_i, saldo_B_f, importe, idcuenta_A, idcuenta_B, idreg_transaccion )
                             VALUES ( '". $saldo_i_origen ."', '". $saldo_f_origen ."', '". $saldo_i_destino ."', '". $saldo_f_destino ."', '". $this->importe ."', '". $idcuenta_origen . "', '". $idcuenta_destino . "', '". $id_reg_tran ."' )";
        $this->insert_sql_traspasos($insert_traspasos);

        return null;

    }



}
