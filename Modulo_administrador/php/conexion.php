

<?php 
		function conexion(){
			$servidor="localhost";
			$usuario="acgsoft_appVisitas";
			$password="adm2019acg";
			$bd="acgsoft_appVisitas";

			$conexion=mysqli_connect($servidor,$usuario,$password,$bd);

			return $conexion;
		}

 ?>