<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$form_consult = new Formularios();
echo $form_consult->form_consults();
// Los valores solo seran accesibles desde este fichero php y sus funciones, objectos en ellos.
//echo $_GET['id'];
//echo $_GET['name'];
//echo $_GET['dni'];

$sql_se = new Selects;

$id = $_GET['id'];
$name = $_GET['name'];
$dni = $_GET['dni'];

$sql_form1 = 'SELECT * FROM usuarios WHERE idusuario = "' . $id . '"';
$sql_form2 = 'SELECT * FROM usuarios WHERE name = "' . $name . '"';
$sql_form3 = 'SELECT * FROM usuarios WHERE dni = "' . $dni . '"';


if ($id != null || $name != null || $dni != null) {
    echo '<div style="color:deepskyblue;">* Resultados. Si desea realice nueva consulta.</div>';
    if ( $sql_se->select_idusuario($sql_form1) != null ) {
        $sql_se->select_usuarios($sql_form1);
    }
    if ( $sql_se->select_idusuario($sql_form2) != null ) {
        $sql_se->select_usuarios($sql_form2);
    }
    if ( $sql_se->select_idusuario($sql_form3) != null ) {
        $sql_se->select_usuarios($sql_form3);
    }
}