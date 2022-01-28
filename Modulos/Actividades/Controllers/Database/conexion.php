<?php 
	 
	$host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_appVisitas';
   
	$conection = mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexion";
	}
?>