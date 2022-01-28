<?php

	// Definir zona horaria
	date_default_timezone_set('America/Lima');

	//Activar la sesión
	session_start();

	//Conexión con BD
    require_once 'conexion.php';
    $tipo_i = 'submit';
    //Inicializar e método POST
    if (!empty($_POST)){

        //VARAIBLES LIBRES
        $b1 = '';

        //Recuperar inputs
        $b1 = $_POST['PERMISO'];
        
        //Recuperar variables tiempo
        $time = time();
        $freg = date('Y-m-d');

        //Recuperar variables datos
        $email = $_SESSION['user'];
        $ti = date("H:i:s", $time);
        $tf = date("H:i:s", $time);
        
        $inactividad = 600;
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

    }else{
    if(!empty($email)){  

        $sql3 = "SELECT * FROM permiso WHERE user ='$email' AND fsol='$freg' AND estado='INICIO PERMISO' ";
        $result3 = mysqli_query($conection, $sql3);
        $mostrar3 = mysqli_num_rows($result3);
    
        //Validación de estado
        if($mostrar3 == 0){
            $tipo_i = 'submit';
            //$alert = $tipo_input . ' ' . $account . ' ' . $mostrar3['idJefeInmediato'];
        }else{
            $tipo_i = 'hidden';
            //$alert = $tipo_input . ' ' . $account;
        }    

        //Valor inicial del input (VALUE)
        //$mostrar3 = 'INICIO PERMISO';

        //Validación inicio de registro
        $sql = "SELECT * FROM permiso WHERE fsol = '$freg' AND user = '$email' ";
        $result2 = mysqli_query($conection, $sql);
        $mostrar = mysqli_fetch_assoc($result2);

        /*//Condicional de valor del input asistencia (VALUE)
        if ($mostrar2['estado'] <> ''){
            $mostrar3 = $mostrar2;
        }*/
       $Horainicio = $mostrar['Tinicio'];
       if($ti>$Horainicio){
        //Grabar información asistencia en BD
        if($b1){
            switch ($mostrar['estado']) {
                case 'APROBADO':
                    //Query grabar
                    $sql5 = "UPDATE permiso SET Trinicio='$ti', estado='INICIO PERMISO' WHERE fsol = '$freg' AND user = '$email' ";
                    mysqli_query($conection, $sql5);

                    //Cerrar consulta
                    mysqli_close($conection);

                    //Notificación de acción
                    if($mostrar['Tinicio']<'$ti'){
                        $alert = 'Inicio de permiso registrado. Recuerde que su permiso se inicio a las '.$mostrar['Tinicio'].' horas.';
                        $tipo_i = 'hidden';
                        }else{
                        $alert = 'Inicio de permiso registrado';
                        $tipo_i = 'hidden';
                        }
                    break;
                default:
                    $alert = 'Usted ya inicio su permiso. Gracias';
                    break;
            }
        }
       }else{
           $alert = 'Importante! Su permiso inicia a las '.$mostrar['Tinicio'].' horas.';
       }  
    }else{
        session_destroy();
        header("Location: ../index.php");
    } 
    }
}}
?>


<!DOCTYPE html>
<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			<h3>
			    Registro de Permiso
			</h3><br><br>

			<img src="../img/businessman.png" alt="Login" style="width: 50%;">

            <script type="text/javascript">

				function RegistrarPermiso(){
                document.getElementById("button").value="REFRIGERIO 1";
                }

			</script>

            <!-- Campos de asistencia-->
            <input type="<?php echo $tipo_i ; ?>" id="button" name="PERMISO" value="INICIO PERMISO" style="font-size: 15px" onchange="RegistrarPermiso();"></input>

			<!-- Notificación de acción -->
             <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
            
            <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema">
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