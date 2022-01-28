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

    //$dato1 = $_SESSION['UsuarioConsulta'];
    //$dato2 = $_SESSION['FechaVisita'];

    $dato0 = $_GET['BoxUsuario'];
    $dato1 = trim($dato0);
    $dato2 = $_GET['fvisita'];

   // echo '-'.$dato0.'-'.$dato1.'-'.$dato2.'-';

    require 'conexion.php';


?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<title>ACG</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="POST">
			
			<!-- ENCABEZADO DE FORMULARIO -->           
			<h3>
			    CONTROL VISITAS
			</h3><br>
            
            <?php
                //CONSULTA PARA INDICAR EL USUARIO EN CONSULTA
                $sql2 = "SELECT concat(apellido,', ',nombre) AS User FROM persona WHERE idusuario='$dato1' ";
                $result2 = mysqli_query($conection, $sql2);
                $mostrar2 = mysqli_fetch_assoc($result2);

                //CERRAR CONSULTA
                //mysqli_close($conection);
            ?>

            <div><center>
                <!--<label for="usuario_cons" style="color:#ffffff">Datos: </label>-->
                <input type="text" name="usuario_cons" id="" style="width:43%; font-family: Arial; font-size:75%; display:inline-block;" readonly="readonly" value="<?php echo $mostrar2['User'] ; ?>">
                <input type="text" name="fsol" id="" style="width:25%; font-family: Arial; font-size:75%;display:inline-block" readonly="readonly" value="<?php echo $dato2 ; ?>">
            </div></center>


            <!-- Lista desplegable - PERSONAL DEL JEFE INMEDIATO -->
            <div id="scroll_tabla">
            <table id="Solicitudes" style="border-top:1px solid #000000; border-bottom:1px solid #000000; font-family: Arial; font-size:95%; border-collapse:collapse">

                <!-- ENCABEZADOS TABLA -->
                <thead style="border-bottom:1px solid #000000; background: #001843; color:#ffffff"> 
                    <tr height="30" style='font-size: 80%'>
                        <th width="20%">TARIFA</th>
                        <th width="61%">DESCRIPCIÓN</th>
                        <th width="%" ></th>
                    </tr>
                
                <!-- CUERPO TABLA -->
                <?php

                        //CONSULTA CON BD
                        $sql = "SELECT m.mdescripcion AS Motivo, cc.sDescripcion AS Origen, ccd.sDescripcion AS Destino, DATE_FORMAT(v.HoraCreacion, '%H:%i') AS HoraInicio, v.tarifa AS TarifaReal, t.TarifaReferencial, v.EstadoVisita AS Estado, concat(p.apellido,', ',p.nombre) AS Usuario, DATE_FORMAT(v.HoraCerrada, '%H:%i') AS HoraFin
                        FROM visita v, motivos m, centrocosto cc, centrocosto_destino ccd, tarifa t, persona p
                        WHERE v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.idtarifa=t.iTarifa AND p.idusuario='$dato1' AND v.usuario='$dato1' AND v.FechaCreacion='$dato2' ORDER BY v.HoraCreacion";
                        $result = mysqli_query($conection, $sql);
                        $i = 1;
                        while($mostrar = mysqli_fetch_assoc($result)){
                        //$alert = "SELECT * FROM visita WHERE usuario='$dato1' AND FechaCreacion='$dato2'" ;
                ?>

                <tbody style="background:#ffffff">
                    <tr class="cuerpo" height="30">
                        <!--<td style="font-size:85%; width:55px"><?php //echo 'Visita '.$i++ ; ?></td>-->
                        <td style="font-size:85%; width:55px">
                        <?php
                        //CONDICIÓN DEL TIPO DE TARIFA EMPLEADA
                        if($mostrar['TarifaReal'] == ''){
                            echo 'S/ '.$mostrar['TarifaReferencial'] ;
                        }else{
                            echo 'S/ '.$mostrar['TarifaReal'] ;
                        }
                        ?>
                        </td>
                        
                        <td style="font-size:85%; width:250px; text-align:left">
                        <?php echo 
                        //DATOS DE LA CONSULTA
                        '<dt>'.'<strong>'.'Motivo: '.'</strong>'.$mostrar['Motivo'].'</dt>'.
                        '<dt>'.'<strong>'.'Hora: '.'</strong>'.$mostrar['HoraInicio'].' - '.$mostrar['HoraFin'].'</dt>'.
                        '<dt>'.'<strong>'.'Ruta: '.'</strong>'.$mostrar['Origen'].'</dt>'.
                        '<dt>'.'<strong>'.'Ruta: '.'</strong>'.$mostrar['Destino'].'</dt>';
                        ?>
                        </td>
                        
                        <td style="font-size:85%; width:55px"><?php 
                        
                        if($mostrar['Estado'] == 0){
                            //echo '<div style="color: green">'.'Terminado'.'</div>';
                            echo '<IMG SRC="../img/Circulo_Verde_2.png">';
                        }else{
                            //echo '<div style="color: red">'.'En Proceso'.'</div>';
                            echo '<IMG SRC="../img/Circulo_Rojo_2.png">';
                        }
                         ; ?></td>
                    </tr>
                </tbody>
                
                <?php
                    }                    
                ?>

                </thead>
            </table>
            </div>
		    <!--<img src="../img/frm.png" style="width: 90%; text-align: center;"><br>-->
            

         <div><center>
            <a href="HomeControl.php"> 
              <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Volver atras" style="margin: 15px auto;text-align: center; display:inline-block;">
			</a>
        </div>
		
		<!-- Notificación de acción -->
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div><br>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>

</body>
</html>