<?php
	 /*
	$host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_appVisitas';
   */
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_cn_planificador';

	$conection_cn = mysqli_connect($host,$user,$password,$db);
    mysqli_set_charset($conection_cn, 'utf8'); //linea a colocar

	if(!$conection){
		echo "Error en la conexión";
	}
?>
