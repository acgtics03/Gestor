<?php 
	require_once "conexion.php";
	$conexion=conexion();
	$ID=$_POST['ID'];
	$dni=$_POST['dni'];
	$fn=$_POST['fn'];
	$correo=$_POST['correo'];
	$apellido=$_POST['apellido'];
	$nombre=$_POST['nombre'];
	$direccion=$_POST['direccion'];
	$telefono=$_POST['telefono'];
	$ch=$_POST['ch'];
	$boxarea=$_POST['boxarea'];
	$boxcargo=$_POST['boxcargo'];
	$supervisor=$_POST['supervisor'];
	$estado=$_POST['estado'];
	$boxme=$_POST['boxme'];
	$fnei=$_POST['fnei'];
	$fnef=$_POST['fnef'];

	$consulta = mysqli_query($conexion, "UPDATE usuario SET estatus='$estado', MotivoEstado='$boxme', FecIniEstado='$fnei', FecFinEstado='$fnef' WHERE usuario='$correo'");

	$sql="UPDATE persona set DNI='$dni',
							FechaNacimiento='$fn',
							apellido='$apellido',
							nombre='$nombre',
							direccion='$direccion',
							Telefono='$telefono',
							CostoxHora='$ch',
							idArea='$boxarea',
							idCargo='$boxcargo',
							idJefeInmediato='$supervisor',
							estatus='$estado'
				where idcliente='$ID'";
	echo $result=mysqli_query($conexion,$sql);

 ?>