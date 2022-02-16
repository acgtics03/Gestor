<?php
	/*
    $host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_Nominas';
	*/
    
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_appvisitas';
        
    /*
	$host = 'localhost';
	$user = 'root';
	$password = '1234';
	$db = 'acgsoft_appvisitas';
     */
     
	$conection_asistencia = mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexion";
	}

?>