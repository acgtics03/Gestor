<?php

	//Activar sesión
	session_start();

	//Recuperar variable de usuario
	$account=$_SESSION['user'];

    	// El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
	
	if(!empty($account)){
		
	$inactividad = 1200;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            //session_destroy();
            //header("Location: ../index.php");
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

	//Acceso a Autorización
	
	//Conexión a BD
	require_once 'conexion.php';

	//Consulta de variables
	$sql3 = "SELECT * FROM persona WHERE idJefeInmediato ='$account' ";
	$result3 = mysqli_query($conection, $sql3);
	$mostrar3 = mysqli_num_rows($result3);

	//Validación de estado
	if($mostrar3 == 0){
		$tipo_input = 'hidden';
		//$alert = $tipo_input . ' ' . $account . ' ' . $mostrar3['idJefeInmediato'];
	}else{
		$tipo_input = 'button';
		//$alert = $tipo_input . ' ' . $account;
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
		
		if($b1){
			//Consulta BD - permiso
			$sql2 = "SELECT * FROM permiso WHERE fsol='$freg' AND user='$account'";
			$result2 = mysqli_query($conection, $sql2);
			mysqli_close($conection);
			$mostrar2 = mysqli_num_rows($result2);
			//Validación de vista
			if($mostrar2 > 0){
				header('location: SelectorPermiso.php');
			}else{
				header('location: HomePermiso.php');
			}
		}
	}
	
	if(isset($_POST['btnAsistencia'])){
	    $_SESSION['ltd'] = $_POST['txtlatitud'];
        $_SESSION['lng'] = $_POST['txtlongitud'];
        
        header("location: SelectorAsist.php");
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="../img/icon.png" type="image/png" />
	<title><?php include_once "NombreApp.php"; ?></title>
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
			    Control Asistencia
			</h3> <br>

		    <!--<img src="../img/frm.png" style="width: 90%; text-align: center;"><br>-->
            <div hidden="">
            <input type="text" id="txtlongitud" name="txtlongitud">
            <input type="text" id="txtlatitud" name="txtlatitud">
            <p hidden=""><button onclick="geoFindMe()">Show my location</button></p>
            <div id="out"></div>
            </div>
            
			<input type="submit" value="Registrar Asistencia" id="btnAsistencia" name="btnAsistencia" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 60%;
			font-size: 12pt;
			">
            
			<input type="submit" name="btton" value="Solicitar Permiso" style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 60%;
			font-size: 12pt;
			">
			
			
			<input type="<?php echo $tipo_input ; ?>" id='auto' value="Autorizar Permiso" onclick="location='SelectorAvisoPermiso.php'"  style="
			background:  #001843;
			padding: 15px;
			color: #FFF;
			letter-spacing: 1px;
			border: 0;
			cursor: pointer;
			width: 60%;
			font-size: 12pt;
			">
         <p><center>
             <div style="display: inline">
                <div style="display: inline-block">
                  <a href="SelectorIni.php"><img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Volver atras"></a>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;
                <div style="display: inline-block">
                  <a href="../sistema/salir.php"><img class="close" src="../sistema/img/cerrar.png" alt="Salir del sistema" title="Cerrar sesión"></a>
                </div>
             </div>
			</center>
         </p><?php

			
			//Conexión con BD
			require_once 'conexion.php';

			//Consulta BD
			$sql="SELECT * FROM persona WHERE idusuario = '$account'";
			$resultado=mysqli_query($conection, $sql);
			$mostrar=mysqli_fetch_assoc($resultado);
       
		
		?>
		
		<!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>
	
	<script>
        geoFindMe();
        function geoFindMe() {
        var output = document.getElementById("out");
    
        if (!navigator.geolocation){
            output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
            return;
        }
    
        function success(position) {
            var latitude  = position.coords.latitude;
            var longitude = position.coords.longitude;
    
                document.getElementsByName("txtlongitud")[0].value = longitude;
                document.getElementsByName("txtlatitud")[0].value = latitude;
            /*
            output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';
            
            var img = new Image();
            img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
    
            output.appendChild(img);*/
        };
    
        function error() {
            output.innerHTML = "Unable to retrieve your location";
        };
    
        output.innerHTML = "<p>Locating…</p>";
    
        navigator.geolocation.getCurrentPosition(success, error);
        }
    </script>
    

</body>
</html>