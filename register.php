<?php session_start(); ?>
<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

//$select = new Selects();
$form_register = new Formularios();
//$inserts = new Inserts();

echo $form_register->form_register();