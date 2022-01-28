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

    $consultaUser = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$UserName'");
    $cont = mysqli_num_rows($consultaUser);

    if($cont>0){

        $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
        $ver = mysqli_fetch_assoc($consultaperfil);

        if($ver['idPerfil']=='3'){
            //VARIABLE DE FECHA
            $factual = date('Y-m-d');
            $fecha=date('d/m/Y');
            $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) );

            //CONSULTA Total
            $total = mysqli_query($conection, "SELECT COUNT(user) AS total FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user");
            $totalr = mysqli_fetch_assoc($total);
            
            //CONSULTA Total Usuarios
            $Totusu = mysqli_query($conection, "SELECT COUNT(usuario) as tot FROM usuario WHERE estatus='Activo' AND usuario!='admin@acg.com.pe'");
            $Totusur= mysqli_fetch_assoc($Totusu);
            
            //CONSULTA ASISTENCIA PERFECTA
            $a_perfecta = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso<'09:00:00'");
            $a_perfectar = mysqli_fetch_assoc($a_perfecta);
            
            //CONSULTA ASISTENCIA ACEPTABLE
            $a_aceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND (a.ingreso>'08:59:59' AND a.ingreso<'09:15:00')");
            $a_aceptabler = mysqli_fetch_assoc($a_aceptable);
            
            //CONSULTA ASISTENCIA INACEPTABLE
            $a_inaceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tarde FROM asistencia a, persona p  WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso>'09:15:00'");
            $a_inaceptabler = mysqli_fetch_assoc($a_inaceptable);
                        
            //PORCENTAJE DE ASISTENCIA PERFECTA
            if($totalr['total'] <> 0){
                $dato1 = round((($a_perfectar['atiempo']/$totalr['total'])*100),0);
            }else{
                $dato1 = '0';
            }
            //PORCENTAJE DE ASISTENCIA ACEPTABLE
            if($totalr['total'] <> 0){
                $dato2 = round((($a_aceptabler['atiempo']/$totalr['total'])*100),0);
            }else{
                $dato2 = '0';
            }
            //PORCENTAJE DE ASISTENCIA INACEPTABLE
            if($totalr['total'] <> 0){
                $dato3 = round((($a_inaceptabler['tarde']/$totalr['total'])*100),0); 
            }else{
                $dato3 = '0';
            }
        }
        if($ver['idPerfil']=='4'){
            //VARIABLE DE FECHA
            $factual = date('Y-m-d');
            $fecha=date('d/m/Y');
            $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) );

            //CONSULTA Total
            $total = mysqli_query($conection, "SELECT COUNT(user) AS total FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName')");
            $totalr = mysqli_fetch_assoc($total);
            
            //CONSULTA Total Usuarios
            $Totusu = mysqli_query($conection, "SELECT COUNT(u.usuario) as tot FROM persona p, usuario u WHERE p.idusuario=u.usuario AND u.estatus='Activo' AND (p.idJefeInmediato='$UserName' OR u.usuario='$UserName')");
            $Totusur= mysqli_fetch_assoc($Totusu);
            
            //CONSULTA ASISTENCIA PERFECTA
            $a_perfecta = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND p.idusuario=a.user AND a.ingreso<'09:00:00'");
            $a_perfectar = mysqli_fetch_assoc($a_perfecta);
            
            //CONSULTA ASISTENCIA ACEPTABLE
            $a_aceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND (a.ingreso>'08:59:59' AND a.ingreso<'09:15:00')");
            $a_aceptabler = mysqli_fetch_assoc($a_aceptable);
            
            //CONSULTA ASISTENCIA INACEPTABLE
            $a_inaceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tarde FROM asistencia a, persona p  WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND a.ingreso>'09:15:00'");
            $a_inaceptabler = mysqli_fetch_assoc($a_inaceptable);
                        
            //PORCENTAJE DE ASISTENCIA PERFECTA
            if($totalr['total'] <> 0){
                $dato1 = round((($a_perfectar['atiempo']/$totalr['total'])*100),0);
            }else{
                $dato1 = '0';
            }
            //PORCENTAJE DE ASISTENCIA ACEPTABLE
            if($totalr['total'] <> 0){
                $dato2 = round((($a_aceptabler['atiempo']/$totalr['total'])*100),0);
            }else{
                $dato2 = '0';
            }
            //PORCENTAJE DE ASISTENCIA INACEPTABLE
            if($totalr['total'] <> 0){
                $dato3 = round((($a_inaceptabler['tarde']/$totalr['total'])*100),0); 
            }else{
                $dato3 = '0';
            }
        }

