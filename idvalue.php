<?php session_start();


require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$sql_se = new Selects;

new Define_vars("dival"); // Como if(empty($_POST["dival"])){$_POST["dival"]=null;}
$dival = $_POST["dival"];

if(empty($_POST["fecha_select1"])){$_POST["fecha_select1"]=null;}
$fsel1 = $_POST["fecha_select1"];

new Define_vars("dia_i"); // Como if(empty($_POST["index"])){$_POST["index"]=null;}
new Define_vars("mes_i");
new Define_vars("año_i");
new Define_vars("dia_f");
new Define_vars("mes_f");
new Define_vars("año_f");
$diai = $_POST["dia_i"];
$mesi = $_POST["mes_i"];
$añoi = $_POST["año_i"];
$diaf = $_POST["dia_f"];
$mesf = $_POST["mes_f"];
$añof = $_POST["año_f"];


//if(!empty($_POST["fecha_select1"]) && !empty($_POST["fecha_select2"])) {
if(!empty($_POST["dia_i"]) && !empty($_POST["mes_i"]) && !empty($_POST["año_i"]) &&
   !empty($_POST["dia_f"]) && !empty($_POST["mes_f"]) && !empty($_POST["año_f"])) {

    $fecha_inicio = $añoi."-".$mesi."-".$diai;
    $fecha_final = $añof."-".$mesf."-".$diaf;

    if( $fecha_inicio == $fecha_final ){
        echo "ERROR NO ES POSIBLE ENTRE FECHAS IGUALES";  echo ' <input type="submit" onclick=data_base(); value="< Nueva búsqueda"> '; }
    elseif( $añoi > $añof ) {
        echo "ERROR NO ES POSIBLE AÑO FINAL MENOR A AÑO INICIO";  echo ' <input type="submit" onclick=data_base(); value="< Nueva búsqueda"> '; }
    elseif( ($añoi == $añof) && ( $mesi > $mesf ) ) {
        echo "ERROR NO ES POSIBLE MES FINAL MENOR A MES INICIO";  echo ' <input type="submit" onclick=data_base(); value="< Nueva búsqueda"> '; }
    elseif( ($añoi == $añof) && ( $mesi == $mesf ) && ( $diai > $diaf ) ) {
        echo "ERROR NO ES POSIBLE DIA FINAL MENOR A DIA INICIO";  echo ' <input type="submit" onclick=data_base(); value="< Nueva búsqueda"> '; }
    else{

        echo "Desde: " .$diai."-".$mesi."-".$añoi. " Hasta: ";
        echo $diaf."-".$mesf."-".$añof;

        // Aquí se mostrará los resultados de ingresos y transacciones comprendidas entre las fechas seleccionadas
        // Primero se obtendrán los idreg_transaccion entre las fechas comprendidas y después se accederá
        //  a los ingresos y traspasos para mostrarlos por pantalla

        $sql_idsregs = "SELECT idreg_transaccion FROM reg_transacciones
                        WHERE fecha >= '$fecha_inicio'
                        AND fecha <= '$fecha_final' ";
        $idsregs = $sql_se->select_idreg_reg_transacciones($sql_idsregs);

        // Ahora con idcuenta y el resultado de idreg_transacciones mostraremos los resultados de ingresos y transacciones
        // Primero se guardarà un array con los valores de ingresos y segundo con los de traspasos

        $count_idsregs = count($idsregs);

        $S_dival = $_SESSION["dival"]; // idcuenta pasado por session

        $sql_idc = "SELECT idcuenta FROM cuentas WHERE idusuario = '$S_dival' ";                  // idcuenta
        $idcu = $sql_se->select_idcuentas($sql_idc);

        // Se obtiene la ultima transaccion para marcar el saldo actual dentro de la tabla de forma dinámica, se mostrará en color azul
        $sql_last_tran_ingresos = "SELECT idreg_transaccion FROM ingresos WHERE idcuenta = '$idcu' ";
        $last_tran_ingre = $sql_se->select_last_reg_tran($sql_last_tran_ingresos);

        $sql_last_tran_traspasos = "SELECT idreg_transaccion FROM traspasos WHERE idcuenta_A = '$idcu'
                                                                            OR idcuenta_B = '$idcu' ";
        $last_tran_tras = $sql_se->select_last_reg_tran($sql_last_tran_traspasos);


        // Segun el mayor se utilizará uno u otro
        if($last_tran_ingre > $last_tran_tras){ $last_tran = $last_tran_ingre; }
        else{ $last_tran = $last_tran_tras; }

        // Se muestra el encabezado. Despues de muestra resultados
        // Ingresos
        echo $sql_se->select_db_ingresos_fechas_encabezado();
        for($i = $count_idsregs-1; $i >= 0; $i--) { // Inverso para resultados fechas ascendientes

            $sql_fecha = "SELECT fecha FROM reg_transacciones WHERE idreg_transaccion = '$idsregs[$i]'";
            $fecha = $sql_se->select_fechas_reg_transacciones($sql_fecha);

            $sql_ingresos = "SELECT * FROM ingresos WHERE idcuenta = '$idcu'
                                                    AND idreg_transaccion = '$idsregs[$i]'";
            echo $sql_se->select_db_ingresos_fechas_resultados($sql_ingresos, $fecha, $last_tran);
        }

        // Traspasos
        echo $sql_se->select_db_traspasos_fechas_encabezado();
        for($i = $count_idsregs-1; $i >= 0; $i--) { // Inverso para resultados fechas ascendientes

            $sql_fecha = "SELECT fecha FROM reg_transacciones WHERE idreg_transaccion = '$idsregs[$i]'";
            $fecha = $sql_se->select_fechas_reg_transacciones($sql_fecha);

            $sql_traspasos_A = "SELECT * FROM traspasos WHERE idcuenta_A = '$idcu'
                                                        AND idreg_transaccion = '$idsregs[$i]'";

            echo $sql_se->select_db_traspasos_fechas_resultadosA($sql_traspasos_A, $fecha, $last_tran);


            $sql_traspasos_B = "SELECT * FROM traspasos WHERE idcuenta_B = '$idcu'
                                                        AND idreg_transaccion = '$idsregs[$i]'";

            echo $sql_se->select_db_traspasos_fechas_resultadosB($sql_traspasos_B, $fecha, $last_tran);
        }

        echo '<br>';
         echo ' <input type="submit" onclick=data_base(); value="< Nueva búsqueda"> '; 

    }

}elseif( ( empty($_POST["dia_i"]) || empty($_POST["mes_i"]) || empty($_POST["mes_i"])  ||
           empty($_POST["dia_f"]) || empty($_POST["mes_f"]) || empty($_POST["año_f"])  )  && empty($dival) ){

    echo " * Error Campos vacíos! Ha de seleccionar fechas!";
    echo "Vuelva a escoger!";
     echo ' <input type="submit" onclick=data_base(); value="<--"> '; 

}else { // Inicialmente se ejecuta

    $_SESSION["dival"] = $dival; // Para acceder dentro de otros se pasa desde aqui por session, ya que es donde se ejecuta defecto

    $sql = "SELECT * FROM cuentas WHERE idusuario = $dival";                            // cuentas
    $sql2 = "SELECT * FROM reg_usuarios WHERE idusuario = $dival";                      // reg_usuarios

    // Para adminis, se obtienen a traves de usuario
    $sql3 = "SELECT * FROM adminis WHERE idusuario = $dival";                           // adminis


    echo' <h3><label style="color:limegreen; text-decoration: underline;">Información adicional</label></h3>';
    echo '<pre id="pre_tran" style="width: 100%; height: 100%; white-space: nowrap;">';
        // Select para seleccionar datos segun fechas.
        echo' <label style="color:limegreen; text-decoration: underline;">Seleccione fechas para ver transacciones.</label>';
        $opt = new Select_option();
        echo '<form id="form_fechas" action="javascript:void(0);" method="POST">';
            echo '<pre id="fechi" style="width: 100%; height: 100%; white-space: nowrap;">';
                echo' <label style="color:limegreen; text-decoration: underline;">Fecha inicio</label>';echo '<br>';
                echo $opt->select_option_date("dia_i","mes_i","año_i");
            echo '</pre>';
            echo '<pre id="fechf" style="width: 100%; height: 100%; white-space: nowrap;">';
                echo' <label style="color:limegreen; text-decoration: underline;">Fecha final</label>';echo '<br>';
                echo $opt->select_option_date("dia_f","mes_f","año_f");
            echo '</pre>';
            echo '<input type="submit" value="Resultados" onclick="transacciones();">';
        echo '</form>';
        echo '<br>';


       // * Parte *

        // Se obtendrán las fechas de transacciones realizadas del idusuario seleccionado para mostrar
        // Primero se obtiene idcuentas con idusuario
        $sql_idc = "SELECT idcuenta FROM cuentas WHERE idusuario = $dival";                  // idcuenta
        $idcu = $sql_se->select_idcuentas($sql_idc);

        // Segundo se obtiene idreg_transacciones de ingreso y de traspasos con su idcuenta

        $sql_idrti = "SELECT idreg_transaccion FROM ingresos WHERE idcuenta = $idcu";   // idreg_transacciones ingresos
        $idrti = $sql_se->select_idregtran_ingresos($sql_idrti);

        $sql_idrtra = "SELECT idreg_transaccion FROM traspasos
                       WHERE idcuenta_A = $idcu OR idcuenta_B = $idcu";                 // idreg_transacciones traspasos
        $idrtr = $sql_se->select_idregtran_traspasos($sql_idrtra);

        // Se juntan los resultados en un solo array. idreg_transacciones totales
        $idreg_trs = [];
        $count_idrti = count($idrti);
        $count_idrtr = count($idrtr);

        for($i = 0; $i < $count_idrti; $i++) {
            $idi = $idrti[$i];
            array_push($idreg_trs,$idi);
        }
        for($j = 0; $j < $count_idrtr; $j++) {
            $idt = $idrtr[$j];
            array_push($idreg_trs,$idt);
        }

        sort($idreg_trs); // idreg_transacciones totales. Ordenación de menor a mayor. No mantiene la asociación con las keys. Para asociacion co las keys asort().
        $count_idtrs = count($idreg_trs);

        // Tercero se obtiene las fechas con los idreg_transacciones obtenidos.

        $array_fechas = [];

        for($i = 0; $i < $count_idtrs; $i++) {
            $sql_fechas = "SELECT fecha FROM reg_transacciones WHERE idreg_transaccion = $idreg_trs[$i]";
            $fecha = $sql_se->select_fechas_reg_transacciones($sql_fechas);
            array_push($array_fechas, $fecha);
        }

        $count_fechas = count($array_fechas); // Numero de valores del array para usarlo en el $form_select_option

        // * Parte *

        // Finalmente $array_fechas insertan en los selects
        echo' <label style="color:limegreen; text-decoration: underline;">Fechas de transacciones/ingresos</label>';
        
            echo '
                <form id="formsel_tran" action="javascript:void(0);" method="POST">
                    <select name="fecha_select1" disabled size="5px" style="padding:5px;>
                            <option value="">Fechas</option>
            ';
                        for($cont = 0; $cont < $count_fechas; $cont++){
            echo '          <option value=" ';  echo  $array_fechas[$cont]  ;  echo ' "> '; echo  $array_fechas[$cont]  ; echo '</option> ';
                        }
            echo '  </select >
                    <!-- <input id="go" name="go" type="submit" value="Go" onclick="transacciones();"> -->
                </form>
            ';
        
        echo '<br>';

        //Mostrará los resultados de tabla especificado
        echo $sql_se->select_db_cuentas($sql);
        echo $sql_se->select_db_reg_usuarios($sql2);
        echo $sql_se->select_db_adminis($sql3);
    echo '</pre>';
}
?>