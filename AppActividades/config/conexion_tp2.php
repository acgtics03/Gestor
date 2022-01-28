<?php

    $host = 'localhost';
	$user = 'acgsoft_appVisitas';
	$password = 'adm2019acg';
	$db = 'acgsoft_Nominas';
   /*
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_nominas';
     */
     /*
    $host = 'localhost';
	$user = 'root';
	$password = '1234';
	$db = 'acgsoft_nominas';
     */
	$conection = mysqli_connect($host,$user,$password,$db);
	$conection->set_charset("utf8");


	if(!$conection){
		echo "Error en la conexi贸n";
	}

?>