?>

<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    	
     <link  rel="icon"   href="../img/logoacg2.jpg" type="image/png" />
    <title>Asistencia Personal ACG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <center><label style="font-size: 23px; font-weight: bold;">ASISTENCIA DIARIA</label></center>
    

        <figure class="highcharts-figure" >
            <div id="container"></div>
        </figure>
 
    <script type="text/javascript">

       var valor1 = '<?php echo $dato1; ?>';
       var valor2 = '<?php echo $dato2; ?>';
       var valor3 = '<?php echo $dato3; ?>';
       var fecha = '<?php echo $fecha; ?>';
       var valor4 = '<?php echo $a_perfectar['atiempo']; ?>';
       var valor5 = '<?php echo $a_aceptabler['atiempo']; ?>';
       var valor6 = '<?php echo $a_inaceptabler['tarde']; ?>';
       var perfecta = parseInt(valor4);
       var aceptable = parseInt(valor5);
       var inaceptable = parseInt(valor6);
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
                text: 'Resultado (%) : Registros de Asistencia - '+fecha
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
                        name: 'ACEPTABLE - '+valor5,
                        y: aceptable,
                        color: 'rgb(255, 251, 41)'
                    },
                    {  name: 'INACEPTABLE - '+valor6, 
                       y: inaceptable,
                       color: 'rgb(255, 0, 0)'
                    },
                    {
                       name: 'PERFECTA - '+valor4, 
                       y: perfecta,
                       color: 'rgb(11, 199, 11)'
                    }
                ]
            }]
        });
        </script> 
  
            <!-- CONTADOR DE REGISTROS -->
        <div style="display: inline">
           
            <label id="label_registros" for="nregistros" style="font-size: 13px; text-align: left; margin-left: 25%">Total registros: <?php echo $totalr['total'].' / '.$Totusur['tot'];?> </label>
            <div style="display: inline-block; margin-left: 29.5%"> 
                <input type="submit" onclick = "location='AdminAsistenciaConsulta.php'" class="buttons" value="Consultar registros anteriores">
            </div><br>
        </div>
            <br>
    </div>
    </div> <br>  
        <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">  
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px">
                        <thead>
                            <tr>
                                <th class="th1">FECHA</th>
                                <th class="th1">COLABORADOR</th>
                                <th class="th1">AREA</th>                               
                                <th class="th1">INGRESO</th>
                                <!--<th class="th1">CENTRO COSTO</th>-->
                                <th class="th1">ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

                        if($ver['idPerfil']=='3'){
                        //CONSULTA EN BD
                            $coons = mysqli_query($conection, "SELECT a.fregistro, CONCAT(p.apellido,' ', p.nombre) AS colaborador, ars.Area AS area, date_format(a.ingreso,'%h:%i') AS hrIngreso, cc.sDescripcion AS Descripcion, 
                            a.Estado FROM asistencia a, persona p, area ars, centrocosto cc WHERE a.user=p.idusuario AND p.idArea=ars.idArea  AND a.ingreso!='' AND a.fregistro='$factual' GROUP BY a.user ORDER BY a.ingreso");
                        }
                        if($ver['idPerfil']=='4'){
                            //CONSULTA EN BD
                                $coons = mysqli_query($conection, "SELECT a.fregistro, CONCAT(p.apellido,' ', p.nombre) AS colaborador, ars.Area AS area, date_format(a.ingreso,'%h:%i') AS hrIngreso, cc.sDescripcion AS Descripcion, 
                                a.Estado FROM asistencia a, persona p, area ars, centrocosto cc WHERE a.user=p.idusuario AND p.idArea=ars.idArea AND a.ingreso!='' AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND 
                                a.fregistro='$factual' GROUP BY a.user ORDER BY a.ingreso");
                            }

                            while($mostrar = mysqli_fetch_assoc($coons)){

                        ?>  
                           <tr>
                            <td class="cuerpotabla"><?php echo $mostrar['fregistro'] ;?></td>
                            <td class="td1"><?php echo $mostrar['colaborador'] ;?></td>
                            <td class="cuerpotabla"><?php echo $mostrar['area'] ;?></td>
                            <td class="cuerpotabla"><?php echo $mostrar['hrIngreso'] ;?></td>
                            <!--<td class="cuerpotabla"><?php echo $mostrar['Descripcion'] ;?></td>   -->    
                            <td class="cuerpotabla"><?php

                            if($mostrar['hrIngreso']<'09:00:00'){
                                echo '<img src="../img/Circulo_Verde_2.png" height="20" width="20"  alt="A_tiempo" title=""><label style="font-size: 1px; color: rgba(255, 255, 255, 0.014)">Perfecta</label>';
                            }else{
                                if($mostrar['hrIngreso']>'08:59:00' && $mostrar['hrIngreso']<'09:16:00'){
                                    echo '<img src="../img/Circulo_Amarillo_02.png" height="20" width="20"  alt="Tarde" title="Tarde"><label style="font-size: 1px; color: rgba(255, 255, 255, 0.014)">Aceptable</label>';
                                }else{
                                echo '<img src="../img/Circulo_Rojo_2.png" height="20" width="20" alt="Tarde" title="Tarde"><label style="font-size: 1px; color: rgba(255, 255, 255, 0.014)">Inaceptable</label>';
                                }
                            }

                            ;?></td>
                             
                        </tr>
                            <?php
                        }
                        ?>  
                        
                         
                            <?php
                            if($ver['idPerfil']=='3'){
                            //CONSULTA EN BD
                            $coonss = mysqli_query($conection,"SELECT concat(p.apellido,' ',p.nombre) as colaborador, ar.Area as area, me.motivo as motivo FROM persona p, area ar, usuario u, motivoestado me WHERE p.idArea=ar.idArea AND p.idusuario=u.usuario AND p.EstadoCuenta='REGISTRADO'  AND u.MotivoEstado=me.idME and NOT EXISTS (SELECT NULL FROM asistencia a WHERE a.fregistro='$factual' and u.usuario=a.user)");
                            }
                            if($ver['idPerfil']=='4'){
                                //CONSULTA EN BD
                                $coonss = mysqli_query($conection,"SELECT concat(p.apellido,' ',p.nombre) as colaborador, ar.Area as area, me.motivo as motivo FROM persona p, area ar, usuario u, motivoestado me WHERE p.idArea=ar.idArea AND p.idusuario=u.usuario AND p.EstadoCuenta='REGISTRADO'  AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND u.MotivoEstado=me.idME and NOT EXISTS (SELECT NULL FROM asistencia a WHERE a.fregistro='$factual' and u.usuario=a.user)");
                            }
                            while($dat = mysqli_fetch_assoc($coonss)){

                            ?>  
                            <tr>
                                <td class="cuerpotabla"><?php echo $factual;?></td>
                                <td class="td1"><?php echo $dat['colaborador'] ;?></td>
                                <td class="cuerpotabla"><?php echo $dat['area'] ;?></td>
                                <td class="cuerpotabla"></td>   
                                <td class="cuerpotabla"><img src="../img/gris.png" height="20" width="20" alt="A_tiempo" title=""><label style="font-size: 1px; color: rgba(255, 255, 255, 0.014)">

                                <?php if($dat['motivo']=='Ninguno'){ 

                                          echo "Inasistencia"; 
                                        }else{ 

                                            echo $dat['motivo']; 
                                        }?>
                                </label></td> 
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