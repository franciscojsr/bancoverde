<?php


class Footer {


    function footer1(){

        $div_footer = new Divs();
        $space = $div_footer->div_message(170, 1, "Derechos reservados 2015! Disfruta del verde! ",'black','lightgreen','greenyellow');
        $space2 = $div_footer->div_message(30, 1, "@Copyright 2015! BANCO VERDE Contacto: Tel:0000000.. bancoverde@verde.banco Encuentre su oficina mas cercana..",'white','#444','black');

//        $space=' <div style="background-color: palegreen; height: 200px; border: 1px solid greenyellow;">Footer</div> ';

        echo $space;
        echo $space2;

        return null;

    }

}
