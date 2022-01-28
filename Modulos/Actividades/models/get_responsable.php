<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

$area_id = filter_input(INPUT_POST, 'area_id'); //obtenemos el parametro que viene de ajax

if($area_id != ''){ //verificamos nuevamente que sea una opcion valida

  $sql = "select u.idusuario as id, concat(p.apellido,' ',p.nombre) as datos from persona p, usuario u where p.idusuario=u.usuario AND p.idArea = '$area_id' AND p.estatus='Activo' AND p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
}


?>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option class="f-box" value="<?= $op['id'] ?>"><?= $op['datos'] ?></option>
<?php endforeach; ?>