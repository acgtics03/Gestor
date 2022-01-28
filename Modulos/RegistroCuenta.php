<?php 
date_default_timezone_set('America/Lima');	
$alert = '';
//VARIABLE DE SESION
session_start();
 
require_once "conexion.php"; 
           $time = time();
           $Fecha= date('Y-m-d');
           $Hora = date("H:i:s", $time);
	//Establecemos el método GET
	if(!empty($_POST))
	{
		$usu = $_POST['Usuario'];
		$_SESSION['user']=$_POST['Usuario'];
		
		//Comprobamos que en la variable GET exista algun valor para usuario y para clave
		if(empty($_POST['Usuario']) || empty($_POST['Contraseña']))
		{
			//Si no se ingresa valores en los campos user y clave saldra el siguiente mensaje.
			$alert = 'Ingrese su usuario y su contraseña';
		}else{
            
            $clave01 = $_POST['Contraseña'];
            $clave02 = $_POST['Contraseña2'];

		    //verificara si la cantidad de registros es mayor a cero
			if($clave01==$clave02)
			{
				require_once "conexion.php"; 
				$usu = $_POST['Usuario'];
				 //Insertar registros ingresados
				// $ActualizaCuenta = mysqli_query($conection, "UPDATE persona SET EstadoCuenta='REGISTRADO' WHERE idusuario='$usu'");	             
	             
				// $InsertaCuenta = mysqli_query($conection, "INSERT INTO usuario(usuario,clave,idPerfil,fecha,hora) values ('$usu','$clave01','2','$Fecha','$Hora')");
	             //mysqli_close($conection);
	 
	             $_SESSION['Psw'] = $_POST['Contraseña'];
	           
   				 //$alert = 'Registro completado! Volver atras para acceder al sistema.'; 
   				 header('location:RegistroCuentaComplemento.php');
						
			}else{

				//En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
				$alert = 'Las contraseas no coinciden';

			}
	}}

 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<h3>Registro de Cuenta</h3><br>

            <center><label style="font-size: 14pt;color: white"><b>Correo</b></label>
            <input type="text" name="Usuario" placeholder="Ingrese su correo" id="Usuario" required>

            <center><label  style="font-size: 14pt;color: white"><b>Contraseña</b></label>
            <input type="password" name="Contraseña" placeholder="Ingrese su contraseña" id="Contraseña" required>

            <input type="password" name="Contraseña2" placeholder="Repetir contraseña" id="Contraseña2" required>


			<script type="text/javascript">

			  function activar_nuevo(){

				var btnNuevo = document.getElementById('Nuevo');
                btnNuevo.style.display='none';

				var btnGrabar = document.getElementById('Registrar');
                btnGrabar.style.display='';

				var txtCorreo = document.getElementById('Usuario');
				txtCorreo.disabled = false;

				var txtpsw1 = document.getElementById('Contraseña');
				txtpsw1.disabled = false;

				var txtpsw2 = document.getElementById('Contraseña2');
				txtpsw2.disabled = false;


			  }

			  function activar_guardar(){
				
				var btnGrabar = document.getElementById('Grabar');
                btnGrabar.style.display='none';

                var btnNuevo = document.getElementById('Nuevo');
                btnNuevo.style.display='';

				var txtCorreo = document.getElementById('correo');
				txtCorreo.disabled = true;

				var txtpsw1 = document.getElementById('psw1');
				txtpsw1.disabled = true;

				var txtpsw2 = document.getElementById('psw2');
				txtpsw2.disabled = true;
               
			  }
			</script>



			<input type="submit" value="Registrar" id="Registrar"></input>
			<input type="button" value="Nuevo" id="Nuevo" onclick="activar_nuevo();"></input>

			<script>
				var btnGrabar2 = document.getElementById('Registrar');
                btnGrabar2.style.display='none';

				var btnNuevo = document.getElementById('Nuevo');
                btnNuevo.style.display='';

				var txtCorreo = document.getElementById('Usuario');
				txtCorreo.disabled = true;

				var txtpsw1 = document.getElementById('Contraseña');
				txtpsw1.disabled = true;

				var txtpsw2 = document.getElementById('Contraseña2');
				txtpsw2.disabled = true;

			</script>

            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            <a href="../sistema/salir.php">
            <img class="close" src="../sistema/img/atras.png" alt="Salir" title="Salir">
            </a>
           
		</form>

	</section>
</body>
</html>