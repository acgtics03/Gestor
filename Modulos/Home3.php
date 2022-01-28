<?php
    //Mantener sesión activa
    session_start();
    
    if(!empty($_POST)){

    //Conectar con BD
    require_once 'conexion.php';

    //Recuperar variables
    $email=$_SESSION['user'];
    $fsol=$_POST['fsol'];
    $ti1=$_POST['BoxHI1'];
    $ti2=$_POST['BoxHI2'];
    $tf1=$_POST['BoxHF1'];
    $tf2=$_POST['BoxHF2'];
    $BoxMotv=$_POST['BoxMotv'];

    //Variables de tiempo
    $factual = date("Y-m-d");
    $fsistema = $fsol;

        //Validación de las variables del permiso
        if ($tf1>$ti1 and $fsistema >= $factual){

            //Sentencia BD
            $sql2 = "INSERT INTO permiso(user, fsol, tinicio1, tinicio2,tfin1, tfin2, motivo) VALUES('$email', '$fsol','$ti1','$ti2','$tf1','$tf2','$BoxMotv')";
            mysqli_query($conection, $sql2);
            mysqli_close($conection);

            //Comunicar solicitud grabada
            $alert2 = 'Se ha guardado la solicitud satisfactoriamente';

        }else{

            //Comunicar error
            $alert2 = 'Registro incorrecto';

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
	
	<title>ACG</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="Home3.php" method="post">

            <h3>Solicitud de permiso</h3>

            <br>
            <label for="fsol" style="font-size: 15px">Fecha de solicitud</label>
            <input type="date" name="fsol" id="" style="width: 90%; background:#FFF; color: #000; border: 1px solid  #85929e; font-size: 15px; padding: 1px"></input>
           
            <!-- Combo hora de inicio-->
            <label for="" style="font-size: 15px">Hora inicio:</label>
                <select name="BoxHI1" id="" style="font-size: 15px; width: 20%">
                    <option selected="true" disabled="disabled">hra</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                </select>

                <select name="BoxHI2" id="" style="font-size: 15px; width: 20%">
                    <option selected="true" disabled="disabled">min</option>
                    <option value="0">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>

            <!-- Combo hora de fin -->
            <label for="" style="font-size: 15px">Hora fin:</label>
            <nav class="BoxF">
                <select name="BoxHF1" id="" style="font-size: 15px; width: 20%">
                    <option selected="true" disabled="disabled">hra</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                </select>

                <select name="BoxHF2" id="" style="font-size: 15px; width: 20%">
                    <option selected="true" disabled="disabled">min</option>
                    <option value="0">00</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                </select>
            </nav>

            <!-- Combo de motivos -->
            <?php
            //Conexión
            require 'conexion.php';

            //Consulta BD
            $query2 = mysqli_query($conection, "SELECT * FROM motivos_permiso WHERE estado = '1' ORDER BY descripcion ASC");
            mysqli_close($conection);
            ?>

            <!-- Lista desplegable -->
            <select name="BoxMotv" id="" style="font-size: 15px">
                <option selected="true" disabled="disabled">Seleccione Motivo</option>
                <?php while($row=mysqli_fetch_assoc($query2)){ ?>
                <option value=" <?php echo $row['id'] ?> " >
                    <?php echo $row['descripcion']; ?>
                </option>
                <?php }?>
                
            </select>
            
            <!-- Aviso de la actividad ejecutada -->
            <div class="alert"><?php echo isset($alert2) ? $alert2 : ''; ?></div>

            <input type="submit" value="Enviar solicitud" title="Enviar" style="font-size: 15px">

           <!-- Mostrar cuenta de usuario activo -->
        <div id="pie">
            <label for="" style="font-size: 11.5px"><?php echo 'User:' . ' ' .$_SESSION['user'] ;?></label>
            <label for="" style="font-size: 11.5px">v.1.0</label>
        </div>
            
		</form>

    </section>

</body>
</html>