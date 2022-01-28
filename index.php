<?php 
	
$alert = '';
//VARIABLE DE SESION
session_start();
 
	//Establecemos el método GET
	if(!empty($_POST))
	{
		//Comprobamos que en la variable GET exista algun valor para usuario y para clave
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			//Si no se ingresa valores en los campos user y clave saldra el siguiente mensaje.
			$alert = 'Ingrese su usuario y su calve';
		}else{
            //caso contrario se inicia la conexion con la BD para validar los datos infgresados
			require_once "Modulos/conexion.php";

			//Se crea un conjunto de caracteres predeterminado para los datos usuario y clave
			$user = $_POST['usuario'];

			//md5 es utilizado para encriptar el registro de la clave del usuario
			$pass = $_POST['clave'];
			

           $consulta_dni = mysqli_query($conection, "SELECT idusuario as user FROM persona WHERE dni='$user'");
    	   $ver_usuario = mysqli_fetch_assoc($consulta_dni);
    
    	   $usern = $ver_usuario['user'];


			//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$usern' AND clave = '$pass' AND estatus = 'Activo'");
		    //Se cierra la conexion
		
			//Se crea una nueva variable que tendra el total de filas de los registros encontrados en el $query
			$result = mysqli_num_rows($query);

		    //verificara si la cantidad de registros es mayor a cero
			if($result > 0){
				//Si la consulta del $query encuentra mas de 1, los registros se guardarán en un Array
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol']    = $data['rol'];
				$_SESSION['estatus']    = $data['estatus'];
               	$_SESSION['idPerfil'] = $data['idPerfil'];


			//header('location: menu.html');

                 
        			if($_SESSION['idPerfil'] == '2'){  
        				header('location: Modulos/SelectorIni.php');
        				}
        			if($_SESSION['idPerfil'] == '3' || $_SESSION['idPerfil'] == '4'){  
					//header('location: Modulos/SelectorAdmin.php');
					header('location: Modulos/SelectorAdmin.php');
		        		}
		        	if($_SESSION['user'] == 'admin@acg.com.pe'){
                 //if($_SESSION['idPerfil'] == '1'){
                        //header('location: Modulo_administrador/HomeAdmin.php');
					header('location: Modulos/SelectorAdmin.php');
        				}
				}else{
				   
                    $query2 = mysqli_query($conection,"SELECT me.motivo as motiv FROM usuario u, motivoestado me WHERE u.MotivoEstado=me.idME AND u.usuario= '$user' AND u.estatus = 'Inactivo'");
                    $result2 = mysqli_num_rows($query2);
                    $mostrar = mysqli_fetch_assoc($query2);
                    $motivo=$mostrar['motiv'];
                   if($result2 > 0){
                       $alert = 'Usted no puede acceder debido a que su cuenta se encuentra inactiva por '.$motivo;
                   }else{
					//En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
					$alert = ' Usuario o clave incorrectos';

					//final de la sesión
					session_destroy();	
                   }
			}
	}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<!--Fecha en formato unix :evitas que si se repite (casualmente) un número generado azarosamente, no cargaras una versión archiva almacenada en la caché del navegador.-->
	<link rel="stylesheet" type="text/css" href="css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<h3></h3>
			<img src="img/icon.png" alt="Login" style="width: 40%; height: 40%">

			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			 <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            
			<input type="submit" value="INGRESAR">

			<!--<a href="Modulos/ValidarCuenta.php" style="color: blue;">
			    <h2>Restablecer Contraseña</h2>
			</a>-->
			<a href="Modulos/RegistroCuenta.php" style="color: blue;">
			    <h2>Registrate</h2>
            </a>
            <a href="../"><img src="../images/mp.png" width="35px" height="35px"></a>
		</form>

	</section>
</body>
</html>
