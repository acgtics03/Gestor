<?php
    //INICIAR VARIABLES DE SESIÓN
    date_default_timezone_set('America/Lima');
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
    
    //CONEXIÓN A BD
    require '../Modulos/conexion.php';

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
    <link  rel="icon"   href="../img/logoacg2.jpg" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaControl.css">
    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">
    
    <title>Asistencia Personal ACG</title>

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

            <br>

            <div class="fonConsulta">
                <form action="AdminAsistenciaConsulta.php" method="GET">
                    
                    <div><br>
                        <div>
                        <center><label style="font-size: 18px; font-weight: bold;">CONSULTA ASISTENCIA</label></center><br>
                        </div>
                        
                        <div style="display: inline">
                    
                                <div style="display: inline">

                                    <div style="display:inline; margin-left: 25%">

                                        <div style="display:inline-block;">
                                            <label class="consultatitulos">Documento</label>
                                        </div>
                                            
                                        <div style="display:inline-block; margin-left: 1%">
                                            <label class="consultatitulos">:</label>
                                        </div>

                                        <div style="display:inline-block; margin-left: 1%">
                                            <input class="consultacampos" type="text" name="dni" id="label_dni" placeholder="Ejemplo: DNI">
                                        </div>
                                    </div>
                                    
                                    <div style="display:inline; margin-left: 2%">

                                        <div style="display:inline-block;">
                                            <label class="consultatitulos">Periodo</label>
                                        </div>

                                        <div style="display:inline-block; margin-left: 1%">
                                            <label class="consultatitulos">:</label>
                                        </div>

                                        <div style="display:inline-block; margin-left: 1%">   
                                            <input class="consultafecha" name="fecha_inicio" type="text" id="datepicker" placeholder="yy-mm-dd">
                                            <label class="consultatitulos">&nbsp;-&nbsp;</label> 
                                            <input class="consultafecha" name="fecha_fin" type="text" id="datepicker2" placeholder="yy-mm-dd">

                                        </div>   

                                    </div>
                                    

                                </div><br><br>
                                
                                <div style="display: inline">

                                    <div style="display:inline; margin-left: 25%">

                                        <div style="display:inline-block;">
                                            <?php 
                                            $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                            $ver = mysqli_fetch_assoc($consultaperfil);
        
                                            if($ver['idPerfil']=='3'){
                                            $areas = mysqli_query($conection, "SELECT idArea, Area FROM area"); 
                                            }
                                            if($ver['idPerfil']=='4'){
                                                $areas = mysqli_query($conection, "SELECT a.idArea as idArea, a.Area as Area FROM area a, persona p WHERE a.idArea=p.idArea AND p.idusuario='$UserName'"); 
                                                }
                                            ?>
                                            <label class="consultatitulos">Area</label>
                                        </div>

                                        <div style="display:inline-block;margin-left: 4%">
                                            <label class="consultatitulos">:</label>
                                        </div>

                                        <div style="display:inline-block;margin-left: 1%">
                                            <select name="areas" id="lista_area" class="consultacampos">
                                                <option selected="true" disabled="disabled">Todas</option>
                                                <?php while($row=mysqli_fetch_assoc($areas)){ ?>
                                                <option value=" <?php echo $row['idArea'] ?> " >
                                                    <?php echo $row['Area']; ?>
                                                </option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div style="display:inline; margin-left: 2%">
                                        <div style="display:inline-block;"> 
                                            <!-- LISTA DESPLEGABLE - ESTADO DE LA ASISTENCIA -->
                                            <label class="consultatitulos">Estado</label>
                                            </div>
                                            <div style="display:inline-block;margin-left: 1.5%">
                                                <label class="consultatitulos">:</label>
                                            </div>

                                            <div style="display:inline-block;margin-left: 1%">
                                            <select name="tipo_asistencia" id="lista_area" class="consultacampos2">
                                                <option selected="true" disabled="disabled">Todas</option>
                                                <option>INGRESO</option>
                                                <option>INICIO REFRIGERIO</option>
                                                <option>FIN REFRIGERIO</option>
                                                <option>SALIDA</option>
                                            </select>
                                        </div>
                                    </div>    
                                </div>
                        </div>
                            <div style="text-align: center;">
                            <br><input style="margin-bottom: 10px;border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 130px;
                            padding: 5px; cursor: pointer; font-weight: bold" id="boton_consulta" name="boton_consulta" type="submit" value="Consultar">
                            </div><br>
                    </div>
                </form>
            </div><br> 
            
        
                    <div class="container">
                    <div class="row">
                    <div class="col-lg-12">
                        <div>
                            
                            <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                                <!-- CABEZERA DE LA TABLA -->
                                <thead>
                                    
                                    <tr>
                                        <th class="th1">FECHA</th>
                                        <th class="th1">COLABORADOR</th>
                                        <th class="th1">DNI</th>
                                        <th class="th1">AREA</th>
                                        <th class="th1">INGRESO</th>
                                        <th class="th1">RF INI.</th>
                                        <th class="th1">RF FIN</th>
                                        <th class="th1">SALIDA</th>
                                        <th class="th1" style="width: 80px"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <!-- CUERPO DE LA TABLA -->
                                <!--<tbody style="overflow-y: scroll; height: 130px">-->
                                    <?php
                                    // VARABLES DE LOS FILTROS
                                    $dni = isset($_GET['dni'])?$_GET['dni']:Null;
                                    $dnir = trim($dni);

                                    $fecha_inicio = isset($_GET['fecha_inicio'])?$_GET['fecha_inicio']:Null;
                                    $fecha_inicior = trim($fecha_inicio);

                                    $fecha_fin = isset($_GET['fecha_fin'])?$_GET['fecha_fin']:Null;
                                    $fecha_finr = trim($fecha_fin);
                                    
                                    $area = isset($_GET['areas'])?$_GET['areas']:Null;
                                    $arear = trim($area);

                                    //$empresa = isset($_GET['empresas'])?$_GET['empresas']:Null;
                                    //$empresar = trim($empresa);

                                    $tipo_asistencia = isset($_GET['tipo_asistencia'])?$_GET['tipo_asistencia']:Null;
                                    $tipo_asistenciar = trim($tipo_asistencia);

                                    //echo '-'.$dnir.'-'.$fecha_inicior.'-'.$fecha_finr.'-'.$arear.'-'.$empresar.'-'.$tipo_asistenciar.'-';
                                    
                                    //FUNCIONALIDAD DEL BOTÓN CONSULTA

                                        //INICIALIZAR LA VARIABLE EN BLANCO
                                        $where = '';
                                        $valoor=0;

                                        //CONDICIONALES DE FILTROS
                                        if(isset($_GET['boton_consulta'])){
                                            //FILTRO ÚNICO
                                            $valoor=1;
                                            if(!empty($dnir)){
                                                $where = "AND p.DNI='$dnir'";
                                            }
                                            
                                            if(!empty($arear)){
                                                $where = "AND p.idArea='$arear'";
                                            }
                                                                                
                                            if(!empty($fecha_inicior) && !empty($fecha_finr)){
                                                $where = "AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                            }

                                            if(!empty($tipo_asistenciar)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where ="AND a.Estado='INICIO_REFRIGERIO'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA'";
                                                }
                                            }

                                            //FILTRO GRUPOS 2

                                            //ÁREA - DNI
                                            if(!empty($dnir) && !empty($arear)){
                                                $where = "AND p.idArea='$arear' AND p.DNI='$dnir'";
                                            }

                                            //ÁREA - FECHAS
                                            if(!empty($arear) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                                $where = "AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                            }

                                            //ÁREA - TIPO ASISTENCIA
                                            if(!empty($arear) && !empty($tipo_asistenciar)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND p.idArea='$arear'";
                                                }
                                            }

                                            //DNI - FECHA
                                            if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                                $where = "AND p.DNI='$dnir' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                            }

                                            //DNI - TIPO ASISTENCIA
                                            if(!empty($dnir) && !empty($tipo_asistenciar)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND p.DNI='$dnir'";
                                                }
                                            }

                                            //FECHA - TIPO ASISTENCIA
                                            if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_asistenciar)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                                }
                                            }
                                
                                            //FILTROS GRUPOS 3
                                        
                                            //DNI - FECHA - AREA
                                            if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($arear)){
                                                $where = "AND p.DNI='$dnir' AND p.idArea='$arear' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                            }

                                            //DNI - FECHA - TIPO ASISTENCIA
                                            if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_asistenciar) && !empty($dnir)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                                }
                                            } 


                                            // FECHA - AREA - TIPO ASISTENCIA
                                            if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_asistenciar) && !empty($arear)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'FIN_REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND a.fregistro BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                                }
                                            }

                                            //DNI - TIPO ASISTENCIA - AREA
                                            if(!empty($dnir) && !empty($arear) && !empty($tipo_asistenciar)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO_REFRIGERIO' AND idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN_REFRIGERIO' AND idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND idArea='$arear' AND p.DNI='$dnir'";
                                                }
                                            }

                                            //FILTRO GRUPOS 4

                                            //DNI - FECHA - AREA - TIPO ASISTENCIA
                                            if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_asistenciar) && !empty($arear) && !empty($dnir)){
                                                if($tipo_asistenciar == 'INGRESO'){
                                                    $where = "AND a.Estado='INGRESO' AND a.fregistro BETWEEN '$fecha_inicior' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'INICIO REFRIGERIO'){
                                                    $where = "AND a.Estado='INICIO REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'FIN REFRIGERIO'){
                                                    $where = "AND a.Estado='FIN REFRIGERIO' AND a.fregistro BETWEEN '$fecha_inicior' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                                }else if($tipo_asistenciar == 'SALIDA'){
                                                    $where = "AND a.Estado='SALIDA' AND a.fregistro BETWEEN '$fecha_inicior' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                                }
                                            }
                                        }

                                    if($valoor==1){
                                    //CONSULTA BD 
                                    $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                    $ver = mysqli_fetch_assoc($consultaperfil);

                                    if($ver['idPerfil']=='3'){                         
                                    $asistencia = mysqli_query($conection, "SELECT a.id as User,a.fregistro as Fecha, a.user, date_format(a.ingreso,'%H:%i') as ing, date_format(a.irefrigerio,'%H:%i') as rfini, date_format(a.frefrigerio,'%H:%i') as rffin, date_format(a.salida,'%H:%i') as sal, s.Area as Area, p.DNI as DNI, concat(p.apellido,' ',p.nombre) AS Usuario FROM asistencia a, persona p, area s WHERE a.user=p.idusuario AND a.user=p.idusuario AND p.idArea=s.idArea $where ORDER BY a.user, a.ingreso asc, a.fregistro asc");
                                    }
                                    if($ver['idPerfil']=='4'){                         
                                        $asistencia = mysqli_query($conection, "SELECT a.id as User,a.fregistro as Fecha, a.user, date_format(a.ingreso,'%H:%i') as ing, date_format(a.irefrigerio,'%H:%i') as rfini, date_format(a.frefrigerio,'%H:%i') as rffin, date_format(a.salida,'%H:%i') as sal, s.Area as Area, p.DNI as DNI, concat(p.apellido,' ',p.nombre) AS Usuario FROM asistencia a, persona p, area s WHERE a.user=p.idusuario AND a.user=p.idusuario AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND p.idArea=s.idArea $where ORDER BY a.user, a.ingreso asc, a.fregistro asc");
                                    }

                                    if(mysqli_num_rows($asistencia)<> 0){                          

                                    while($asistenciar = mysqli_fetch_assoc($asistencia)){
                                    
                                        $dts= $asistenciar['User']."||".
                                                $asistenciar['Usuario']."||".
                                                $asistenciar['Fecha']."||".
                                                $asistenciar['ing']."||".
                                                $asistenciar['rfini']."||".
                                                $asistenciar['rffin']."||".
                                                $asistenciar['sal'];
                            ?>
 
                                    <tr>
                                            <td class="cuerpotabla"><?php echo $asistenciar['Fecha'];?></td>
                                            <td class="td1"><?php echo $asistenciar['Usuario'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['DNI'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['Area'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['ing'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['rfini'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['rffin'];?></td>
                                            <td class="cuerpotabla"><?php echo $asistenciar['sal'];?></td>
                                            <td style="text-align: center; width: 50px; font-size: 80%"><?php

                                                if($asistenciar['ing']<'09:00'){
                                                    echo '<img src="../img/Circulo_Verde_2.png" height="20" width="20"  alt="A_tiempo" title="">';
                                                }else{
                                                    if($asistenciar['ing']>'08:59' && $asistenciar['ing']<'09:16'){
                                                        echo '<img src="../img/Circulo_Amarillo_02.png" height="20" width="20"  alt="Tarde" title="Tarde">';
                                                    }else{
                                                    echo '<img src="../img/Circulo_Rojo_2.png" height="20" width="20" alt="Tarde" title="Tarde">';
                                                    }
                                                }

                                                ;?>
                                                     &nbsp;&nbsp;
                                                     <?php 
                                                     $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                                     $ver = mysqli_fetch_assoc($consultaperfil);
                 
                                                     if($ver['idPerfil']=='3'){   ?>
                                                       <button class="button-edit" data-toggle="modal" data-target="#modalEdicion" onclick="agregaform('<?php echo $dts ?>')"><img src="../img/lap.png" alt="" style="cursor: pointer;"></button>
                                                       <?php }
                                                     ?>
                                                </td>
                                        </tr>
                                    
                            <?php
                                    }
                                }else{
                            ?>
                            
                            <div>
                                <label for=""><?php $alert = 'No se han encontrado registros en la búsqueda';?></label>
                            </div>
                            
                            <?php
                                }
                            }
        }else{
            header('location: ../index.php');
        }
                            ?>                        
                            </tbody>

                            </table>
                            <br><br>
                           
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                 
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div>
                    <div class="modal-body"> 

                            <input type="text" hidden="" id="idpersona" name="">

                            <div style="display: inline-block">
                                <label class="popup-nombres">Colaborador</label><br>
                                <input type="text" name="" id="user" class="popup-campos" readonly>
                            </div>
                            
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Fecha</label><br>
                                <input class="consultafecha" name="fecha" type="text" id="datepicker3" placeholder="yy-mm-dd">
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Ingreso</label><br>
                                <input type="time" name="" id="ing" class="popup-campos2">
                            </div>

                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Rf. Ini</label><br>
                                <input type="time" name="" id="rfini" class="popup-campos2">
                            </div>

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Rf. Fin</label><br>
                                <input type="time" name="" id="rffin" class="popup-campos2">
                            </div>

                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Salida</label><br>
                                <input type="time" name="" id="sal" class="popup-campos2">
                            </div>

                            <br><br>
                    </div>



                    <div class="modal-footer">
                       <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>
                        
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
       

            
            
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabla').load('componentes/tabla.php');
    $('#buscador').load('componentes/buscador.php');
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#guardarnuevo').click(function(){
          nombre=$('#nombre').val();
          apellido=$('#apellido').val();
          email=$('#email').val();
          telefono=$('#telefono').val();
            agregardatos(nombre,apellido,email,telefono);
        });



        $('#actualizadatos').click(function(){
          actualizaDatos();
        });
    
    });
</script>