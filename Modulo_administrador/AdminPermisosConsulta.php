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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminPermisosControl.css">
    <title>Permisos Personal ACG</title>

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
        <form action="AdminPermisosConsulta.php" method="GET">
            <div><br>
                    <div>
                    <center><label style="font-size: 18px; font-weight: bold;">CONSULTA PERMISO</label></center><br>
                    </div>
                            
                    <div style="display: inline">
                    
                         <div style="display: inline">

                            <div style="display:inline; margin-left: 24%">

                                <div style="display:inline-block;">                    
                                    <label class="consultatitulos">Documento</label>
                                </div>

                                <div style="display:inline-block; margin-left: 1.2%">
                                    <label class="consultatitulos">:</label>
                                </div>

                                <div style="display:inline-block; margin-left: 1%">
                                    <input class="consultacampos" type="text" name="dni" id="label_dni" placeholder="Ejemplo: DNI">
                                </div>

                            </div>

                            <div style="display:inline; margin-left: 2%">

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

                                <div style="display:inline-block; margin-left: 4.7%">
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
                           <br><br>
                        </div>

                        <div style="display: inline">

                            <div style="display:inline; margin-left: 24%">

                                <div style="display:inline-block;">
                                    <!-- LISTA DESPLEGABLE - MOTIVOS PERMISOS -->
                                    <?php $motivos_permisos = mysqli_query($conection, "SELECT descripcion FROM motivos_permiso WHERE estado='1'"); ?>
                                    <label class="consultatitulos">Motivo</label>
                                </div>

                                <div style="display:inline-block; margin-left: 3.5%">
                                    <label class="consultatitulos">:</label>
                                </div>
                                
                                <div style="display:inline-block; margin-left: 1%">
                                        <select name="motivos_permisos" id="lista_area" class="consultacampos">
                                            <option selected="true" disabled="disabled">Todas</option>
                                            <?php while($row=mysqli_fetch_assoc($motivos_permisos)){ ?>
                                            <option value=" <?php echo $row['descripcion'] ?> " >
                                                <?php echo $row['descripcion']; ?>
                                            </option>
                                            <?php }?>
                                        </select>
                                </div>

                            </div>
                            <div style="display:inline; margin-left: 2%">

                                <div style="display: inline">
                                    <!-- LISTA DESPLEGABLE - ESTADO PERMISO -->
                                    <label class="consultatitulos">Estado</label>
                                </div>
                                    
                                <div style="display:inline-block; margin-left: 3.5%">
                                    <label class="consultatitulos">:</label>       
                                </div>
                                    
                                <div style="display:inline-block; margin-left: 1%">
                                    <select name="estado_permiso" id="estado_permiso" class="consultacampos">>
                                        <option selected="true" disabled="disabled">Todas</option>
                                        <option>APROBADO</option>
                                        <option>POR APROBAR</option>
                                        <option>RECHAZADO</option>
                                    </select>
                                </div>
                            </div>  
                            <br><br>
                        </div>


                        <div style="display: inline">

                            <div style="display:inline; margin-left: 24%">

                                <div style="display:inline-block;">
                                    <label class="consultatitulos">Periodo</label>
                                </div>
                                
                                <div style="display:inline-block; margin-left: 3%">
                                    <label class="consultatitulos">:</label>
                                </div>

                                <div style="display:inline-block; margin-left: 1%">
                                    <input class="consultafecha" name="fecha_inicio" type="text" id="datepicker" placeholder="yy-mm-dd">
                                </div>

                                <div style="display:inline-block;">
                                    <label class="consultatitulos">-</label>
                                </div>

                                <div style="display:inline-block">
                                    <input class="consultafecha" name="fecha_fin" type="text" id="datepicker2" placeholder="yy-mm-dd">
                                </div>
                               
                            </div>

                            <br><br>
                        </div>
                        <center>
                        <div style="display:inline;">
                                    <input style="margin-bottom: 10px; border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 130px;
                            padding: 5px; cursor: pointer; font-weight: bold" id="boton_consulta" name="boton_consulta" type="submit" value="Consultar">
                        </div>
                        </center>
                    </div>
                    <br><br>
                </div>
            </div>
        </form>
    </div>
            <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <!-- CABEZERA DE LA TABLA -->
                        <thead>
                            <tr>
                                <th>FECHA</th>
                                <th>COLABORADOR</th>
                                <th>DNI</th>
                                <th>AREA</th>
                                <th>INICIO PERMISO</th>
                                <th>FIN PERMISO</th>
                                <th>MOTIVO</th>
                                <th></th>
                            </tr>
                        </thead>
                            
                        <!-- CUERPO DE LA TABLA -->
                        <tbody style="overflow-y: scroll; height: 130px">   
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

                            $motivos_permisos = isset($_GET['motivos_permisos'])?$_GET['motivos_permisos']:Null;
                            $motivos_permisosr = trim($motivos_permisos);

                            $estado_permiso = isset($_GET['estado_permiso'])?$_GET['estado_permiso']:Null;
                            $estado_permisor = trim($estado_permiso);

                            //echo '-'.$dnir.'-'.$fecha_inicior.'-'.$fecha_finr.'-'.$arear.'-'.$motivos_permisosr.'-'.$estado_permisor;
                            
                            //FUNCIONALIDAD DEL BOTÓN CONSULTA

                                //INICIALIZAR LA VARIABLE EN BLANCO
                                $where = '';
                                $valoor=0;

                                //CONDICIONALES DE FILTROS
                                if(isset($_GET['boton_consulta'])){
                                    ///////////FILTRO ÚNICO///////////
                                    $valoor=1;
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
                                        $where = "AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                    }

                                    //MOTIVOS PERMISO
                                    if(!empty($motivos_permisosr)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal'";
                                        }
                                    }

                                    //ESTADO PERMISO
                                    if(!empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO')";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado = 'POR APROBAR'";
                                        }
                                    }

                                    /////////FILTRO GRUPOS 2/////////////

                                    //DNI - FECHA
                                    if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                        $where = "AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                    }

                                    //DNI - AREA
                                    if(!empty($dnir) && !empty($arear)){
                                        $where = "AND p.DNI='$dnir' AND p.idArea='$arear'";
                                    }

                                    //DNI - MOTIVOS PERMISO
                                    if(!empty($dnir) && !empty($motivos_permisosr)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //DNI - ESTADO PERMISO
                                    if(!empty($dnir) && !empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //FECHA - AREA
                                    if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($arear)){
                                        $where = "AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                    }

                                    //FECHA - MOTIVOS PERMISO
                                    if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($motivos_permisosr)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }
                                    }

                                    //FECHA - ESTADO PERMISO
                                    if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }
                                    }

                                    //AREA - MOTIVOS PERMISO
                                    if(!empty($arear) && !empty($motivos_permisosr)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND p.idArea='$arear'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND p.idArea='$arear'";
                                        }
                                    }

                                    //AREA - ESTADO PERMISO
                                    if(!empty($arear) && !empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND p.idArea='$arear'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND p.idArea='$arear'";
                                        }
                                    }

                                    //MOTIVOS PERMISO - ESTADO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO')";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR'";    
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO')";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO')";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado == 'POR APROBAR'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado == 'POR APROBAR'";
                                        }
                                    }

                                    ////////////FILTRO GRUPOS 3///////////
                                    
                                    //DNI - FECHA - AREA
                                    if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($arear)){
                                        $where = "AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir' AND p.idArea='$arear'";
                                    }

                                    //DNI - FECHA - MOTIVO PERMISO
                                    if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //DNI - FECHA - ESTADO PERMISO
                                    if(!empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //DNI - AREA - ESTADO PERMISO
                                    if(!empty($dnir) && !empty($arear) && !empty($estado_permisor)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.DNI='$dnir' AND p.idArea='$arear'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND p.DNI='$dnir' AND p.idArea='$arear'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND p.DNI='$dnir' AND p.idArea='$arear'";
                                        }
                                    }

                                    //DNI - AREA - MOTIVO PERMISO
                                    if(!empty($dnir) && !empty($arear)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND p.DNI='$dnir' AND p.idArea='$arear'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND p.DNI='$dnir' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND p.DNI='$dnir' AND p.idArea='$arear'";
                                        }
                                    }

                                    //DNI - MOTIVO PERMISO - ESTADO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor) && !empty($dnir)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='POR APROBAR' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //FECHA - AREA - MOTIVO PERMISO
                                    if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($motivos_permisosr) && !empty($arear)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear'";
                                        }
                                    }

                                    //FECHA - AREA - ESTADO PERMISO
                                    if(!empty($arear) && !empty($estado_permisor) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado == 'POR APROBAR' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }
                                    }

                                    //AREA - MOTIVO PERMISO - ESTADO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor) && !empty($arear)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO' AND p.idArea='$arear'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO'AND pr.estado='RECHAZADO' AND p.idArea='$arear'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='POR APROBAR'AND pr.estado='RECHAZADO' AND p.idArea='$arear'";
                                        }
                                    }

                                    ////////////FILTRO GRUPO 4///////////////

                                    //DNI - FECHA - AREA - ESTADO PERMISO
                                    if(!empty($arear) && !empty($estado_permisor) && !empty($fecha_inicior) && !empty($fecha_finr) && !empty($dnir)){
                                        if($estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'RECHAZADO'){
                                            $where = "AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }else if($estado_permisor == 'POR APROBAR'){
                                            $where = "AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //DNI - FECHA - AREA - MOTIVOS PERMISO
                                    if(!empty($fecha_inicior) && !empty($fecha_finr) && !empty($motivos_permisosr) && !empty($arear) && !empty($dnir)){
                                        if($motivos_permisosr == 'Salud'){
                                            $where = "AND mp.descripcion='Salud' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Vacaciones'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal'){
                                            $where = "AND mp.descripcion='Personal' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //FECHA - AREA - MOTIVO PERMISO - ESTADO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor) && !empty($arear) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO'AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='POR APROBAR'AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }
                                    }

                                    //DNI - AREA - MOTIVO PERMISO - ESTADO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor) && !empty($arear) && !empty($dnir)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND p.DNI='$dnir'";    
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND p.DNI='$dnir'";
                                        }
                                    }

                                    //////////FILTRO GRUPO 5/////////////

                                    //DNI - FECHA - AREA - ESTADO PERMISO - MOTIVO PERMISO
                                    if(!empty($motivos_permisosr) && !empty($estado_permisor) && !empty($arear) && !empty($dnir) && !empty($fecha_inicior) && !empty($fecha_finr)){
                                        if($motivos_permisosr == 'Salud' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Salud' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Salud' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";    
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='RECHAZADO' AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Vacaciones' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Vacaciones' AND pr.estado='POR APROBAR' AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'APROBADO' or $estado_permisor == 'INICIO PERMISO' or $estado_permisor == 'FIN PERMISO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado IN ('APROBADO', 'INICIO PERMISO', 'FIN PERMISO') AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'RECHAZADO'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='RECHAZADO'AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }else if($motivos_permisosr == 'Personal' && $estado_permisor == 'POR APROBAR'){
                                            $where = "AND mp.descripcion='Personal' AND pr.estado='POR APROBAR'AND p.idArea='$arear' AND p.DNI='$dnir' AND pr.fsol BETWEEN '$fecha_inicior' AND '$fecha_finr'";
                                        }
                                    }
                                }
                                if($valoor==1){
    
                                $consultaperfil = mysqli_query($conection, "SELECT idPerfil FROM usuario WHERE usuario='$UserName'");
                                $ver = mysqli_fetch_assoc($consultaperfil);

                                if($ver['idPerfil']=='3'){  
                                //CONSULTA BD - ASISTENCIA GENERAL
                                $permiso = mysqli_query($conection, "SELECT pr.fsol, s.Area, pr.Trinicio, pr.Trfin, CONCAT(UCASE(LEFT(pr.estado, 1)), LCASE(SUBSTRING(pr.estado, 2))) AS estado, pr.estado AS estado2, mp.descripcion AS motivo, CONCAT(p.apellido,', ',p.nombre) AS usuario, p.DNI FROM permiso pr, persona p, motivos_permiso mp, area s WHERE pr.user=p.idusuario AND pr.estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO', 'INICIO PERMISO', 'FIN PERMISO') AND pr.motivo=mp.id AND p.idArea=s.idArea $where ORDER BY pr.fsol");
                                }
                                if($ver['idPerfil']=='4'){  
                                    //CONSULTA BD - ASISTENCIA GENERAL
                                    $permiso = mysqli_query($conection, "SELECT pr.fsol, s.Area, pr.Trinicio, pr.Trfin, CONCAT(UCASE(LEFT(pr.estado, 1)), LCASE(SUBSTRING(pr.estado, 2))) AS estado, pr.estado AS estado2, mp.descripcion AS motivo, CONCAT(p.apellido,', ',p.nombre) AS usuario, p.DNI FROM permiso pr, persona p, motivos_permiso mp, area s WHERE pr.user=p.idusuario AND pr.estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO', 'INICIO PERMISO', 'FIN PERMISO') AND (p.idJefeInmediato='$UserName' OR p.idusuario='$UserName') AND pr.motivo=mp.id AND p.idArea=s.idArea $where ORDER BY pr.fsol");
                                    }
                                if(mysqli_num_rows($permiso) <> 0){

                                while($permisor = mysqli_fetch_assoc($permiso)){
                            ?>
                                <tr id="tr" style="text-align: center; height: 30px">
                                    <td style="width: 90px; font-size: 90%"><?php echo $permisor['fsol'];?></td>
                                    <td style="width: 320px; font-size: 70%; text-align: left"><?php echo $permisor['usuario'];?></td>
                                    <td style="width: 90px; font-size: 90%"><?php echo $permisor['DNI'];?></td>
                                    <td style="width: 120px; font-size: 70%"><?php echo $permisor['Area'];?></td>
                                    <td style="width: 80px; font-size: 90%"><?php echo $permisor['Trinicio'];?></td>
                                    <td style="width: 80px; font-size: 90%"><?php echo $permisor['Trfin'];?></td>
                                    <td style="width: 80px; font-size: 90%"><?php echo $permisor['motivo'];?></td>
                                    <td style="width: 30px; font-size: 90%"><?php 
                                        if($permisor['estado2'] == 'APROBADO' or $permisor['estado2'] == 'INICIO PERMISO' or $permisor['estado2'] == 'FIN PERMISO'){
                                            echo '<img style="width: 20px; height: 20px" src="../img/Circulo_Verde_2.png">';
                                        }else if($permisor['estado2'] == 'RECHAZADO'){
                                            echo '<img style="width: 20px; height: 20px" src="../img/Circulo_Rojo_2.png">';
                                        }else if($permisor['estado2'] == 'POR APROBAR'){
                                            echo '<img style="width: 20px; height: 20px" src="../img/Circulo_Amarillo_02.png">';
                                        }
                                    ?></td>
                                </tr>
                            <?php
                                    }
                                }else{
                            ?>

                            <div>
                                <label for=""><?php $alert = '';?></label>
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
                    
                </div>
            </div>
            </div>
            </div>
        </form>
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