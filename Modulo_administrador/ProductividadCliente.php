<?php
    //CONEXIÓN A BD
    require '../Modulos/conexion.php';

    //INICIAR VARIABLES DE SESIÓN
    session_start();

    //VARIABLE DE FECHA
    $factual = date('Y-m-d');
    $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) );

    //CONSULTA Total
    $total = mysqli_query($conection, "SELECT COUNT(user) AS total FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user");
    $totalr = mysqli_fetch_assoc($total);
    
    //CONSULTA ASISTENCIA PERFECTA
    $a_perfecta = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso<'09:00:00'");
    $a_perfectar = mysqli_fetch_assoc($a_perfecta);
    
    //CONSULTA ASISTENCIA ACEPTABLE
    $a_aceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND (a.ingreso>'08:59:00' AND a.ingreso<'09:16:00')");
    $a_aceptabler = mysqli_fetch_assoc($a_aceptable);
    
    //CONSULTA ASISTENCIA INACEPTABLE
    $a_inaceptable = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tarde FROM asistencia a, persona p  WHERE a.fregistro='$factual' AND a.ingreso!='' AND p.idusuario=a.user AND a.ingreso>'09:15:00'");
    $a_inaceptabler = mysqli_fetch_assoc($a_inaceptable);
                
    //PORCENTAJE DE ASISTENCIA PERFECTA
    if($totalr['total'] <> 0){
        $dato1 = ($a_perfectar['atiempo']/$totalr['total'])*100;
    }else{
        $dato1 = '0';
    }
     //PORCENTAJE DE ASISTENCIA ACEPTABLE
    if($totalr['total'] <> 0){
        $dato2 = ($a_aceptabler['atiempo']/$totalr['total'])*100;
    }else{
        $dato2 = '0';
    }
    //PORCENTAJE DE ASISTENCIA INACEPTABLE
    if($totalr['total'] <> 0){
        $dato3 = ($a_inaceptabler['tarde']/$totalr['total'])*100; 
    }else{
        $dato3 = '0';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaDiaria.css">
    <title>Asistencia ACG</title>

    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    
    <script type="text/javascript" src="jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="dist/Chart.bundle.min.js"></script>
    
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css"> 
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
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
            <input type="submit" onclick = "location='AdminAsistenciaConsulta.php'" class="buttons" value="Supervisor">
            <input type="submit" onclick = "location='AdminAsistenciaEditar.php'" class="buttons" value="Cliente">
            <label style="margin-left: 27%; font-size: 18px; font-weight: bold;">PRODUCTIVIDAD - Personal</label>
     </div>
      <br><br>
     
        <div style="margin-left: 4%; " class="container">
        <div class="row"> 
        <div class="col-lg-12">
            <div style="border-color: black">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" style="text-align: center">
                    <!-- CABEZERA DE LA TABLA -->
                    <thead>
                        <tr>
                            <th style="font-size: 90%">FECHA</th>
                            <th style="font-size: 80%">PERSONA</th>
                            <th style="font-size: 90%">CONCEPTO</th>
                            <th style="font-size: 80%">CC ORIGEN</th>
                            <th style="font-size: 80%">CC DESTINO</th>
                            <th style="font-size: 80%">INI REAL</th>
                            <th style="font-size: 80%">FIN REAL</th>
                            <th style="font-size: 80%">HORAS REAL</th>
                            <th style="font-size: 80%">INI ACG</th>
                            <th style="font-size: 80%">FIN ACG</th>
                            <th style="font-size: 80%">HORAS ACG</th>
                            <th style="font-size: 80%">COSTO / HORAS</th>
                            <th style="font-size: 80%">TOTAL COSTO REAL</th>
                            <th style="font-size: 80%">TOTAL COSTO ACG</th>
                            <th style="font-size: 80%">COMENTARIO</th>
                        </tr>
                    </thead>

                    <!-- CUERPO DE LA TABLA -->
                    <tbody style="overflow-y: scroll; height: 180px">

                        <!-- RECOPILAR INFORMACIÓN DE BD -->
                        <?php
                        //CONSULTA EN BD
                        $sql = mysqli_query($conection, "SELECT v.FechaCreacion AS fecha, concat(p.nombre,' ',p.apellido) as persona, m.mdescripcion as concepto, cc.sDescripcion as origen, ccd.sDescripcion as destino, v.HoraAbierta as inicioreal,v.HoraCerrada as finreal, TIMEDIFF(v.HoraCerrada, v.HoraAbierta) as horasreales, 
                        v.HoraAbierta as inicioacg, v.HoraCerrada as finacg, TIMEDIFF(v.HoraCerrada, v.HoraAbierta) as horasacg, 
                        p.CostoxHora AS cxh, CONVERT(((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)*24)*p.CostoxHora)/10000, decimal(10,2)) as totalcostoreal,CONVERT(((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)*24)*p.CostoxHora)/10000, decimal(10,2)) as totalcostoacg FROM visita v, persona p, motivos m, centrocosto cc, centrocosto_destino ccd
                        WHERE v.usuario=p.idusuario AND v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.HoraCerrada!=''
                        ORDER BY `v`.`FechaCreacion` DESC");
                        while($mostrar = mysqli_fetch_assoc($sql)){

                        ?>  

                        <!-- RECOPILAR INFORMACIÓN DE BD -->
                        <tr>
                            <td style="font-size: 80%"><?php echo $mostrar['fecha'] ;?></td>
                            <td style="font-size: 80%;"><?php echo $mostrar['persona'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['concepto'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['origen'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['destino'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['inicioreal'] ;?></td> 
                            <td style="font-size: 80%"><?php echo $mostrar['finreal'] ;?></td> 
                            <td style="font-size: 80%"><?php echo $mostrar['horasreales'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['inicioacg'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['finacg'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['horasacg'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['cxh'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['totalcostoreal'] ;?></td>
                            <td style="font-size: 80%"><?php echo $mostrar['totalcostoacg'] ;?></td>
                            <td style="font-size: 80%"><?php echo 'TEXTO' ;?></td>           
                        </tr>
                        <?php
                        }
                        ?>
                        
                    </body>      
                </table>
            </div>

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