<?php
date_default_timezone_set('America/Lima');
//CONEXIÓN A BD
require '../Modulos/conexion.php';

//INICIAR VARIABLES DE SESIÓN
session_start();

//VARIABLE DE USAURIO SESSION
$UserName = $_SESSION['user'];

if(empty($UserName)){
                session_destroy();
                echo '<script type="text/javascript">';
                echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
                echo '</script>';
                echo '<script type="text/javascript">';
                echo 'location.href="../index.php"';
                echo '</script>'; 
    }

//VARIABLE DE FECHA
$factual = date('Y-m-d');
$fecha=date('d/m/Y');
$fayer = date("Y-m-d", strtotime("-1 day", strtotime($factual)));

$consultaUser = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$UserName'");
    $cont = mysqli_num_rows($consultaUser);

    if($cont>0){
        $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
        $ver = mysqli_fetch_assoc($consultaperfil);

                $sistemas = mysqli_query($conection, "SELECT COUNT(*) AS totals FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='SISTEMAS'");
                $sistemasr = mysqli_fetch_assoc($sistemas);

                $contabilidad = mysqli_query($conection, "SELECT COUNT(*) AS totalc FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='CONTABILIDAD'");
                $contabilidadr = mysqli_fetch_assoc($contabilidad);

                $legal = mysqli_query($conection, "SELECT COUNT(*) AS totall FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='LEGAL'");
                $legalr = mysqli_fetch_assoc($legal);

                $comercial = mysqli_query($conection, "SELECT COUNT(*) AS totalco FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='COMERCIAL'");
                $comercialr = mysqli_fetch_assoc($comercial);

                $administracion = mysqli_query($conection, "SELECT COUNT(*) AS totala FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='ADMINISTRACION'");
                $administracionr = mysqli_fetch_assoc($administracion);

                $costos = mysqli_query($conection, "SELECT COUNT(*) AS totalcs FROM visita v, persona p , area ar WHERE v.usuario=p.idusuario AND p.idArea=ar.idArea AND v.FechaCreacion='$factual' AND ar.Area='COSTOS'");
                $costosr = mysqli_fetch_assoc($costos);
        


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminVisitasDiarias.css">
    <title>Visitas ACG</title>

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="dist/css/tableexport.css" rel="stylesheet" type="text/css">


    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/graficas-visitas.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script type="text/javascript" src="jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="dist/Chart.bundle.min.js"></script>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

</head>

<body>

    <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->

    <br>
    <div>
<div class="fndgrafica"><br>
    <!-- -----------------------GRAFICAS---------------------------- -->

    <script src="../code/highcharts.js"></script>
<script src="../code/modules/data.js"></script>
<script src="../code/modules/drilldown.js"></script>
<script src="../code/modules/exporting.js"></script>
<script src="../code/modules/export-data.js"></script>
<script src="../code/modules/accessibility.js"></script>

<figure class="highcharts-figure">
    <div id="container"></div>
</figure>



<script type="text/javascript">
// Create the chart
var fecha = '<?php echo $fecha; ?>';

var valor1 = '<?php echo $sistemasr['totals']; ?>';
var v1 = parseInt(valor1);
if(v1 == null){v1=0;}

var valor2 = '<?php echo $contabilidadr['totalc']; ?>';
var v2 = parseInt(valor2);
if(v2 == null){v2=0;}

var valor3 = '<?php echo $legalr['totall']; ?>';
var v3 = parseInt(valor3);
if(v3 == null){v3=0;}

var valor4 = '<?php echo $comercialr['totalco']; ?>';
var v4 = parseInt(valor4);
if(v4 == null){v4=0;}

var valor5 = '<?php echo $administracionr['totala']; ?>';
var v5 = parseInt(valor5);
if(v5 == null){v5=0;}

var valor6 = '<?php echo $costosr['totalcs']; ?>';
var v6 = parseInt(valor6);
if(v6 == null){v6=0;}

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Reporte diario de Visitas por área - ACG - '+fecha
    },
    subtitle: {
        text: 'Cantidad de visitas acumuladas en el día'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Cantidad de Visitas'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> actividades<br/>'
    },

    series: [
        {
            name: "Area - ACG",
            colorByPoint: true,
            data: [
                {
                    name: "Sistemas",
                    y: v1,
                    drilldown: "Sistemas"
                },
                {
                    name: "Contabilidad",
                    y: v2,
                    drilldown: "Contabilidad"
                },
                {
                    name: "Legal",
                    y: v3,
                    drilldown: "Legal"
                },
                {
                    name: "Comercial",
                    y: v4,
                    drilldown: "Comercial"
                },
                {
                    name: "Administracion",
                    y: v5,
                    drilldown: "Administracion"
                },
                {
                    name: "Costos",
                    y: v6,
                    drilldown: "Costos"
                }
            ]
        }
    ],
   
});
		</script>

    <!-- --------------------------------------------------- -->
    <?php
            $sql2 = mysqli_query($conection, "SELECT COUNT(*) AS contador FROM visita WHERE FechaCreacion='$factual'");
            $mostrar2 = mysqli_fetch_assoc($sql2);
            ?>
            
            <!-- CONTADOR DE REGISTROS -->
        <div style="display: inline">
           
            <label id="label_registros" for="nregistros" style="font-size: 13px; text-align: left; margin-left: 20%">Total registros: <?php echo $mostrar2['contador'];?> </label>
            <div style="display: inline-block; margin-left: 35%"> 
                <input type="submit" onclick = "location='AdminVisitasConsulta.php'" class="buttons3" value="Consultar registros anteriores"></input>
            </div><br>
        </div>
            <br>
    </div>
    </div> <br>


    
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <!-- CABEZERA DE LA TABLA -->
                            <thead>
                                <tr>
                                    <th class="th1">FECHA</th>
                                    <th class="th1">COLABORADOR</th>
                                    <th class="th1">ÁREA</th>
                                    <th class="th1">INICIO</th>
                                    <th class="th1">FIN</th>
                                    <th class="th1">ORIGEN</th>
                                    <th class="th1">DESTINO</th>
                                    <th class="th1">TARIFA</th>
                                    <th class="th1">ACTIVIDAD</th>
                                    <th class="th1">ESTADO</th>
                                    
                                </tr>
                            </thead>

                            <!-- CUERPO DE LA TABLA -->
                            <tbody>

                                <!-- RECOPILAR INFORMACIÓN DE BD -->
                                <?php
                                //DECLARAR VARIABLE PARA CONSULTA
                                $factual = date('Y-m-d');


                                if($ver['idPerfil']=='3'){
                                //CONSULTA EN BD
                                $sql = mysqli_query($conection, "SELECT m.mdescripcion AS Motivo, cc.sDescripcion AS Origen, ccd.sDescripcion AS Destino, DATE_FORMAT(v.HoraCreacion, '%H:%i') AS HoraInicio, v.tarifa AS TarifaReal, v.EstadoVisita AS Estado, concat(p.apellido,', ',p.nombre) AS Usuario, DATE_FORMAT(v.HoraCerrada, '%H:%i') AS HoraFin, a.Area as area, v.FechaCreacion, v.Actividad AS Actividad FROM visita v, motivos m, centrocosto cc, centrocosto_destino ccd, tarifa t, persona p, area a WHERE v.idmotivo=m.iCodigo AND p.idArea=a.idArea AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.idtarifa=t.iTarifa AND v.FechaCreacion='$factual' AND v.usuario=p.idusuario ORDER BY v.HoraCreacion");
                                }
                                if($ver['idPerfil']=='4'){
                                    //CONSULTA EN BD
                                    $sql = mysqli_query($conection, "SELECT m.mdescripcion AS Motivo, cc.sDescripcion AS Origen, ccd.sDescripcion AS Destino, DATE_FORMAT(v.HoraCreacion, '%H:%i') AS HoraInicio, v.tarifa AS TarifaReal, v.EstadoVisita AS Estado, concat(p.apellido,', ',p.nombre) AS Usuario, DATE_FORMAT(v.HoraCerrada, '%H:%i') AS HoraFin, a.Area as area, v.FechaCreacion, v.Actividad AS Actividad FROM visita v, motivos m, centrocosto cc, centrocosto_destino ccd, tarifa t, persona p, area a WHERE v.idmotivo=m.iCodigo AND p.idArea=a.idArea AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.idtarifa=t.iTarifa AND v.FechaCreacion='$factual' AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND v.usuario=p.idusuario ORDER BY v.HoraCreacion");
                                }

                                while ($mostrar = mysqli_fetch_assoc($sql)) {
                                ?>

                                    <!-- RECOPILAR INFORMACIÓN DE BD -->
                                    <tr>
                                        <td class="cuerpotabla"><?php echo $mostrar['FechaCreacion']; ?></td>
                                        <td class="td1"><?php echo $mostrar['Usuario']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['area']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['HoraInicio']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['HoraFin']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['Origen']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['Destino']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['TarifaReal']; ?></td>
                                        <td class="cuerpotabla"><?php echo $mostrar['Actividad']; ?></td>

                                        <td class="cuerpotabla"><?php

                                                                            if ($mostrar['HoraFin'] == '') {
                                                                                echo '<img src="../img/Circulo_Amarillo_02.png" alt="Tarde"  height="20" width="20" title="Iniciado">';
                                                                            } else {
                                                                                echo '<img src="../img/Circulo_Verde_2.png" alt="A_tiempo" height="20" width="20" title="Finalizado">';
                                                                            }; ?></td>

                                    </tr>

                                <?php
                                }
                            }else{
                                header('location: ../index.php');
                            }
                                ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="../jquery/jquery-3.3.1.min.js"></script>
        <script src="../popper/popper.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>

        <!-- datatables JS -->
        <script type="text/javascript" src="../datatables/datatables.min.js"></script>

        <!-- para usar botones en datatables JS -->
        <script src="../datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="../datatables/JSZip-2.5.0/jszip.min.js"></script>
        <script src="../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
        <script src="../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
        <script src="../datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

        <!-- código JS propìo-->
        <script type="text/javascript" src="../main.js"></script>

</body>

</html>