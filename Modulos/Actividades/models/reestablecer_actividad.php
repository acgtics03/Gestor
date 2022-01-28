<?php 
	require_once "conexion.php";
	
	$ID=$_POST['ID3'];
	
	$campo3="Error";
	$campo1="Error";
	
	if(!empty($ID)){
	    $campo3 = "estado='PLANIFICADO'";
	    $campo1 = "idactividades='$ID'";
	}
	
	$consulta = "UPDATE actividades SET $campo3  WHERE $campo1";
	echo $result=mysqli_query($conection,$consulta);

 ?>