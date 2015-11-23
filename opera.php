<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$form_opera = new Formularios();
echo $form_opera->form_operaciones();





///**
// *
// */
//$cadena = new Texto();
//$cadena->entrar_cadena($_POST['usuario']);
//$cadena->limpiar_espacios();
//
//echo 'Se ha seleccionado el usuario '.$cadena->preparar_HTML().'';
//
//// Prepara consulta SQL para validar usuario
//$cadena->insertar_delante("SELECT nombre_completo FROM usuarios WHERE login='");
//$cadena->insertar_detras("'");
//
//$sql = $cadena->preparar_SQL();

