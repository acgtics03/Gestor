<?php

	// Definir zona horaria
	date_default_timezone_set('America/Lima');

	//Activar la sesiÃ³n
	session_start();
    $email = $_SESSION['user'];
	//ConexiÃ³n con BD
	require_once 'conexion.php';
    $tipo_input = 'submit';
    //Inicializar e mÃ©todo POST
    if (!empty($_POST)){

        //Recuperar variables tiempo
        $time = time();
        $freg = date('Y-m-d');
        $Hora = date("H:i:s", $time);

        //ValidaciÃ³n inicio de registro
        $consulta = "SELECT Estado FROM ProcesoAsistencia WHERE User = '$email' AND Fecha ='$freg'";
        $result = mysqli_query($conection, $consulta);
        $mostrar3 = mysqli_num_rows($result);


      if($mostrar3 < 1)  {
        //Grabar informaciÃ³n asistencia en BD
     
                   //Query grabar
                    $sql3 = "INSERT INTO asistencia(fregistro, user, ingreso, Estado) VALUES('$freg', '$email', '$Hora', 'INGRESO')";
                    mysqli_query($conection, $sql3);
                    mysqli_close($conection);
                    $tipo_input = 'hidden';
                    $alert = "Se ha registrado correctamente su ingreso. Muchas Gracias";

      } 
        
    }           
?>

    
<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Home</title>

	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			<h3>Registro de Asistencia</h3>
            <script type="text/javascript">ShowHiddenElement(){if($("#123"))}</script>
           
            <div id="map"></div>
            <script src="script.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnMhTCra_vc5tjCj54AtGTc_g540b9GyM&callback=iniciarMap"></script>


            <!-- Campos de asistencia-->
           <input type="<?php echo $tipo_input; ?>" name="Registrar" value="Registrar Ingreso" style="font-size: 15px" onClick=""></input>


			<!-- NotificaciÃ³n de acciÃ³n -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            
            <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Salir">
            </a>
            <br>

			<!-- Mostrar cuenta de usuario activo -->
			<label for="" style="font-size: 15px"><?php echo 'Usuario:' . ' ' .$_SESSION['user'] ;?></label>

		</form>

	</section>
</body>
</html>