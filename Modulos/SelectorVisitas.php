<?php
		   date_default_timezone_set('America/Lima');  
		   session_start();            
            $Users = $_SESSION['user'];
			
			//Conexión con BD
			require_once 'conexion.php';
			 
			$time = time();
			$Fecha= date('Y-m-d');
			$Hora = date("H:i:s", $time);

         	$consultaAsistencia = mysqli_query($conection, "SELECT * FROM asistencia WHERE user='$Users' AND fregistro='$Fecha'");
	        $result = mysqli_num_rows($consultaAsistencia);
	    if($result>0){
			//Consulta BD
			$consultaReg=mysqli_query($conection, "SELECT * FROM visita WHERE  usuario = '$Users' AND FechaCreacion='$Fecha' AND EstadoVisita='1' ");
			$result = mysqli_num_rows($consultaReg);

			if($result > 0){
			   
				header('location: FinVisita.php');
				}else{
			
				header('location: InicioVisita.php'); 				
			}	
	     }else{
	        
	        $alert = 'Error! Registre su asistencia del dia para poder continuar.';
	    }

		?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
	<link  rel="icon"   href="img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
	         
			<h3>Registro de Actividades</h3> <br>
			
			<img src="../img/businessman.png" alt="Login" style="width: 50%;">
            <br>
			
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div><br>
            
            <a href="SelectorIni.php"> 
              <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Volver atras" style="margin: 15px auto;text-align: center; display:inline-block;">
			</a>
           <br>
		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <label for="" style="font-size: 11.5px"><?php echo 'User:' . ' ' .$_SESSION['user'] ;?></label>
            <label for="" style="font-size: 11.5px">v.1.0</label>
        </div>
		</form>

	</section>

</body>
</html>