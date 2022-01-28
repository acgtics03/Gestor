<?php 
	require_once "conexion.php";
	
	$ID_a=$_POST['ID_a'];
	$nombre_a=$_POST['nombre_a'];
	$descripcion_a=$_POST['descripcion_a'];
	$bxm=$_POST['bxm'];
	$desc=$_POST['desc'];
	
	if(empty($bxm)){
	    $campo3 = "error";
	}else{
	    $campo3 = "estado='ELIMINADO'";
	    $campo5 = "MotivoEliminado='$bxm'";
	   
	}
	if(empty($desc)){
	    $campo1 = "error";
	}else{
	    $campo1 = "idactividades='$ID_a'";
	    $campo6 = "DescEliminado='$desc'";
	}
	
	$consulta = "UPDATE actividades SET $campo3 $campo5 $campo6  WHERE $campo1";
	echo $result=mysqli_query($conection,$consulta);

 ?>