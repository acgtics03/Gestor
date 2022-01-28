<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	 
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css?v=<?php echo time(); ?>">
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
        <h3>
            ¡VISITA REGISTRADA!
        </h3>
        <script type="text/javascript">

				ShowHiddenElement(){
					if($("#123"))
				}
			</script>
         <?php
         session_start(); 
        
                      
           $Users = $_SESSION['user'];
           
           //Conexión con BD
           require_once 'conexion.php';
           
           $tipo_input = 'submit';
           
           $time = time();
           $Fecha= date('Y-m-d');
           $Hora = date("H:i:s", $time);
           $sql="SELECT * 
			FROM visita
			WHERE  usuario = '$Users' AND FechaCreacion='$Fecha' AND EstadoVisita='1' ";
			$resultado=mysqli_query($conection, $sql);
            $Tar = mysqli_fetch_assoc($resultado);
            
            $Valor1 = $Tar['FechaCreacion'];
            $Valor2 = $Tar['origen'];
            $Valor3 = $Tar['destino'];
            $Valor4 = $Tar['usuario'];
            $Valor5 = $Tar['idtarifa'];
            $Valor6 = $Tar['HoraCreacion'];

            $sql2="SELECT * 
			FROM centrocosto
			WHERE  iCodigo='$Valor2' ";
            $resultado2=mysqli_query($conection, $sql2);
            $Tar2 = mysqli_fetch_assoc($resultado2);

            $origenn = $Tar2['sDescripcion'];

            $sql2="SELECT * 
			FROM centrocosto
			WHERE  iCodigo='$Valor3' ";
            $resultado3=mysqli_query($conection, $sql2);
            $Tar3 = mysqli_fetch_assoc($resultado3);

            $destinoo = $Tar3['sDescripcion'];

            $sql2="SELECT CONCAT(apellido,' ',nombre) AS datos
			FROM persona
			WHERE  idusuario='$Valor4' ";
            $resultado4=mysqli_query($conection, $sql2);
            $Tar4 = mysqli_fetch_assoc($resultado4);

            $datoss = $Tar4['datos'];

            $sql2="SELECT *
			FROM tarifa
			WHERE  iTarifa='$Valor5' ";
            $resultado5=mysqli_query($conection, $sql2);
            $Tar5 = mysqli_fetch_assoc($resultado5);

            $tarii = $Tar5['TarifaReferencial'];
            ?>
            <br>
            <p style="background-color: white;">
            
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Fecha Visita : </b><label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo "$Valor1";?></label></a><br>
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Hora inicio : </b><label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo "$Valor6";?></label></a><br>
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Centro Costo Origen : </b><label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo " $origenn"; ?></label><br>
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Centro Costo Destino : </b><labe style="font-family: Arial; color: #001843; font-size: 16px;"l><?php echo "$destinoo"; ?></label><br>
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Usuario : </b> <label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo "$datoss"; ?></label><br>
            <a style="font-family: Arial; color: #001843; font-size: 14px;"><b>-> Tarifa Referencial : </b> <label style="font-family: Arial; color: #001843; font-size: 16px;"><?php echo "S/. $tarii"; ?></label></p>
          
             <a href="SelectorIni.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema">
            </a>

		<!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <label for="" style="font-size: 11.5px"><?php echo 'User:' . ' ' .$_SESSION['user'] ;?></label>
            <label for="" style="font-size: 11.5px">v.1.0</label>
        </div>
		</form>

	</section>
    <script src="js/clock.js"></script>
</body>
</html>