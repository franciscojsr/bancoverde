<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<!--    <meta charset="UTF-8">-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="bootstrap/mi_bootstrap.css" rel="stylesheet" type='text/css'>
    <script src="bootstrap/jquery-1.11.2.min.js"> </script>
    <script src="bootstrap/bootstrap.min.js"> </script>

    <script>

        function ajax_form(form, file, element, method) {
            $(document).ready(function() {
                // Ajax
                $(form).submit(function() {             // catch the form's submit event
                    $.ajax({                            // create an AJAX call...
                        data: $(this).serialize(),      // get the form data
                        type: method,                   // GET or POST
                        url: file,                      // the file to call
                        success: function(response) {   // on success..
                            $(element).html(response);  // update the DIV
                        }
                    });
                    return false; // cancel original event to prevent form submitting
                });
            });
        }
        function ajax_2_form(form1, form2, file, element, method) {
            $(document).ready(function() {
//                var init_time = new Date().getTime(); // El tiempo inicial
                // Ajax
                $(form1).submit(function() {             // catch the form's submit event
                    $.ajax({                            // create an AJAX call...
                        data: $(form1).serialize()+'&'+$(form2).serialize(), // get the form data
                        type: method,                   // GET or POST
                        url: file,                      // the file to call
                        success: function(response) {   // on success..
                            $(element).html(response);  // update the DIV
//                            var final_time = new Date().getTime(); // Tiempo final donde acaba
//                            alert(final_time-init_time+"ms");
                        }
                    });
                    $(form1).unbind('submit'); // Remove a previously-attached event handler from the elements. Asi no se acumulan los sumbit y causar errores.
                    return false; // cancel original event to prevent form submitting
                });
            });
        }

        // Formulario inicio session
        function session() {
            ajax_form('#form_session', 'res_session.php', '#body1', 'POST');     // Para mostrar mensajes body1, y acceder a perfil si se inicia sesion correctamente
//            ajax_form('#form_session', 'res_session_body2.php', '#body2', 'POST');// Para mostrar mensajes body2 si se inicia sesion correctamente o no.
        }
        // Cierre de session
        function session_closed() {
            $("body").load('session_closed.php');
        }
        // Si se inicia sessión correctamente se muestran las opciones adecuadas a cada perfil.
        function session_profile(){
            ajax_form('#form_session', 'profile.php', '#bs-example-navbar-collapse-1', 'POST');
        }

        // Formulario de registro cliente
        function registro() {
            $(document).ready(function() {
                $("#body1").load("register.php");
            });
            $("#col_opera").load("opera_list.php");// lista operaciones
            $("#body2").load("logo.php");

        }

        // Formulario de consultas
        function consultas() {
            $(document).ready(function() {
                $("#body1").load("consultas.php");
            });
            $("#col_opera").load("opera_list.php"); // lista operaciones
            $("#body2").load("logo.php");

        }
        function sql_consul() {
            ajax_form('#form_consults','res_consult.php','#body1','GET');
        }
        function sql_consulauto() {
            ajax_form('#form_consults','res_consult_auto.php','#consulauto','GET');
        }

        // Formularios de operaciones, se muestran al ir a sus sección
        function operaciones() {
            $(document).ready(function() {
                $("#body1").load("opera.php");
                $("#col_opera").load("opera_list.php");// lista operaciones
            });
            $("#body2").load("logo.php");
        }
        function suma() {
            ajax_form('#form_suma','suma.php','#res_mas','POST');
        }
        function resta() {
            ajax_form('#form_resta','resta.php','#res_menos','POST');
        }
        function verify() {
            ajax_form('#form_verify','trasingres.php','#verify','POST');
        }
        // Cuando onfocus en la parte del formulario de cuentas trasingres se ejecute la comprobación de cuentas
        function verify_cuentas() {
            verify();
        }
        function traspaso_ingreso() { // Obtiene data de los dos formularios
            ajax_2_form('#form_tras_ingres','#form_verify','trasingres.php','#tras_ingres','POST');
        }

        // Base de datos con sus campos para muestra ejemplo
        function data_base() {
            $("#body1").load("data_base.php"); // Tabla con base de datos
            $("#body2").load("logo.php");
        }

        // Mostrará las transacciones entre las fechas introducidas en formulario
        function transacciones() {
            ajax_form('#form_fechas','idvalue.php','#pre_tran','POST');
        }

    </script>

</head>
<body style="background-color: white;">
<?php
/* First we call '__autoload' function, that we place in autoload class, to run
 the files that we require when we create an object. */
require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

// inicializacion var access
if(empty($_SESSION['access'])) {
    $_SESSION['access'] = 'null';
}

// Creamos objeto html para incorporar todos los complementos
$html = new Html();
$html->html1();

?>




</body>
</html>