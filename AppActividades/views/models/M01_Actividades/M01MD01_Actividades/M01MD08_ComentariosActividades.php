<?php 
   session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../../config/configuracion.php";
   include_once "../../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
   
   $data = array();
   $dataList = array();

	$username = $_SESSION['usu'];
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    $ids = $consulta_idr['idusuario'];
	
//

if(!empty($_POST["nombre"]) && !empty($_POST["comentario"])){

	$insertComments = "INSERT INTO coment_actividades (idactividades, idusuario, comentario, nombre) VALUES ('".$_POST["txtIDActividadComentarios"]."', '".$_POST["IdUsuario"]."', '".$_POST["comentario"]."','".$_POST["nombre"]."')";
	mysqli_query($conection, $insertComments) or die("database error: ".mysqli_error($conection));
	$message = '<label class="text-success">Comentario publicado.</label';
	$status = array(
		'error' => 0,
		'message' => $message
	);	
} else {
	$message = '<label class="text-danger">Error: comentario no posteado.</label>';
	$status = array (
		'error' => 1,
		'message' => $message
	);
}
echo json_encode($status);



?>