<?php
		   date_default_timezone_set('America/Lima');  
		   session_start();            
            $Users = $_SESSION['user'];
			
			//Conexión con BD
			require_once 'conexion.php';
			 
			$time = time();
			$Fecha= date('Y-m-d');
			$Hora = date("H:i:s", $time);

			$consultaReg=mysqli_query($conection, "SELECT pr.*, p.* FROM permiso pr, persona p WHERE pr.user=p.idusuario AND idJefeInmediato='$Users' AND pr.estado='POR APROBAR'");
			$result = mysqli_num_rows($consultaReg);
	    if($result>0){
			//Consulta BD
			   
				header('location: HomeAutorizacion.php');
				}else{
			
	        $alert = 'Usted no tiene solicitudes de permiso del personal a cargo.';
	    }

		?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
	
	<title>ACG</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
	         
			<h3>PERMISOS</h3> <br>
			
			<img src="../img/businessman.png" alt="Login" style="width: 50%;">
            <br>
			
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div><br>
            
            <a href="SelectorAsistencia.php"> 
              <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Volver atras" style="margin: 15px auto;text-align: center; display:inline-block;">
			</a>
           <br>
		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>

</body>
</html>