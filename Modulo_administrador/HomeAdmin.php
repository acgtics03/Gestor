<?php
 date_default_timezone_set('America/Lima');
    //INICIAR VARIABLES DE SESIÓN
    session_start();
    $UserName = $_SESSION['user'];
    //CONEXIÓN A BD
    require '../Modulos/conexion.php';

    //VARIABLE DE FECHA
    $factual = date('Y-m-d');
    $hoy = date('d-m-Y');
    $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) ); 

    if(empty($UserName)){
                session_destroy();
                echo '<script type="text/javascript">';
                echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
                echo '</script>';
                echo '<script type="text/javascript">';
                echo 'location.href="../index.php"';
                echo '</script>'; 
    }


    //INDICADORES DE ASISTENCIA
        //CONSULTA Total
        $total = mysqli_query($conection, "SELECT COUNT(user) AS total FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user");
        $totalra = mysqli_fetch_assoc($total);
        
        //CONSULTA A TIEMPO
        $a_tiempo = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso<='09:00:00'");
        $a_tiempor = mysqli_fetch_assoc($a_tiempo);

        //CONSULTA TOLERANCIA
        $tolerancia = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tolerancia FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso>'09:00:00' AND a.ingreso<='09:15:00'");
        $toleranciar = mysqli_fetch_assoc($tolerancia);

        //CONSULTA TARDE
        $tarde = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tarde FROM asistencia a, persona p  WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso>='09:15:00'");
        $tarder = mysqli_fetch_assoc($tarde);

    //INDICADORES DE PERMISOS

        //CONSULTA Total
        $total = mysqli_query($conection, "SELECT COUNT(estado) AS total FROM permiso WHERE fsol='$factual' AND estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO')");
        $totalrp = mysqli_fetch_assoc($total);

        //CONSULTA APROBADOS
        $aprobado = mysqli_query($conection, "SELECT COUNT(estado) AS aprobado FROM permiso WHERE fsol='$factual' AND estado='APROBADO'");
        $aprobador = mysqli_fetch_assoc($aprobado);

        //CONSULTA RECHAZADOS
        $rechazado = mysqli_query($conection, "SELECT COUNT(estado) AS rechazado FROM permiso WHERE fsol='$factual' AND estado='RECHAZADO'");
        $rechazador = mysqli_fetch_assoc($rechazado);

        //CONSULTA POR APROBAR
        $pendientes = mysqli_query($conection, "SELECT COUNT(estado) AS pendiente FROM permiso WHERE fsol='$factual' AND estado='POR APROBAR'");
        $pendientesr = mysqli_fetch_assoc($pendientes);

    //INDICADORES DE VISITAS
        //CONSULTA DE VISITAS FECHA ACTUAL, FECHA AYER Y TOTAL DE VISITAS MENSUAL
        $sql2 = mysqli_query($conection, "SELECT COUNT(usuario) AS nvisitas, (SELECT COUNT(usuario) FROM visita WHERE YEAR(FechaCreacion)=YEAR('$factual') AND month(FechaCreacion)=month('$factual')) as nvisitas_mes, (SELECT COUNT(usuario) AS nvisitas_ayer FROM visita WHERE FechaCreacion='$fayer') AS nvisitas_ayer FROM visita WHERE FechaCreacion='$factual' ");
        $nvisitasr = mysqli_fetch_assoc($sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link  rel="icon"   href="../img/logoacg2.jpg" type="image/png" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppVisitas Principal</title>
    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>
<body>

    <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->
    <br>
    <div class="superpanel">
        <div class="panel">
            <div class="fecdia">
                <label for="" id="label_tituloj"><?php echo "Resultado de Registros de hoy, ".$hoy ;?></label><br>
            </div><br>

            <div class="panelAsistencia"><br>
                <div class="titulos">
                    <label>Asistencia</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado1"><?php echo $a_tiempor['atiempo'] ;?></label><br>
                    <label class="tituloresultado">Perfecta</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado2"><?php echo $toleranciar['tolerancia'] ;?></label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Aceptable</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado3"><?php echo $tarder['tarde'] ;?></label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Inaceptable</label><br><br>
                </div>
            </div>

            <div class="panelPermiso"><br>
                <div class="titulos">
                    <label for="">Permisos</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado1"><?php echo $aprobador['aprobado'] ;?></label><br>&nbsp;
                    <label class="tituloresultado">Aprobado</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado2"><?php echo $rechazador['rechazado'] ;?></label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Rechazado</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado3"><?php echo $pendientesr['pendiente'] ;?></label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Pendiente</label><br><br>
                </div>    
            </div>

            <div class="panelVisita"><br>
                <div class="titulos">
                    <label for="">Visitas</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado1"><?php echo $nvisitasr['nvisitas_ayer'] ;?></label><br>
                    <label class="tituloresultado">Ayer</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado2"><?php echo $nvisitasr['nvisitas'] ;?></label></label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Hoy</label><br><br>
                </div>
                <div style="display: inline-block">
                    <label class="resultado3"><?php echo $nvisitasr['nvisitas_mes'] ;?></label></label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="tituloresultado">Mes</label><br><br>
                </div>
            </div>

        </div>

    </div>
</body>

</html>