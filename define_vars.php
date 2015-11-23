<?php

class Define_vars{

    function define_vars($var_index) {

        if( empty($_POST[$var_index]) ){ $_POST[$var_index]=null; }

        return null;

    }

}