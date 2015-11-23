<?php

class Body{

    private $form1;
    private $form_reg;
    private $welcome1;
    private $welcome2;
    private $welcome3;
    private $sql_in;

    function body1() {

        // Creamos objetos divs y formularios
        $space = new Divs();
        $form = new Formularios();
        $welcome = new Welcome();

        // Hacemos espacio superior 80px/50px y de 2px/1px de grosor
        echo $space->div(80,1);
        // Hacemos más espacio inferior de 50px y de 1px de grosor
        echo $space->div(50,1);

        // Inserts valores a la base de datos
        $this->sql_in = new Inserts();
        $this->sql_in->inserts_register();

        // Si hay acceso permitido mostrará mensaje de bienvenida, sinó mostrará formulario de inicio sesión
        if($_SESSION['access']=='true'){

            // Si se envía formulario correctamente al crear registro de cliente, mostrará formulario de registro con mensaje del estado.
            // Mostrará mensaje bienvenida por defecto al iniciar sesion
            $this->form_reg = $form->form_register();
//            $this->form_reg = $form_res_register->form_res_register();
            $_SESSION['ok'] = $this->sql_in->inserts_status();
            $info = '<div style="color:dodgerblue;">* Valores enviados correctamente. Revise su correo, pronto le llegará sus datos de acceso.</div>';

            if($this->sql_in->inserts_status()=='true') {
                // div_id(height,border,id); Div con id dinamico
                // div_id_content($height, $border, $id, $content); Div con id y contenido dinamico
                echo $space->div_bootstrap($space->div_id("100%", "1px", "col_opera"),
                    $space->div_id_content("100%", "1px", "body1", $this->form_reg.$info),
                    $space->div(50, 1));
            }else{
                $this->welcome1 = $welcome->welcome_message();
                echo $space->div_bootstrap($space->div_id("100%", "1px", "col_opera"),
                    $space->div_id_content("100%", "1px", "body1", $this->welcome1),
                    $space->div(50, 1));
                echo'
                <script>
                    $("#col_opera").load("opera_list.php");// lista operaciones
                </script>
            ';
            }

        }else {
            // Introducimos el formulario mediante funcion con estructura de bootstrap
            $this->form1 = $form->form_session();
//            echo $space->div_bootstrap($space->div(50,1), $this->form1, $space->div(50,1));
            // Introducimos un div, para que al clickar a direfentes links se refresque solo una parte de la pagina
            echo $space->div_bootstrap($space->div_id("100%", "1px", "col_opera"),
                $space->div_id_content("100%", "1px", "body1", $this->form1),
                $space->div(50, 1));
        }
        echo $space->div(50,1);

        return null;
    }


    function body2() {
        $space = new Divs();
        $welcome = new Welcome();

        echo $space->div(50,1);

        $this->welcome2 = $welcome->welcome_message2();
        $this->welcome3 = $welcome->welcome_message3();

        // Si hay acceso permitido mostrará mensaje de bienvenida, sinó mostrará formulario de inicio sesión
        if($_SESSION['access']=='true'){
            echo $space->div_bootstrap($space->div_id("100%", "1px", "col_opera"),
                $space->div_id_content("100%", "1px", "body2", $this->welcome3),
                '');
        }else {
            echo $space->div_bootstrap('',
                $space->div_id_content("100%", "1px", "body2", $this->welcome2),
                '');
        }


        return null;

    }



}