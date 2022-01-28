<?php 
	require_once "conexion.php";
	
	$ID_act=$_POST['ID_act'];
	$nombre_act=$_POST['nombre_act'];
	$descripcion_act=$_POST['descripcion_act'];
	$fecha_act=$_POST['fecha_act'];
	$fechafin_act=$_POST['fechafin_act'];
	$Hini_act=$_POST['Hini_act'];
	$Hfin_act=$_POST['Hfin_act'];
	$estado_act=$_POST['estado_act'];

	$consulta = "UPDATE actividades SET nombre='$nombre_act', descripcion='$descripcion_act', estado='$estado_act', 
	fecha='$fecha_act', fechafin='$fechafin_act', Horaini='$Hini_act', Horafin='$Hfin_act' WHERE idactividades='$ID_act'";
	echo $result=mysqli_query($conection,$consulta);

 ?>