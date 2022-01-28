<?php
            session_start();            
            $Users = $_SESSION['user'];
			
			//Conexión con BD
			require_once 'conexion.php';
			 
			$time = time();
			$Fecha= date('Y-m-d');
			$Hora = date("H:i:s", $time);
			$freg = date('Y-m-d');
			
       		 $ConsultarEstado = mysqli_query($conection, "SELECT * FROM permiso WHERE user='$Users' AND estado='POR APROBAR'");
			$mostrar3 = mysqli_num_rows($ConsultarEstado);

			if($mostrar3 > 0)  {
				$alert = 'Usted aun tiene un permiso pendiente de Autorización, comunicarse con su supervisor. Gracias';
			}else{ 

			//REPORTAR ESTADO APROBADO DE PERMISO
			$permisoaprobado =mysqli_query($conection, "SELECT * FROM permiso WHERE fsol='$freg' AND user='$Users' AND estado='APROBADO'");
			$estadopermiso = mysqli_num_rows($permisoaprobado);

			if($estadopermiso > 0){
				header('location: HomeEjecutarPermiso.php');
				
			}
			//----------------------------------------------------------------------

			//REPORTAR INICIO DE PERMISO
			$iniciopermiso=mysqli_query($conection,"SELECT * FROM permiso WHERE fsol='$freg' AND user='$Users' AND estado='INICIO PERMISO'");
			$estadoinicio = mysqli_num_rows($iniciopermiso);

			if($estadoinicio > 0){
				header('location: HomeEjecutarPermiso2.php');
				
			}
			//---------------------------------------------------------------------

			//REPORTAR FIN DE PERMISO
			$finpermiso=mysqli_query($conection,"SELECT * FROM permiso WHERE fsol='$freg' AND user='$Users' AND estado='FIN PERMISO'");
			mysqli_close($conection);
			$estadofin = mysqli_num_rows($finpermiso);

			if($estadofin > 0){
				header('location: HomePermiso.php');
				
			}
			//---------------------------------------------------------------------
			}
		?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
			
		    <h3>
			    Ejecución de Permiso
			</h3> <br>
	
			<img src="../img/businessman.png" alt="Login" style="width: 50%;">
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