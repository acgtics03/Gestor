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

if($_POST){
	$name=$_SESSION['nombre'];
    $msg=$_POST['msg'];
    
	$sql="INSERT INTO `comentarios`(`nombre`, `comentario`) VALUES ('".$name."', '".$msg."')";

	$query = mysqli_query($conn,$sql);
	if($query)
	{
		header('Location: index.php');
	}
	else
	{
		echo "Algo salió mal";
	}
	
	}
?>