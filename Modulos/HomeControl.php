<?php
    //INICIAR SESIÓN
    session_start();
    
    	// El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
		
	$inactividad = 600;
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout"])){
        // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
        $sessionTTL = time() - $_SESSION["timeout"];
        if($sessionTTL > $inactividad){
            session_destroy();
            header("Location: ../index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
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
		<form action="ControlVisitas.php" method="GET">
			
			<!-- ENCABEZADO DE FORMULARIO -->           
			<h3>
			    CONTROL VISITAS
			</h3> <br>
            
            <!-- DESPLEGABLE DE VISITAS DE USUARIO POR SUPERVISOR -->
            <?php
                //Conexion
                require 'conexion.php';

                //VARIABLLE DE USUARIO EN SISTEMA
                $email = $_SESSION['user'];

                //Consulta BD
                $sql = "SELECT idcliente, idusuario FROM persona WHERE idJefeInmediato LIKE '$email'";
                $result = mysqli_query($conection, $sql);

            ?>

            <!-- Lista desplegable - PERSONAL DEL JEFE INMEDIATO -->
            <div>
            <div style="display:block">
            <label for="BoxUsuario" style="font-size:15px">Usuario:</label>
            <select name="BoxUsuario" id="" style="display: inline-block; font-size: 15px; width:58%">
                <option selected="true" disabled="disabled">Colaborador</option>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                <option value=" <?php echo $row['idusuario'] ;?> " >
                    <?php echo $row['idusuario']; ?>
                </option>
                    <?php }?>        
            </select>
            </div>

            <!-- INPUT DE FECHA -->

            <div style="display:block">
            <label for="fvisita" style="font-size:15px">Fecha:</label>
            <input type="date" name="fvisita" id="" style="display: inline-block; height:32px; width: 52%; background:#FFF; color: #000; border: 1px solid  #85929e; font-size: 15px;">
            </div>
            </div>

            <!-- BOTÓN DE CONSULTA-->
            <input type="submit" id="" name="" value="CONSULTAR" style="font-size: 15px" onclick="location='ControlVisitas.php'"></input>

		    <!--<img src="../img/frm.png" style="width: 90%; text-align: center;"><br>-->
            
            <?php
            
                //CAMBIAR DE VALOR A VARIABLE DE USUARIO DE COMBO
                if(!empty($_POST)){

                    /*//DECLARAR VARIABLES DE SESIÓN
                    $_SESSION['UsuarioConsulta'] = $_POST['BoxUsuario'];
                    $_SESSION['FechaVisita'] = $_POST['fvisita'];*/

                    //$usuario = trim($_POST['BoxUsuario']);
                    //$alert = '-'.$_POST['BoxUsuario'].'-'.$_POST['fvisita'].'-'.$email.'-'.$usuario.'-';
                }
            ?>

		<!-- BOTÓN DE RETROCESO DE PÁGINA -->
         <div><center>
            <a href="SelectorIni.php"> 
              <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Volver atras" style="margin: 15px auto;text-align: center; display:inline-block;">
			</a>
        </div>
		
		<!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

		<!-- Mostrar cuenta de usuario ac -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>

</body>
</html>