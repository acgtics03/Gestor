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
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminVisitasControl.css">
    <title>Visitas ACG</title>

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

     <br>
     
    <div class="fonConsulta">
    <form action="AdminVisitasConsulta.php" method="GET">
        <div><br>
            <div>
                <center><label style="font-size: 18px; font-weight: bold;">CONSULTA VISITA</label></center><br>
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

                        <div style="display:inline-block; margin-left: 3%">
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
                            <!-- LISTA DESPLEGABLE - ÁREAS -->
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

                        <div style="display:inline-block; margin-left: 4%">
                            <label class="consultatitulos">:</label>
                        </div>

                        <div style="display:inline-block; margin-left: 1%">
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
                            <!-- LISTA DESPLEGABLE - TIPOS REGISTRO -->
                            <label class="consultatitulos">Tipo registro</label>
                        </div>

                        <div style="display:inline-block; margin-left: 1%">
                            <label class="consultatitulos">:</label>
                        </div>

                        <div style="display:inline-block; margin-left: 1%">
                            <select name="tipo_registro" id="lista_area" class="consultacampos">
                                <option selected="true" disabled="disabled">Todas</option>
                                <option>INICIO VISITA</option>
                                <option>FIN VISITA</option>
                            </select>
                        </div>
                    </div>
                </div><br><br>
                
                <div style="display: inline">

                    <div style="display:inline; margin-left: 25%">

                        <div style="display:inline-block;">
                            <!-- LISTA DESPLEGABLE - CENTROS DE COSTOS ORIGEN-->
                            <?php $origen = mysqli_query($conection, "SELECT sDescripcion FROM centrocosto ORDER BY sDescripcion ASC"); ?>
                            <label class="consultatitulos">CC Origen</label>
                        </div>

                        <div style="display:inline-block; margin-left: 1.3%">
                            <label class="consultatitulos">:</label>
                        </div>

                        <div style="display:inline-block; margin-left: 1%">
                            <select name="origen" id="lista_origen" class="consultacampos">
                                <option selected="true" disabled="disabled">Todas</option>
                                <?php while($row=mysqli_fetch_assoc($origen)){ ?>
                                <option value=" <?php echo $row['sDescripcion'] ?> " >
                                    <?php echo $row['sDescripcion']; ?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div style="display:inline; margin-left: 2%">
                        <div style="display:inline-block;">
                            <!-- LISTA DESPLEGABLE - CENTROS DE COSTOS DESTINO-->
                            <?php $destino = mysqli_query($conection, "SELECT sDescripcion FROM centrocosto_destino ORDER BY sDescripcion ASC"); ?>
                            <label class="consultatitulos">CC Destino:</label>

                        </div>

                        <div style="display:inline-block; margin-left: 1%">
                            <label class="consultatitulos">:</label>
                        </div>


                        <div style="display:inline-block; margin-left: 1%">
                            <select name="destino" id="lista_destino" class="consultacampos">
                                <option selected="true" disabled="disabled">Todas</option>
                                <?php while($row=mysqli_fetch_assoc($destino)){ ?>
                                <option value=" <?php echo $row['sDescripcion'] ?> " >
                                    <?php echo $row['sDescripcion']; ?>
                                </option>
                                <?php }?>
                            </select>
                        </div>
                    <div>
                </div><br>
                <div style="text-align: center;">
                        <input style="border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 130px; padding: 5px; cursor: pointer; font-weight: bold" id="boton_consulta" name="boton_consulta" type="submit" value="Consultar">
                </div><br><br>
               </div> 
               </div>
            </div>
        </div>
    </form>
    </div>
        <br><br>
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
                            <th class="th1">AREA</th>
                            <th class="th1">INICIO</th>
                            <th class="th1">FIN</th>
                            <th class="th1">MOTIVO</th>
                            <th class="th1">ORIGEN</th>
                            <th class="th1">DESTINO</th>
                            <th class="th1">ACTIVIDAD</th>
                            <th class="th1"></th>
                        </tr>
                    </thead>
                        
                    <!-- CUERPO DE LA TABLA -->
                    <tbody>   
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

                        $tipo_registro = isset($_GET['tipo_registro'])?$_GET['tipo_registro']:Null;
                        $tipo_registror = trim($tipo_registro);

                        $origen = isset($_GET['origen'])?$_GET['origen']:Null;
                        $origenr = trim($origen);

                        $destino = isset($_GET['destino'])?$_GET['destino']:Null;
                        $destinor = trim($destino);

                        //echo '-'.$dnir.'-'.$fecha_inicior.'-'.$fecha_finr.'-'.$arear.'-'.$tipo_registror.'-'.$origenr.'-'.$destinor;
                        
                        //FUNCIONALIDAD DEL BOTÓN CONSULTA

                            //INICIALIZAR LA VARIABLE EN BLANCO
                            $where = '';
                            $valoor=0;

                            //CONDICIONALES DE FILTROS
                            if(isset($_GET['boton_consulta'])){
                                $valoor=1;
                                ///////////FILTRO ÚNICO///////////
                                
                                //DNI
                                if(!empty($dnir)){
                                    $where = "AND p.DNI='$dnir'";
                                }
                                
                                //AREA
                                if(!empty($arear)){
                                    $where = "AND p.idArea='$arear'";
                                }
                                        
                                //FECHA
                                if(!empty($fecha_inicior) && !empty($fecha_finr)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                }

                                //TIPO REGISTRO
                                if(!empty($tipo_registror)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>''";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>''";
                                    }
                                }

                                //ORIGEN
                                if(!empty($origenr)){
                                    $where = "AND cc.sDescripcion='$origenr'";
                                }

                                //DESTINO
                                if(!empty($destinor)){
                                    $where = "AND ccd.sDescripcion='$destinor'";
                                }

                                ////////////////FILTRO GRUPO 2////////////////

                                //DNI - FECHA
                                if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                    $where = "AND p.DNI='$dnir' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                }

                                //DNI - AREA
                                if(!empty($dnir) && !empty($arear)){
                                    $where = "AND p.DNI='$dnir' AND p.idArea='$arear'";
                                }

                                //DNI - TIPO REGISTRO
                                if(!empty($dnir) && !empty($tipo_registror)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.DNI='$dnir'";
                                    }
                                }

                                //DNI - ORIGEN
                                if(!empty($dnir) && !empty($origenr)){
                                    $where = "AND p.DNI='$dnir' AND cc.sDescripcion='$origenr'";
                                }

                                //DNI - DESTINO
                                if(!empty($dnir) && !empty($destinor)){
                                    $where = "AND p.DNI='$dnir' AND ccd.sDescripcion='$destinor'";
                                }

                                //FECHA - ÁREA
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($arear)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                }

                                //FECHA - TIPO REGISTRO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                    }
                                }

                                //FECHA ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($origenr)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr'";
                                }

                                //FECHA - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($destinor)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor'";
                                }

                                //AREA - TIPO REGISTRO
                                if(!empty($tipo_registror) && !empty($arear)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear'";
                                    }
                                }
                                
                                //AREA - ORIGEN
                                if(!empty($arear) && !empty($origenr)){
                                    $where = "AND p.idArea='$arear' AND cc.sDescripcion='$origenr'";
                                }

                                //AREA - DESTINO
                                if(!empty($destinor) && !empty($arear)){
                                    $where = "AND ccd.sDescripcion='$destinor' AND p.idArea='$arear'";
                                }

                                //TIPO REGISTRO - ORIGEN
                                if(!empty($tipo_registror) && !empty($origenr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND cc.sDescripcion='$origenr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND cc.sDescripcion='$origenr'";
                                    }
                                }

                                //TIPO REGISTRO - DESTINO
                                if(!empty($tipo_registror) && !empty($destinor)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND ccd.sDescripcion='$destinor'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND ccd.sDescripcion='$destinor'";
                                    }
                                }

                                //ORIGEN - DESTINO
                                if(!empty($destinor) && !empty($origenr)){
                                    $where = "AND ccd.sDescripcion='$destinor' AND cc.sDescripcion='$origenr'";
                                }

                                ///////////////FILTRO GRUPO 3//////////////////

                                //DNI - FECHA - AREA
                                if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($arear)){
                                    $where = "AND p.DNI='$dnir' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                }

                                //DNI - FECHA - TIPO REGISTRO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($dnir)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                    }
                                }

                                //DNI - FECHA - ORIGEN
                                if(!empty($dnir) && !empty($origenr) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                    $where = "AND p.DNI='$dnir' AND cc.sDescripcion='$origenr' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                }

                                //DNI - FECHA - DESTINO
                                if(!empty($dnir) && !empty($destinor) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                    $where = "AND p.DNI='$dnir' AND ccd.sDescripcion='$destinor' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                }

                                //FECHA - AREA - TIPO REGISTRO
                                if(!empty($tipo_registror) && !empty($arear) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                    }
                                }

                                //FECHA - AREA - ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($origenr) && !empty($arear)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear'";
                                }

                                //FECHA - AREA - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($destinor) && !empty($arear)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear'";
                                }

                                //FECHA - TIPO REGISTRO - ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($origenr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr'";
                                    }
                                }

                                //FECHA - TIPO REGISTRO - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($destinor)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor'";
                                    }
                                }

                                //AREA - TIPO REGISTRO - ORIGEN
                                if(!empty($tipo_registror) && !empty($arear) && !empty($origenr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear' AND cc.sDescripcion='$origenr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear' AND cc.sDescripcion='$origenr'";
                                    }
                                }

                                //AREA - TIPO REGISTRO - DESTINO
                                if(!empty($tipo_registror) && !empty($arear) && !empty($destinor)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear' AND ccd.sDescripcion='$destinor'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear' AND ccd.sDescripcion='$destinor'";
                                    }
                                }

                                //AREA - ORIGEN - DESTINO
                                if(!empty($destinor) && !empty($origenr) && !empty($arear)){
                                    $where = "AND ccd.sDescripcion='$destinor' AND cc.sDescripcion='$origenr' AND p.idArea='$arear'";
                                }

                                //TIPO REGISTRO - ORIGEN - DESTINO
                                if(!empty($tipo_registror) && !empty($destinor) && !empty($origenr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND ccd.sDescripcion='$destinor' AND cc.sDescripcion='$origenr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND ccd.sDescripcion='$destinor' AND cc.sDescripcion='$origenr'";
                                    }
                                }

                                //////////////////FILTRO GRUPO 4//////////////////

                                //DNI - FECHA - AREA - TIPO REGISTRO
                                if(!empty($tipo_registror) && !empty($arear) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($dnir)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                    }
                                }

                                //DNI - FECHA - AREA - ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($origenr) && !empty($arear) && !empty($dnir)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                }

                                //DNI - FECHA - AREA - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($destinor) && !empty($arear) && !empty($dnir)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                }

                                //FECHA - AREA - TIPO REGISTRO - ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($origenr) && !empty($arear)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear'";
                                    }
                                }

                                //FECHA - AREA - TIPO REGISTRO - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($destinor) && !empty($arear)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear'";
                                    }
                                }

                                //FECHA - AREA - ORIGEN - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($origenr) && !empty($arear) && !empty($destinor)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear' AND ccd.sDescripcion='$destinor'";
                                }
                        
                                //AREA - TIPO REGISTRO - ORIGEN - DESTINO
                                if(!empty($tipo_registror) && !empty($arear) && !empty($origenr) && !empty($destinor)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND p.idArea='$arear' AND cc.sDescripcion='$origenr' AND ccd.sDescripcion='$destinor'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND p.idArea='$arear' AND cc.sDescripcion='$origenr' AND ccd.sDescripcion='$destinor'";
                                    }
                                }

                                //////////////////FILTRO GRUPO 5///////////////////

                                //DNI - FECHA - AREA - TIPO REGISTRO - ORIGEN
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($origenr) && !empty($arear) && !empty($dnir)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                    }
                                }

                                //DNI - FECHA - AREA - TIPO REGISTRSO - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($destinor) && !empty($arear) && !empty($dnir)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                    }
                                }
        
                                //DNI - FECHA - AREA - ORIGEN - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($origenr) && !empty($arear) && !empty($destinor) && !empty($dnir)){
                                    $where = "AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND cc.sDescripcion='$origenr' AND p.idArea='$arear' AND ccd.sDescripcion='$destinor' AND p.DNI='$dnir'";
                                }

                                //FECHA - AREA - TIPO REGISTRO - ORIGEN - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($destinor) && !empty($arear) && !empty($origenr)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND cc.sDescripcion='$origenr'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND cc.sDescripcion='$origenr'";
                                    }
                                }

                                ///////////////////FILTRO GRUPO &/////////////////////

                                //DNI - FECHA - AREA - TIPO REGISTRO - ORIGEN - DESTINO
                                if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($tipo_registror) && !empty($destinor) && !empty($arear) && !empty($origenr) && !empty($dnir)){
                                    if($tipo_registror == 'INICIO VISITA'){
                                        $where = "AND v.HoraAbierta<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND cc.sDescripcion='$origenr' AND p.DNI='$dnir'";
                                    }else if($tipo_registror == 'FIN VISITA'){
                                        $where = "AND v.HoraCerrada<>'' AND v.FechaCreacion BETWEEN '$fecha_inicior' AND '$fecha_finr' AND ccd.sDescripcion='$destinor' AND p.idArea='$arear' AND cc.sDescripcion='$origenr' AND p.DNI='$dnir'";
                                    }
                                }
                            }

                            if($valoor==1){
                                $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                    $ver = mysqli_fetch_assoc($consultaperfil);

                                    if($ver['idPerfil']=='3'){   
                                        //CONSULTA BD - ASISTENCIA GENERAL
                                        $permiso = mysqli_query($conection, "SELECT v.idVisita as User, m.mdescripcion AS Motivo, cc.sDescripcion AS Origen, ccd.sDescripcion AS Destino, v.HoraCreacion AS HoraInicio, v.tarifa AS TarifaReal, v.EstadoVisita AS Estado, concat(p.apellido,', ',p.nombre) AS Usuario, v.HoraCerrada AS HoraFin, s.Area, v.FechaCreacion as Fecha, p.DNI, v.origen as org, v.destino as dest, v.idmotivo as motiv, v.Actividad as Actividad FROM visita v, motivos m, centrocosto cc, centrocosto_destino ccd, tarifa t, persona p, area s WHERE v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.idtarifa=t.iTarifa AND v.usuario=p.idusuario AND p.idArea=s.idArea $where ORDER BY v.usuario, v.FechaCreacion, v.HoraCreacion asc");
                                    }
                                    if($ver['idPerfil']=='4'){   
                                        //CONSULTA BD - ASISTENCIA GENERAL
                                        $permiso = mysqli_query($conection, "SELECT v.idVisita as User, m.mdescripcion AS Motivo, cc.sDescripcion AS Origen, ccd.sDescripcion AS Destino, v.HoraCreacion AS HoraInicio, v.tarifa AS TarifaReal, v.EstadoVisita AS Estado, concat(p.apellido,', ',p.nombre) AS Usuario, v.HoraCerrada AS HoraFin, s.Area, v.FechaCreacion as Fecha, p.DNI, v.origen as org, v.destino as dest, v.idmotivo as motiv, v.Actividad as Actividad FROM visita v, motivos m, centrocosto cc, centrocosto_destino ccd, tarifa t, persona p, area s WHERE v.idmotivo=m.iCodigo AND v.origen=cc.iCodigo AND v.destino=ccd.iCodigo AND v.idtarifa=t.iTarifa AND v.usuario=p.idusuario AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND p.idArea=s.idArea $where ORDER BY v.usuario, v.FechaCreacion, v.HoraCreacion asc");
                                    }

                            if(mysqli_num_rows($permiso) <> 0){

                            while($visitar = mysqli_fetch_assoc($permiso)){

                                          $vis= $visitar['User']."||".
                                                $visitar['Usuario']."||".
                                                $visitar['Fecha']."||".
                                                $visitar['Motivo']."||".
                                                $visitar['HoraInicio']."||".
                                                $visitar['HoraFin']."||".
                                                $visitar['Origen']."||".
                                                $visitar['Destino'];
                        ?>
                            <tr>
                                <td class="cuerpotabla"><?php echo $visitar['Fecha'];?></td>
                                <td class="td1"><?php echo $visitar['Usuario'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['Area'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['HoraInicio'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['HoraFin'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['Motivo'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['Origen'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['Destino'];?></td>
                                <td class="cuerpotabla"><?php echo $visitar['Actividad'];?></td>
                                <td class="cuerpotabla">
                                    <?php
                                        if($visitar['HoraFin'] == ''){
                                            echo '<img height="20" width="20" src="../img/Circulo_Rojo_2.png">';
                                        }else if($visitar['HoraFin'] <> ''){
                                            echo '<img height="20" width="20" src="../img/Circulo_Verde_2.png">';
                                        }
                                    ?>
                                    &nbsp;&nbsp;
                                    <?php 
                                                     $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                                     $ver = mysqli_fetch_assoc($consultaperfil);
                 
                                                     if($ver['idPerfil']=='3'){   ?>
                                                     <button class="button-edit" data-toggle="modal" data-target="#modalEdicion" onclick="Visita('<?php echo $vis ?>')"><img src="../img/lap.png" alt="" style="cursor: pointer;"></button>
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
                        ?>

                    </tbody>
                </table>
                
               

            </div>
        </div>
        </div>
        </div>
        </form>

    </div>

    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                 
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div>
                    <div class="modal-body"> 

                            <input type="text" hidden="" id="idvisita" name="">

                            <div style="display: inline-block">
                                <label class="popup-nombres">Colaborador</label><br>
                                <input type="text" name="" id="user" class="popup-campos" readonly>
                            </div>
                            
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Fecha</label><br>
                                <input class="consultafecha" name="fecha" type="text" id="datepicker4" placeholder="yy-mm-dd">
                            </div>
                            &nbsp;&nbsp;
                            <div style="display: inline-block">
                            <br>
                            <?php 
                            
                            $motivo = mysqli_query($conection, "SELECT * FROM motivos ORDER BY mdescripcion ASC"); 
                            ?>
                                <label class="popup-nombres">Motivo</label><br>

                                <select id="bxm"  class="popup-campos3">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                    <?php while($row=mysqli_fetch_assoc($motivo)){ ?>
                                    <option> <?php echo $row['mdescripcion']; ?> </option>
                                    <?php }?>
                                </select>
                            </div>
                            
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Inicio</label><br>
                                <input type="time"  id="inicio" class="popup-campos2">
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block">
                            <br>
                                <label class="popup-nombres">Fin</label><br>
                                <input type="time" id="fin" class="popup-campos2">
                            </div>

                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="display: inline-block">
                            <?php $origen = mysqli_query($conection, "SELECT * FROM centrocosto ORDER BY sDescripcion ASC"); ?>  
                                 <label class="popup-nombres">Origen</label><br>

                                <select id="bxo" class="popup-campos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                    <?php while($row=mysqli_fetch_assoc($origen)){ ?>
                                    <option> <?php echo $row['sDescripcion']; ?> </option>
                                    <?php }?>
                               </select>
                            </div>

                            <div style="display: inline-block">
                            <br>
                            <?php $destino = mysqli_query($conection,"SELECT * FROM centrocosto_destino ORDER BY sDescripcion ASC");?>
                            <label class="popup-nombres">Destino</label><br>

                                <select id="bxd" class="popup-campos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($destino)){?>
                                <option> <?php echo $datos['sDescripcion']; ?> </option>
                                <?php }?>
                                </select>
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
    <?php }else{
            header('location: ../index.php');
        }?>

<script type="text/javascript" src="../Js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="../Js/jquery-ui.min.js"></script>
    <script>
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker4").datepicker();
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

     <br><br>

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
          
        });
    
    });
</script>