<?php
        date_default_timezone_set('America/Lima');
        //CONEXIÓN A BD
        require '../Modulos/conexion.php';

        //INICIAR VARIABLES DE SESIÓN
         session_start();
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
        //VARIABLE DE FECHA
        $factual = date('Y-m-d');
         $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) );
?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaDiaria.css">
    <title>Reporte Productividad ACG</title>

    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="dist/Chart.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css"> 
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> 
   
    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">

	<script src="../librerias/jquery-3.2.1.min.js"></script>
    <script src="../Js/funciones.js"></script>
	<script src="../librerias/bootstrap/js/bootstrap.js"></script>
	<script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>


</head>
<body>
    
    <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->

    
     <div>
           <!-- <input type="submit" onclick = "location='#'" class="buttons2" value="Supervisor">
            <input type="submit" onclick = "location='#'" class="buttons2" value="Cliente">-->
    </div><br>

    <div class="fonConsulta"><br>
            <center>
            <label style="font-size: 18px; font-weight: bold;">Reporte de Productividad</label>
            <br><br>
            <form action="ProductividadPersonal.php" method="GET">
            <div style="display: inline">

                <div style="display: inline-block">
                    <label class="namefiltro">Fecha inicio: </label>
                    <input class="campofiltro" type="text" name="Fecini" id="datepicker" placeholder="yy-mm-dd">
                </div>
                
                <div style="display: inline-block">
                    <label class="namefiltro">Fecha Fin : </label>
                    <input class="campofiltro2" type="text" name="Fecfin" id="datepicker2" placeholder="yy-mm-dd">
                </div>

                <div style="display: inline-block">
                    <label class="namefiltro">Año :</label>
                    <select class="comboboxfiltro" name="boxaño">
                    <option selected="true" disabled="disabled">Todos</option>
                        <option>2019</option>
                        <option>2020</option>
                        <option>2021</option>
                        <option>2022</option>
                    </select>
                </div>
                
                <div style="display: inline-block">
                    <?php
                     
                     $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                    $ver = mysqli_fetch_assoc($consultaperfil);
        
                      if($ver['idPerfil']=='3'){
                            //CONSULTA BD - AREAS
                            $empleados = mysqli_query($conection, "SELECT concat(nombre,' ',apellido) as empleado FROM persona ORDER BY empleado ASC");
                      }
                      if($ver['idPerfil']=='4'){
                        //CONSULTA BD - AREAS
                        $empleados = mysqli_query($conection, "SELECT concat(nombre,' ',apellido) as empleado FROM persona WHERE idJefeInmediato='$UserName' OR idusuario='$UserName' ORDER BY empleado ASC");
                      }

                    ?>

                    <label class="namefiltro">Empleado :</label>
                    <select class="comboboxfiltro2" name="boxempleado">
                                    <option selected="true" disabled="disabled">Todos</option>
                                    <?php while($row=mysqli_fetch_assoc($empleados)){ ?>
                                    <option value=" <?php echo $row['empleado'] ?> " >
                                        <?php echo $row['empleado']; ?>
                                    </option>
                                    <?php }?>
                    </select>
                </div><br><br><br>
                <div style="text-align: right; margin-right: 5%; text-align: center;">
                    <input name="consulta" type="submit" class="buttons2" value="Consultar"><br>.
                </div>
                </center>
                <br>
    </div>       
        
    </div>                  
    </div>
      <br><br>
       
        
        <div class="container" style="margin-left: 3%">
        
        <div class="row"> 
        
        <div class="col-lg-12">
            
            <div style="border-color: black;" >
                <table id="example" class="table table-striped table-bordered" cellspacing="0" style="text-align: center; background-color: #ffffffa9;">
                    <!-- CABEZERA DE LA TABLA -->
                    <thead>
                        <tr>
                            <th style="font-size: 80%">FECHA</th>
                            <th style="font-size: 80%">PERSONA</th>
                            <th style="font-size: 80%">CONCEPTO</th>
                            <th style="font-size: 80%">CC ORIGEN</th>
                            <th style="font-size: 80%">CC DESTINO</th>
                            <th style="font-size: 80%">INI REAL</th>
                            <th style="font-size: 80%">FIN REAL</th>
                            <th style="font-size: 80%">HORAS REAL</th>
                            <th style="font-size: 80%">INI ACG</th>
                            <th style="font-size: 80%">FIN ACG</th>
                            <th style="font-size: 80%">HORAS ACG</th>
                            <th style="font-size: 80%">CxH</th>
                            <th style="font-size: 80%">COSTO REAL</th>
                            <th style="font-size: 80%">COSTO ACG</th>
                            <th style="font-size: 80%">COMENTARIO</th>
                        </tr>
                    </thead>

                    <!-- CUERPO DE LA TABLA -->
                    <tbody style="overflow-y: scroll; height: 180px">

                        <!-- RECOPILAR INFORMACIÓN DE BD -->
                       <?php

                            
                            $condicion='';
                            $boton = 0;
                            $consultar="";
                            //CONSULTA Total
                           
                            $fecha_inicio = isset($_GET['Fecini'])?$_GET['Fecini']:Null;
                                $fecinir = trim($fecha_inicio);

                            $fecha_fin = isset($_GET['Fecfin'])?$_GET['Fecfin']:Null;
                                $fecfinr = trim($fecha_fin);

                            $bxañ = isset($_GET['boxaño'])?$_GET['boxaño']:Null;
                            $bxaño = trim($bxañ);
                             
                            $bxemplead= isset($_GET['boxempleado'])?$_GET['boxempleado']:Null;
                            $bxempleado = trim($bxemplead);
                        
                            if(isset($_GET['consulta'])){
                                $boton = 1;
                                //Comprobamos que en la variable GET exista algun valor para usuario y para clave
                                if(!empty($fecinir) && !empty($fecfinr))
                                {

                                $condicion="AND v.FechaCreacion BETWEEN '$fecinir' AND '$fecfinr'";

                                $consultar = mysqli_query($conection, 
                                "SELECT v.Actividad AS Actividad, v.FechaCreacion AS fecha, concat(p.nombre,' ',p.apellido) as persona, m.mdescripcion as concepto, cc.sDescripcion as origen, ccd.sDescripcion as destino,DATE_FORMAT(v.HoraAbierta,'%H:%i') as inicioreal, DATE_FORMAT(v.HoraCerrada,'%H:%i') as finreal, DATE_FORMAT(TIMEDIFF(v.HoraCerrada, v.HoraAbierta),'%H:%i') as horasreales, DATE_FORMAT(v.HoraAbierta,'%H:%i') as inicioacg, DATE_FORMAT(v.HoraCerrada,'%H:%i') as finacg, DATE_FORMAT(TIMEDIFF(v.HoraCerrada, v.HoraAbierta),'%H:%i') as horasacg, p.CostoxHora AS cxh, CONVERT((date_format((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)),'%H')+((date_format((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)),'%i'))/60))*p.CostoxHora, decimal(10,2)) as totalcostoreal, CONVERT((date_format((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)),'%H')+((date_format((TIMEDIFF(v.HoraCerrada, v.HoraAbierta)),'%i'))/60))*p.CostoxHora, decimal(10,2)) as totalcostoacg FROM visita v, persona p, motivos m, centrocosto cc, centrocosto_destino ccd WHERE v.usuario=p.idusuario AND v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo 
                                AND v.HoraCerrada!='' $condicion GROUP BY persona, fecha ORDER BY fecha, destino
                                ");

                                }
                            }
                                
                            if($boton==1){
                                while($mostrar = mysqli_fetch_assoc($consultar)){
                             
                                
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
                            <td style="font-size: 80%"><?php echo $mostrar['Actividad'] ;?></td>           
                        </tr>
                        <?php
                        }
                    }
                }else{
                    header('location: ../index.php');
                }      
                        ?>
                        
                    </body>      
                </table>
            </div>

        </div>
        </div>
        </div>
        </div>

    </div>

    <script src="popup.js"></script>


<script type="text/javascript" src="../Js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../Js/jquery-ui.min.js"></script>
    <script>
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker3").datepicker();
    </script>
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
            </form>
   <br><br>
</body>

</html>