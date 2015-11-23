<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

//$select = new Selects();
$form_consult = new Formularios();
echo $form_consult->form_consults();
