<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

$tipo_id = filter_input(INPUT_POST, 'tipo_id'); //obtenemos el parametro que viene de ajax

if($tipo_id != ''){ //verificamos nuevamente que sea una opcion valida

  $area = mysqli_query($conection, "SELECT a.idArea as area FROM area a, persona p WHERE p.idArea=a.idArea AND p.idusuario='$username'");
  $arear = mysqli_fetch_assoc($area);
  
  $valor_idarea=$arear['area'];

  $sql = "select idgestion, nombre from tipos where categoria = '$tipo_id' AND area='$valor_idarea'";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
}


?>

<option value="" class="f-box" selected="true" disabled="disabled">Ninguno</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option class="f-box" value="<?= $op['nombre'] ?>"><?= $op['nombre'] ?></option>
<?php endforeach; ?>