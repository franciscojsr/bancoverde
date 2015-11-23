<?php

class Divs {

    function div($height, $border) {

//        echo "<div style='background-color: lightgreen'></div>";

        $space=' <div style="background-color: lightgreen; height: '.$height.'px; border: '.$border.'px solid greenyellow;"></div> ';

        return $space;

    }

    function div_id($height, $border, $id){
        $space=' <div id="'.$id.'" style="background-color: lightgoldenrodyellow; height: '.$height.'; border: '.$border.' solid greenyellow;"></div> ';
        return $space;
    }
    // Div con contenido dinamico
    function div_id_content($height, $border, $id, $content){
        $space=' <div id="'.$id.'" style=" padding:15px; background-color: lightgoldenrodyellow; height: '.$height.'; border: '.$border.' solid greenyellow;">'.$content.'</div> ';
        return $space;
    }
    function div_bootstrap($body1, $body2, $body3) {

        $style = ' style="margin-bottom:10px; " ';

        $space='
                     <div class="container-fluid">
                         <div class="row">
                             <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2" '.$style.'>
                                '.$body1.'
                             </div>
                             <div class="col-xs-12 col-sm-8 col-md-7 col-lg-8" '.$style.'>
                                '.$body2.'
                             </div>
                             <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" '.$style.'">
                                '.$body3.'
                             </div>
                         </div>
                     </div>
                 ';
        echo $space;

        return null;

    }

    // div dinamico con mensaje
    function div_message($height, $border, $mess, $color, $background, $borcolor){
        $style = 'style="color:'.$color.'; background-color: '.$background.'; height: '.$height.'px; border: '.$border.'px solid '.$borcolor.';"';

        $space=' <div '.$style.'>'.$mess.'</div> ';

        return $space;
    }

}