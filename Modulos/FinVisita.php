<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
	 <link  rel="icon"   href="../img/logoacg2.jpg" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        $(document).ready(function(){
        
            var max_chars = 50;
        
            $('#max').html(max_chars);
        
            $('#comment').keyup(function() {
                var chars = $(this).val().length;
                var diff = max_chars - chars;
                $('#contador').html(diff);   
            });
        });
        
        </script>
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
        <h3 style="border-radius: 11px 11px 11px 11px;">
            Finalizar Visita
        </h3>
       
         <?php
         
         date_default_timezone_set('America/Lima');
         session_start(); 
        
        	    
           $Users = $_SESSION['user'];
           
           //Conexi贸n con BD
           require_once 'conexion.php';
           
           $tipo_input = 'submit';
           
           $time = time();
           $Fecha= date('Y-m-d');
           $Hora = date("H:i:s", $time);
  
            $sql="SELECT * FROM visita WHERE  usuario = '$Users' AND FechaCreacion='$Fecha' AND EstadoVisita='1' ";
            $resultado=mysqli_query($conection, $sql);
            $Tar = mysqli_fetch_assoc($resultado);
            
            $Fecha = $Tar['FechaCreacion'];
            $cod_origen = $Tar['origen'];
            $cod_destino = $Tar['destino'];
            $nom_usuario = $Tar['usuario'];
            $codigo_tarifa = $Tar['idtarifa'];
            $Hora = $Tar['HoraCreacion'];


            $sql_origen=mysqli_query($conection,"SELECT * FROM centrocosto WHERE  iCodigo='$cod_origen'");
            $FO = mysqli_fetch_assoc($sql_origen);

            $desc_origen = $FO['sDescripcion'];


            $sql_destino=mysqli_query($conection,"SELECT * FROM centrocosto WHERE  iCodigo='$cod_destino'");
            $FD = mysqli_fetch_assoc($sql_destino);

            $desc_destino = $FD['sDescripcion'];

            $datos =mysqli_query($conection,"SELECT CONCAT(apellido,' ',nombre) AS datos FROM persona WHERE  idusuario='$nom_usuario'");
            $FDatos = mysqli_fetch_assoc($datos);

            $desc_datos = $FDatos['datos'];

            $tarifa =mysqli_query($conection, "SELECT * FROM tarifa WHERE  iTarifa='$codigo_tarifa'");
            $FT = mysqli_fetch_assoc($tarifa);

            $c_tarifa = $FT['TarifaReferencial'];

           if(!empty($Users)){
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

            if(!empty($Users)){
                if(!empty($_POST))
                    {     
                    if(!empty($_POST['comentarios']))
                    {
                    
                            $tarf = $_POST['TReal'];
                            $Actividad = $_POST['comentarios'];
                            $time = time();
                            $Hora = date("H:i:s", $time);
                            $x = 1;
                            $updatetarifa="UPDATE visita SET EstadoVisita='0', tarifa='$tarf',HoraCerrada='$Hora', Actividad='$Actividad' WHERE usuario = '$Users' AND FechaCreacion='$Fecha' AND EstadoVisita='1'";
                            mysqli_query($conection, $updatetarifa);
                        
                                $alert = 'Usted a finalizado Visita';
                                $tipo_input = 'hidden';
                            date_default_timezone_set('America/Lima');
                            $ActualizaTarifa = mysqli_query($conection, "UPDATE tarifa SET TarifaReferencial='$tarf' WHERE LugarOrigen='$cod_origen' AND LugarDestino='$cod_destino'");
                            $InsertaTarfTemp = mysqli_query($conection, "INSERT tarifa_temporal(iorigen,idestino,tarifaactual,tarifanueva,usuario) VALUES ('$cod_origen','cod_destino','$c_tarifa','$tarf','$Users')");
                            $c_tarifa=$tarf;
                        
                    }else{
                        $alert = 'Error! El campo Actividad es obligatorio. ';
                    } }
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
            
                        <p style="background-color: white; border-radius: 11px 11px 11px 11px;">
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Fecha Visita : </b><label style="font-family: Arial; color: #001843; font-size: 14px;"><?php echo "$Fecha";?></label></a><br>
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Hora inicio : </b><label style="font-family: Arial; color: #001843; font-size: 14px;"><?php echo "$Hora";?></label></a><br>
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Origen : </b><label style="font-family: Arial; color: #001843; font-size: 12px;"><?php echo " $desc_origen"; ?></label><br>
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Destino : </b><labe style="font-family: Arial; color: #001843; font-size: 12px;"l><?php echo "$desc_destino"; ?></label><br>
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Usuario : </b> <label style="font-family: Arial; color: #001843; font-size: 12px;"><?php echo "$desc_datos"; ?></label><br>
                        <a style="font-family: Arial; color: #001843; font-size: 14px;"><b> Tarifa Referencial : </b> <label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo "S/. $c_tarifa"; ?></label>
                        </p>
               
                   <center>
                    <table border="0">
                        <tr>
                           <td><a style="font-family: Arial; color: #001843; font-size: 14px;text-align: left;"><b>Ingrese tarifa real :&nbsp;&nbsp; </b></a><br /></td>
                           <td><input type="number" style="width: 100px" name="TReal" placeholder="S/. 0.00"></input></td>
                       </tr>
                    </table>
                    </center>
                      <div style="text-align: left;">
                       <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>&nbsp;&nbsp; Actividad : (max. 300 caracteres) </b></a>
                        <textarea name="comentarios" rows="5" cols="40" style="width: 100%; border-radius: 11px 11px 11px 11px;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;" maxlength="300" placeholder="" id="comment"></textarea>
                      </div>
                        <input type="<?php echo $tipo_input ; ?>" value="Finalizar visita" style="font-size: 15px" onclick="VerDatos();"></input><br>
                        <div class="alert" style="color:#FFC931; font-weight: bold; background: #001843; font-size: 14px"><?php echo isset($alert) ? $alert : ''; ?></div>
                        <a href="SelectorIni.php" style="width: 50px;">
                            <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema">
                        </a>
            
			<!-- Mostrar cuenta de usuario activo -->
            <div id="pie">
                <?php require "piepagina.php"; ?>
            </div>
          </div>
		</form>

	</section>
    <script src="js/clock.js"></script>
</body>
</html> 