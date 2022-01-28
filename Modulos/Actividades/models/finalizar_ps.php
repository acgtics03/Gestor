<?php 
	require_once "conexion.php";
	
	$vp = $_GET['SV'];

	$consulta = "UPDATE producto_servicio SET estado='FINALIZADO' WHERE idps='$vp'";
	$result=mysqli_query($conection,$consulta);
	
	$consulta2 = mysqli_query($conection, "SELECT * FROM producto_servicio WHERE estado='FINALIZADO' AND idps='$vp'");
	$result2=mysqli_num_rows($consulta2);
	
	if($result2>0){
	  echo '<script type="text/javascript"> 
                      alert("FINALIZADO CON EXITO!")
                      location.href="../Views/ProductosServicios.php";
                      </script>';
	}else{
	     echo '<script type="text/javascript"> 
                      alert("ERROR AL FINALIZAR REGISTRO!")
                      window.history.go(-1);
                      </script>';
	    
	}            

 ?>