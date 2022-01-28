<!-- Sentencia para enviar los headers -->
<?php
// Definir zona horaria
	date_default_timezone_set('America/Lima');
ob_start();
?>

<?php
    //Activar sesión
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

    //Conexión con BD
    require_once 'conexion.php';

    //Recuperar variable de usuario
    $account=$_SESSION['user'];
    
    	// El siguiente key se crea cuando se inicia sesión
    $_SESSION["timeout"] = time();
    
    $consultaReg=mysqli_query($conection, "SELECT pr.*, p.* FROM permiso pr, persona p WHERE pr.user=p.idusuario AND idJefeInmediato='$account' AND pr.estado='POR APROBAR'");
			$result = mysqli_num_rows($consultaReg);
	    if($result=0){
			//Consulta BD
			   
				header('location: SelectorAvisoPermiso.php');
        }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <!--http-equiv="REFRESH" content="15">-->
	<link  rel="icon"   href="../img/icon.png" type="image/png" />
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
			    Autorizar Permiso
			</h3>
			<p><center>
			
            <div id="scroll_tabla">
            <table id="Solicitudes" style="border-top:1px; border-bottom:1px; font-family: Arial; font-size:95%; border-collapse:collapse; background-color: white">
            
                <!-- Encabezados -->
                <thead style="border-bottom:1px solid #000000; background-color: #001843; color: white;"> 
                    <tr height="30" style='font-size: 80%'>
                        <th>FECHA</th>
                        <th>USUARIO</th>
                        <th>HORA</th>
                    </tr>
                </thead>
                
                <?php

                    //SELECT cc.sDescripcion, m.mdescripcion FROM visita v, motivos m, centrocosto cc WHERE v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=cc.iCodigo AND v.usuario='dangulo@acg.com.pe' AND v.FechaCreacion='2020-01-16'

                    //Conexión BD
                    require_once 'conexion.php';

                    //Recuperar variables tiempo
                    $time = time();
                    $freg = date('Y-m-d');

                    //Consulta BD
                   $sql = "SELECT pr.fsol, pr.user, concat(p.apellido,', ',p.nombre) AS user2, DATE_FORMAT(pr.Tinicio, '%H:%i') AS hora_inicio, DATE_FORMAT(pr.Tfin, '%H:%i') AS hora_fin, pr.Tinicio AS hinicio, pr.Tfin AS hfin, mp.descripcion as motivo FROM persona p, permiso pr, motivos_permiso mp WHERE p.idusuario=pr.user AND pr.motivo=mp.id AND pr.fsol >= '$freg' AND p.idJefeInmediato='$account' AND pr.estado='POR APROBAR'";
                    $result = mysqli_query($conection, $sql);
                    while($mostrar2 = mysqli_fetch_assoc($result)){

                ?>
                
                <tbody style="background-color: white;">
                    <tr class="cuerpo" height="40">
                        <td style="width: 80px; font-size: 11px; text-align: center"><?php echo $mostrar2['fsol'] ; ?></td>
                        <td style="width: 150px; font-size: 11px; text-align: center"><?php echo $mostrar2['user2'] ; ?></td>
                       <td style="width: 100px; font-size: 11px; text-align: center"><?php echo $mostrar2['hora_inicio'];
                                                                  echo ' - '; 
                                                                  echo $mostrar2['hora_fin']; ?></td>
                        <td width="0.1%" style="font-size:85%; visibility: hidden; font-size:0.000000000000001%"><?php echo $mostrar2['user']?></td>
                        <td width="0.1%" style="font-size:85%; visibility: hidden; font-size:0.000000000000001%"><?php echo $mostrar2['motivo']; ?></td>
                    </tr>
                </tbody>

                <?php 
                    }
                ?>
                
            </table>
            </div>
            <!-- Script para toma de valores de la tabla - JS -->
            <script>
                
                $('#Solicitudes tr').on('click', function(){
                    var dato = $(this).find('td:first').html();
                    var dato2 = $(this).find('td:nth-child(4)').html();
                    var dato3 = $(this).find('td:nth-child(2)').html();
                    var dato4 = $(this).find('td:nth-child(5)').html();


                    $('#prueba').val(dato4);
                    $('#prueba2').val(dato2);
                    $('#prueba3').val(dato3);
                    $('#prueba4').val(dato);


                });

            </script>
                
            <!-- Datos tomados de la tabla para validar -->
            
                <label for="prueba2" style="font-size:12px; color: #001843; font-weight: bold">Datos : </label>
                <input type="text" id="prueba3" name="prueba2" style="display:inline-block; font-size:10px; width:130px" readonly="readonly">
                &nbsp;&nbsp;
                <label for="prueba" style="font-size:12px; color: #001843; font-weight: bold">Motivo: </label> 
                <input type="text" id="prueba" name="prueba" style="display:inline-block; font-size:75%; width:25%" readonly="readonly">
                <input type="hidden" id="prueba2" name="prueba3" style="display:inline-block; font-size:10px; width:25%;">
                <input type="hidden" id="prueba4" name="prueba4" style="display:inline-block; font-size:10px; width:25%;">
            
               <?php
                require_once "conexion.php";
    			$query = mysqli_query($conection,"SELECT * FROM EstadosAutorizacion WHERE EstadoEA= 1");
                ?>
                <div style="background-color: hsl(0, 0%, 47%); "><label for="" style="font-size:12px; color: white; font-weight: bold">ATENCIÓN A SOLICITUD</label></div>
                <select name="BoxEstado" style="font-weight: bold">
                <option>APROBADO</option>
                <option>RECHAZADO </option>
                </select>  
                
            <?php
            
            //Inicializar método POST
            if(!empty($_POST)){
                
                //Recuperar variables de inputs
                $fsol = $_POST['prueba4'];
                $user = $_POST['prueba3'];        
                $estad = $_POST['BoxEstado'];
                if(!empty($user)){
                 
                //Consulta de variables
                $sql2 = "UPDATE permiso SET estado='$estad' WHERE user='$user' AND fsol='$fsol' ";
                $result2 = mysqli_query($conection, $sql2);
                
                //Cerrar conexión
                mysqli_close($conection);
                
                //Notificación de acción
                if($estad == 'APROBADO'){
                    $alert = 'Se ha aprobado el permiso';
                }else{
                $alert = 'Se ha rechazado el permiso';    
                }
                
                //Refrescar vista
                header('location:HomeAutorizacion.php');
              }else{
                $alert = 'Error! Seleccione un registro de la tabla'; 
              }
            }
            ?>

        <!-- Botones para aprobación -->
        <input type="submit" name="Aprobar" value="Ejecutar">
         
        <!-- Notificación de acción -->
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <!-- Botón de retorno de página -->
        <a href="SelectorAsistencia.php">
            <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Salir">
        </a>
        
<!-- Mostrar cuenta de usuario activo -->
       <!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
        
		</form>

	</section>

</body>
</html>

<!-- Sentencia para enviar los headers -->
<?php
ob_end_flush();
?>