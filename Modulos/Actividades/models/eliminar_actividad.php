<?php 
	require_once "conexion.php";
	
	$ID_a=$_POST['ID_a'];
	$nombre_a=$_POST['nombre_a'];
	$descripcion_a=$_POST['descripcion_a'];
	$boxmotivo=$_POST['boxmotivo'];
	$descripcion2=$_POST['descripcion2'];
	
	$campo3 = "error";
	$campo1 = "error";
	$campo5 = "error";
	$campo6 = "error";
	
	if(!empty($boxmotivo)){
	    $campo3 = "estado='ELIMINADO'";
	    $campo5 = "MotivoEliminado='$boxmotivo'";
	   
	}
	if(!empty($descripcion2)){
	    $campo1 = "idactividades='$ID_a'";
	    $campo6 = "DescEliminado='$descripcion2'";
	}
	
	$consulta = "UPDATE actividades SET $campo3, $campo5, $campo6  WHERE $campo1";
	echo $result=mysqli_query($conection,$consulta);

 ?>