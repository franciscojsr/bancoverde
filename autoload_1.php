<?php
/**
 * Created by PhpStorm.
 * User: xiki
 * Date: 09/08/15
 * Time: 00:27
 */

class Autoload_1 {

    function autoload_1() {

//        function __autoload($class_name) {
//
//            $fileClass = $class_name . '.php';
//
//            if(!file_exists($fileClass)){
//                echo '
//                    <script>
//                        alert("ERROR class_file missing");
//                    </script>
//                ';
//            }else {
//                require_once $fileClass;
//            }
//
//        }

        /* There is 'spl_autoload_register(), that will be use instead '__autoload' function
         * There is possibility to register autoload functions.
         * '__autoload' will be obsolete in the future.
         * */

        function mi_first_autoload($n_class) {

        	$classname = strtolower($n_class); //case sensitive, so lower
            $fileClass = dirname(__FILE__) .'/'. $classname . '.php'; // full path
            
            $path = dirname(__FILE__).'/sql_classes/'. strtolower($n_class) . '.php';
            $path2 = dirname(__FILE__).'/tablas/'. strtolower($n_class) . '.php';
//            echo $path;

            if(!file_exists($fileClass)){
                //$fileClass = 'sql_classes/' . $n_class . '.php';
                $fileClass = $path;
                if(!file_exists($fileClass)) {
                    $fileClass = $path2;
                    if(!file_exists($fileClass)) {
                        echo '
                            <script>
                                alert("ERROR class_file missing");
                            </script>
                        ';
                    }else{
                        require_once $fileClass;
//                      echo '</br>' . strtolower($fileClass). ' -> Class ok!! ';
                    }
                }else {
                    require_once $fileClass;
//                  echo '</br>' . strtolower($fileClass). ' -> Class ok!! ';
                }
            }else {
                require_once $fileClass;
//                echo '</br>' . strtolower($fileClass). ' -> Class ok!! ';
            }
        }

        spl_autoload_register('mi_first_autoload', true, true);



    }



}