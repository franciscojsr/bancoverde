<?php

class Select_option {


    function array_options(){
        $array_date = [];
        $days = [];
        $months = [];
        $years = [];

        $año = new Datetime();
        $var_year = $año->getTimestamp();
        $actual_year = date('Y',$var_year); // Obtenermos el año actual y mostramos siempre dos años anterios al año actual
        $period = $actual_year-2;

        for($i = 1; $i <= 31; $i++ ) {
            if( $i>=1 && $i<10 ) {
                $day = '<option value="0'.$i.'">0'.$i.'</option>'; // formato 00, 01, 02,...
            }else {
                $day = '<option value="' . $i . '">' . $i . '</option>';
            }
            array_push($days,$day);
        }
        for($i = 1; $i <= 12; $i++ ) {
            if( $i>=1 && $i<10 ) {
                $month = '<option value="0'.$i.'">0'.$i.'</option>'; // formato 00, 01, 02,...
            }else {
                $month = '<option value="' . $i . '">' . $i . '</option>';
            }
            array_push($months,$month);
        }
        for($i = $period; $i <= $actual_year; $i++ ) {
            $year = '<option value="'.$i.'">'.$i.'</option>';
            array_push($years,$year);
        }

        array_push($array_date, $days);
        array_push($array_date, $months);
        array_push($array_date, $years);

        return $array_date;
    }

    function select_option_date($id_dia, $id_mes, $id_año) {

        // Días
        echo '
            <select name="'.$id_dia.'"  >
                <option value="">Día</option>
        ';
                for($i = 0; $i <= 31; $i++) {
        echo '
                    '.self::array_options()[0][$i].'
        ';
                }
        echo '
            </select>
        ';

        // Meses
        echo '
            <select name="'.$id_mes.'"  >
                <option value="">Mes</option>
        ';
                for($i = 0; $i <= 12; $i++) {
            echo '
                    '.self::array_options()[1][$i].'
        ';
                }
        echo '
            </select>
        ';

        // Años
        echo '
            <select name="'.$id_año.'" onchange="" >
                <option value="">Año</option>
        ';
                for($i = 0; $i <= 3; $i++ ) {
            echo '
                    '.self::array_options()[2][$i].'
        ';
                }
        echo '
            </select>
        ';

        return null;
    }

}
