<?php 
     
	/**
	 * 
	 */
	class Conexion 
	{
		
		public static function Conectar()
		{	
			/*
		    $PDO = new PDO("mysql:host=localhost;dbname=acgsoft_Nominas;charset=utf8","acgsoft_appVisitas","adm2019acg");
			$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $PDO;
		*/	
		   	$PDO = new PDO("mysql:host=localhost;dbname=acgsoft_nominas;charset=utf8","root","");
			$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $PDO;
		
		/* $PDO = new PDO("mysql:host=localhost;dbname=acgsoft_nominas;charset=utf8","root","1234");
			$PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $PDO;*/
			
		}
	}

?>