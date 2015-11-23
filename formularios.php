<?php


class Formularios {

    private $form;

    function form_session() {
        $size = ' size="14" ';
        $pad = 'style="padding-bottom: 5px;"';
        $style_border = '
            style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "
        ';

        // Se usa
        //          javascript:void(0);
        // para que no redirija el formulario, y se usa ajax para obtener valores para pasar a php
        // Al usar ajax seran accesibles los valores del form en php, sin necesidad de enviar el formulario mediante action
        $this->form = '
            <h3><label style="color:limegreen; text-decoration: underline;">Inicio Sesión</label></h3>

            <form id="form_session" action="javascript:void(0);" method="POST">
                <div ' . $pad . '>
                    <input id="name" type="text" name="dni" placeholder="Dni *" autofocus  ' . $size . '' . $style_border . '>
                    <input id="dni" type="password" name="pass" placeholder="Password *" autofocus  ' . $size . '' . $style_border . '>
                </div>
                <input type="submit" name="sub_session" onclick="session(); session_profile();" Value="Sing in" ' . $style_border . '>
            </form>

            <div><label>* Acceso con DNI y clave de acceso. Si no dispone de una, consulte con su Banco Verde.</label></div>
        ';


        return $this->form;
    }

    function form_register() {

        $size = ' size="14" ';
        $size1 = ' size="34" ';
        $size2 = ' size="54" ';
        $pad = 'style="padding-bottom: 5px; font-size:12px;"';
        $color_green = 'style="color:limegreen; padding-left:5px;"';
        $style_border = ' style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; " ';

        $this->form = '
            <h3><label style="color:limegreen; text-decoration: underline;">Registro de nuevo usuario</label></h3>

            <form id="form_register" action="" method="post">
                <div '.$pad.'>
                    <input id="name" type="text" name="name" placeholder="Nombre *" autofocus required '.$size.''.$style_border.'>
                    <input type="text" name="apellido1" placeholder="Apellido 1 *" autofocus required '.$size.''.$style_border.'>
                    <input type="text" name="apellido2" placeholder="Apellido 2 *" autofocus required '.$size.''.$style_border.'>
                </div>
                <div '.$pad.'>
                    <input type="text" name="dni" placeholder="Dni *" autofocus required '.$size.''.$style_border.'>
                    <input type="text" name="email" placeholder="Email *" autofocus required '.$size1.''.$style_border.'>
                </div>
                <div '.$pad.'>
                    <input type="text" name="direccion" placeholder="Dirección *" autofocus required '.$size2.$style_border.'>
                </div>
                <div style="font-size:12px;">
                    <select id="tip_usu" name="tipo_usuario" '.$style_border.' required>
                        <option value="">Tipo usuario</option>
                        <option value="Cliente">Cliente</option>
                        <option value="Usuario bancario">Usuario bancario</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                    <select id="sel_dept" name="departamento" '.$style_border.' required>
                        <option value="">Departamentos</option>
                        <option value="null">Sin departamento</option>
                        <option value="Operaciones">Operaciones</option>
                        <option value="Financiación">Financiación</option>
                        <option value="Crédito">Crédito</option>
                        <option value="Gerencia">Geréncia</option>
                        <option value="Administración">Administración</option>
                    </select>
                    <input name="tipo_transaccion" value="Registro" hidden>
                </div>
                <div style="font-size:12px;">
                    <input type="radio" name="tipo_cuenta" value="Ahorro" required '.$style_border.' '.$color_green.'>
                    <label id="" '.$color_green.'>Cuenta de ahorro *</label>
                    <input type="radio" name="tipo_cuenta" value="Corriente"required '.$style_border.' '.$color_green.'>
                    <label id="" '.$color_green.'>Cuenta corriente *</label>
                </div>
                <div '.$pad.'>
                    <input type="text" name="saldo_registro" placeholder="Saldo inicial *" '.$style_border.' required>
                    <label id="" '.$color_green.'>* Saldo inicial mínimo de 1€ para clientes.</label>
                </div>
                <div '.$pad.'>
                    <input type="submit" name="sub" onclick="" value="Registro" '.$style_border.'>
                </div>
            </form>

            <div><label id="">* Campos obligatorios.</label></div>

            <script>
                // Para controlar si es un cliente no se entrará departamento

                var tipusu = document.getElementById("tip_usu");
                var seldep = document.getElementById("sel_dept");

                tipusu.addEventListener("change", function(){
                    if(tipusu.value=="Cliente"){
                        seldep.value = "null";
//                        seldep.disabled = true;
                    }else{
                        seldep.value = "";
//                        seldep.disabled = false;
                    }
                });

                seldep.addEventListener("change", function(){ // Se asegura que no se introduce otro valor
                    if(tipusu.value=="Cliente"){
                        seldep.value = "null";
                        alert("No es posible asignat departamento a un cliente.");
                    }else{
                        if(seldep.value =="null"){
                            seldep.value = "";
                            alert("Sin departamento no es posible para este usuario.");
                        }
                    }
                });
            </script>
        ';

        return $this->form;
    }

