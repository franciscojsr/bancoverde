<?php

class Bars {

    private $bar_profile;

    function bar_profile() {

        $style_border = '
            style = "margin:-15px; padding:10px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "
        ';

        // Si hay acceso por usuario se ejecutará las opciones de profile, aqui cuando se ejecute la pagina
        $this->bar_profile= null;

        if($_SESSION['access']=='true'){
            $this->bar_profile = '
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#" class="" id="" onclick="registro();">Registro Clientes</a>
                        </li>
                        <li >
                            <a href="#" class="" id="" onclick="consultas();">Consulta Clientes</a>
                        </li>
                        <li >
                            <a href="#" class="" id="" onclick="operaciones();">Operaciones</a>
                        </li>
                        <li>
                            <!--<a href="profile.php" class="barr" id="barre">Profile</a>-->
                        </li>
                        <li>
                            <a href="#" class="" id="" onclick="data_base();">Datos muestra</a>
                        </li>
                        <li>
                            <a href="#" onclick="session_closed(); "><input type="submit" '.$style_border.' value="Cierre sessión"></a>
                        </li>
                    </ul>

                ';
        }else {
            $this->bar_profile = '
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="" class="barr" id="barre">QUE ES BANCO VERDE ?</a>
                        </li>
                        <li>
                            <a href="#" class="" id="" onclick="data_base();">Datos muestra</a>
                        </li>
                    </ul>
                ';
        }

        return $this->bar_profile;
    }

    function bar1() {

        self::bar_profile(); // Es crida la funcio de la mateixa clase.

        $barra_html = '
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed bot" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        Menú
                      </button>
                      <ul class="nav navbar-nav navbar-brand">
                        <li><a class="navbar-brand" href="">BANCO VERDE</a></li>
                      </ul>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        '.$this->bar_profile.'
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
        ';

        echo $barra_html;

        return null;

    }


}