<?php
   date_default_timezone_set('America/Lima');
    //CONEXIÓN A BD
    require '../Modulos/conexion.php';

    //INICIAR VARIABLES DE SESIÓN
    session_start();
    

    //VARIABLE DE FECHA
    $factual = date('Y-m-d');
    $fecha=date('d/m/Y');
    $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) ); 

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

    $consultaUser = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$UserName'");
    $cont = mysqli_num_rows($consultaUser);

    if($cont>0){

        $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
        $ver = mysqli_fetch_assoc($consultaperfil);

        if($ver['idPerfil']=='3'){

                //CONSULTA Total
                $total = mysqli_query($conection, "SELECT COUNT(estado) AS total FROM permiso WHERE fsol='$factual' AND estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO')");
                $totalr = mysqli_fetch_assoc($total);
    
                //CONSULTA A TIEMPO
                $aprobado = mysqli_query($conection, "SELECT COUNT(estado) AS aprobado FROM permiso WHERE fsol='$factual' AND estado='APROBADO'");
                $aprobador = mysqli_fetch_assoc($aprobado);
    
                //CONSULTA TARDE
                $rechazado = mysqli_query($conection, "SELECT COUNT(estado) AS rechazado FROM permiso WHERE fsol='$factual' AND estado='RECHAZADO'");
                $rechazador = mysqli_fetch_assoc($rechazado);
    
                //CONSULTA TARDE
                $pendiente = mysqli_query($conection, "SELECT COUNT(estado) AS pendiente FROM permiso WHERE fsol='$factual' AND estado='POR APROBAR'");
                $pendienter = mysqli_fetch_assoc($pendiente);
    
                //PORCENTAJE DE APROBADOS
                if($totalr['total'] <> 0){
                  $dato1 = round((($aprobador['aprobado']/$totalr['total'])*100),0);
                }else{
                  $dato1 = '0';
                }
    
                //PORCENTAJE DE RECHAZADOS
                if($totalr['total'] <> 0){
                  $dato2 = round((($rechazador['rechazado']/$totalr['total'])*100),0);
                }else{
                  $dato2 = '0';
                }                  
    
                //PORCENTAJE DE PENDIENTES
                if($totalr['total'] <> 0){
                  $dato3 = round((($pendienter['pendiente']/$totalr['total'])*100),0);
                }else{
                  $dato3 = '0';
                }                  
            }
        if($ver['idPerfil']=='4'){

                //CONSULTA Total
                $total = mysqli_query($conection, "SELECT COUNT(p.estado) AS total FROM permiso p, persona pa WHERE p.user=pa.idusuario AND (pa.idJefeInmediato='$UserName' OR pa.idusuario='$UserName') AND p.fsol='$factual' AND p.estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO') ");
                $totalr = mysqli_fetch_assoc($total);
    
                //CONSULTA A TIEMPO
                $aprobado = mysqli_query($conection, "SELECT COUNT(p.estado) AS aprobado FROM permiso p, persona pa WHERE p.user=pa.idusuario AND (pa.idJefeInmediato='$UserName' OR pa.idusuario='$UserName') AND  fsol='$factual' AND estado='APROBADO'");
                $aprobador = mysqli_fetch_assoc($aprobado);
    
                //CONSULTA TARDE
                $rechazado = mysqli_query($conection, "SELECT COUNT(p.estado) AS rechazado FROM permiso p, persona pa WHERE p.user=pa.idusuario AND (pa.idJefeInmediato='$UserName' OR pa.idusuario='$UserName') AND fsol='$factual' AND estado='RECHAZADO'");
                $rechazador = mysqli_fetch_assoc($rechazado);
    
                //CONSULTA TARDE
                $pendiente = mysqli_query($conection, "SELECT COUNT(p.estado) AS pendiente FROM permiso p, persona pa WHERE p.user=pa.idusuario AND (pa.idJefeInmediato='$UserName' OR pa.idusuario='$UserName') AND fsol='$factual' AND estado='POR APROBAR'");
                $pendienter = mysqli_fetch_assoc($pendiente);
    
                //PORCENTAJE DE APROBADOS
                if($totalr['total'] <> 0){
                  $dato1 = round((($aprobador['aprobado']/$totalr['total'])*100),0);
                }else{
                  $dato1 = '0';
                }
    
                //PORCENTAJE DE RECHAZADOS
                if($totalr['total'] <> 0){
                  $dato2 = round((($rechazador['rechazado']/$totalr['total'])*100),0);
                }else{
                  $dato2 = '0';
                }                  
    
                //PORCENTAJE DE PENDIENTES
                if($totalr['total'] <> 0){
                  $dato3 = round((($pendienter['pendiente']/$totalr['total'])*100),0);
                }else{
                  $dato3 = '0';
                }                  
            }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminPermisosDiarios.css">
    <title>Permisos Personal ACG</title>

    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaDiaria.css">

<link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">
<link rel="stylesheet" type="text/css" href="../css/graficas.css?v=<?php echo time(); ?>">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script type="text/javascript" src="jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="dist/Chart.bundle.min.js"></script>
<script type="text/javascript" src="../Js/plotly-latest.min.js"></script>

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../main.css"> 
<link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
<link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> 


</head>
<body>
    <script src="../code/highcharts.js"></script>
    <script src="../code/highcharts-3d.js"></script>
    <script src="../code/modules/exporting.js"></script>
    <script src="../code/modules/export-data.js"></script>
    <script src="../code/modules/accessibility.js"></script>
    
    <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->

     <br>
     <div>
     <div class="fndgrafica"><br>
            <!-- <input type="submit" onclick = "location='AdminAsistenciaConsulta.php'" class="buttons" value="Consultar">
            <input type="submit" onclick = "location='AdminAsistenciaEditar.php'" class="buttons" value="Editar">-->
            <center><label style="font-size: 23px; font-weight: bold;">PERMISOS DIARIOS</label></center>
    

        <figure class="highcharts-figure" >
            <div id="container"></div>
        </figure>
 
    <script type="text/javascript">

       var valor1 = '<?php echo $dato1; ?>';
       var valor2 = '<?php echo $dato2; ?>';
       var valor3 = '<?php echo $dato3; ?>';
       var fecha = '<?php echo $fecha; ?>';
       var valor4 = '<?php echo $aprobador['aprobado']; ?>';
       var valor5 = '<?php echo $rechazador['rechazado']; ?>';
       var valor6 = '<?php echo $pendienter['pendiente']; ?>';

       var aprobado = parseInt(valor4);
       var rechazado = parseInt(valor5);
       var pendiente = parseInt(valor6);
        Highcharts.chart('container', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45,
                    beta: 0
                }
            },
            title: {
                text: 'Resultado (%) : Registros de Permisos - '+fecha
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje',
                data: [
                    {
                        name: 'PENDIENTE - '+valor6,
                        y: pendiente,
                        color: 'rgb(255, 251, 41)'
                    },
                    {  name: 'RECHAZADO - '+valor5, 
                       y: rechazado,
                       color: 'rgb(255, 0, 0)'
                    },
                    {
                       name: 'APROBADO - '+valor4, 
                       y: aprobado,
                       color: 'rgb(11, 199, 11)'
                    }
                ]
            }]
        });
        </script> 
  
            
            <!-- CONTADOR DE REGISTROS -->
        <div style="display: inline">
           
            <label id="label_registros" for="nregistros" style="font-size: 13px; text-align: left; margin-left: 25%">Total registros: <?php echo $totalr['total'];?> </label>
            <div style="display: inline-block; margin-left: 29.5%"> 
                <input type="submit" onclick = "location='AdminPermisosConsulta.php'" class="buttons" value="Consultar registros anteriores">
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
                        <tr id="tr0">
                            <th>FECHA</th>
                            <th>COLABORADOR</th>
                            <th>ÁREA</th>
                            <th>Hr. Inicio</th>
                            <th>Hr. Fin</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <!-- CUERPO DE LA TABLA -->
                    <tbody style="overflow-y: scroll; height: 130px">

                        <!-- RECOPILAR INFORMACIÓN DE BD -->
                        <?php
                        //DECLARAR VARIABLE PARA CONSULTA
                        $factual = date('Y-m-d');

                        if($ver['idPerfil']=='3'){
                            //CONSULTA EN BD
                            $sql = mysqli_query($conection, "SELECT pr.fsol, pr.user, s.Area, pr.Tinicio, pr.Tfin, CONCAT(UCASE(LEFT(pr.estado, 1)), LCASE(SUBSTRING(pr.estado, 2))) AS estado, mp.descripcion AS motivo, CONCAT(p.apellido,', ',p.nombre) AS usuario FROM permiso pr, persona p, motivos_permiso mp, area s WHERE pr.user=p.idusuario AND pr.estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO') AND pr.motivo=mp.id AND pr.fsol='$factual' AND p.idArea=s.idArea ORDER BY pr.fsol");
                        }

                        if($ver['idPerfil']=='4'){
                            //CONSULTA EN BD
                            $sql = mysqli_query($conection, "SELECT pr.fsol, pr.user, s.Area, pr.Tinicio, pr.Tfin, CONCAT(UCASE(LEFT(pr.estado, 1)), LCASE(SUBSTRING(pr.estado, 2))) AS estado, mp.descripcion AS motivo, CONCAT(p.apellido,', ',p.nombre) AS usuario FROM permiso pr, persona p, motivos_permiso mp, area s WHERE pr.user=p.idusuario AND pr.estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO') AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND pr.motivo=mp.id AND pr.fsol='$factual' AND p.idArea=s.idArea ORDER BY pr.fsol");
                        }

                        while($mostrar = mysqli_fetch_assoc($sql)){

                        ?>  

                        <!-- RECOPILAR INFORMACIÓN DE BD -->
                        <tr id="tr1">
                            <td id="td1"><?php echo $mostrar['fsol'] ;?></td>
                            <td style="width: 350px; text-align: center; font-size: 14px" id="td2"><?php echo $mostrar['usuario'] ;?></td>
                            <td style="width: 120px; font-size: 14px" id="td3"><?php echo $mostrar['Area'] ;?></td>
                            <td style="width: 70px" id="td4"><?php echo $mostrar['Tinicio'] ;?></td>
                            <td style="width: 70px" id="td5"><?php echo $mostrar['Tfin'] ;?></td>
                            <td style="width: 100px" id="td6"><?php echo $mostrar['motivo'] ;?></td>
                             <td style="width: 120px" id="td5"><?php

                            if($mostrar['hrIngreso']<'09:00:00'){
                                echo '<center><img src="../img/Circulo_Verde_2.png" height="20" width="20"  alt="A_tiempo" title="">';
                            }else{
                                if($mostrar['hrIngreso']>'08:59:00' && $mostrar['hrIngreso']<'09:16:00'){
                                    echo '<center><img src="../img/Circulo_Amarillo_02.png" height="20" width="20"  alt="Tarde" title="Tarde">';
                                }else{
                                echo '<center><img src="../img/Circulo_Rojo_2.png" height="20" width="20" alt="Tarde" title="Tarde">';
                                }
                            }

                            ;?></td>
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
    <br><br>
</body>

</html>