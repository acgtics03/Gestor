<?php


	// Definir zona horaria
	date_default_timezone_set('America/Lima');

	//Activar la sesiÃ³n
	session_start();
    $email = $_SESSION['user'];
    $account = $_SESSION['user'];

    $valor_lo = '';
    $valor_la = '';
    

    //echo 'Long: '.$valor_lo.' - Latitud:'.$valor_la;
    
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

                    //ConexiÃ³n con BD
                    require_once 'conexion.php';
                    $tipo_input = 'submit';
                    //Inicializar e mÃ©todo POST
                    if (!empty($_POST)){

                        //Recuperar variables tiempo
                        $time = time();
                        $freg = date('Y-m-d');
                        $Hora = date("H:i:s", $time);
                        $longitud = $_SESSION['lng'];
                        $latitud = $_SESSION['ltd'];   

                        if(!empty($email)){   

                            //ValidaciÃ³n inicio de registro
                            $consultaPerfil = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$email' AND idPerfil='2'");
                            $ResultadoPerfil = mysqli_num_rows($consultaPerfil);
                            
                            if(empty($longitud)){
                               $longitud="0"; 
                            }
                             if(empty($latitud)){
                               $latitud="0"; 
                            }

                            if($ResultadoPerfil > 0)  {
                                //Grabar informaciÃ³n asistencia en BD
                            
                                        //Query grabar
                                            $sql3 = "INSERT INTO asistencia(fregistro, user, ingreso,irefrigerio, frefrigerio, Estado,LongIngreso, LatIngreso) VALUES('$freg', '$email', '$Hora','13:00:00','14:00:00', 'FIN_REFRIGERIO',$longitud, $latitud)";
                                            mysqli_query($conection, $sql3);
                                            
                                            $tipo_input = 'hidden';
                                            $alert = "Se ha registrado correctamente su ingreso. Muchas Gracias";

                            }   
                        
                            $consulPerfil = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$email' AND (idPerfil='3' OR idPerfil='4')");
                            $ResulPerfil = mysqli_num_rows($consulPerfil);
                        
                        
                            if($ResulPerfil > 0)  {
                                //Grabar informaciÃ³n asistencia en BD
                            
                                        //Query grabar
                                            $sql3 = "INSERT INTO asistencia(fregistro, user, ingreso, Estado,LongIngreso, LatIngreso) VALUES('$freg', '$email', '$Hora', 'INGRESO',$longitud, $latitud)";
                                            mysqli_query($conection, $sql3);
                                        
                                            $tipo_input = 'hidden';
                                            $alert = "Se ha registrado correctamente su ingreso. Muchas Gracias";

                            }
                        }else{
                            session_destroy();
                            header("Location: ../index.php");
                        } 
                    }   
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
  
      

      //echo 'Longitud :'.$valor_lo.' '.'Latitud :'.$valor_la;
      
?>

    
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
    <link  rel="icon"   href="../img/icon.png" type="image/png" />
	<title><?php include_once "NombreApp.php"; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
	<section id="container">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
		<form action="" method="post">
			<h3>Registro de Asistencia</h3>
           <br>
           
                <input type="hidden" name="long" id="long">
                <input type="hidden" name="lati" id="lati">
      
            
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


           <!-- Campos de asistencia


            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw3_AJDyLZNSCBu7bglC8SLEKxl7wI9tk"></script>
            <script>
               
                        var latitude = posicion.coords.latitude;
                        var longitude = posicion.coords.longitude;

                        var imgURL = "https://maps.googleapis.com/maps/api/staticmap?center="+latitude+","+longitude+"&size=600x300&markers=color:red%7C"+latitude+","+longitude+"&key=AIzaSyDw3_AJDyLZNSCBu7bglC8SLEKxl7wI9tk";

                        output.innerHTML = "<iframe src='https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15603.618923456568!2d-76.969403!3d-12.162629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1579018299941!5m2!1ses-419!2spe' width='400' height='300' frameborder='0' style='border:0;' allowfullscreen=''></iframe>";
                        
                       output.innerHTML = "<p>Latitud: "+latitude+"<br> Longitude: "+longitude+"</p>";
                  
            </script> -->

           <input type="<?php echo $tipo_input; ?>" name="Registrar" value="Registrar Ingreso" style="font-size: 15px" onClick=""></input>


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