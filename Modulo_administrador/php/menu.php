<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <!--------------------- MENU SISTEM ------------------------->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <label><img src="../img/logotipoacg.png" class="logotipoacg" alt=""></img></label>
        <ul>
            <li><a href="HomeAdmin.php" class="active" href="#">Inicio</a> </li>
            <li><a href="AdminAsistenciaDiaria.php">Asistencia</a></li>
            <li><a href="AdminPermisosDiarios.php">Permiso</a></li>
            <li><a href="AdminVisitasDiarias.php">Visitas</a></li>
            <li><a href="ProductividadPersonal.php">Productividad</a></li>
            <?php 
             $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
             $ver = mysqli_fetch_assoc($consultaperfil);
        
             if($ver['idPerfil']=='3'){
                 echo '<li><a href="AdminUsuarios.php">Usuarios</a></li>';
                 echo '<li><a href="Tareo.php">Tareo</a></li>';
              }
            ?>
        <li><a href="../sistema/salir.php"><img src="../img/logout.png"></a></li>
        </ul>
        </nav>
    <!-- --------------------------------------------------- -->
</body>
</html>

