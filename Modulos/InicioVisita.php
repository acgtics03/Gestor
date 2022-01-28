<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <link  rel="icon"   href="../img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	<script language="javascript" src="../package/jquery-3.1.1.min.js"></script>
	
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
        <h3>
            Registro de Actividad
        </h3><br>
      

             <?php
             date_default_timezone_set('America/Lima');
               session_start(); 
               
               	// El siguiente key se crea cuando se inicia sesión
                $_SESSION["timeout"] = time();
            		
               $User = $_SESSION['user'];
               $Fecha= date('Y-m-d');
               $tipo_input = 'submit';
               $nmax='';
             ?>

            <!-- COMBOBOX MOTIVOS-->
            <?php
		    require_once "conexion.php";
			$query = mysqli_query($conection,"SELECT * FROM motivos WHERE iEstado= 1 ORDER BY mdescripcion ASC");
            ?>
            <select name="BoxM">
            <option selected="true" disabled="disabled">Seleccione Motivo</option>
            <?php 
               while($row=mysqli_fetch_assoc($query)){
            ?>
            <option value=" <?php echo $row['iCodigo'] ?> " >
            <?php echo $row['mdescripcion']; ?>
             </option>
        
            <?php
             
             }  
             ?> 
             </select>


            <!-- COMBOBOX CENTRO DE COSTOS origen-->
            <?php
            require_once "conexion.php";

            $consultaVisita = mysqli_query($conection, "SELECT * FROM visita WHERE usuario='$User'  AND  FechaCreacion='$Fecha'");
            $conteo = mysqli_num_rows($consultaVisita);
            
            if($conteo > 0){
                $consultaMaxHora = mysqli_query($conection, "SELECT MAX(HoraCreacion) as MaxHoras FROM visita WHERE FechaCreacion='$Fecha' AND usuario='$User'");
                $MaxHora = mysqli_fetch_assoc($consultaMaxHora);
                $Max = $MaxHora['MaxHoras'];
                $CD = mysqli_query($conection, "SELECT destino FROM visita WHERE HoraCreacion='$Max' AND usuario='$User'");
                $lista = mysqli_fetch_assoc($CD);
                      $nmax = $lista['destino'];
                      $consulta = mysqli_query($conection,"SELECT * FROM centrocosto WHERE iCodigo='$nmax'");
            }else{
                $consulta = mysqli_query($conection,"SELECT * FROM centrocosto WHERE iEstado= 1 ORDER BY sDescripcion ASC");
            }
            ?>

            <select name="BoxCCI">
            <option selected="true" disabled="disabled">Seleccione origen</option>
            <?php 
               while($datos=mysqli_fetch_assoc($consulta)){
            ?>
            <option value=" <?php echo $datos['iCodigo'] ?> " >
            <?php echo $datos['sDescripcion']; ?>
             </option>
        
            <?php
             }
             ?>
             </select>
             
             	<script language="javascript">
            	    $(document).ready(function(){
            	       $("#BoxCCI").change(function(){
            	           
            	           $("#BoxCCI option:selected").each(function(){
            	               id_estado = $(this).val();
            	               
            	           });
            	           
            	       }); 
            	    });
            	</script>
             
             
             
             <!-- COMBOBOX CENTRO DE COSTOS destino-->
             <?php
			require_once "conexion.php";
			//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
			
			$consulta = mysqli_query($conection,"SELECT * FROM centrocosto WHERE iEstado= 1 AND iCodigo!='$nmax' ORDER BY sDescripcion ASC");

            ?>
            
            <select name="BoxCCF">
            <option selected="true" disabled="disabled">Seleccione Destino</option>
            <?php 
               while($datos=mysqli_fetch_assoc($consulta)){
            ?>
            <option value=" <?php echo $datos['iCodigo'] ?> ">
            <?php echo $datos['sDescripcion']; ?>
             </option>
        
            <?php
             }
             ?>
             </select>
             
             
             
             <?php
             
              if(!empty($User)){  
             
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

             if(!empty($User)){  
             $alert = '';
              if(!empty($_POST))
              {
                if($_POST['BoxCCI']!=$_POST['BoxCCF'])    
              
              {
                  if((empty($_POST['BoxM']) || empty($_POST['BoxCCI'])) || empty($_POST['BoxCCF'])){

                    $alert = 'Complete todos los campos';

                }else{

              require_once "conexion.php";
              
              $motivo = $_POST['BoxM'];
              $Box_origen = $_POST['BoxCCI'];
              $Box_destino = $_POST['BoxCCF'];
              
              $iTarifa = mysqli_query($conection, "SELECT iTarifa FROM tarifa WHERE LugarOrigen=$Box_origen AND LugarDestino=$Box_destino");
              $iT = mysqli_num_rows($iTarifa);
              if($iT>0){
                $Tar = mysqli_fetch_assoc($iTarifa);
                $i_tarif = $Tar['iTarifa'];
              }else{
                $new_tarifa = mysqli_query($conection, "INSERT INTO tarifa(TarifaReferencial, LugarOrigen, LugarDestino) VALUES (0,$Box_origen, $Box_destino)");
                $selec_tarifa = mysqli_query($conection, "SELECT * FROM tarifa WHERE LugarOrigen=$Box_origen AND LugarDestino=$Box_destino");
                $id_tarifa = mysqli_fetch_assoc($selec_tarifa);
                $i_tarif = $id_tarifa['iTarifa'];
              }
              $time = time();
              $FechaCreacion= date('Y-m-d');
              $HoraCreacion = date("H:i:s", $time);

              //REGISTRAR VISITA (Tab: visita)
              $Ins = mysqli_query($conection, "INSERT INTO visita(idmotivo,origen,destino,usuario,idtarifa,HoraAbierta,FechaCreacion, HoraCreacion) VALUES ($motivo,$Box_origen,$Box_destino,'$User',$i_tarif,'$HoraCreacion','$FechaCreacion','$HoraCreacion')");

              $consultV = mysqli_query($conection,"SELECT * FROM visita WHERE usuario='$User' AND FechaCreacion='$FechaCreacion' AND HoraCreacion='$HoraCreacion'");

              $contador = mysqli_num_rows($consultV);
              if($contador > 0){
                
                mysqli_close($conection);
                  ?>
            <br>
            <?php
                  $alert = 'Registro completado! Visita iniciada.';
                  $tipo_input = 'hidden';
                 // header('location: VistaIniVisita.php');
				}else{
                    $alert = 'Error en la inserción';
                    }
                }
                  
              }else{
                  $alert = 'Error! El origen y destino no pueden ser el mismo.';
              }
              }
            }else{
                session_destroy();
                header("Location: ../index.php");
            } 
            }}
              }else{
                    session_destroy();
                    echo '<script type="text/javascript">';
                    echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
                    echo '</script>';
                    echo '<script type="text/javascript">';
                    echo 'location.href="../index.php"';
                    echo '</script>';  
              }
             ?>
            <br>
             <div class="alert" style="color:#FFC931; font-weight: bold; background: #001843"><?php echo isset($alert) ? $alert : ''; ?></div>
            
            <input type="<?php echo $tipo_input; ?>" id="btnIV" value="Iniciar visita" style="font-size: 15px"></input>
          
            <a href="SelectorIni.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema">
            </a>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <?php require "piepagina.php"; ?>
        </div>
		</form>

	</section>
</body>
</html>