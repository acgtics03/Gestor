<?php 
	 
	$host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_appVisitas';
   /*
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_appvisitas2';
    */
	$conection = mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}
?>