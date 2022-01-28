<?php

	//Activar sesión
	session_start();

	//Recuperar variable de usuario
	$account=$_SESSION['user'];
	
	//Conexión con BD
		require_once 'conexion.php';
	
	// El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();

  if(!empty($account)){		
	$inactividad = 1200;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
                session_destroy();
           
                echo '<script type="text/javascript">';
                echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
                echo '</script>';
                echo '<script type="text/javascript">';
                echo 'location.href="../index.php"';
                echo '</script>';
        }
    }
  }else{
      
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="../index.php"';
        echo '</script>';
      
  }
    
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="../img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<!-- Mostrar cuenta de usuario activo -->
			           
			<h3>
			    SELECCIONAR PERFIL
			</h3> <br>
			

		    <!--<img src="../img/frm.png" style="width: 90%; text-align: center;"><br>-->
            <br>
			<input type="button" value="OPERATIVO" onclick="location='SelectorIni.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 55%;
			font-size: 12pt;
			">
            
            <input type="button" value="ADMINISTRADOR" onclick="location='../Modulo_administrador/HomeAdmin.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 55%;
			font-size: 12pt;
			">
		<?php

			
			//Conexión con BD
			require_once 'conexion.php';

			//Consulta BD
			$sql="SELECT * FROM persona WHERE idusuario = '$account'";
			$resultado=mysqli_query($conection, $sql);
			$mostrar=mysqli_fetch_assoc($resultado);
       
			//Cerrar
			//session_destroy();
		?>
		
			<!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

           <a href="../sistema/salir.php">
                <img class="close" src="../sistema/img/cerrar.png" alt="Salir del sistema" title="Salir" style="margin: 15px auto;text-align: center; display: block;">
			</a><br>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>

</body>
</html>