    function form_consults()
    {


        $size = ' size="14" ';
        $pad = 'style="padding-bottom: 5px; font-size:12px;""';
        $style_border = '
            style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "
        ';

        // Se usa
        //          javascript:void(0);
        // para que no redirija el formulario, y se usa ajax para obtener valores para pasar a php
        // Al usar ajax seran accesibles los valores del form en php, sin necesidad de enviar el formulario mediante action
        $this->form = '
            <h3><label style="color:limegreen; text-decoration: underline;">Consultas clientes</label></h3>

            <form id="form_consults" name="form_consults" action="javascript:void(0);" method="GET">
                <div ' . $pad . '>
                    <input id="id" type="text" name="id" placeholder="Id *" onfocus="sql_consulauto()" ' . $size . '' . $style_border . '>
                    <input id="name" type="text" name="name" placeholder="Nombre *"  onfocus="sql_consulauto()" ' . $size . '' . $style_border . '>
                    <input id="dni" type="text" name="dni" placeholder="Dni *"  onfocus="sql_consulauto()" ' . $size . '' . $style_border . '>
                </div>
                <input id="sub_consults" type="submit" name="sub_consults" onclick="sql_consul()" value="Consulta" ' . $style_border . ' disabled>
            </form>
            <div id="consulauto" style="color:deepskyblue;">
                <div><label>* Seleccione tipo de búsqueda. Un campo permitido.</label></div>
            </div>


            <script>
                // Se ejecuta indefinidamente, un proceso empieza cuando acaba el otro. Justo en onfocus
                (function loopsform(){
                    $("#form_consults").submit();
//                      setTimeout(arguments.callee,1000)
                        setTimeout(loopsform,1000)
                })()
            </script>


        ';


        return $this->form;

    }

    function form_operaciones() {

        $size = 'size="16"';
        $simbol_size = 'size="2"';
        $pad = 'style="padding-bottom: 5px; font-size:12px;"';
        $style_border = 'style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "';
        $color_dec = 'style="color:limegreen; text-decoration: underline;"';
        $color_green = 'style="color:limegreen;"';
        $color_blue = 'style="color:deepskyblue;"';

        // Se usa
        //          javascript:void(0);
        // para que no redirija el formulario, y se usa ajax para obtener valores para pasar a php
        // Al usar ajax seran accesibles los valores del form en php, sin necesidad de enviar el formulario mediante action
        $this->form = '
            <h3><label '.$color_dec.'>Operaciones</label></h3>
            <h3><label '.$color_dec.'>Sumas</label></h3>

            <form id="form_suma" action="javascript:void(0);" method="POST">
                <div ' . $pad . '>
                    <input id="valor2" type="text" name="valor1" placeholder="Valor 1"   ' . $size . '' . $style_border . '>
                    <input id="" type="" value="  +" disabled ' . $simbol_size . '' . $style_border . '>
                    <input id="valor1" type="text" name="valor2" placeholder="Valor 2"   ' . $size . '' . $style_border . '>
                    <input id="" type="submit" onclick="suma();" value="=" ' . $simbol_size . '' . $style_border . '>
                    <label id="res_mas" '.$color_blue.'>Resultado</label>
                </div>
            </form>

            <h3><label '.$color_dec.'>Restas</label></h3>

            <form id="form_resta" action="javascript:void(0);" method="POST">
                <div ' . $pad . '>
                    <input id="valor2" type="text" name="valor1" placeholder="Valor 1"  ' . $size . '' . $style_border . '>
                    <input id="" type="" placeholder="  -" disabled ' . $simbol_size . '' . $style_border . '>
                    <input id="valor1" type="text" name="valor2" placeholder="Valor 2"  ' . $size . '' . $style_border . '>
                    <input id="" type="submit" onclick="resta();" value="=" ' . $simbol_size . '' . $style_border . '>
                    <label id="res_menos" '.$color_blue.'>Resultado</label>
                </div>
            </form>

        ';

        return $this->form;



    }

