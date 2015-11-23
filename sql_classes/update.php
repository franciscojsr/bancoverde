<?php

Class Update extends Update_sql{

    function update_saldo($sql){
        $this->update_sql_saldo($sql);
        return null;
    }

    function status($status){
        return $status;
    }

}