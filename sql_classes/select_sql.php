<?php


Class Select_sql extends Conexio_db{

    protected $hashpass;
    protected $saldo_cuenta;
    protected $saldo_cuentaA;
    protected $saldo_cuentaB;


    function __construct() {}

    function select_sql_session($sql, $con) {
        $this->hashpass="";
        foreach ($con->conexio->query($sql) as $row) {
            $this->hashpass = $row['hash_pass'];
        }
        return $this->hashpass;
    }

    // Obtiene idreg_transacciones de traspasos
    function select_sql_idregtran_traspasos($sql, $con) {
        $array_idrgt=[];
        foreach ($con->conexio->query($sql) as $row){
            $idrgt = $row['idreg_transaccion'];
            array_push($array_idrgt,$idrgt);
        }
        return $array_idrgt;
    }
    // Obtiene idreg_transacciones de ingresos
    function select_sql_idregtran_ingresos($sql, $con) {
        $array_idrgi=[];
        foreach ($con->conexio->query($sql) as $row){
            $idrgi = $row['idreg_transaccion'];
            array_push($array_idrgi, $idrgi);
        }
        return $array_idrgi;
    }

    function select_sql_saldo($sql, $con) {
        $cont=0;
        foreach ($con->conexio->query($sql) as $row) {
            $cont++;
            $this->saldo_cuenta = $row['saldo_actual'];
            echo $this->saldo_cuenta;
        }
        if($cont==0){
            echo '*Cuenta inexistente. Compruebe si es correcta!';
        }
        return null;
    }

    function select_sql_saldoA($sql, $con) {
        $cont=0;
        foreach ($con->conexio->query($sql) as $row) {
            $cont++;
            $this->saldo_cuentaA = $row['saldo_actual'];
//            echo $this->saldo_cuentaA;
        }
        if($cont==0){
            echo '*Cuenta inexistente. Compruebe si es correcta!';
        }
        return $this->saldo_cuentaA;
    }
    function select_sql_saldoB($sql, $con) {
        $cont=0;
        foreach ($con->conexio->query($sql) as $row) {
            $cont++;
            $this->saldo_cuentaB = $row['saldo_actual'];
//            echo $this->saldo_cuentaB;
        }
        if($cont==0){
            echo '*Cuenta inexistente. Compruebe si es correcta!';
        }
        return $this->saldo_cuentaB;
    }

    // Obtiene idusuario
    function select_sql_idusuario($sql, $con) {
        $idusu="";
        foreach ($con->conexio->query($sql) as $row){
            $idusu = $row['idusuario'];
        }
        return $idusu;
    }

    // Obtiene idcuenta
    function select_sql_idcuentas($sql, $con) {
        $idcuenta="";
        foreach ($con->conexio->query($sql) as $row){
            $idcuenta = $row['idcuenta'];
        }
        return $idcuenta;
    }


    function select_sql_cuentas($sql){

        $con = new Conexio_db();

        $idcuenta="";

        foreach ($con->conexio->query($sql) as $row){  // $this->conexio->query($sql), seria igual a mysqli_query($query,$con->conexio);
            echo $row['idcuenta'] . "\t";
            echo $row['idusuario'] . "\t";
            echo $row['saldo_actual'] . "\t";
            echo $row['tipo'] . "</br>";
//            var_dump($row); echo "</br>";
            $idcuenta = $row['idcuenta'];

        }
        return $idcuenta;
    }

    // Get values table usuarios
    function select_sql_value_usuarios($sql){
        $con = new Conexio_DB();
        $campos=[];
        foreach ($con->conexio->query($sql) as $row){  // $this->conexio->query($sql), seria igual a mysqli_query($query,$con->conexio);
            $campos = array ($row['idusuario'],
                $row['name'],
                $row['apellido1'],
                $row['apellido2'],
                $row['dni'],
                $row['email'],
                $row['direccion'],
                $row['pass']);

        }
        return $campos;
    }

    function select_sql_usuarios($sql) {
        $con = new Conexio_DB();

        $lista_campos = array (
            array('ID', 'Name', 'Apellido1', 'Apellido2', 'Dni', 'Email', 'Dirección', 'Password', 'Hashpass')
        );

        foreach ($con->conexio->query($sql) as $row){  // $this->conexio->query($sql), seria igual a mysqli_query($query,$con->conexio);
            $campos = array ($row['idusuario'], $row['name'], $row['apellido1'], $row['apellido2'],$row['dni'],$row['email'],$row['direccion'],$row['pass']);
            array_push($lista_campos, $campos);
        }

        $tableusu = new Table();
        $tableusu->table_db_show(2, 8, $lista_campos);

        return $lista_campos;
    }

    // This function to control numero cuenta
    function select_cuenta($sql){
        $con = new Conexio_db();
        $row_array[]=null;
        foreach ($con->conexio->query($sql) as $row){
//            echo $row['num_cuenta'] . "</br>";
//            var_dump($row); echo "</br>";
            $row_array[] =  $row['num_cuenta'];
        }
//        print_r( $row_array );

        return $row_array;
    }


    // Return fechas values from table reg_transacciones
    function select_sql_db_fecha($sql, $con) {
        $fecha=null;
        foreach ($con->conexio->query($sql) as $row) {
            $fecha = $row['fecha'];
        }
        return $fecha;
    }
    function select_sql_db_last_id_reg_tran($sql, $con) {
        $idreg=null;
        foreach ($con->conexio->query($sql) as $row) {
            $idreg = $row['idreg_transaccion'];
        }
        return $idreg;
    }

    function select_sql_db_idreg($sql, $con) {

        $idregs = [];

        foreach ($con->conexio->query($sql) as $row) {
            $idreg = $row['idreg_transaccion'];
            array_push($idregs, $idreg);
        }

        return $idregs;
    }



    function select_sql_db_usuarios($sql, $con){
        $array_id=[];
        $array_name=[];
        $array_ap1=[];
        $array_ap2=[];
        $array_dni=[];
        $array_email=[];
        $array_dir=[];
        $array_pass=[];
        $array_hapa=[];

        foreach ($con->conexio->query($sql) as $row){

            $id = $row['idusuario'];
            $na = $row['name'];
            $ap1 = $row['apellido1'];
            $ap2 = $row['apellido2'];
            $dni = $row['dni'];
            $em = $row['email'];
            $dir = $row['direccion'];
            $pas = $row['pass'];
            $hapa = $row['hash_pass'];

            // Se insertan los elementos al final de cada uno de su array
            array_push($array_id, $id);
            array_push($array_name, $na);
            array_push($array_ap1, $ap1);
            array_push($array_ap2, $ap2);
            array_push($array_dni, $dni);
            array_push($array_email, $em);
            array_push($array_dir, $dir);
            array_push($array_pass, $pas);
            array_push($array_hapa, $hapa);

        }

        $lista_campos = array (
              array('ID', 'Name', 'Apellido1', 'Apellido2', 'Dni', 'Email', 'Dirección', 'Password', 'Hashpass')
        );

        $values_count = count($lista_campos[0]); // Obtenemos el numero de columnas del array 0
        $campos_count = count($array_id); // Obtenemos el total de array que se crearan, que sera igual al nombre de elementos

        for($i = 0; $i < $campos_count; $i++) { // Se definen las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }
        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $campos_count; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_id[$i], $array_name[$i], $array_ap1[$i], $array_ap2[$i], $array_dni[$i], $array_email[$i],
                    $array_dir[$i], $array_pass[$i], $array_hapa[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al finalde este
        }


        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--USUARIOS-- * Sobre ID podra acceder a otra información.</div>";
        $result_count = count($lista_campos); // Obtenemos el numero de valores del array

        //  Se crea fichero php para mostrar la información
        // Se crea sentencia sql para cada busqueda, así se incorporará al script, que cambiará con cada valor.
        $idvalue = fopen("idvalue.php", "w") or die("Unable to open file!");

        $ret = "echo '<br>';";
        $style = 'style="color:limegreen; text-decoration: underline;"';
        $style2 = 'style="width: 100%; height: 100%; white-space: nowrap;"';
        $label1 = "echo' <h3><label $style>Información adicional</label></h3>';";
        $label2 = "echo' <label $style>Seleccione fechas para ver transacciones.</label>';";
        $label3 = "echo' <label $style>Fechas de transacciones/ingresos</label>';";
        $label_fi = "echo' <label $style>Fecha inicio</label>';";
        $label_ff = "echo' <label $style>Fecha final</label>';";
        $pre_open = "echo '<pre id=".'"pre_tran"'." $style2>';";
        $pre_close = "echo '</pre>';";
        $pre_open_fechai = "echo '<pre id=".'"fechi"'." $style2>';";
        $pre_open_fechaf = "echo '<pre id=".'"fechf"'." $style2>';";
        $form_open_fechas = "echo '<form id=".'"form_fechas"'." action=".'"javascript:void(0);"'." method=".'"POST"'.">';";
        $form_close_fechas = "echo '</form>';";
        $input_submit_fechas= "echo '<input type=".'"submit"'." value=".'"Resultados"'." onclick=".'"transacciones();"'.">';";
        $simbol_size = 'size="5px" style="padding:5px;';
        $form_select_option = "
            echo '
                <form id=".'"formsel_tran"'." action=".'"javascript:void(0);"'." method=".'"POST"'.">
                    <select name=".'"fecha_select1"'." disabled $simbol_size>
                            <option value=".'""'.">Fechas</option>
            ';
                        for(".'$cont'." = 0; ".'$cont'." < ".'$count_fechas'."; ".'$cont'."++){
            echo '          <option value=".'"'." ';  echo ".' $array_fechas[$cont] '." ;  echo ' ".'"'."> '; echo ".' $array_fechas[$cont] '." ; echo '</option> ';
                        }
            echo '  </select >
                    <!-- <input id=".'"go"'." name=".'"go"'." type=".'"submit"'." value=".'"Go"'." onclick=".'"transacciones();"'."> -->
                </form>
            ';
        ";
        $href = " echo ' <input type=".'"submit"'." onclick=".'data_base();'." value=".'"<--"'."> '; ";
        $href_busqueda = " echo ' <input type=".'"submit"'." onclick=".'data_base();'." value=".'"< Nueva búsqueda"'."> '; ";

        $data = "'2014-02-01'";

        $fichero = '<?php session_start();


require_once (dirname(__FILE__)."/autoload_1.php");
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
        echo "ERROR NO ES POSIBLE ENTRE FECHAS IGUALES"; '.$href_busqueda.'}
    elseif( $añoi > $añof ) {
        echo "ERROR NO ES POSIBLE AÑO FINAL MENOR A AÑO INICIO"; '.$href_busqueda.'}
    elseif( ($añoi == $añof) && ( $mesi > $mesf ) ) {
        echo "ERROR NO ES POSIBLE MES FINAL MENOR A MES INICIO"; '.$href_busqueda.'}
    elseif( ($añoi == $añof) && ( $mesi == $mesf ) && ( $diai > $diaf ) ) {
        echo "ERROR NO ES POSIBLE DIA FINAL MENOR A DIA INICIO"; '.$href_busqueda.'}
    else{

        echo "Desde: " .$diai."-".$mesi."-".$añoi. " Hasta: ";
        echo $diaf."-".$mesf."-".$añof;

        // Aquí se mostrará los resultados de ingresos y transacciones comprendidas entre las fechas seleccionadas
        // Primero se obtendrán los idreg_transaccion entre las fechas comprendidas y después se accederá
        //  a los ingresos y traspasos para mostrarlos por pantalla

        $sql_idsregs = "SELECT idreg_transaccion FROM reg_transacciones
                        WHERE fecha >= '."'".'$fecha_inicio'."'".'
                        AND fecha <= '."'".'$fecha_final'."'".' ";
        $idsregs = $sql_se->select_idreg_reg_transacciones($sql_idsregs);

        // Ahora con idcuenta y el resultado de idreg_transacciones mostraremos los resultados de ingresos y transacciones
        // Primero se guardarà un array con los valores de ingresos y segundo con los de traspasos

        $count_idsregs = count($idsregs);

        $S_dival = $_SESSION["dival"]; // idcuenta pasado por session

        $sql_idc = "SELECT idcuenta FROM cuentas WHERE idusuario = '."'".'$S_dival'."'".' ";                  // idcuenta
        $idcu = $sql_se->select_idcuentas($sql_idc);

        // Se obtiene la ultima transaccion para marcar el saldo actual dentro de la tabla de forma dinámica, se mostrará en color azul
        $sql_last_tran_ingresos = "SELECT idreg_transaccion FROM ingresos WHERE idcuenta = '."'".'$idcu'."'".' ";
        $last_tran_ingre = $sql_se->select_last_reg_tran($sql_last_tran_ingresos);

        $sql_last_tran_traspasos = "SELECT idreg_transaccion FROM traspasos WHERE idcuenta_A = '."'".'$idcu'."'".'
                                                                            OR idcuenta_B = '."'".'$idcu'."'".' ";
        $last_tran_tras = $sql_se->select_last_reg_tran($sql_last_tran_traspasos);


        // Segun el mayor se utilizará uno u otro
        if($last_tran_ingre > $last_tran_tras){ $last_tran = $last_tran_ingre; }
        else{ $last_tran = $last_tran_tras; }

        // Se muestra el encabezado. Despues de muestra resultados
        // Ingresos
        echo $sql_se->select_db_ingresos_fechas_encabezado();
        for($i = $count_idsregs-1; $i >= 0; $i--) { // Inverso para resultados fechas ascendientes

            $sql_fecha = "SELECT fecha FROM reg_transacciones WHERE idreg_transaccion = '."'".'$idsregs[$i]'."'".'";
            $fecha = $sql_se->select_fechas_reg_transacciones($sql_fecha);

            $sql_ingresos = "SELECT * FROM ingresos WHERE idcuenta = '."'".'$idcu'."'".'
                                                    AND idreg_transaccion = '."'".'$idsregs[$i]'."'".'";
            echo $sql_se->select_db_ingresos_fechas_resultados($sql_ingresos, $fecha, $last_tran);
        }

        // Traspasos
        echo $sql_se->select_db_traspasos_fechas_encabezado();
        for($i = $count_idsregs-1; $i >= 0; $i--) { // Inverso para resultados fechas ascendientes

            $sql_fecha = "SELECT fecha FROM reg_transacciones WHERE idreg_transaccion = '."'".'$idsregs[$i]'."'".'";
            $fecha = $sql_se->select_fechas_reg_transacciones($sql_fecha);

            $sql_traspasos_A = "SELECT * FROM traspasos WHERE idcuenta_A = '."'".'$idcu'."'".'
                                                        AND idreg_transaccion = '."'".'$idsregs[$i]'."'".'";

            echo $sql_se->select_db_traspasos_fechas_resultadosA($sql_traspasos_A, $fecha, $last_tran);


            $sql_traspasos_B = "SELECT * FROM traspasos WHERE idcuenta_B = '."'".'$idcu'."'".'
                                                        AND idreg_transaccion = '."'".'$idsregs[$i]'."'".'";

            echo $sql_se->select_db_traspasos_fechas_resultadosB($sql_traspasos_B, $fecha, $last_tran);
        }

        '.$ret.'
        '.$href_busqueda.'

    }

}elseif( ( empty($_POST["dia_i"]) || empty($_POST["mes_i"]) || empty($_POST["mes_i"])  ||
           empty($_POST["dia_f"]) || empty($_POST["mes_f"]) || empty($_POST["año_f"])  )  && empty($dival) ){

    echo " * Error Campos vacíos! Ha de seleccionar fechas!";
    echo "Vuelva a escoger!";
    '.$href.'

}else { // Inicialmente se ejecuta

    $_SESSION["dival"] = $dival; // Para acceder dentro de otros se pasa desde aqui por session, ya que es donde se ejecuta defecto

    $sql = "SELECT * FROM cuentas WHERE idusuario = $dival";                            // cuentas
    $sql2 = "SELECT * FROM reg_usuarios WHERE idusuario = $dival";                      // reg_usuarios

    // Para adminis, se obtienen a traves de usuario
    $sql3 = "SELECT * FROM adminis WHERE idusuario = $dival";                           // adminis


    '.$label1.'
    '.$pre_open.'
        // Select para seleccionar datos segun fechas.
        '.$label2.'
        $opt = new Select_option();
        '.$form_open_fechas.'
            '.$pre_open_fechai.'
                '.$label_fi.''.$ret.'
                echo $opt->select_option_date("dia_i","mes_i","año_i");
            '.$pre_close.'
            '.$pre_open_fechaf.'
                '.$label_ff.''.$ret.'
                echo $opt->select_option_date("dia_f","mes_f","año_f");
            '.$pre_close.'
            '.$input_submit_fechas.'
        '.$form_close_fechas.'
        '.$ret.'


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
        '.$label3.'
        '.$form_select_option.'
        '.$ret.'

        //Mostrará los resultados de tabla especificado
        echo $sql_se->select_db_cuentas($sql);
        echo $sql_se->select_db_reg_usuarios($sql2);
        echo $sql_se->select_db_adminis($sql3);
    '.$pre_close.'
}
?>';
        fwrite($idvalue, $fichero);
        fclose($idvalue);

        //
        //

        // Imprime dinamicamente tabla con valores. Se crearan funcions js con cada cliente, donde se podra acceder a otras funciones.
        echo '<table style="border:2px solid limegreen; width: 100%;">';

            for($i = 0; $i < $result_count; $i++){
                echo '<tr style="border:2px solid limegreen;">';

                for($j = 0; $j < $values_count; $j++){
                    if($i == 0 ){ // Valores de datos de cabecera

                        echo "<td style='border:2px solid limegreen; text-align:center; background-color: palegreen; padding-left: 15px; padding-right: 15px;' >".$lista_campos[$i][$j]."</td>";

                    }elseif($j == 0 ){ // Valores ID, parte donde a traves del id se pordra acceder a otra informacion. Creará script js para cada selemento id

                        echo "<td style='border:2px solid limegreen;'>
                                <form id='form_db".$lista_campos[$i][$j]."' action='javascript:void(0);' method='post'>
                                    <input id='".$lista_campos[$i][$j]."' name='".$lista_campos[$i][$j]."' type='submit' style='text-align:center; font-weight:bold; background-color: palegreen ; width:100%;' onclick='id".$lista_campos[$i][$j]."();' value='".$lista_campos[$i][$j]."'>
                                    <input id='dival".$lista_campos[$i][$j]."' name='dival' hidden>
                                </form>
                                <script>
                                    // A continuacion se crean las funciones para cada botón de la tabla.
                                    // Tambien se creara fichero php para acceder a la base de datos y ejecutar sentencias sql. Hecho antes del script.
                                    idval_name = 'id".$lista_campos[$i][$j]."';
                                    window[idval_name] = function () {
                                        // Se obtiene el valor del element y se adjunta al element html correspondiente para acceder con php
                                        var idval = document.getElementById('".$lista_campos[$i][$j]."').value;
                                        document.getElementById('dival".$lista_campos[$i][$j]."').value = idval; // Se asigna el valor al input hidden de cada boton
                                        // when function load the own page button
                                        // Ajax para obtener values a traves de boton de id de cliente o usuario
                                        ajax_form('#form_db".$lista_campos[$i][$j]."','idvalue.php','#body1','POST');
                                    }
                                </script>
                              </td>";

                    }else{ // Valores de los datos

                        echo "<td style='border:2px solid limegreen; background-color:#E0FFD1; padding-left: 5px; padding-right: 5px;'>" . $lista_campos[$i][$j] . "</td>";

                    }
                }
                echo "</tr>";
            }
        echo '</table>';

        return null;
    }

    function select_sql_db_cuentas($sql, $con){
        $array_idc=[];
        $array_nc=[];
        $array_sa=[];
        $array_tipo=[];
        $array_idu=[];

        foreach ($con->conexio->query($sql) as $row){

            $idc = $row['idcuenta'];
            $nc = $row['num_cuenta'];
            $sa = $row['saldo_actual'];
            $tipo = $row['tipo'];
            $idu = $row['idusuario'];

            // Se insertan los elementos al final de cada uno de su array
            array_push($array_idc, $idc);
            array_push($array_nc, $nc);
            array_push($array_sa, $sa);
            array_push($array_tipo, $tipo);
            array_push($array_idu, $idu);

        }

        $array_ncu=[];

        // Se mira si num_cuenta es menor a 10 digitos, si es así se insertarán digitos 0 para mostrar
        $coun_array_nc = count($array_nc);
        for($i=0; $i<$coun_array_nc; $i++) {
            $rep_dig = ( 10 - strlen($array_nc[$i]) ); // numero de digitos que faltan para ser 10 digitos
            $dig = "0";
            // srt_repeat( $string, $num), repite un string un muero de veces
            array_push( $array_ncu , str_repeat($dig, $rep_dig).$array_nc[$i]) ;
        }

        $lista_campos = array (
            array('ID', 'Num.Cuenta', 'Saldo actual', 'Tipo', 'Id de usuario')
        );

        $values_count = count($lista_campos[0]); // Obtenemos el numero de columnas
        $campos_count = count($array_idc); // Obtenemos el total de array que se crearan

        for($i=0;$i<$campos_count;$i++) { // Se definen las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }
        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $campos_count; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_idc[$i], $array_ncu[$i], $array_sa[$i], $array_tipo[$i], $array_idu[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al finalde este
        }

        $result_count = count($lista_campos); // Obtenemos el numero de valores del array

        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO CLIENTES-- </div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $values_count, $lista_campos);

        return null;
    }

    function select_sql_db_adminis($sql, $con){

        $array_ida = [];
        $array_dep = [];
        $array_idu = [];

        foreach ($con->conexio->query($sql) as $row) {

            $ida = $row['idadmini'];
            $dep = $row['departamento'];
            $idu = $row['idusuario'];

            array_push($array_ida, $ida);
            array_push($array_dep, $dep);
            array_push($array_idu, $idu);
        }

        $lista_campos = array(
            array("Id de Administrador", "Departamento", "ID de Usuario")
        );

        $cont_col = count($lista_campos[0]); // Obtenemos el numero de columnas
        $cont_elementos = count($array_ida); // Obtenemos el total de array que se crearan, que sara igual al numero de elementos

        for($i=0;$i<$cont_elementos;$i++) { // Se definen las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }
        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $cont_elementos; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_ida[$i], $array_dep[$i], $array_idu[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al finalde este
        }

        $result_count = count($lista_campos); // Obtenemos de nuevo el numero de valores del array lleno

        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO ADMINISTRADORES--</div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $cont_col, $lista_campos);

        return null;

    }

    function select_sql_db_reg_usuarios($sql, $con) {

        $array_idru = [];
        $array_fecha = [];
        $array_hora = [];
        $array_tipo = [];
        $array_idu = [];

        foreach ($con->conexio->query($sql) as $row) {

            $idru = $row['idreg_usuario'];
            $fecha = $row['fecha'];
            $hora = $row['hora'];
            $tipo = $row['tipo'];
            $idu = $row['idusuario'];

            array_push($array_idru, $idru);
            array_push($array_fecha, $fecha);
            array_push($array_hora, $hora);
            array_push($array_tipo, $tipo);
            array_push($array_idu, $idu);
        }

        $lista_campos = array(
            array("Id de Reg. Usuario", "Fecha", "Hora", "Tipo", "Id de Usuario")
        );

        $cont_col = count($lista_campos[0]); // Obtenemos el numero de columnas
        $cont_elementos = count($array_idru); // Obtenemos el total de array que se crearan, que sara igual al numero de elementos

        for($i=0;$i<$cont_elementos;$i++) { // Se definen las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }
        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $cont_elementos; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_idru[$i], $array_fecha[$i], $array_hora[$i], $array_tipo[$i], $array_idu[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al finalde este
        }

        $result_count = count($lista_campos); // Obtenemos de nuevo el numero de valores del array lleno

        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO REGISTRO USUARIOS--</div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $cont_col, $lista_campos);

        return null;

    }

    function select_sql_db_reg_transacciones($sql, $con) {

        $array_idrt = [];
        $array_fecha = [];
        $array_hora = [];
        $array_tipo = [];
        $array_conc = [];

        foreach ($con->conexio->query($sql) as $row) {

            $idrt = $row['idreg_transaccion'];
            $fecha = $row['fecha'];
            $hora = $row['hora'];
            $tipo = $row['tipo'];
            $conc = $row['concepto'];

            array_push($array_idrt, $idrt);
            array_push($array_fecha, $fecha);
            array_push($array_hora, $hora);
            array_push($array_tipo, $tipo);
            array_push($array_conc, $conc);
        }

        $lista_campos = array(
            array("Id de Reg. Trasacciones", "Fecha", "Hora", "Tipo", "Concepto")
        );

        $cont_col = count($lista_campos[0]); // Obtenemos el numero de columnas
        $cont_elementos = count($array_idrt); // Obtenemos el total de array que se crearan, que sara igual al numero de elementos

        for($i=0;$i<$cont_elementos;$i++) { // Se definen las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }
        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $cont_elementos; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_idrt[$i], $array_fecha[$i], $array_hora[$i], $array_tipo[$i], $array_conc[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al finalde este
        }

        $result_count = count($lista_campos); // Obtenemos de nuevo el numero de valores del array lleno

        //        PARA valuesdemo
//        for($i = 0; $i < $result_count; $i++) {
////            for ($j = 0; $j < $values_count; $j++) {
//            $arra = implode('", "',$lista_campos[$i]);
//            echo ' "'.$arra.'"<br>';
////            }
//        }

        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO REGISTRO TRANSACCIONES--</div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $cont_col, $lista_campos);

        return null;

    }

    function select_db_ingresos_fechas_encabezado(){
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO INGRESOS-- </div>";

        $lista_campos =
            array('ID ', 'Saldo', 'Importe', 'Fecha')
        ;
        $cont_col = count($lista_campos); // Obtenemos el numero de columnas

        $tabla_usu = new Table();

        $tabla_usu->table_db_show_encabezado($cont_col, $lista_campos);
        return null;
    }
    function select_db_ingresos_fechas_resultados($sql, $fecha, $idreg_tra){

        $con = new Conexio_db();

        $last = false;

        $lista_campos = [];

        foreach ($con->conexio->query($sql) as $row) {

            $lista_campos = [ $row['idingreso'], $row['saldo_f'], $row['importe'], $fecha ];

            if($idreg_tra == $row['idreg_transaccion']){ // Se comprueba si es el último registro
                $last = true;
            }
        }

        $result_count = count($lista_campos);

        $tabla_usu = new Table();
        $tabla_usu->table_db_show_resultado($result_count, $lista_campos, $last);

        return null;
    }


    function select_sql_db_ingresos($sql, $con) {

        $array_idi = [];
        $array_sali = [];
        $array_salf= [];
        $array_imp = [];
        $array_idc = [];
        $array_idrt = [];

        foreach ($con->conexio->query($sql) as $row) {

            $idi = $row['idingreso'];
            $sali = $row['saldo_i'];
            $salf = $row['saldo_f'];
            $imp = $row['importe'];
            $idc = $row['idcuenta'];
            $idrt = $row['idreg_transaccion'];

            array_push($array_idi, $idi);
            array_push($array_sali, $sali);
            array_push($array_salf, $salf);
            array_push($array_imp, $imp);
            array_push($array_idc, $idc);
            array_push($array_idrt, $idrt);

        }

        $lista_campos = array (
            array('ID de Ingreso ', 'Saldo inicial', 'Saldo final ', 'Importe', 'Id de cuenta', 'Id de Reg. Trasacciones')
        );
        $cont_col = count($lista_campos[0]); // Obtenemos el numero de columnas
        $cont_elementos = count($array_idi); // Obtenemos el total de array que se crearan, que sra igual al numero de elementos

        for($i = 0; $i < $cont_elementos; $i++) { // Se inicializan las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }

        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $cont_elementos; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_idi[$i], $array_sali[$i], $array_salf[$i], $array_imp[$i], $array_idc[$i], $array_idrt[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al final de este
        }

        $result_count = count($lista_campos); // Obtenemos de nuevo el numero de valores del array lleno

        //        PARA valuesdemo
//        for($i = 0; $i < $result_count; $i++) {
////            for ($j = 0; $j < $values_count; $j++) {
//            $arra = implode('", "',$lista_campos[$i]);
//            echo ' "'.$arra.'"<br>';
////            }
//        }


        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO INGRESOS-- </div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $cont_col, $lista_campos);

        return null;
    }


    function select_db_traspasos_fechas_encabezado(){
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO TRASPASOS/COBROS-- </div>";

        $lista_campos =
            array('ID ', 'Saldo', 'Importe', 'Fecha')
        ;
        $cont_col = count($lista_campos); // Obtenemos el numero de columnas

        $tabla_usu = new Table();

        $tabla_usu->table_db_show_encabezado($cont_col, $lista_campos);
        return null;
    }
    function select_db_traspasos_fechas_resultadosA($sql, $fecha, $idreg_tra){

        $con = new Conexio_db();

        $lista_campos = [];

        $last = false;

        foreach ($con->conexio->query($sql) as $row) {
            $lista_campos = [ $row['idtraspaso'], $row['saldo_A_f'], (-1 * $row['importe']), $fecha ];

            if($idreg_tra == $row['idreg_transaccion']){ // Se coprueba si es el último registro
                $last = true;
            }
        }

        $result_count = count($lista_campos);

        $tabla_usu = new Table();
        $tabla_usu->table_db_show_resultado($result_count, $lista_campos, $last);

        return null;
    }
    function select_db_traspasos_fechas_resultadosB($sql, $fecha, $idreg_tra){

        $con = new Conexio_db();

        $lista_campos = [];

        $last = false;


        foreach ($con->conexio->query($sql) as $row) {
            $lista_campos = [ $row['idtraspaso'], $row['saldo_B_f'], $row['importe'], $fecha ];

            if($idreg_tra == $row['idreg_transaccion']){ // Se coprueba si es el último registro
                $last = true;
            }
        }

        $result_count = count($lista_campos);

        $tabla_usu = new Table();
        $tabla_usu->table_db_show_resultado($result_count, $lista_campos, $last);

        return null;
    }

    function select_sql_db_traspasos($sql, $con) {

        $array_idt = [];
        $array_sali_A = [];
        $array_salf_A = [];
        $array_sali_B = [];
        $array_salf_B = [];
        $array_imp = [];
        $array_idc_A = [];
        $array_idc_B = [];
        $array_idrt = [];

        foreach ($con->conexio->query($sql) as $row) {

            $idt = $row['idtraspaso'];
            $sali_A = $row['saldo_A_i'];
            $salf_A = $row['saldo_A_f'];
            $sali_B = $row['saldo_B_i'];
            $salf_B = $row['saldo_B_f'];
            $imp = $row['importe'];
            $idcA = $row['idcuenta_A'];
            $idcB = $row['idcuenta_B'];
            $idrt = $row['idreg_transaccion'];


            array_push($array_idt, $idt);
            array_push($array_sali_A, $sali_A);
            array_push($array_salf_A, $salf_A);
            array_push($array_sali_B, $sali_B);
            array_push($array_salf_B, $salf_B);
            array_push($array_imp, $imp);
            array_push($array_idc_A, $idcA);
            array_push($array_idc_B, $idcB);
            array_push($array_idrt, $idrt);

        }

        $lista_campos = array (
            array('ID de traspaso', 'Saldo origen inicial', 'Saldo origen final ', 'Saldo destino inicial', 'Saldo destino final',
                'Importe', 'Id cuenta origen', 'Id cuenta destino', 'Id de Reg. Trasacciones')
        );
        $cont_col = count($lista_campos[0]); // Obtenemos el numero de columnas
        $cont_elementos = count($array_idt); // Obtenemos el total de array que se crearan, que sra igual al numero de elementos

        for($i = 0; $i < $cont_elementos; $i++) { // Se inicializan las variables dinamicas de array
            if (empty(${'arr'.$i})) {
                ${'arr'.$i} = null;
            }
        }

        // Creamos los arrays dinamicamente e introducimos seguidamente del array lista_campos
        for($i = 0; $i < $cont_elementos; $i++) {
            $arr = (${'arr'.$i}); // damos valores numericos a la variable para tener variales de forma dinamica
            $arr = [$array_idt[$i], $array_sali_A[$i], $array_salf_A[$i], $array_sali_B[$i], $array_salf_B[$i],
                $array_imp[$i], $array_idc_A[$i], $array_idc_B[$i], $array_idrt[$i]];
            array_push($lista_campos, $arr); // Se insertan los valores dentro del array principal al final de este
        }

        $result_count = count($lista_campos); // Obtenemos de nuevo el numero de valores del array lleno

        //        PARA valuesdemo
//        for($i = 0; $i < $result_count; $i++) {
////            for ($j = 0; $j < $values_count; $j++) {
//            $arra = implode('", "',$lista_campos[$i]);
//            echo ' "'.$arra.'"<br>';
////            }
//        }

        echo "</br>";
        echo "<div style='color:limegreen; text-decoration: underline;'>--INFO TRASPASOS-- </div>";

        $tabla_usu = new Table();
        $tabla_usu->table_db_show($result_count, $cont_col, $lista_campos);

        return null;
    }


    function __destruct(){}

}