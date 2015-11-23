<?php

/**
 *  Clase de creación de tablas
 *
 */
class Table {


    function table_db_show($result_count, $cont_col, $lista_campos){


        echo '<table style="border:2px solid limegreen; width: 100%;">';

        for($i = 0; $i < $result_count; $i++){
            echo '<tr style="border:2px solid limegreen;">';

            for($j = 0; $j < $cont_col; $j++){
                if($i == 0){
                    echo "<td style='border:2px solid limegreen; text-align:center; background-color: palegreen; padding-left: 15px; padding-right: 15px;' >".$lista_campos[$i][$j]."</td>";
                }elseif($j==0){
                    echo "<td style='border:2px solid limegreen; background-color:#E0FFD1; text-align:center;' >".$lista_campos[$i][$j]."</td>";
                }else {
                    echo "<td style='border:2px solid limegreen; background-color:#E0FFD1; padding-left: 5px; padding-right: 5px;'>" . $lista_campos[$i][$j] . "</td>";
                }
            }
            echo "</tr>";
        }
        echo '</table>';


        return null;
    }

    function table_db_show_encabezado($result_count, $lista_campos){
        echo '<table style="border:2px solid limegreen; width: ;">';
        echo '<tr style="border:2px solid limegreen;">';

        for($j = 0; $j < $result_count; $j++) {
            if($j==0){
                echo "<td style='border:2px solid limegreen; width:60px; text-align:center; background-color: palegreen; padding-left: 15px; padding-right: 15px;' >" . $lista_campos[$j] . "</td>";
            }
            elseif($j==$result_count-1){
                echo "<td style='border:2px solid limegreen; width:90px; text-align:center; background-color: palegreen; ' >" . $lista_campos[$j] . "</td>";
            }
            else {
                if($lista_campos[$j]<0){ // Valores negativos en rojo
                    echo "<td style='border:2px solid limegreen; color:red; width:70px; text-align:center; background-color: palegreen; ' >" . $lista_campos[$j] . "</td>";
                }else {
                    echo "<td style='border:2px solid limegreen; width:70px; text-align:center; background-color: palegreen; ' >" . $lista_campos[$j] . "</td>";
                }
            }
        }

        echo "</tr>";

        echo '</table>';

        return null;
    }
    function table_db_show_resultado($result_count, $lista_campos, $last){
        $color_last = '';
        $actual='';

        if($last==true){   // Si es el ultimo elemento actual se mostrará color azulado
            $color_last = ' background-color: deepskyblue; ';
            $actual = '<td>Top</td>';
        }else {
            $color_last = 'background-color:#E0FFD1;';
        }

        echo '<table style="border:0.5px solid limegreen; width: ;">';
        echo '<tr style="border:0.5px solid limegreen;">';

        for($i = 0; $i < $result_count; $i++){

            if($i == 0){
                echo "<td style=' $color_last border:2px solid limegreen; width:60px; text-align:center; padding-left: 15px; padding-right: 15px; ' >".$lista_campos[$i]."</td>";
            }
            elseif($i==$result_count-1){
                echo "<td style=' $color_last border:2px solid limegreen; width:90px; text-align:center; ' >" . $lista_campos[$i] . "</td>";
            }
            else {
                if($lista_campos[$i]<0){ // Valores negativos en rojo
                    echo "<td style=' $color_last border:2px solid limegreen; color:red; width:70px; text-align:center; '>" . $lista_campos[$i] . "</td>";
                }else {
                    echo "<td style=' $color_last border:2px solid limegreen; width:70px; text-align:center; '>" . $lista_campos[$i] . "</td>";
                }
            }

        }
        echo $actual;
        echo "</tr>";

        echo '</table>';


        return null;
    }



}