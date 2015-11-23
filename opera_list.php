<?php
$style='style="padding:15px;color:deepskyblue;text-decoration:underline;  text-align: center;"';
$simbol_size = 'size="4px" ';
$style_border = 'style = " font-size:13px; padding-top:1px; padding-bottom:5px; padding-left:8px;
                padding-right:8px; border-radius: 5px; border: 1px solid lightgreen; outline:0; "';
?>
<div <?php echo $style; ?> id="asel">
    <div id="cont" style="color:limegreen; text-decoration: underline;">Lista de operaciones</div>
    <select id="select_opera" name="select_opera" onchange="change_opera();" <?php echo $simbol_size . $style_border ?> >
        <option id="opt0" name="opt" value="def" disabled>Selecciona opción-></option>
        <option id="opt1" class="opt" name="opt" value="+">Sumas</option>
        <option id="opt2" class="opt" name="opt" value="-">Restas</option>
        <option id="opt3" class="opt" name="opt" value="->">Traspasos/Ingresos</option>
    </select>
</div>
<!--<script type="text/javascript" src="js/master.js"></script> <!-- include js file to access to functions -->
<script>

    function load_on_div(div,name_file){
        $(div).load(name_file+".php");
    }

    function change_opera(){
        var sel_opt_value = document.getElementById("select_opera").value;
        if(sel_opt_value=="+"){
            load_on_div("#body1","opera_suma");
            $("#body2").load("logo.php");
        }
        if(sel_opt_value=="-"){
            load_on_div("#body1","opera_resta");
            $("#body2").load("logo.php");
        }
        if(sel_opt_value=="->"){
            load_on_div("#body1","opera_trasingres");
            $("#body2").load("logo.php");
        }
    }


    var sel = document.getElementById("select_opera");
    var opt = document.getElementsByTagName("option");
    var opt0 = document.getElementById("opt0");
    var opt1 = document.getElementById("opt1");
    var opt2 = document.getElementById("opt2");
    var opt3 = document.getElementById("opt3");
    var seljq = $("#select_opera");
    var option0 = $("#opt0");
    var pos = '';
//    seljq.click(function(){
//        seljq.animate({height:'20'},'slow');
////        if(sel.selectedIndex==0){ opt0.selected='true'; pos = "opt0"; }
////        if(sel.selectedIndex==1){ opt1.selected='true'; pos = "opt1"; }
////        if(sel.selectedIndex==2){ opt2.selected='true'; pos = "opt2"; }
////        if(sel.selectedIndex==3){ opt3.selected='true'; pos = "opt3"; }
//
//    });

</script>