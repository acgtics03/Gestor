<?php
    //Mantener sesi車n activa
    session_start();
    
    if(!empty($_POST)){

    //Conectar con BD
    require_once 'conexion.php';

    //Variables de tiempo
    $factual = date("Y-m-d");

    //Recuperar variable de inicio de sesi車n
    $email=$_SESSION['user'];

    //Consulta de permisos BD - permiso
    $sql = "SELECT * FROM permiso WHERE fsol>='$factual' AND user='$email' AND estado IN ('POR APROBAR', 'APROBADO') ";
    $result = mysqli_query($conection, $sql);
    $mostrar = mysqli_num_rows($result);

    //Validar cantidad de permisos
    if($mostrar > 0){
        $alert2 = 'Ya se cuenta con una solicitud vigente';
    
    }else{

        $fsol=$_POST['fsol'];
        $ti=$_POST['BoxHI'];
        $tf=$_POST['BoxHF'];
        $BoxMotv=$_POST['BoxMotv'];

        //Variables de tiempo
        //$fsistema = $fsol;
 
        //Validaci車n de las variables del permiso
        if ($tf>$ti && $fsol >= $factual){

            //Sentencia BD
            $sql2 = "INSERT INTO permiso(user, fsol, Tinicio, Tfin, motivo, estado) VALUES('$email', '$fsol','$ti','$tf','$BoxMotv', 'POR APROBAR')";
            mysqli_query($conection, $sql2);
            
            //Cerrar consulta
            mysqli_close($conection);

            //Comunicar solicitud grabada
            $alert2 = 'Se ha guardado la solicitud satisfactoriamente';

            //Redireccionar a Selector
            //header('location:Selector.php');

        }else{

            //Comunicar error
            $alert2 = 'Registro incorrecto';

        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
	
	<title>ACG</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="HomePermiso.php" method="post">

            <h3>Solicitud de permiso</h3>

            <br>
            <input type="date" name="fsol" id="" style="width: 52%; background:#FFF; color: #000; border: 1px solid  #85929e; font-size: 15px;">
            
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
            <div class="alert" style="color:#FFC931; font-weight: bold; background: #001843"><?php echo isset($alert2) ? $alert2 : ''; ?></div>

            <input type="submit" value="Enviar solicitud" title="Enviar" style="font-size: 15px">

            <a href="SelectorAsistencia.php">
                <img class="close" src="../sistema/img/atras.png" alt="Salir del sistema" title="Regresar">
            </a>
            
		</form>

    </section>

</body>
</html>