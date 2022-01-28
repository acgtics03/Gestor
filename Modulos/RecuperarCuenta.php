<?php 
	
$alert = '';
//VARIABLE DE SESION
session_start();
 
	//Establecemos el método GET
	if(!empty($_POST))
	{
		//Comprobamos que en la variable GET exista algun valor para usuario y para clave
		if(empty($_POST['Codigo']) || empty($_POST['Contraseña']))
		{
            //caso contrario se inicia la conexion con la BD para validar los datos infgresados
			require_once "conexion.php";

			//Se crea un conjunto de caractees predeterminado para los datos usuario y clave
			$user=$_SESSION['Usser'];
            $pass = $_POST['Contraseña'];
            $pass2 = $_POST['Contraseña2'];
            
            if($pass==$pass2)
			{

			//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user'");
		    //Se cierra la conexion
			//mysqli_close($conection);
			//Se crea una nueva variable que tendra el total de filas de los registros encontrados en el $query
			$result = mysqli_num_rows($query);

		    //verificara si la cantidad de registros es mayor a cero
			if($result > 0)
			{
                ;
				//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
				mysqli_query($conection,"UPDATE codigosrecuperacion SET Estado='0' WHERE correo= '$user'");
                 mysqli_query($conection,"UPDATE usuario SET clave='$pass' WHERE usuario= '$user'");
                 mysqli_close($conection);
               //Finalmente pasara al menu principal  
				header('location: ../index.php');

			}else{

				//En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
				$alert = '¡El usuario ingresado no existe!';

				//final de la sesión
				session_destroy();
            }
            }else{
                //En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
				$alert = 'Las contraseas no coinciden';

				//final de la sesión
				session_destroy();
            }
            
		}
		else{
		    //Si no se ingresa valores en los campos user y clave saldra el siguiente mensaje.
			$alert = 'Ingrese su usuario y su nueva Contraseña';
		}
		
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<h3>Recuperar Cuenta</h3><br>

            <!--<center><label><b>Nueva Contraseña</b></label>-->
            <input type="password" name="Contraseña" placeholder="Ingrese nueva contraseña">

            <input type="password" name="Contraseña2" placeholder="Repetir contraseña">

            <input type="submit" value="FINALIZAR"></input><br>
             <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <a href="../sistema/salir.php">
            <img class="close" src="../sistema/img/cerrar.png" alt="Salir" title="Salir">
            </a>
           
		</form>
	</section>
</body>
</html>