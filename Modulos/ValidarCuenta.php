<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
	// Definir zona horaria
	date_default_timezone_set('America/Lima');
$alert = '';
//VARIABLE DE SESION
session_start();
 
	//Establecemos el método GET
	if(!empty($_POST))
	{
		//Comprobamos que en la variable GET exista algun valor para usuario y para clave
		if(empty($_POST['Usuario']))
		{
			//Si no se ingresa valores en los campos user y clave saldra el siguiente mensaje.
			$alert = '¡Ingrese su usuario!';
		}else{
            //caso contrario se inicia la conexion con la BD para validar los datos infgresados
			require_once "conexion.php";

			//Se crea un conjunto de caractees predeterminado para los datos usuario y clave
			$user = $_POST['Usuario'];
            $_SESSION['Usser'] = $_POST['Usuario'];
			//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario= '$user' AND estatus=1");
		    //Se cierra la conexion
		    //mysqli_close($conection);
			//Se crea una nueva variable que tendra el total de filas de los registros encontrados en el $query
			$result = mysqli_num_rows($query);

		    //verificara si la cantidad de registros es mayor a cero
			if($result > 0)
			{
				
				$vg = $GLOBALS['Usuario'];
				
				function generarCodigo($longitud) {
				$key = '';
				$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
				$max = strlen($pattern)-1;
				for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
				return $key;
				}
 
				//Ejemplo de uso
				$variable = generarCodigo(6);
				$consulta = "INSERT INTO codigosrecuperacion(Codigo,correo,Estado) values ('$variable','$user',1)";
				  mysqli_query($conection,$consulta);
				  mysqli_close($conection);
				//mail("trinidadd100@gmail.com","CODIGO","Su codigo es 588961");
			/*ini_set('display_errors',1);
				error_reporting(E_ALL);
				$from = "soporte@acg-soft.com";
				$to = "$user";
				$subjet = "AppVisitas : Codigo de Recuperación de Cuenta";
				$message = "El código generado para recuperar su cuenta es: $variable";
				$headers = "From:" . $from;
				mail($to,$subjet,$message,$headers);*/

			   //CON PHP MAILER

			   require "../PHPMailer/Exception.php";
			   require "../PHPMailer/PHPMailer.php";
			   require "../PHPMailer/SMTP.php";
              // Instantiation and passing `true` enables exceptions
				$mail = new PHPMailer(true);

				try {
					//Server settings
					$mail->SMTPDebug = 2;                      // Enable verbose debug output
					$mail->isSMTP();                                            // Send using SMTP
					$mail->Host       = 'mail.acg.com.pe';                    // Set the SMTP server to send through
					$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
					$mail->Username   = 'cpalomino@acg.com.pe';                     // SMTP username
					$mail->Password   = 'Sistemas99_';                               // SMTP password
					$mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
					$mail->Port       = 465;                                    // TCP port to connect to

					//Recipients
					$mail->setFrom('cpalomino@acg.com.pe', 'soporte');
					$mail->addAddress($user, 'Destinatario'); 

					// Attachments
					//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
					//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

					// Content
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = 'AppVisitas : Codigo de Recuperacion de Cuenta"';
					$mail->Body    = 'El codigo generado para recuperar su cuenta es: </b>'.$variable;

					$mail->send();
					echo 'Mensaje enviado';
					 //Finalmente pasara al menu principal  
				     header('location: ValidarCodigo.php');
				} catch (Exception $e) {
					echo "Error al enviar mensaje: {$mail->ErrorInfo}";
				}
			}else{

				//En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
				$alert = '¡Usuario no registrado!.';

            }
            
            
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

			<center><label style="font-size: 16px; color: white;"><b>Usuario</b></label>
            <input type="text" name="Usuario" placeholder="Escriba su correo">
            
            <input type="submit" value="CONTINUAR"><center></input><br>
             <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <a href="../sistema/salir.php">
            <img class="close" src="../sistema/img/cerrar.png" alt="Salir" title="Salir">
            </a>
           
		</form>

	</section>
</body>
</html>