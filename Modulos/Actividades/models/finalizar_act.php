<?php 
	require_once "conexion.php";
	
	$vp = $_GET['CA'];

	$consulta = "UPDATE actividades SET estado='FINALIZADO' WHERE idactividades='$vp'";
	$result=mysqli_query($conection,$consulta);
	
	$consulta2 = mysqli_query($conection, "SELECT * FROM actividades WHERE estado='FINALIZADO' AND idactividades='$vp'");
	$result2=mysqli_num_rows($consulta2);
	
	if($result2>0){
	  echo '<script type="text/javascript"> 
                      alert("FINALIZADO CON EXITO!")
                      location.href="../Views/SeguimientoActividades.php";
                      </script>';
	}else{
	     echo '<script type="text/javascript"> 
                      alert("ERROR AL FINALIZAR REGISTRO!")
                      window.history.go(-1);
                      </script>';
	    
	}            

 ?>