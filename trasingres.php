<?php session_start(); ?>

<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$saldo_opera = new Cuenta();

$css = ' style="background-color: transparent; border: transparent; box-shadow: none;" ';

if( empty($_POST['importe']) ){ $_POST['importe']=null; }
if( empty($_POST['radio']) ){ $_POST['radio']=null; }
if( empty($_POST['status']) ){ $_POST['status']=null; }
if( empty($_POST['alert']) ){ $_POST['alert']=null; }
if( empty($next_ori) ){ $next_ori = "false"; }
if( empty($next_des) ){ $next_des = "false"; }

?>

    <script>
        var ingre = document.getElementById('ingreso');
        var trasp = document.getElementById('traspaso');
        var orig = document.getElementById('origen');
        var dest = document.getElementById('destino');
        var impo = document.getElementById('importe');

        var tras_ingre_button = document.getElementById("sub_tras_ingre");
        var mes_dis = document.getElementById("mess_disabled");
        var div_mes_dis_sub = document.getElementById("mess_dis_sub");

        var mess_ori = document.getElementById("messori");
        var mess_des = document.getElementById("messdes");
        var val_num_ori = document.getElementById("valor_num_ori");
        var val_num_des = document.getElementById("valor_num_des");
        var num_carac_ori = 0;
        var num_carac_des = 0;
        var i;
        var status;
        var status_input = document.getElementById("status");

        function boton_disable_true() {
            tras_ingre_button.style.backgroundColor="#f7ecb5";
            tras_ingre_button.style.color="deepskyblue";
            tras_ingre_button.disabled=true;
            mes_disabled(); // No activado mostrara -> X
            status="nok";
            status_input.value = status;
        }
        function boton_disable_false() {
            tras_ingre_button.style.backgroundColor = "";
            tras_ingre_button.style.color = "";
            tras_ingre_button.disabled = false;
            mes_diss_leave(); // Activado mostrara -> √
            status="ok";
            status_input.value = status;
        }

        if( ingre.checked ) { $("#messori").hide(); }

    </script>

    <script>
        // Aquí controlamos que se ingresa o traspasa los campos correctamente
        //Al clickar radio ingreso, se desactiva cuenta de origen y cambia estilo css
        ingre.addEventListener("mousedown",function(){
            trasp.disabled=false;
            orig.value=null;
            orig.style.backgroundColor = "#f7ecb5";
            orig.readOnly="readonly";
            orig.placeholder="No necesario *";
        });
        //Al clickar radio traspaso, se activa cuenta de origen y cambia estilo css
        trasp.addEventListener("mousedown",function(){
            ingre.disabled=false;
            orig.style.backgroundColor = "white";
            orig.placeholder="Cuenta origen *";
            orig.readOnly="";
        });
        // Se habilitan los radios cuando hay valores en los campos específicos
        if( orig.value!="" && dest.value!="" && impo.value!="" ){ trasp.disabled=false; }
        if( orig.value=="" && dest.value!="" && impo.value!="" ){ ingre.disabled=false; }
        // Se deshabilita el boton de traspaso e ingreso, hasta que los campos son correctos
        if( orig.value=="" || dest.value=="" || impo.value==""){
            tras_ingre_button.style.backgroundColor="#f7ecb5";
            tras_ingre_button.style.color="deepskyblue";
            tras_ingre_button.disabled=true;
        }
        // Si se intenta enviar con boton desaccivado aparecerá mensaje de informacion
        function mes_disabled(){
            mes_dis.value="X";
            mes_dis.style.display="inline";
            mes_dis.style.position="absolute";
            mes_dis.style.left="340px";
            mes_dis.style.textAlign="center";
            mes_dis.style.fontWeight="bold";
            mes_dis.style.fontSize="14px";
            mes_dis.style.width="26px";
            mes_dis.style.borderRadius="50%";
            mes_dis.style.color="black";
            mes_dis.style.backgroundColor="red";
        }
        function mes_diss_leave(){
            mes_dis.value="√";
            mes_dis.style.backgroundColor="limegreen";
        }
        if(tras_ingre_button.disabled==true){ mes_disabled(); }
        if(tras_ingre_button.disabled==false){ mes_diss_leave(); }
    </script>

    <div id="salori" style="color:deepskyblue;">
<?php
        $A="";
        $saldo_opera->definir_cuenta($_POST['origen']);
        echo 'Saldo origen:';
        if($_POST['valor_num_ori']==10) {
            $A = $saldo_opera->obtener_saldoA();
            if( $A != null ){ $next_ori="true"; echo $A;}
            else{ $next_ori="false";}
        }
        else{ $next_ori="false";}

?>
        <input "<?php echo $css;?>" type="text" size="40" id="messori" value="<?php echo"€. Faltan "; echo 10-$_POST['valor_num_ori']; echo " dígitos."; ?>" disabled>

    </div>
    <div id="saldes" style="color:deepskyblue;">
<?php
        $B="";
        $saldo_opera->definir_cuenta($_POST['destino']);
        echo 'Saldo destino: ';
        if($_POST['valor_num_des']==10) {
            $B = $saldo_opera->obtener_saldoB();
            if( $B != null ) { $next_des = "true"; echo $B;}
            else{ $next_des="false";}
        }
        else{ $next_des="false";}

