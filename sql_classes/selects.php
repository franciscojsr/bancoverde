<?php


Class Selects extends Select_sql{

    private $sql_session;


    private $sql_form;
    private $sql_form1;
    private $sql_form2;
    private $sql_form3;

    // Select para iniciar session
    function select_session() {
        $this->sql_session = 'SELECT hash_pass FROM usuarios WHERE dni = "' . $_POST['dni'] . '"';
        $this->select_sql_session($this->sql_session, new Conexio_db());
        return null;
    }

    // Select ejemplo
    function selects1(){

        $sql1 = 'SELECT * FROM cuentas';
        $sql2 = 'SELECT * FROM cuentas WHERE saldo_actual > 1200';

//        $this->select_sql($sql1);
//        $this->select_sql($sql2);

        // Hacemos un for, si se usan muchas sentencias, asi no hay que ir introduciendo la misma funcion cada que queramos hacer sentencias.
        for($i=1; $i<=2; $i++){
            $sql = (${'sql'.$i}); // Con esto anexamos un numero a la variable, asi nos dará las consultas a realizar
            $this->select_sql_cuentas($sql);
        }
    }

    // Set color background elements
    public function style_background($color, $id1, $id2) {
        echo '
            <script>
                var a = document.getElementById("'.$id1.'");
                var b = document.getElementById("'.$id2.'");
                a.style.backgroundColor = "'.$color.'";
                b.style.backgroundColor = "'.$color.'";
            </script>
        ';
        if($color == "#E0FFD1"){
            echo '
            <script>
                var subm = document.getElementById("sub_consults");
                subm.disabled=false;
            </script>
        ';
        }else {
            echo '
            <script>
                var subm = document.getElementById("sub_consults");
                subm.disabled=true;
            </script>
        ';
        }
    }
    // Select consultas
    function select2()
    {

        $id = $_GET['id'];
        $name = $_GET['name'];
        $dni = $_GET['dni'];

        $this->sql_form1 = 'SELECT * FROM usuarios WHERE idusuario = "' . $id . '"';
        $this->sql_form2 = 'SELECT * FROM usuarios WHERE name = "' . $name . '"';
        $this->sql_form3 = 'SELECT * FROM usuarios WHERE dni = "' . $dni . '"';

//      Llamamos a:
//                  $this->select_sql_cuentas($this->sql_form1);
//      y miramos si hay coincidencias o no. En caso afirmativo se mostrará los resultados.

        if ($id == null && $name == null && $dni == null) {
            echo '<div style="color:red;">* Rellene un campo como mínimo</div>';
            self::style_background("transparet", "name", "dni"); // Set color inputs
        }
        if ($id != null || $name != null || $dni != null) {
            echo '<div style="color:deepskyblue;">* Campo mínimo introducido.</div>';
            if($id !=null){
                if( !is_numeric($id) ){ // Se comprueba valores numericos
                    echo '<div style="color:red;">* Id no válido. No numérico.</div>';
                    echo '<input id="valname" name="valname" value="Nombre *" hidden>'; // passing value to js if no value
                    echo '<input id="valdni" name="valdni" value="Dni *" hidden>'; // passing value to js if no value
                    self::style_background("#FAEBE6", "name", "dni"); // Set color inputs
                }else {
                    if ($this->select_idusuario($this->sql_form1) == null) {
                        echo '<div><span style="color:red;">* Id sin coincidencias.</span> <span class="wait"></span></div>';
                        echo '<input id="valname" name="valname" value="Nombre *" hidden>'; // passing value to js if no value
                        echo '<input id="valdni" name="valdni" value="Dni *" hidden>'; // passing value to js if no value
                        self::style_background("#FAEBE6", "name", "dni"); // Set color inputs
                    } else {
//                    $this->select_usuarios($this->sql_form1);
                        $valname = $this->select_value_usuarios($this->sql_form1)[1]; // name
                        $valdni = $this->select_value_usuarios($this->sql_form1)[4]; // dni
                        echo '<input id="valname" name="valname" value="' . $valname . '" hidden>'; // passing value to js
                        echo '<input id="valdni" name="valdni" value="' . $valdni . '" hidden>'; // passing value to js
                        self::style_background("#E0FFD1", "name", "dni"); // Set color inputs
                    }
                }
            }elseif($name != null){
                if ( $this->select_idusuario($this->sql_form2) == null ) {
                    echo '<div><span style="color:red;">* Nombre sin coincidencias.</span> <span class="wait"></span></div>';
                    echo '<input id="valid" name="valid" value="Id *" hidden>';
                    echo '<input id="valdni" name="valdni" value="Dni *" hidden>';
                    self::style_background("#FAEBE6", "id", "dni"); // Set color inputs
                }else{
//                    $this->select_usuarios($this->sql_form2);
                    $valid = $this->select_value_usuarios($this->sql_form2)[0]; // id
                    $valdni = $this->select_value_usuarios($this->sql_form2)[4]; // dni
                    echo '<input id="valid" name="valid" value="'.$valid.'" hidden>';
                    echo '<input id="valdni" name="valdni" value="'.$valdni.'" hidden>';
                    self::style_background("#E0FFD1", "id", "dni"); // Set color inputs
                }
            }else{
                if ( $this->select_idusuario($this->sql_form3) == null ) {
                    echo '<div><span style="color:red;">* Dni sin coincidencias.</span> <span class="wait"></span></div>';
                    echo '<input id="valid" name="valid" value="Id *" hidden>';
                    echo '<input id="valname" name="valname" value="Nombre *" hidden>';
                    self::style_background("#FAEBE6", "id", "name"); // Set color inputs
                }else{
//                    $this->select_usuarios($this->sql_form3);
                    $valid = $this->select_value_usuarios($this->sql_form3)[0]; // id
                    $valname = $this->select_value_usuarios($this->sql_form3)[1]; // name
                    echo '<input id="valid" name="valid" value="'.$valid.'" hidden>';
                    echo '<input id="valname" name="valname" value="'.$valname.'" hidden>';
                    self::style_background("#E0FFD1", "id", "name"); // Set color inputs
                }
            }

        }

        echo '
            <style>
                input.placehold-color::-webkit-input-placeholder{
                    color: deepskyblue;
                }
            </style>
            <script>

                var valid = document.getElementById("valid"); // Valor dni a introducir en input
                var valdni = document.getElementById("valdni"); // Valor dni a introducir en input
                var valname = document.getElementById("valname"); // Valor name a introducir en input

                var camp_id = document.getElementById("id");
                var camp_name = document.getElementById("name");
                var camp_dni = document.getElementById("dni");

                if(camp_id.value != ""){
                    camp_name.className = "placehold-color";
                    camp_name.placeholder = valname.value;
                    camp_name.readOnly = true;
                    camp_name.style.color = "deepskyblue";
                    camp_dni.className = "placehold-color";
                    camp_dni.placeholder = valdni.value;
                    camp_dni.readOnly = true;
                    camp_dni.style.color = "deepskyblue";
                }else if(camp_name.value != ""){
                    camp_id.className = "placehold-color";
                    camp_id.placeholder = valid.value;
                    camp_id.readOnly=true;
                    camp_id.style.color="deepskyblue";
                    camp_dni.className = "placehold-color";
                    camp_dni.placeholder = valdni.value;
                    camp_dni.readOnly=true;
                    camp_dni.style.color="deepskyblue";
                }else if(camp_dni.value!=""){
                    camp_id.className = "placehold-color";
                    camp_id.placeholder = valid.value;
                    camp_id.readOnly=true;
                    camp_id.style.color="deepskyblue";
                    camp_name.className = "placehold-color";
                    camp_name.placeholder = valname.value;
                    camp_name.readOnly=true;
                    camp_name.style.color="deepskyblue";
                }else{
                    camp_id.className = "";
                    camp_id.placeholder = "Id *";
                    camp_id.readOnly=false;
                    camp_id.style.backgroundColor="";
                    camp_id.style.color="";
                    camp_name.className = "";
                    camp_name.placeholder = "Nombre *";
                    camp_name.readOnly=false;
                    camp_name.style.backgroundColor="";
                    camp_name.style.color="";
                    camp_dni.className = "";
                    camp_dni.placeholder = "Dni *";
                    camp_dni.readOnly=false;
                    camp_dni.style.backgroundColor="";
                    camp_dni.style.color="";
                }
            </script>
        ';




//        $security = new Secure_sql();
//        $security->entrar_cadena($id);
//        echo $security->preparar_SQL2(new Conexio_DB());

    }


    // Select saldos
    function select_saldo($sql) {
        $this->select_sql_saldo($sql, new Conexio_db());
        return null;
    }
    // Para la clase Cuenta
    function select_saldoA($sql) {
        $this->select_sql_saldoA($sql, new Conexio_db());
        return null;
    }
    function select_saldoB($sql) {
        $this->select_sql_saldoB($sql, new Conexio_db());
        return null;
    }

    // Select data bases muestra
    function select_db_adminis($sql){
        $this->select_sql_db_adminis($sql, new Conexio_db());
        return null;
    }
    function select_db_reg_usuarios($sql){
        $this->select_sql_db_reg_usuarios($sql, new Conexio_db());
        return null;
    }
    function select_db_usuarios($sql){
        $this->select_sql_db_usuarios($sql, new Conexio_db());
        return null;
    }
    function select_db_cuentas($sql){
        $this->select_sql_db_cuentas($sql, new Conexio_db());
        return null;
    }
    function select_db_reg_transacciones($sql) {
        $this->select_sql_db_reg_transacciones($sql, new Conexio_db());
        return null;
    }
    function select_db_ingresos($sql) {
        $this->select_sql_db_ingresos($sql, new Conexio_db());
        return null;
    }
    function select_db_traspasos($sql) {
        $this->select_sql_db_traspasos($sql, new Conexio_db());
        return null;
    }

    function select_usuarios($sql){
        $this->select_sql_usuarios($sql);
        return null;
    }
    function select_value_usuarios($sql){
        return $this->select_sql_value_usuarios($sql);
    }

    function select_idusuario($sql) {
        return $this->select_sql_idusuario($sql, new Conexio_db());
    }
    function select_idcuentas($sql) {
        return $this->select_sql_idcuentas($sql, new Conexio_db());
    }
    function select_cuentas($sql) {
        return $this->select_sql_cuentas($sql, new Conexio_db());
    }
    function select_idregtran_traspasos($sql) {
        return $this->select_sql_idregtran_traspasos($sql, new Conexio_db());
    }
    function select_idregtran_ingresos($sql) {
        return $this->select_sql_idregtran_ingresos($sql, new Conexio_DB());
    }
    function select_fechas_reg_transacciones($sql){
        return $this->select_sql_db_fecha($sql, new Conexio_db());
    }
    function select_last_reg_tran($sql){
        return $this->select_sql_db_last_id_reg_tran($sql, new Conexio_db());
    }

    function select_idreg_reg_transacciones($sql){
        return $this->select_sql_db_idreg($sql, new Conexio_db());
    }



}