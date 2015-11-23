<?php

class Conexio_dades_db {

    protected $host = 'you_hostname';
    const user_name = 'your_username';
    const password = 'your_password';
    const DB_name = 'your_dbname';


    protected function dades_DB() {
        $ho = $this->host;
        $una = $this::user_name;
        $upa = $this::password;
        $dbn = $this::DB_name;

        // Se guardan los datos en un array para poder retornarlos
        $ArrayDades = [$ho, $una, $upa, $dbn];

        return $ArrayDades;
    }

}

?>