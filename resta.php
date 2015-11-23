<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$opera = new Operaciones();
echo $opera->resta($_POST['valor1'], $_POST['valor2']);