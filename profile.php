<?php session_start(); ?>

<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$ses_acc = new Session();
$ses_acc->session_access();

// Si hay acceso por usuario se ejecutará las opciones de profile, aquí cuando se inicie o cierre sesion por ajax
$bar_profile = new Bars();
echo $bar_profile->bar_profile();

