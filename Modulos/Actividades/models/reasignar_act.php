<?php 
	require_once "conexion.php";
	
	$ID3=$_POST['ID3'];
	$nombre3=$_POST['nombre3'];
	$descripcion3=$_POST['descripcion3'];
	$nombre4=$_POST['nombre4'];
	$bxresponsable=$_POST['bxresponsable'];
	
	$ver_idusuario = mysqli_query($conection, "SELECT u.idusuario as id FROM usuario u, persona p WHERE u.usuario=p.idusuario AND concat(p.apellido,' ',p.nombre)='$nombre4'");
	$ver_idusuarior = mysqli_fetch_assoc($ver_idusuario);
	
	$idusuario = $ver_idusuarior['id'];

	$ver_person = mysqli_query($conection, "SELECT idusuario as usu FROM usuario WHERE usuario='$bxresponsable'");
	$ver_personr = mysqli_fetch_assoc($ver_person);
	
	$person = $ver_personr['usu'];
	
	if(!empty($person)){
	    $indicador = "participante='$idusuario'";
	    $indicador2 = "responsable='$person' WHERE idactividades='$ID3' AND responsable='$idusuario'";
	    $indicador11= "vinculo='$ID3' AND responsable='$idusuario'";
	}
	
	$consult = mysqli_query($conection, "UPDATE participantes_tareas SET participante='$person' WHERE idactividad='$ID3' AND $indicador");
	
	$act_act=mysqli_query($conection, "UPDATE tareas SET responsable='$person' WHERE $indicador11");
	
	$consulta = "UPDATE actividades SET $indicador2";
	echo $result=mysqli_query($conection,$consulta);
    
 ?>