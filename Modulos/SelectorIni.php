<?php

	//Activar sesión
	session_start();

	//Recuperar variable de usuario
	$account=$_SESSION['user'];
	$_SESSION['usu'] = $account;
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
	
	//Conexión con BD
		require_once 'conexion.php';
	
	//Consulta de variables
		$sql3 = "SELECT * FROM persona WHERE idusuario ='$account' and TipoTrabajador='SUPERVISOR' ";
		$result3 = mysqli_query($conection, $sql3);
		$mostrar3 = mysqli_num_rows($result3);

		//ValidaciÃ³n de estado
		if($mostrar3 == 0){
			$tipo_input = 'hidden';
			//$alert = $tipo_input . ' ' . $account . ' ' . $mostrar3['idJefeInmediato'];
		}else{
			$tipo_input = 'button';
			//$alert = $tipo_input . ' ' . $account;
		}
		
		if($account=="admin@acg.com.pe"){
		    $tipo_input = 'button';
		}
		
		if($account=="dtrinidad@acg-soft.com"){
		    $tipo_input2 = 'button';
		}

	if(!empty($_POST)){

		//Conexión con BD
		require_once 'conexion.php';
		
		//Variable de tiempo
		$freg = date('Y-m-d');

		//Variable libre
		$b1 = '';
		
		//Recuperar variable
		$b1 = $_POST['btton'];
		
	
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
			           
			<h3 style="border-radius: 11px 11px 11px 11px;">
			    OCURRENCIA PERSONAL
			</h3> <br>
			
			<script type="text/javascript">

				ShowHiddenElement(){
					if($("#123"))
				}
			</script>

		    <!--<img src="../img/frm.png" style="width: 90%; text-align: center;"><br>-->
            <br>
			<input type="button" value="ASISTENCIA" onclick="location='SelectorAsistencia.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 50%;
			font-size: 12pt;
			">
            
            <input type="button" value="VISITAS" onclick="location='SelectorVisitas.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 50%;
			font-size: 12pt;
			">
			
			<input type="button" value="ACTIVIDADES" onclick="location='../AppActividades/principal.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 50%;
			font-size: 12pt;
			">
			
            
            <input type="<?php echo $tipo_input ; ?>" value="CONTROL" onclick="location='HomeControl.php'" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 50%;
			font-size: 12pt;
			">
            <br>

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
                <img class="close" src="../sistema/img/cerrar.png" alt="Salir del sistema" style="margin: 15px auto;text-align: center; display: block;">
			</a><br>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>

</body>
</html>