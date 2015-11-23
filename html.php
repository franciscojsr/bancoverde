<?php


class Html {

    private $bar1;
    private $body1;
    private $body2;
    private $footer1;


    function html1() {

        $bar = new Bars();
        $body = new Body();
        $footer = new Footer();

        $this->bar1 = $bar->bar1();

        $this->body1 = $body->body1();
        $this->body2 = $body->body2();

        $this->footer1 = $footer->footer1();

        return null;

    }

    function html_consultas(){

        echo "CONSULTAS !!!!!";

    }


}