    function form_suma() {

        $size = 'size="16"';
        $simbol_size = 'size="2"';
        $pad = 'style="padding-bottom: 5px; font-size:12px;"';
        $style_border = 'style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "';
        $color_dec = 'style="color:limegreen; text-decoration: underline;"';
        $color_blue = 'style="color:deepskyblue;"';

        $this->form= '
            <h3><label '.$color_dec.'>Operaciones</label></h3>
            <h3><label '.$color_dec.'>Sumas</label></h3>

            <form id="form_suma" action="javascript:void(0);" method="POST">
                <div ' . $pad . '>
                    <input id="valor2" type="text" name="valor1" placeholder="Valor 1"   ' . $size . '' . $style_border . '>
                    <input id="" type="" value="  +" disabled ' . $simbol_size . '' . $style_border . '>
                    <input id="valor1" type="text" name="valor2" placeholder="Valor 2"   ' . $size . '' . $style_border . '>
                    <input id="" type="submit" onclick="suma();" value="=" ' . $simbol_size . '' . $style_border . '>
                    <label id="res_mas" '.$color_blue.'>Resultado</label>
                </div>
            </form>
        ';

        return $this->form;
    }
    function form_resta() {

        $size = 'size="16"';
        $simbol_size = 'size="2"';
        $pad = 'style="padding-bottom: 5px; font-size:12px;"';
        $style_border = 'style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "';
        $color_dec = 'style="color:limegreen; text-decoration: underline;"';
        $color_blue = 'style="color:deepskyblue;"';

        $this->form= '
            <h3><label '.$color_dec.'>Operaciones</label></h3>
            <h3><label '.$color_dec.'>Restas</label></h3>

            <form id="form_resta" action="javascript:void(0);" method="POST">
                <div ' . $pad . '>
                    <input id="valor2" type="text" name="valor1" placeholder="Valor 1"  ' . $size . '' . $style_border . '>
                    <input id="" type="" placeholder="  -" disabled ' . $simbol_size . '' . $style_border . '>
                    <input id="valor1" type="text" name="valor2" placeholder="Valor 2"  ' . $size . '' . $style_border . '>
                    <input id="" type="submit" onclick="resta();" value="=" ' . $simbol_size . '' . $style_border . '>
                    <label id="res_menos" '.$color_blue.'>Resultado</label>
                </div>
            </form>
        ';

        return $this->form;
    }
    function form_trasingres() {

        $size = 'size="16"';
        $simbol_size = 'size="2"';
        $pad = 'style="padding-bottom: 5px; font-size:12px;"';
        $style_border = 'style = " padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "';
        $style_textarea = 'style = " float:left; padding:5px; border-radius: 5px; border: 1px solid lightgreen; outline:0; resize:none; width:100%;"';
        $color_dec = 'style="color:limegreen; text-decoration: underline;"';
        $color_green = 'style="color:limegreen;"';
        $color_blue = 'style="color:deepskyblue;"';

        $this->form= '
            <h3><label '.$color_dec.'>Operaciones</label></h3>
            <h3><label '.$color_dec.'>Traspaso/Ingreso de saldo</label></h3>

            <form id="form_verify" action="javascript:void(0);" method="POST" name="form_verify">
                <div ' . $pad . '>
                    <label '.$color_blue.'>Origen :</label>
                    <input id="origen" type="text" name="origen" placeholder="Cuenta origen *" onfocus="verify_cuentas()" ' . $size . '' . $style_border . '>
                    <label '.$color_blue.'>Destino :</label>
                    <input id="destino" type="text" name="destino" placeholder="Cuenta destino *" onfocus="verify_cuentas()" ' . $size . '' . $style_border . '>
                    <!--<input type="submit" name="sub_verify" onclick="verify();" value="Verify"  ' . $style_border . '>-->
                </div>
                <input id="valor_num_ori" name="valor_num_ori" hidden><!-- Se pasa el valor de variable js num_carac para poder acceder a ella con PHP -->
                <input id="valor_num_des" name="valor_num_des" hidden><!-- Se pasa el valor de variable js num_carac para poder acceder a ella con PHP -->
            </form>
            <form id="form_tras_ingres" action="javascript:void(0);" method="POST" '.$pad.'>
                <div>
                    <div '.$pad.'><label '.$color_blue.'>Importe</label>
                        <input id="importe" type="text" name="importe" placeholder="Importe *"  ' . $size . '' . $style_border . '>
                        <!--<input id="" type="" placeholder=" ->" disabled ' . $simbol_size . '' . $style_border . '>-->
                        <span id="mess_dis_sub">
                            <input id="mess_disabled" type="text" value="" disabled hidden="hidden">
                            <input id="sub_tras_ingre" type="submit" name="sub_tras_ingre" onclick="open_message();" value="Traspasar/Ingresar" disabled ' . $style_border . '>
                        </span>
                    </div>
                    <input id="grab_origen" name="grab_origen" value="" hidden>
                    <input id="grab_destino" name="grab_destino" value="" hidden>
                    <pre style="width:100%;">
                        <label id="concepto_pre" style = " float:left; padding:5px">Concepto de traspaso/ingreso</label>
                        <textarea maxlength="50" id="concepto" name="concepto" placeholder="* Especifique el concepto. 50 caracteres max." ' . $style_textarea . '></textarea>
                    </pre>
                    <div>
                        <input id="traspaso" type="radio" name="tipo_radio" value="traspaso" disabled>
                        <label id="" '.$color_blue.'>Traspaso *</label>
                        <input id="ingreso" type="radio" name="tipo_radio" value="ingreso" disabled>
                        <label id="" '.$color_blue.'>Ingreso *</label>
                        <label id="" style="color:red; font-size:10px;">* Para ingresos especificar cuenta de destino e importe.</label>
                        <label id="">* Campos obligatorios </label>
                    </div>
                    <input id="status" name="status" hidden><!-- Se pasa el valor de variable js status y controlar ok y se accede desde PHP -->
                    <input id="alert" name="alert" hidden><!-- Se pasa el valor del alert para controlar ok o cancel y se accede desde PHP -->
                    <div id="alert_mess" hidden><!-- Para message secure -->
                        <label>Esta a punto de modificar saldo de clientes. ¿Desea continuar?</label>
                        <input id="alok" name="alok" type="submit" value="Ok" onclick="traspaso_ingreso(); close_ok();" ' . $style_border . '><!-- Se coge la funcion traspaso_ingreso, para ejecutar el form -->
                        <input id="alno" name="alno" type="submit" value="No, gracias" onclick="close_nok();" ' . $style_border . '>
                    </div>
                </div>
            </form>

            <label id="" style="color:deepskyblue;">Saldos: </label>
            <div id="verify" style="color:deepskyblue;"></div>
            <div id="tras_ingres" style="color:deepskyblue;"></div>

            <script>

//              setInterval(function(){
//                  $("#form_trasingres").submit();
//              }, 5000);
                // Lo siguiente realiza lo mismo que setinterval, pero espera hasta que ha acabado el anterior recurso.
                (function loopsform(){
                    $("#form_verify").submit();
//                      setTimeout(arguments.callee,1000)
                        setTimeout(loopsform,275)
                })()

                // Se cambia color del boton background por defecto, al activarse volverá a su color original
                var tras_ingre_button = document.getElementById("sub_tras_ingre");
                tras_ingre_button.style.backgroundColor="#f7ecb5";
                tras_ingre_button.style.color="deepskyblue";

                // Aparecerá mensaje de informacion estado boton
                  var mes_dis = document.getElementById("mess_disabled");
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
            //          mes_dis.style.top="100px";

                  }
                  if(tras_ingre_button.disabled==true){ mes_disabled(); }



            </script>

        ';


        return $this->form;
    }

}