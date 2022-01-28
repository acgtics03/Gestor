<?php
// Definir zona horaria
	date_default_timezone_set('America/Lima');
    //Mantener sesi車n activa
    session_start();
    
    if(!empty($_POST)){

    //Conectar con BD
    require_once 'conexion.php';

    //Variables de tiempo
    $factual = date("Y-m-d");

    //Recuperar variable de inicio de sesi車n
    $email=$_SESSION['user'];
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
    //Consulta de permisos BD - permiso
    $sql = "SELECT * FROM permiso WHERE fsol>='$factual' AND user='$email' AND estado IN ('POR APROBAR', 'APROBADO') ";
    $result = mysqli_query($conection, $sql);
    $mostrar = mysqli_num_rows($result);

    //Validar cantidad de permisos
    if($mostrar > 0){
        $alert2 = 'Ya se cuenta con una solicitud de permiso pendiente de autorizacion.';
    
    }else{

        $fsol=$_POST['fsol'];
        $ti=$_POST['BoxHI'];
        $tf=$_POST['BoxHF'];
        $BoxMotv=$_POST['BoxMotv'];

            //CONSULTA BD DE HORA INICIO DECIMAL
        $sql3 = "SELECT hora_decimal AS hora_inicio FROM horas_permiso WHERE hora='$ti' ";
        $result2 = mysqli_query($conection, $sql3);
        $mostrar2 = mysqli_fetch_assoc($result2);

        //CAPTURAR HORA INICIO DECIMAL
        $hora_inicio = $mostrar2['hora_inicio'];

        //CONSULTA BD DE HORA FIN DECIMAL
        $sql4 = "SELECT hora_decimal AS hora_fin FROM horas_permiso WHERE hora='$tf' ";
        $result3 = mysqli_query($conection, $sql4);
        $mostrar3 = mysqli_fetch_assoc($result3);

        //CAPTURAR HORA FIN DECIMAL
        $hora_fin = $mostrar3['hora_fin'];

        //OPERACIÃ“N LLAMANDO A LA FUNCIÃ“N RESTA
        $R1 = $hora_fin - $hora_inicio;
 
        //Validaci車n de las variables del permiso
        if ($tf>$ti && $R1<5 &&$fsol >= $factual){

            //Sentencia BD
            if($hora_fin>13 && $hora_inicio<15){
               $R1 = $R1 - 1;
               }

            $sql2 =mysqli_query($conection, "INSERT permiso(user, fsol, Tinicio, Tfin, motivo, estado, CantHoras) VALUES('$email', '$fsol','$ti','$tf','$BoxMotv', 'POR APROBAR','$R1')");          
            $consultar = mysqli_query($conection, "SELECT CONCAT(apellido,' ',nombre) FROM persona WHERE idusuario = '$email'");
            $consultaSup = mysqli_query($conection, "SELECT idjefeinmediato FROM persona WHERE idusuario = '$email'");
            mysqli_close($conection);
			
			 $alert2 = 'Se ha guardado la solicitud satisfactoriamente';
			 
            //Redireccionar a Selector
            //header('location:Selector.php');

        }else{

            //Comunicar error
             $alert2 = 'Cantidad de horas no permitidas.';

        }

        }
    }else{
        session_destroy();
        header("Location: ../index.php");
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
        
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="../img/icon.png" type="image/png" />
	<title>AppVisitas</title>
    <link rel="stylesheet" type="text/css" href="../css/style2.css">

    <script type="text/javascript" src="calendario_dw/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="calendario_dw/calendario_dw.js"></script>
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="HomePermiso.php" method="post">

            <h3>Solicitud de permiso</h3>

            <br>
            <input type="date" name="fsol" id="" style="width: 52%; font-size: 15px;" placeholder="Fecha">
            
            <!-- CCOMBO HORA INICIO-->
            <?php
                //Conexi車n
                require 'conexion.php';

                //Consulta BD
                $query = mysqli_query($conection, "SELECT * FROM horas_permiso ");
                mysqli_close($conection);
            ?>

                <!-- Lista desplegable - HI -->

                <select name="BoxHI" id="" style="font-size: 15px; width:52%">
                    <option selected="true" disabled="disabled">Hora inicio</option>
                    <?php while($row=mysqli_fetch_assoc($query)){ ?>
                    <option value=" <?php echo $row['hora'] ?> " >
                        <?php echo $row['hora']; ?>
                    </option>
                    <?php }?>
                    
                </select>

            <!-- COMBO HORA FIN -->
            <?php
                //Conexi車n
                require 'conexion.php';

                //Consulta BD
                $query2 = mysqli_query($conection, "SELECT * FROM horas_permiso ");
                mysqli_close($conection);
            ?>

                <!-- Lista desplegable -->
                <select name="BoxHF" id="" style="font-size: 15px; width:52%">
                    <option selected="true" disabled="disabled">Hora fin</option>
                    <?php while($row=mysqli_fetch_assoc($query2)){ ?>
                    <option value=" <?php echo $row['hora'] ?> " >
                        <?php echo $row['hora']; ?>
                    </option>
                    <?php }?>
                    
                </select>

            <!-- COMBO MOTIVOS -->
            <?php
            //Conexi車n
            require 'conexion.php';

            //Consulta BD
            $query3 = mysqli_query($conection, "SELECT * FROM motivos_permiso WHERE estado = '1' ORDER BY descripcion ASC");
            mysqli_close($conection);
            ?>

            <!-- Lista desplegable -->
            <select name="BoxMotv" id="" style="font-size: 15px; width:52%">
                <option selected="true" disabled="disabled">Motivo</option>
                <?php while($row=mysqli_fetch_assoc($query3)){ ?>
                <option value=" <?php echo $row['id'] ?> " >
                    <?php echo $row['descripcion']; ?>
                </option>
                <?php }?>
                
            </select>
            
            <!-- Aviso de la actividad ejecutada -->
            <div class="alert"><?php echo isset($alert2) ? $alert2 : ''; ?></div>

            <input type="submit" value="Enviar solicitud" title="Enviar" style="font-size: 15px">

            <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Regresar">
            </a>
            <!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require 'conexion.php'; require "piepagina.php";  ?>
        </div>
		</form>

    </section>

</body>
</html>