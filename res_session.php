<?php session_start(); ?>
<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$form_session = new Formularios();
$wel = new Welcome();
$session = new Session();

if($_SESSION['access']=='true') {
//    echo $wel->welcome_message();
    echo '<a href="" style="color:deepskyblue;" >Password correct. Access granted!!!! Go to your personal area >> </a>';
}else {
    echo $form_session->form_session();
    $session->session_user();
}