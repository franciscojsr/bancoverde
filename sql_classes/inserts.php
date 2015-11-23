<?php

class Inserts extends Insert_sql {

    // Variables de numero de cuentas y password se crearan aleatoriamente con random

    // Adminis
    private $dep;

    // Usuario
    private $name;
    private $ap1;
    private $ap2;
    private $dni;
    private $email;
    private $direc;
    private $pass_rand;
    private $hash_pass_rand;

    // Reg_usuario
    private $tipo_usuario;

    // Cuenta
    private $saldo_registro;
    private $tipo_cuenta;
    private $cuen_rand;
    var $existe_cuenta = false; //Para ver si existe una cuenta, usamos por defecto false y si de da el caso pasara a ser true


    private $ok; // Si es correcto se registrara en la base de datos

    function __construct() {}

    // Función para registro de ususarios
    function inserts_register() {

        // Al enviar formulario que se ejecute
        if(isset($_POST['sub'])) {

            // Obtenemos los valores de usuario del formulario de registro
            $this->name = $_POST['name'];
            $this->ap1 = $_POST['apellido1'];
            $this->ap2 = $_POST['apellido2'];
            $this->dni = $_POST['dni'];
            $this->email = $_POST['email'];
            $this->direc = $_POST['direccion'];

            $this->dep = $_POST['departamento'];

            $this->saldo_registro = $_POST['saldo_registro'];
            $this->tipo_cuenta = $_POST['tipo_cuenta'];

            $this->tipo_usuario = $_POST['tipo_usuario'];


            // Se usa la classe para obtener valores con random
            $rand_class = new Random_var();

            // Random para el número de cuenta.
            // -- Num Cuenta --
            $this->cuen_rand = $rand_class->random_numeric();

            // Random para el password alfanumérico.
            // -- Password --
            $this->pass_rand = $rand_class->random_alphanumeric(10);
            // Se crea un hash para la contraseña y augmentar la seguridad.
            $this->hash_pass_rand = password_hash($this->pass_rand, PASSWORD_DEFAULT);

            // Miramos si existe una cuenta con el mismo valor, si no es así se introduce en la base de datos y sino se vuelve a realizar
            // Se usa un while, para que vaya realizando el valor random
            $sql = 'SELECT num_cuenta FROM cuentas';
            $sel_sql = new Select_sql(); // Creamos objeto pra realizar consulta

            // Se controla si existe una cuenta al crear cliente. Si se da el caso, se vuelve a ejecutar random_alphanumeric
            $this->ok = 'false';
            while ($this->ok != 'true') {

                // Se obtiene el array con el valor de las cuentas existentes
                $array_cuentas = $sel_sql->select_cuenta($sql);
                $cuentas_count = count($array_cuentas); // Obtenemos el numero de valores del array

                // Miramos si existe la cuenta $this->cuen_rand
                for ($i = 0; $i < $cuentas_count; $i++) {
                    if ($array_cuentas[$i] == $this->cuen_rand) {
//                    echo "VALOR EXISTENTE".print_r($array_cuentas[$i]);
                        $this->existe_cuenta = true;
                    }
                }

                if ($this->existe_cuenta) {
//                    echo "</br>Cuenta existente!!!</br>";
                    $this->cuen_rand = $rand_class->random_alphanumeric(10);
                } else {
                    // Comprovamos que se introducen todos los campos
                    if ($this->name != null || $this->ap1 != null || $this->ap2 != null || $this->dni != null ||
                        $this->email != null || $this->direc != null
                    ) {

                        $this->ok = 'true';
//                        echo "</br>Cuenta no existente. La cuenta cliente se guardará en la base de datos!!!</br></br>";

                        // Se insertan los datos en las tablas
                        $adminis = new Adminis();
                        $usuarios = new Usuarios();
                        $reg_usuarios = new Reg_usuarios();
                        $cuentas = new Cuenta();

                        // Inserión tabla usuarios
                        $user_id = $usuarios->insert_table_usuarios($this->name, $this->ap1, $this->ap2, $this->dni, $this->email,
                                                                    $this->direc, $this->pass_rand, $this->hash_pass_rand);

                        // Aquí se introduce tabla si usuario no es un cliente, sinó será valor null departament, idadmini
                        if($this->dep!="null") {
                            // Inserción tabla adminis
                            $adminis->insert_table_adminis($this->dep, $user_id); // A la vez que se insertan los campos se obtiene el id para introducirlo en usuarios
                        }

                        // Inserción tabla reg_usuarios
                        $reg_user_id = $reg_usuarios->insert_table_reg_usuarios($this->tipo_usuario, $user_id);

                        // Inserción tabla cuentas
                        $cuentas->insert_tabla_cuentas($this->saldo_registro, $this->tipo_cuenta, $this->cuen_rand, $reg_user_id);

//                        echo "</br>Su numero de cuenta y contraseña són: " . $this->cuen_rand . " / " . $this->pass_rand;
                    }
                }

            }
        }

        return null;
    }

    function inserts_status(){
        if(empty($this->ok)){
            $this->ok = 'false';
        }
        return $this->ok;
    }


}