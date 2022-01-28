<?php 
	
$alert = '';
//VARIABLE DE SESION
session_start();
 
	//Establecemos el método GET
	if(!empty($_POST))
	{
		//Comprobamos que en la variable GET exista algun valor para usuario y para clave
		if(empty($_POST['Clave']))
		{
			//Si no se ingresa valores en los campos user y clave saldra el siguiente mensaje.
			$alert = '¡Ingrese el código enviado a su correo!';
		}else{
		    
			require_once "conexion.php";
			$Cod = $_POST['Clave'];
			$usuario = $_SESSION['Usser'];
			
			$query = mysqli_query($conection,"SELECT * FROM codigosrecuperacion WHERE Codigo= '$Cod' AND correo='$usuario' AND Estado=1");
			          mysqli_close($conection);
			$result = mysqli_num_rows($query);
               
			if($result > 0)
			{  
                $AcualizaEstado = mysqli_query($conection, "UPDATE codigosrecuperacion SET Estado=0 WHERE Codigo= '$cod' AND correo='$usuario' AND Estado=1");
                mysqli_close($conection);
                
                
                $ConsultaEstado = mysqli_query($conection, "SELECT Estado FROM codigosrecuperacion WHERE Codigo= '$cod' AND correo='$usuario'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                if($result>0){
               //Finalmente pasara al menu principal
				header('location: RecuperarCuenta.php');
                }else{$alert = 'Error! al actualiar estado';
                }
			}else{

				//En caso de no encontrar registros semejantes en la base de datos saldra error de la conexion.
				$alert = '¡El código no es válido!';

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

           <h4 style="font-size: 11px; color: blue; font-family: Arial, Helvetica, sans-serif; text-align: center;">Se le envió un código de verificación a su correo.</h4>
            <input type="text" name="Clave" placeholder="Ingrese el código enviado">
            
            <input type="submit" value="CONTINUAR"><center></input><br>
             <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

            <a href="../sistema/salir.php">
            <img class="close" src="../sistema/img/cerrar.png" alt="Salir" title="Salir">
            </a>
           
		</form>

	</section>
</body>
</html>