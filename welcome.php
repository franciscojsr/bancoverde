<?php

class Welcome {

    function welcome_message() {

        $welcome = '
            <h3>
                <label style="color:limegreen; text-decoration: underline; text-align: center;">
                    Bienvenido al Banco Verde.<br>Aquí usted podrá ver sus datos de usuario, saldo, y realizar consultas y operaciones con distintas opciones.
                </label>
            </h3>
        ';

        return $welcome;
    }

    function welcome_message2() {

        $welcome = '
            <h3>
                <label style="color:limegreen; text-decoration: underline; text-align: center;">
                    Inicie sesión!<br>Aquí usted podrá ver sus datos de usuario, saldo, y realizar consultas y operaciones con distintas opciones.
                </label>
            </h3>
        ';

        return $welcome;
    }

    function welcome_message3() {

        $welcome = '
            <h3>
                <label style="color:limegreen; text-decoration: underline; text-align: center;">
                    Este es su especio personal. Consulte su saldo o haga operaciones segun su nivel de acesso. Usuarios bancarios tienen acceso limitado
                </label>
            </h3>
        ';

        return $welcome;
    }

}