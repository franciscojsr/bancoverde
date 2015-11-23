<?php


class Date_time {

    // Funcion que devuelve array con fecha y hora actual.
    function date_time() {

        $fecha = new DateTime();
        $var = $fecha->getTimestamp();

        $date = date('Y-m-d',$var);
        $time = date('H:i:s');

        $data_time = [$date,$time];

        return $data_time;
    }


}