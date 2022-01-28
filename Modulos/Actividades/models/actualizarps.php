<?php 
	require_once "conexion.php";
	
	$ID=$_POST['ID'];
	$tipo=$_POST['tipo'];
	$bxestado=$_POST['bxestado'];
	$boxempresa=$_POST['boxempresa'];
	$nombres=$_POST['nombres'];
	$descripcion=$_POST['descripcion'];
	$boxArea=$_POST['boxArea'];
	$boxResponsable=$_POST['boxResponsable'];
	$fecinicio=$_POST['fecinicio'];
	$fecinicioreal=$_POST['fecinicioreal'];
	$fecfinal=$_POST['fecfinal'];
	$fecfinalreal=$_POST['fecfinalreal'];
	
	$consultaa = mysqli_query($conection, "SELECT a.idArea as area FROM persona p, usuario u, area a WHERE p.idusuario=u.usuario AND p.idArea=a.idArea AND u.idusuario='$boxResponsable'");
	$consultaar = mysqli_fetch_assoc($consultaa);
	
	$idarea = $consultaar['area'];
	
	$consult = mysqli_query($conection, "SELECT idgestion as id FROM tipos WHERE nombre='$nombres' AND ((area='$idarea' AND categoria='$tipo') OR (area='Todos' AND categoria='Todos'))");
	$consultr = mysqli_fetch_assoc($consult);
	
	$idgestion = $consultr['id'];

	$consulta = "UPDATE producto_servicio SET categoria='$tipo', nombre='$idgestion', descripcion='$descripcion', empresa='$boxempresa', area='$boxArea', responsable='$boxResponsable', 
	fecinicio='$fecinicio', fecfin='$fecfinal', fecinicioReal='$fecinicioreal', fecfinReal='$fecfinalreal', estado='$bxestado'  WHERE idps='$ID'";
	echo $result=mysqli_query($conection,$consulta);

 ?>