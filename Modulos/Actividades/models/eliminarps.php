<?php 
	require_once "conexion.php";
	
	$IDs=$_POST['IDs'];
	$boxmotivo=$_POST['boxmotivo'];
	$descripcion2=$_POST['descripcion2'];
	$tiposs=$_POST['tiposs'];
	
	if($boxmotivo==0){
	    $campo1 = "error";
	}else{
	    $campo1 = "MotivoEliminado='$boxmotivo',";
	    $campo3 = "estado='ELIMINADO'";
	    $campo5 = "MotivoEliminado='$boxmotivo'";
	    $campo6 = "DescEliminado='$descripcion2'";
	}
	
	if(empty($descripcion2)){
	    $campo2 = "error";
	}else{
	    $campo2 = "DescEliminado='$descripcion2',";
	    $campo4 = "vinculo='$IDs' AND identificador='$tiposs'";
	}
	
	$eliminar = mysqli_query($conection, "UPDATE actividades_participante SET $campo3, $campo5, $campo6 WHERE $campo4");
	
	$eliminar2 = mysqli_query($conection, "UPDATE actividades SET $campo3, $campo5, $campo6  WHERE $campo4");
	
	$consulta = "UPDATE producto_servicio SET $campo1 $campo2 estado='ELIMINADO' WHERE idps='$IDs'";
	echo $result=mysqli_query($conection,$consulta);

 ?>