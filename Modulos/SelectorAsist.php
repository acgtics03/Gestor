<?php
// Definir zona horaria
	date_default_timezone_set('America/Lima');
            session_start();            
            $Users = $_SESSION['user'];
			
			//Conexión con BD
			require_once 'conexion.php';
			 
			$time = time();
			$Fecha= date('Y-m-d');
			$Hora = date("H:i:s", $time);
			$freg = date('Y-m-d');
			$CtrlFec = date('d-m-Y');
			
     		$ConsultarEstado = mysqli_query($conection, "SELECT * FROM asistencia WHERE user = '$Users' AND fregistro ='$freg' AND Estado='SALIDA'");
			$mostrar3 = mysqli_num_rows($ConsultarEstado);
			if($mostrar3 > 0)  {
				$alert = 'El registro de su Asistencia fue completado por el dia de hoy.';
			}else{  
			//REPORTAR ASISTENCIA - INGRESO
			$AsisIngreso =mysqli_query($conection, "SELECT * FROM asistencia WHERE  user = '$Users' AND fregistro='$Fecha'");
			$ContIngreso = mysqli_num_rows($AsisIngreso);

			if($ContIngreso < 1){
			    
				header('location: AsistenciaIngreso.php');
				
			}
			//----------------------------------------------------------------------
			

			//REPORTAR ASISTENCIA - REFRIGERIO INICIO
			$AsisIniRefri=mysqli_query($conection,"SELECT * FROM asistencia WHERE  user = '$Users' AND fregistro='$Fecha' AND Estado='INGRESO' ");
			$ContIniRefri = mysqli_num_rows($AsisIniRefri);

			if($ContIniRefri > 0){

				header('location: AsistenciaIniRefri.php');
				
			}
			//---------------------------------------------------------------------

			
            //REPORTAR ASISTENCIA - REFRIGERIO FINAL
			$AsisFinRefri=mysqli_query($conection,"SELECT * FROM asistencia	WHERE  user = '$Users' AND fregistro='$Fecha' AND Estado='INICIO_REFRIGERIO'");
			$ContFinRefri = mysqli_num_rows($AsisFinRefri);

			if($ContFinRefri > 0){

                header('location: AsistenciaFinRefri.php');
			}
			//---------------------------------------------------------------------

			
			//REPORTAR ASISTENCIA - SALIDA
			$sql3="SELECT * 
			FROM asistencia
			WHERE  user = '$Users' AND fregistro='$Fecha' AND Estado='FIN_REFRIGERIO' ";
			$resultado3=mysqli_query($conection, $sql3);
			$result3 = mysqli_num_rows($resultado3);

			if($result3 > 0){
			    

                header('location: AsistenciaSalida.php');
				}
			//---------------------------------------------------------------------
			}
			
			$alert = 'Usted a completado el registro de asistencia por el dia de hoy '.$CtrlFec.', Gracias';
		?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
	<title>ACG</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
	         
			<h3>
			    Registro de Asistencia
			</h3> <br>
	
            <img src="../img/login2.png" alt="Login" style="width: 50%;">
            <br>
            <!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <br>
            
           <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Regresar">
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