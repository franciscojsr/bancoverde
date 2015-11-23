<?php

class Cuenta extends Selects{

    private $num_cuenta;

    // Función que insertará tabla cuenta con información, pasando por parametro variable id_reg_usuario insertado,
    // y numero de cuenta random. $this->cuen_rand. Tambien los demas valores para no repetición
    function insert_tabla_cuentas($saldo_reg, $tip_cuenta, $cuenta_rand, $reg_user_id) {

        // Inserción tabla cuentas
        $insert_cuenta = "INSERT INTO cuentas (num_cuenta, saldo_actual, tipo, idusuario)
                          VALUES ('" . $cuenta_rand . "', '".$saldo_reg."', '".$tip_cuenta."', '". $reg_user_id . "' )";
        $inserts = new Inserts();
        $inserts->insert_cuentas($insert_cuenta);

        return null;
    }


    // Declaracion numero cuenta bancaria
    function definir_cuenta($num_count) {
        $this->num_cuenta = $num_count;
        return null;
    }

    function obtener_saldo() {
        $sql = "SELECT saldo_actual FROM cuentas WHERE num_cuenta = '".$this->num_cuenta."'";
        $this->select_saldo($sql);
        return $this->saldo_cuenta; // Obtenido por herencia classe select_sql
    }
    // Consulta el saldo de las cuentas asociadas
    function obtener_saldoA() {
        $sql = "SELECT saldo_actual FROM cuentas WHERE num_cuenta = '".$this->num_cuenta."'";
        $this->select_saldoA($sql);
        return $this->saldo_cuentaA; // Obtenido por herencia classe select_sql
    }
    function obtener_saldoB() {
        $sql = "SELECT saldo_actual FROM cuentas WHERE num_cuenta = '".$this->num_cuenta."'";
        $this->select_saldoB($sql);
        return $this->saldo_cuentaB; // Obtenido por herencia classe select_sql
    }

    // Dar valores a variables de importe a trasferir/ingresar y actualizar base de datos
    function entrar_saldo($valor){
        $this->saldo_cuenta = $valor;
        $sql = "UPDATE cuentas SET saldo_actual='".$this->saldo_cuenta."' WHERE num_cuenta = '".$this->num_cuenta."'";
        $update = new Update();
        $update->update_saldo($sql);
        return null;
    }

    // Traspaso de saldo entre cuentas
    function traspaso_saldo($cue_origen, $cue_destino, $sal_origen, $sal_destino, $importe){

        $opera = new Operaciones();

        // Se comprueba el saldo de origen
        if( $opera->resta($sal_origen, $importe) < 0 ){
            return "* No hay saldo suficiente en la cuenta origen.";
        }
        elseif($cue_origen==$cue_destino){
            echo'
                <script>
                    alert("No es posiblle trasferir de una misma cuenta");
                </script>
            ';
            return "* No es posible trasferir de una misma cuenta";
        }
        else {
            // Si hay saldo suficiente se realiza el traspaso se suma y resta saldo dependiendo de la cuenta origen y destino
            // Resta saldo a origen
            $saldo_nuevoA = $opera->resta($sal_origen, $importe);
            $this->definir_cuenta($cue_origen); // Se define la cuenta
            $this->entrar_saldo($saldo_nuevoA);
            // Suma saldo a destino
            $saldo_nuevoB = $opera->suma($importe, $sal_destino);
            $this->definir_cuenta($cue_destino);
            $this->entrar_saldo($saldo_nuevoB);

            // Inserta tabla traspasos registros
            $traspas = new Traspasos();
            $traspas->insert_table_traspasos($saldo_nuevoA, $saldo_nuevoB, $sal_origen, $sal_destino);

            return "* Importe traspasado correctamente.";
        }


    }

    // Ingreso sde saldo en cuenta destino
    function ingreso_saldo($cue_destino, $sal_destino, $importe){

        $opera = new Operaciones();

        // Se comprueba el saldo de origen
        if( $importe > 2000 ){ return "* Importe máximo superado."; }
        else {
            // Si importe correcto se realiza ingreso
            $saldo_nuevo = $opera->suma($importe, $sal_destino);
            $this->definir_cuenta($cue_destino);
            $this->entrar_saldo($saldo_nuevo);

            // Inserta tabla ingresos con los registros
            $ingres = new Ingresos();
            $ingres->insert_table_ingresos($saldo_nuevo, $sal_destino);

            return "* Importe ingresado correctamente.";
        }
    }


}