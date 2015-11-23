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
        // Ajax
        $(form1).submit(function() {             // catch the form's submit event
            $.ajax({                            // create an AJAX call...
                data: $(form1).serialize()+'&'+$(form2).serialize(), // get the form data
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

// Formulario inicio session
function session() {
    ajax_form('#form_session', 'res_session.php', '#body1', 'POST');     // Para mostrar mensajes body1, y acceder a perfil si se inicia sesion correctamente
    ajax_form('#form_session', 'res_session_body2.php', '#body2', 'POST');// Para mostrar mensajes body2 si se inicia sesion correctamente o no.
}
// Cierre de session
function session_closed() {
    $('#bs-example-navbar-collapse-1').load('session_closed.php');
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
}

// Formulario de consultas
function consultas() {
    $(document).ready(function() {
        $("#body1").load("consultas.php");
    });
}
function sql_consul() {
//          var id = document.getElementById("id").value;
//          var name = document.getElementById("name").value;
//          var dni = document.getElementById("dni").value;
    ajax_form('#form_consults','res_consult.php','#body1','GET');
}

// Formularios de operaciones, se muestran al ir a sus sección
function operaciones() {
    $(document).ready(function() {
        $("#body1").load("opera.php");
        $("#col_opera").load("opera_list.php");
    });
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

