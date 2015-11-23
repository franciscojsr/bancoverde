<?php session_start(); ?>
<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$ses_acc = new Session();
if($ses_acc->session_closed()){
    header('Location:index.php');
}
