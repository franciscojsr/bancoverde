

error_reporting(E_ALL ^ E_NOTICE); // Notifica todos los errores menos los de notice.

error_reporting(E_ALL); // Notifica todos los errores.


<script>
//  Para cambiar el value de un element html a traves del formulario de orden
//  se especifica el formulario, el id y value
//   document.formulario_numero_array.id.value
//   Si hay mas de un formulario el primero es 0
     document.forms[0].resultado.value = 1;

</script>