<?php

require_once ('autoload_1.php');
$autoload_1 = new Autoload_1();


class Data_base{

    private $sql;
    private $sql2;
    private $sql3;
    private $db_shows;

    function data_base() {

        $this->sql = "SELECT * FROM usuarios";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_usuarios($this->sql);

        $this->sql0 = "SELECT * FROM reg_usuarios";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_reg_usuarios($this->sql0);

        $this->sql1 = "SELECT * FROM adminis";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_adminis($this->sql1);

        $this->sql2 = "SELECT * FROM cuentas";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_cuentas($this->sql2);

        $this->sql3 = "SELECT * FROM reg_transacciones";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_reg_transacciones($this->sql3);

        $this->sql4 = "SELECT * FROM ingresos";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_ingresos($this->sql4);

        $this->sql5 = "SELECT * FROM traspasos";
        $this->db_shows = new Selects();
        $this->db_shows->select_db_traspasos($this->sql5);

        return null;
    }

}

$style='style = "width: 100%; height: 100%; white-space: nowrap; "';
echo '</br>';
echo '<pre id="" name="" '.$style.' > ';
//echo '<form id="form_db_usuarios" action="javascript:void(0);" method="post">';
    $DB_sql = new Data_base();
//echo '</form>';
echo '</pre>';
?>
