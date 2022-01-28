<?php 
	require_once "conexion.php";
	$conexion=conexion();
	$idpersona=$_POST['idpersona'];
	$nombreu=$_POST['nombreu'];
	$datepicker3=$_POST['datepicker3'];
	$ing=$_POST['ing'];
	$rfini=$_POST['rfini'];
	$rffin=$_POST['rffin'];
	$sal=$_POST['sal'];

	$sql="UPDATE asistencia set fregistro='$datepicker3',
								ingreso='$ing',
								irefrigerio='$rfini',
								frefrigerio='$rffin',
								salida='$sal'
				where id='$idpersona'";
	echo $result=mysqli_query($conexion,$sql);

 ?>