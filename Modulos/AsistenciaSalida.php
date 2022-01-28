<?php

// Definir zona horaria
	date_default_timezone_set('America/Lima');

	//Activar la sesiÃ³n
	session_start();
 //Recuperar variables datos
 $email = $_SESSION['user'];
 $account = $_SESSION['user'];
	//ConexiÃ³n con BD
	require_once 'conexion.php';
    $tipo_input = 'submit';
    //Inicializar e mÃ©todo POST
    
  if(!empty($email)){
    
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

    }else{
        if(!empty($email)){  
            if (!empty($_POST)){
                
                //Recuperar variables tiempo
                $time = time();
                $freg = date('Y-m-d');
                $Hora = date("H:i:s", $time);
                $longitud = $_SESSION['lng'];
                $latitud = $_SESSION['ltd'];  

                if($Hora>'17:59:59'){
                
                $ConsultarEstado = mysqli_query($conection, "SELECT * FROM asistencia WHERE user = '$email' AND fregistro ='$freg' AND Estado='SALIDA'");

                if($ConsultarEstado<>'SALIDA'){
                
            
                //ValidaciÃ³n inicio de registro
                $consulta = "SELECT * FROM asistencia WHERE user = '$email' AND fregistro ='$freg' AND Estado='FIN_REFRIGERIO'";
                $result = mysqli_query($conection, $consulta);
                $mostrar3 = mysqli_num_rows($result);


                    if($mostrar3 > 0)  {
            
                            //Query grabar
                            $sql3 = "UPDATE asistencia SET salida='$Hora', Estado='SALIDA', LongSalida='$longitud', LatSalida='$latitud' WHERE fregistro = '$freg' AND user = '$email' ";
                            mysqli_query($conection, $sql3);
                            mysqli_close($conection);
                            $tipo_input = 'hidden';
                            $alert = "Fue un excelente día. Hasta pronto!";
                    }}else{
                        $tipo_input = 'hidden';
                        $alert = "Su salida de hoy ya fue registrado. Gracias";
                    } 
                }else{
                $alert = "Error! Marcar salida a partir de las 6:00 pm";  
            }   
            }
        }else{
            session_destroy();
            header("Location: ../index.php");
        } 
    }} 
    
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
<html lang="es">
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
			<h3>
            Registro de Asistencia
            </h3>
            <br>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0dZegZtV3rwam4pbgiPZJdSndRzEo38Y"></script>
            <script>
               
			   		var output = document.getElementById('map');

					if(navigator.geolocation){
						//output.innerHTML = "<p>Tu mavegador soporta Geolocalizacion</p>";
					}else{
						//output.innerHTML = "<p>Tu mavegador no soporta Geolocalizacion</p>";
					}

					function localizacion(posicion){
						var latitude = posicion.coords.latitude;
						var longitude = posicion.coords.longitude;

						document.getElementById("lati").value = latitude;
						document.getElementById("long").value = longitude;
					}


					function error(){
						output.innerHTML = "<p>No se pudo obtener tu ubicacion</p>";
					}

					navigator.geolocation.getCurrentPosition(localizacion,error);

					
			</script>
              <?php 
                 
                 
                $longitud = $_SESSION['lng'];
                $latitud = $_SESSION['ltd'];   
                
                //echo "latitud :".$latitud." ,longitud :".$longitud;
                
                /*if(!empty($_POST)){
                   //$longitud = $_POST['long'];
                   //$latitud = $_POST['lati'];
                    $longitud = '-77.0300854';
                    $latitud = '-12.1196629'; 
                }*/
                
            ?>

             <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15603.618923456568!2d<?php echo $longitud; ?>!3d<?php echo $latitud; ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1579018299941!5m2!1ses-419!2spe" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>


            <!-- Campos de asistencia-->
           <input type="<?php echo $tipo_input; ?>" name="Registrar" value="Registrar Salida" style="font-size: 15px" onClick=""></input>


			<!-- NotificaciÃ³n de acciÃ³n -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            
            <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Salir">
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