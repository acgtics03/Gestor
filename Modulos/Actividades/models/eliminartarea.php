<?php 
	require_once "conexion.php";
	
	$ID_act=$_POST['ID_act'];
	$nombre_act=$_POST['nombre_act'];
	$descripcion_act=$_POST['descripcion_act'];
	$bxm=$_POST['bxm'];
	$desc=$_POST['desc'];
	
	if($bxm==0){
	    $campo3 = "error";
	}else{
	    $campo3 = "estado='ELIMINADO'";
	    $campo5 = "MotivoEliminado='$bxm'";
	   
	}
	if(empty($desc)){
	    $campo1 = "error";
	}else{
	    $campo1 = "idtareas='$ID_act'";
	    $campo6 = "DescEliminado='$desc'";
	}
	
	$consulta = "UPDATE tareas SET $campo3, $campo5, $campo6  WHERE $campo1";
	echo $result=mysqli_query($conection,$consulta);

 ?>