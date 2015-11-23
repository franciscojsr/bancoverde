<?php

require_once (dirname(__FILE__).'/autoload_1.php');
$autoload_1 = new Autoload_1();

$sql_se = new Selects;
$sql_se->select2();

// Shows anim until data it's loaded.
echo '
    <script>
        $(document).ready(function(){
            $(".wait").load("anim/circle_wait.html");
        });
    </script>
';