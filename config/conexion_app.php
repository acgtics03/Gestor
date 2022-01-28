<?php 
	 
	$host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_appVisitas';
   /*
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_asistencia';
    */
	$conection = mysqli_connect($host,$user,$password,$db);
    mysqli_set_charset($conection, 'utf8'); //linea a colocar
    
	if(!$conection){
		echo "Error en la conexión";
	}
?>