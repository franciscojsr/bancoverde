<?php

class Session extends Selects{

//    private $acces;

    function session_user(){

        if(empty($_SESSION['access'])) {
            $_SESSION['access'] = 'null';
        }

        if(!empty($_POST['dni']) || !empty($_POST['pass'])) {
            $this->select_session();
            if (password_verify($_POST['pass'], $this->hashpass)) {
                $_SESSION['access'] = 'true';
//                echo '<a href="" style="color:limegreen;">Password correct. Access granted!!!! Go to your personal area >> </a>';
            } else {
                $_SESSION['access'] = 'false';
                echo '<div style="color:red;">* Dni o password incorrectos. Access denied!!!! '.$_SESSION['access'].'</div>';
            }
        }
        if(empty($_POST['dni']) || empty($_POST['pass'])) {
            echo '<div style="color:red;">* You have to use your dni and pass! Try again! </div>';
//            echo $_SESSION['access'];
            echo '<div style="color:red;">* Si olvidó los datos de acceso, contacte con su Banco Verde.</div>';
        }else {
//            echo ''.$_SESSION['access'].'';
        }

        // Redirigimos si el acceso es correcto
        if($_SESSION['access']== 'true'){
//            header('Location:res_session.php');
            echo'
                <script>
                    $("#body1").load("res_session.php");// body1
                    $("#body2").load("res_session_body2.php");// body2
                    $("#bs-example-navbar-collapse-1").load("profile.php");// barra
                    $("#col_opera").load("opera_list.php");// lista operaciones
                </script>
            ';
        }

        return $_SESSION['access'];
    }

    function session_closed(){
        $_SESSION['access'] = 'false';
        return $_SESSION['access'];
    }

    function session_access(){
        return $_SESSION['access'];
    }

    function session_admin(){

    }


}