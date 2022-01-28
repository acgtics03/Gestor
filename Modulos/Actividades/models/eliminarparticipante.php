<?php 
	require_once "conexion.php";
	
	$IDp=$_POST['IDp'];
	$bxmo=$_POST['bxmo'];
	$desc_eliminado=$_POST['desc_eliminado'];
	
	if($bxmo==0){
	    $campo3 = "error";
	}else{
	    $campo3 = "estado='eliminado'";
	    $campo5 = "MotivoEliminado='$bxmo'";
	   
	}
	if(empty($desc_eliminado)){
	    $campo1 = "error";
	}else{
	    $campo1 = "idparticipante='$IDp'";
	    $campo6 = "DescEliminado='$desc_eliminado'";
	}
	
	$consulta = "UPDATE participantes_tareas SET $campo3, $campo5, $campo6  WHERE $campo1";
	echo $result=mysqli_query($conection,$consulta);

 ?>