<?php session_start(); ?>
<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$form_session = new Formularios();
$wel = new Welcome();
$session = new Session();

if($_SESSION['access']=='true') {
    echo $wel->welcome_message3();
}else {
    echo $wel->welcome_message2();
}