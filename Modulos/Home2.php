<?php

	// Definir zona horaria
	date_default_timezone_set('America/Lima');

	//Activar la sesión
	session_start();


	//Conexión con BD
	require_once 'conexion.php';

	//Recuperar variables tiempo
	$time = time();
	$freg = date('Y-m-d');

	//Recuperar variables datos
	$email = $_SESSION['user'];
	$ingreso = date("H:i:s", $time);
	$irefrigerio = date("H:i:s", $time);
	$frefrigerio = date("H:i:s", $time);
	$salida = date("H:i:s", $time);
	
	//Validación inicio de registro
	$consulta = "SELECT * FROM asistencia WHERE fregistro = '$freg' AND user = '$email' ";
	$result = mysqli_query($conection, $consulta);
	$mostrar2 = mysqli_fetch_assoc($result);

	//Cierre de consulta
	//mysqli_close($conection);


	//Condición de consulta 1: Ingreso
	if ($mostrar2['ingreso'] == ''){

		//Query grabar
		$sql3 = "INSERT INTO asistencia(fregistro, user, ingreso) VALUES('$freg', '$email', '$ingreso')";
		mysqli_query($conection, $sql3);

		//Cerrar consulta
		mysqli_close($conection);

		$alert = 'Registro efectuado';

		//echo $mostrar2['ingreso'];
	
	}else{
		$alert = 'Ya se ha realizado el registro';
	}

	//Condición de consulta 2: Inicio Refrigerio
	if($mostrar2['ingreso'] <> '' && $mostrar2['irefrigerio'] == ''){
		
		//Query grabar
		$sql3 = "UPDATE asistencia SET irefrigerio='$irefrigerio' WHERE fregistro = '$freg' AND user = '$email' ";
		mysqli_query($conection, $sql3);

		//Cerrar consulta
		mysqli_close($conection);

		$alert = 'Registro efectuado';

	}else{
		$alert = 'Ya se ha realizado el registro';
	}

	//Condición de consulta 3: Fin Refrigerio
	if($mostrar2['ingreso'] <> '' && $mostrar2['irefrigerio'] <> '' && $mostrar2['frefrigerio'] == ''){
		
		//Query grabar
		$sql3 = "UPDATE asistencia SET frefrigerio='$frefrigerio' WHERE fregistro = '$freg' AND user = '$email' ";
		mysqli_query($conection, $sql3);

		//Cerrar consulta
		mysqli_close($conection);

		$alert = 'Registro efectuado';

	}else{
		$alert = 'Ya se ha realizado el registro';
	}

	//Condición de consulta 4: Salida
	if($mostrar2['ingreso'] <> '' && $mostrar2['irefrigerio'] <> '' && $mostrar2['frefrigerio'] <> '' && $mostrar2['salida'] == ''){
		
		//Query grabar
		$sql3 = "UPDATE asistencia SET salida='$salida' WHERE fregistro = '$freg' AND user = '$email' ";
		mysqli_query($conection, $sql3);

		//Cerrar consulta
		mysqli_close($conection);

		$alert = 'Registro efectuado';

	}else{
		$alert = 'Ya se ha realizado el registro';
	}


?>




<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<h3>Asistencia</h3><br>

            <!-- Campos de asistencia -->
            <input type="submit" value="INGRESO" style="font-size: 15px"></input>

            <input type="submit" value="INICIO REFRIGERIO" style="font-size: 15px"></input>

			<input type="submit" value="FIN REFRIGERIO" style="font-size: 15px"></input>

            <input type="submit" value="SALIDA" style="font-size: 15px"></input>

			<!-- Campos de permisos -->
            <input type="submit" value="INICIO PERMISO" style="font-size: 15px"></input>

			<input type="submit" value="FIN PERMISO" style="font-size: 15px"></input>


			<!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <a href="Selector.php">
                <img class="close" src="../sistema/img/back.png" alt="Salir del sistema" title="Salir">
            </a>

<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <label for="" style="font-size: 11.5px"><?php echo 'User:' . ' ' .$_SESSION['user'] ;?></label>
            <label for="" style="font-size: 11.5px">v.1.0</label>
        </div>
		</form>

	</section>
</body>
</html>