?>
        <input "<?php echo $css;?>" type="text" size="40" id="messdes" value="<?php echo"€. Faltan "; echo 10-$_POST['valor_num_des']; echo " dígitos."; ?>" disabled>

    </div>

<?php
    // Cuando los campos son correctos y hay un importe y se selecciona traspaso o ingreso, se habilita el boton de envío.
    // Se deshabilita el boton de trasaso e ingreso, hasta que los campos son correctos.

    if( ($next_ori == "true" && $next_des == "true") ){
//        echo $next_ori."1///".$next_des;
?>
        <script>
            if( impo.value!="" && trasp.checked ) { boton_disable_false(); }
        </script>
<?php
    }
    elseif( ($next_ori == "false" && $next_des == "true") ){
//        echo $next_ori."/2//".$next_des;
?>
        <script>
            if( impo.value!="" && ingre.checked ) { boton_disable_false(); $("#mess_ori").hide(); }
            if( impo.value!="" && trasp.checked ) { boton_disable_true(); }
        </script>
<?php
    }
    elseif( ($next_ori == "true" && $next_des == "false") || ($next_ori == "false" && $next_des == "false") ){
//        echo $next_ori."///3".$next_des;
?>
        <script>
            boton_disable_true();
        </script>
<?php
    }
?>

<script>
    // Comprobamos la entrada de caracteres y ejecutamos php al llegar a 10 caracteres
//    (function loop_carac(){ // No es necesario ya que el script ya es ejecutado dentro de un loop
//        var num_carac = 0;
        for( i = 0; i < orig.value.length; i++ ) {
            num_carac_ori++;
        }
        if(num_carac_ori > 10){
            mess_ori.value="* Más de 10 Digitos no permitidos.";
        }
        for( i = 0; i < dest.value.length; i++ ) {
            num_carac_des++;
        }
        if(num_carac_des > 10){
            mess_des.value="* Más de 10 Digitos no permitidos.";
        }
//        setTimeout(loop_carac,1000)
//    })()

    // Se pasa valores a input hidde para acceder desde php
    val_num_ori.value = num_carac_ori;
    val_num_des.value = num_carac_des;

    validad_num();

    function validad_num() {
        if (!/^([0-9])*$/.test(orig.value)) {
            mess_ori.value = "* Cuenta no válida";
            boton_disable_true();
        }
        if (!/^([0-9])*$/.test(dest.value)) {
            mess_des.value = "* Cuenta no válida";
            boton_disable_true();
        }
        if (!/^([0-9])*$/.test(impo.value)) {
            mess_des.value = mess_des.value + "* Importe no válido";
            boton_disable_true();
        }
    }
</script>
<script>
    var div_alert_jq = $("#alert_mess");
    var div_alert = document.getElementById("alert_mess");
    var alert_ok = document.getElementById("alok");
    var alert_nok = document.getElementById("alno");
    var al_mess = document.getElementById("alert");
    var doc_opa = document.body.style.opacity;


    function open_message(){

//        alert(window.outerWidth/2);
//        alert(window.innerHeight/2);
//        alert(window.outerWidth/2);

        div_alert.style.display="inline";
        div_alert.style.zIndex="100";
        div_alert.style.position="absolute";
        div_alert.style.textAlign="center";
        div_alert.style.fontSize="20px";
        div_alert.style.left="0";
        div_alert.style.top="0";
        div_alert.style.paddingTop="40px";
        div_alert.style.paddingBottom="80px";
        div_alert.style.height="100px";
        div_alert.style.width="100%";
        div_alert.style.backgroundColor="deepskyblue";
        div_alert.style.color="white";
        div_alert.style.border="5px solid blue";
        div_alert.style.borderRadius="15px";
        doc_opa="0.3";
        div_alert.style.opacity="1";
        doc_opa.disabled="true";

    }
    function close_ok(){
        al_mess.value = "ok";
        doc_opa="1";
        div_alert_jq.hide(1000);
    }
    function close_nok(){
        al_mess.value = "nok";
        doc_opa="1";
        div_alert_jq.hide(1000);
    }
</script>

<?php

    // Si se clicka ok, se raliza el traspaso/ingreso
    if( $_POST['alert']=="ok" ) {
        if($_POST['concepto']==null){
            echo '<script>
                alert("Concepto ha de estar completado");
            </script>
            ';
        }else {
            // Si loa campos son correctos se realiza el traspaso/ingreso
            if ($_POST['status'] == "ok" && $A != "" && $B != "") { // traspaso

                $saldo_opera->definir_cuenta($_POST['destino']);
                echo $saldo_opera->traspaso_saldo($_POST['origen'], $_POST['destino'], $A, $B, $_POST['importe']);

            } elseif ($_POST['status'] == "ok" && $B != "") {        // ingreso

                $saldo_opera->definir_cuenta($_POST['destino']);
                echo $saldo_opera->ingreso_saldo($_POST['destino'], $B, $_POST['importe']);

            }
        }
    }