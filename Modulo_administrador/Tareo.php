<?php
//INICIAR VARIABLES DE SESIÓN
date_default_timezone_set('America/Lima');
session_start();

//CONEXIÓN A BD
require '../Modulos/conexion.php';
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
$fayer = date("Y-m-d", strtotime("-1 day", strtotime($factual)));
$mes = date('m');
$year = date('Y');

// Variables tipo Hidden

  // $txt = 'hidden';
  //$txt6 = 'visibility:hidden';
  //$btn='hidden';
  //$btn2='submit';
  // $label = 'visibility:hidden';
                           
    $txt = '';
    $txt6 = '';
    $btn='submit';
    $btn2='hidden';
    $label = '';
                           
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="../img/logoacg2.jpg" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaControl.css">
    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">

    <title>Usuarios - Personal ACG</title>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="dist/Chart.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">

    <script src="../librerias/jquery-3.2.1.min.js"></script>
    <script src="../Js/funciones2.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.js"></script>
    <script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

     <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->

    <br>

    <div class="fonConsulta">
        <form action="" method="GET">

            <div><br>
                <div>
                    <center><label style="font-size: 18px; font-weight: bold;">Consultar Tareo</label></center><br>
                </div>

                <div style="display: inline">

                    <div style="display: inline">

                        <div style="display:inline; margin-left: 25%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Mes</label>
                            </div>

                            <div style="display:inline-block; margin-left: 4.5%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block; margin-left: 0.8%">

                                <select name="mes" id="mes" class="consultacampos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>

                        <div style="display:inline; margin-left: 2.3%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Año</label>
                            </div>

                            <div style="display:inline-block; margin-left: 4.3%">
                                <label class="consultatitulos">:</label>
                            </div>
                            
                            <div style="display:inline-block; margin-left: 1%">
                            <select name="year" id="year" class="consultacampos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                            </select>
                            </div>

                        </div>


                    </div><br><br>
                    <div style="display: inline">

                        <div style="display:inline; margin-left: 25%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Usuario</label>
                            </div>

                            <div style="display:inline-block; margin-left: 2.5%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <?php $consultar_usuarios = mysqli_query($conection, "SELECT idusuario as id, concat(apellido,' ',nombre) as datos FROM persona WHERE EstadoCuenta='REGISTRADO' ORDER BY apellido ASC"); ?>
                            <div style="display:inline-block; margin-left: 1%">
                            <select name="usuario" id="usuario" class="consultacampos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($consultar_usuarios)){?>
                                <option value=" <?php echo $datos['id'] ?> ">
                                <?php echo $datos['datos']; ?>
                                </option>
                                <?php }?>
                            </select>
                            </div>
                        </div>

                        <div style="display:inline; margin-left: 2.7%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Área</label>
                            </div>

                            <div style="display:inline-block; margin-left: 4.1%">
                                <label class="consultatitulos">:</label>
                            </div>
                            <?php $consultar_area = mysqli_query($conection, "SELECT idArea as id, Area as datos FROM area ORDER BY Area ASC"); ?>
                            <div style="display:inline-block; margin-left: 1%">
                            <select name="area" id="area" class="consultacampos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($consultar_area)){?>
                                <option value=" <?php echo $datos['id'] ?> ">
                                <?php echo $datos['datos']; ?>
                                </option>
                                <?php }?>
                            </select>
                            </div>

                        </div>


                    </div><br><br>
                </div>
                <div style="text-align: center;">
                    <br>


                        <?php
                        
                        
                            // VARABLES DE LOS FILTROS
                            $mess = isset($_GET['mes']) ? $_GET['mes'] : Null;
                            $mesr = trim($mess);

                            $yeaar = isset($_GET['year']) ? $_GET['year'] : Null;
                            $yearr = trim($yeaar);

                            $usuario = isset($_GET['usuario']) ? $_GET['usuario'] : Null;
                            $usuarior = trim($usuario);

                            $area = isset($_GET['area']) ? $_GET['area'] : Null;
                            $arear = trim($area);

                            //echo '-'.$dnir.'-'.$fecha_inicior.'-'.$fecha_finr.'-'.$arear.'-'.$empresar.'-'.$tipo_asistenciar.'-';


                            
                            //FUNCIONALIDAD DEL BOTÓN CONSULTA

                            //INICIALIZAR LA VARIABLE EN BLANCO
                            $where = '';
                            $valoor = 0;

                            $cant_mes = date('m');
                            $condicion_1 = "AND (MONTH(a.fregistro)='7' OR MONTH(a.fregistro) NOT IN ('7'))";
                            $condicion_2 = '';
                            $condicion_3 = '';
                            $condicion_4 = '';

                            //CONDICIONALES DE FILTROS
                            if (isset($_GET['boton_consulta'])) {
                              
                              $info = "p.DNI as Numero_Tarjeta ,concat(p.apellido,' ',p.nombre) as Trabajador";
                              
                              if(!empty($mesr)){
                                $condicion_1 = "AND (MONTH(a.fregistro)='$mesr' OR MONTH(a.fregistro) NOT IN ('$mesr'))";
                                $mes=$mesr; 
                              }
                              if(!empty($yearr)){
                                $condicion_2 = "AND YEAR(a.fregistro)='$yearr'";
                                $year=$yearr;
                              }
                              if(!empty($usuarior)){
                                $condicion_2 = "AND a.user='$usuarior'"; 
                              }
                              if(!empty($arear)){
                                $condicion_2 = "AND p.idArea='$arear'"; 
                              }

                            }
                        ?>
                        <div style="text-align: center; font-size: 14px; font-weight: bold; color: red"><?php echo isset($alert) ? $alert : ''; ?> </div>

                        <input style="margin-bottom: 10px;border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 160px;
                            padding: 5px; cursor: pointer; font-weight: bold" id="boton_consulta" name="boton_consulta" type="submit" value="CONSULTAR">

                </div><br>
            </div>
        </form>
    </div><br>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">

                   <?php

                      //Estableciendo variables
                      
                      $nom1=$mes.'-01';
                      $nom2=$mes.'-02';
                      $nom3=$mes.'-03';
                      $nom4=$mes.'-04';
                      $nom5=$mes.'-05';
                      $nom6=$mes.'-06';
                      $nom7=$mes.'-07';
                      $nom8=$mes.'-08';
                      $nom9=$mes.'-09';
                      $nom10=$mes.'-10';
                      $nom11=$mes.'-11';
                      $nom12=$mes.'-12';
                      $nom13=$mes.'-13';
                      $nom14=$mes.'-14';
                      $nom15=$mes.'-15';
                      $nom16=$mes.'-16';
                      $nom17=$mes.'-17';
                      $nom18=$mes.'-18';
                      $nom19=$mes.'-19';
                      $nom20=$mes.'-20';
                      $nom21=$mes.'-21';
                      $nom22=$mes.'-22';
                      $nom23=$mes.'-23';
                      $nom24=$mes.'-24';
                      $nom25=$mes.'-25';
                      $nom26=$mes.'-26';
                      $nom27=$mes.'-27';
                      $nom28=$mes.'-28';
                      $nom29=$mes.'-29';
                      $nom30=$mes.'-30';
                      $nom31=$mes.'-31';

                      $VAR1=$year.'-'.$mes.'-01';
                      $VAR2=$year.'-'.$mes.'-02';
                      $VAR3=$year.'-'.$mes.'-03';
                      $VAR4=$year.'-'.$mes.'-04';
                      $VAR5=$year.'-'.$mes.'-05';
                      $VAR6=$year.'-'.$mes.'-06';
                      $VAR7=$year.'-'.$mes.'-07';
                      $VAR8=$year.'-'.$mes.'-08';
                      $VAR9=$year.'-'.$mes.'-09';
                      $VAR10=$year.'-'.$mes.'-10';
                      $VAR11=$year.'-'.$mes.'-11';
                      $VAR12=$year.'-'.$mes.'-12';
                      $VAR13=$year.'-'.$mes.'-13';
                      $VAR14=$year.'-'.$mes.'-14';
                      $VAR15=$year.'-'.$mes.'-15';
                      $VAR16=$year.'-'.$mes.'-16';
                      $VAR17=$year.'-'.$mes.'-17';
                      $VAR18=$year.'-'.$mes.'-18';
                      $VAR19=$year.'-'.$mes.'-19';
                      $VAR20=$year.'-'.$mes.'-20';
                      $VAR21=$year.'-'.$mes.'-21';
                      $VAR22=$year.'-'.$mes.'-22';
                      $VAR23=$year.'-'.$mes.'-23';
                      $VAR24=$year.'-'.$mes.'-24';
                      $VAR25=$year.'-'.$mes.'-25';
                      $VAR26=$year.'-'.$mes.'-26';
                      $VAR27=$year.'-'.$mes.'-27';
                      $VAR28=$year.'-'.$mes.'-28';
                      $VAR29=$year.'-'.$mes.'-29';
                      $VAR30=$year.'-'.$mes.'-30';
                      $VAR31=$year.'-'.$mes.'-31';

                     
                   ?>

                    <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                        <!-- CABEZERA DE LA TABLA -->
                        <thead>
                            
                            <tr>
                                <th class="th1" style="font-size: 10px;">N° TARJETA</th>
                                <th class="th1" style="font-size: 10px; width: 300px;">TRABAJADOR</th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$mom1);
                                                                             $dia = date("D",$fec);
                                                                             echo $dia;
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom1; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$mom2);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>">
                                                                        <?php echo $nom2; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$mom3);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom3; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom4);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom4; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom5);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom5; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom6);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom6; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom7);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom7; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom8);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom8; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom9);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom9; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom10);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom12; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom11);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom11; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom12);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom12; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom13);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom13; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom14);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom14; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom15);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom15; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom16);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom16; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom17);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom17; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom18);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom18; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom19);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom19; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom20);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom20; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom21);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom21; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom22);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom22; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom23);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom23; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom24);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom24; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom25);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom25; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom26);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom26; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom27);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom27; ?></th>
                                <th class="th1" style="font-size: 12px;<?php  $fec = strtotime($year."-".$nom28);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "color: orange;";
                                                                              }
                                                                             ?>"><?php echo $nom28; ?></th>
                                <?php

                                    if(($mes=='1' || $mes=='3') || ($mes=='5' || $mes=='7') || ($mes=='8' || $mes=='10') || $mes=='12'){
                                     
                                        $fec = strtotime($year."-".$nom29);
                                         $dia = date("D",$fec);
                                         $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                         $consr = mysqli_num_rows($cons);
                                         $color="";
                                         if($consr>0){ $color = "color: orange;";}
                                        echo '<th class="th1" style="font-size: 12px;'.$color.'">'.$nom29.'</th>';

                                        $fec = strtotime($year."-".$nom30);
                                         $dia = date("D",$fec);
                                         $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                         $consr = mysqli_num_rows($cons);
                                         $color2="";
                                         if($consr>0){ $color2 = "color: orange;";}
                                        echo '<th class="th1" style="font-size: 12px;'.$color2.'">'.$nom30.'</th>';

                                        $fec = strtotime($year."-".$nom31);
                                         $dia = date("D",$fec);
                                         $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                         $consr = mysqli_num_rows($cons);
                                         $color3="";
                                         if($consr>0){ $color3 = "color: orange;";}
                                        echo '<th class="th1" style="font-size: 12px;'.$color3.'">'.$nom31.'</th>';

                                    }else{
                                        if(($mes=='4' || $mes=='6') || ($mes=='9' || $mes=='11')){

                                            $fec = strtotime($year."-".$nom29);
                                            $dia = date("D",$fec);
                                            $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                            $consr = mysqli_num_rows($cons);
                                            $color4="";
                                            if($consr>0){ $color4 = "color: orange;";}
                                            echo '<th class="th1" style="font-size: 12px;'.$color4.'">'.$nom29.'</th>';

                                            $fec = strtotime($year."-".$nom30);
                                            $dia = date("D",$fec);
                                            $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                            $consr = mysqli_num_rows($cons);
                                            $color5="";
                                            if($consr>0){ $color5 = "color: orange;";}   
                                            echo '<th class="th1" style="font-size: 12px;'.$color5.'">'.$nom30.'</th>';
    
                                        }else{
                                            if($mes=='2'){
                                                $fec = strtotime($year."-".$nom30);
                                                $dia = date("D",$fec);
                                                $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones=5 AND valorp='$dia'");
                                                $consr = mysqli_num_rows($cons);
                                                $color6="";
                                                if($consr>0){ $color6 = "color: orange;";}
                                                echo '<th class="th1" style="font-size: 12px;'.$color6.'">'.$nom29.'</th>';
                                            }
                                        }
                                    }
                                    
                                ?>
 
                                <th class="th1">EMPRESA</th>
                                <th class="th1">PROYECTO</th>
                                <th class="th1">LICENCIAS</th>
                                <th class="th1">SUPERVISOR</th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- CUERPO DE LA TABLA -->
                            <!--<tbody style="overflow-y: scroll; height: 130px">-->
                            <?php
                                //CONSULTA BD     
                                
                                $query="";
                                $variable1="";
                                $variable2="";
                                $variable3="";

                                if(($mes=='1' || $mes=='3') || ($mes=='5' || $mes=='7') || ($mes=='8' || $mes=='10') || $mes=='12'){
                                    $variable1 = "'$VAR29' AS 'T29',
                                    '$VAR30' AS 'T30',
                                    '$VAR31' AS 'T31',";
                                   

                                    }else{
                                        if(($mes=='4' || $mes=='6') || ($mes=='9' || $mes=='11')){

                                            $variable2 = "'$VAR29' AS 'T29',
                                            '$VAR30' AS 'T30',";

                                        }else{
                                            if($mes=='2'){

                                                $variable3 = "'$VAR29' AS 'T29',";
                                                
                                            }
                                        }
                                    }

                                $query="SELECT $info, p.idusuario as correo,
                                   '$VAR1' AS 'T1',
                                   '$VAR2' AS 'T2',
                                   '$VAR3' AS 'T3',
                                   '$VAR4' AS 'T4',
                                   '$VAR5' AS 'T5',
                                   '$VAR6' AS 'T6',
                                   '$VAR7' AS 'T7',
                                   '$VAR8' AS 'T8',
                                   '$VAR9' AS 'T9',
                                   '$VAR10' AS 'T10',
                                   '$VAR11' AS 'T11',
                                   '$VAR12' AS 'T12',
                                   '$VAR13' AS 'T13',
                                   '$VAR14' AS 'T14',
                                   '$VAR15' AS 'T15',
                                   '$VAR16' AS 'T16',
                                   '$VAR17' AS 'T17',
                                   '$VAR18' AS 'T18',
                                   '$VAR19' AS 'T19',
                                   '$VAR20' AS 'T20',
                                   '$VAR21' AS 'T21',
                                   '$VAR22' AS 'T22',
                                   '$VAR23' AS 'T23',
                                   '$VAR24' AS 'T24',
                                   '$VAR25' AS 'T25',
                                   '$VAR26' AS 'T26',
                                   '$VAR27' AS 'T27',
                                   '$VAR28' AS 'T28',
                                   $variable1
                                   $variable2
                                   $variable3
                                   p.idJefeInmediato as Supervisor
                                   FROM persona p, asistencia a
                                   WHERE p.idusuario=a.user AND p.EstadoCuenta='REGISTRADO' $condicion_1 $condicion_2 $condicion_3 $condicion_4   
                                   GROUP BY p.idusuario 
                                   ORDER BY p.dni DESC";
                                
                                $personal = mysqli_query($conection, $query);

                                if (mysqli_num_rows($personal) > 0) {

                                    while ($personalr = mysqli_fetch_assoc($personal)) {

                            ?>

                                        <tr style="text-align: center;">
                                           
                                            <td style="font-size: 10px;"><?php echo $personalr['Numero_Tarjeta']; ?></td>
                                            <td style="font-size: 10px;width: 300px;"><?php echo $personalr['Trabajador']; ?></td>
                                            <td style="font-size: 10px;"><?php 
                                                                             $actual=$year."-".$nom1;
                                                                             if($actual>$factual){
                                                                                 echo "-";
                                                                             }else{
                                                                             $fec = strtotime($year."-".$nom1);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                 $num_fec = $personalr['T1'];
                                                                                 $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php 
                                                                             $actual=$year."-".$nom2;
                                                                             if($actual>$factual){
                                                                                 echo "-";
                                                                             }else{
                                                                             $fec = strtotime($year."-".$nom2);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{
                                                                             $num_fec = $personalr['T2']; 
                                                                             $indicador = $personalr['correo'];
                                                                             $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                             }?></td>
                                                                             
                                            <td style="font-size: 10px;"><?php 
                                                                             $actual=$year."-".$nom3;
                                                                             if($actual>$factual){
                                                                                 echo "-";
                                                                             }else{
                                                                             $fec = strtotime($year."-".$nom3);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{
                                                                                $num_fec = $personalr['T3'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.ususario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                            } ?></td>
                                            <td style="font-size: 10px;"><?php 
                                                                             $actual=$year."-".$nom4;
                                                                             if($actual>$factual){
                                                                                 echo "-";
                                                                             }else{
                                                                             $fec = strtotime($year."-".$nom4);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T4']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                } 
                                                                              }?></td>
                                            <td style="font-size: 10px;"><?php 
                                                                             $actual=$year."-".$nom5;
                                                                             if($actual>$factual){
                                                                                 echo "-";
                                                                             }else{
                                                                             $fec = strtotime($year."-".$nom5);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T5'];
                                                                                $indicador = $personalr['Numero_Tarjeta'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                  $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                  $inactividadr = mysqli_num_rows($inactividad);
                                                                                  if($inactividadr>0){
                                                                                     $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                     $motivor = mysqli_fetch_assoc($motivo);
                                                                                     $e_motivo = $motivor['motiv'];
                                                                                     echo $e_motivo;
                                                                                   }else{
                                                                                     echo "F";
                                                                                   }
                                                                                }else{
                                                                                   $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                   $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                   $sigla = $modalidadr['cod'];
                                                                                   echo $sigla;
                                                                                }
                                                                               }
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php 
                                                                            $actual=$year."-".$nom6;
                                                                            if($actual>$factual){
                                                                                echo "-";
                                                                            }else{
                                                                            $fec = strtotime($year."-".$nom6);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                  $num_fec = $personalr['T6']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                                  }?></td>

                                            <td style="font-size: 10px;"><?php 
                                                                            $actual=$year."-".$nom7;
                                                                            if($actual>$factual){
                                                                                echo "-";
                                                                            }else{
                                                                            $fec = strtotime($year."-".$nom7);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T7'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php 
                                                                            $actual=$year."-".$nom8;
                                                                            if($actual>$factual){
                                                                                echo "-";
                                                                            }else{
                                                                            $fec = strtotime($year."-".$nom8);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{
                                                                                  $num_fec = $personalr['T8'];
                                                                                   $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                              } 
                                                                             }?></td>

                                            <td style="font-size: 10px;"><?php 
                                                                            $actual=$year."-".$nom9;
                                                                            if($actual>$factual){
                                                                                echo "-";
                                                                            }else{
                                                                            $fec = strtotime($year."-".$nom9);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                  $num_fec = $personalr['T9'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               }   
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom10;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{ 
                                                                              $fec = strtotime($year."-".$nom10);
                                                                              $dia = date("D",$fec);
                                                                              $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                              $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T10']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                                }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom11;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom11);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T11']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom12;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom12);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T12']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom13;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom13);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T13']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom14;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom14);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T14']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom15;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom15);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T15'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom16;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom16);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T16'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                }
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom17;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom17);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T17'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom18;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom18);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T18'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom19;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{ 
                                                                             $fec = strtotime($year."-".$nom19);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T19']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom20;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom20);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T20']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom21;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{ 
                                                                             $fec = strtotime($year."-".$nom21);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T21'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               }  
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom22;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom22);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T22'];
                                                                                  $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom23;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom23);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T23']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom24;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom24);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T24'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom25;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom25);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T25'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              } ?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom26;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom26);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T26']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom27;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom27);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T27']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <td style="font-size: 10px;"><?php $actual=$year."-".$nom28;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom28);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T28']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                            <?php if(($mes=='1' || $mes=='3') || ($mes=='5' || $mes=='7') || ($mes=='8' || $mes=='10') || $mes=='12'){ ?>
                                                <td style="font-size: 10px;"><?php $actual=$year."-".$nom29;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom29);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T29'];
                                                                                  $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                } 
                                                                              }?></td>

                                                <td style="font-size: 10px;"><?php $actual=$year."-".$nom30;
                                                                                if($actual>$factual){
                                                                                    echo "-";
                                                                                }else{
                                                                             $fec = strtotime($year."-".$nom30);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T30'];
                                                                                $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                  $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                  $inactividadr = mysqli_num_rows($inactividad);
                                                                                  if($inactividadr>0){
                                                                                     $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                     $motivor = mysqli_fetch_assoc($motivo);
                                                                                     $e_motivo = $motivor['motiv'];
                                                                                     echo $e_motivo;
                                                                                   }else{
                                                                                     echo "F";
                                                                                   }
                                                                                }else{
                                                                                   $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                   $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                   $sigla = $modalidadr['cod'];
                                                                                   echo $sigla;
                                                                                }
                                                                               }
                                                                              } ?></td>

                                                <td style="font-size: 10px;"><?php $actual=$year."-".$nom31;
                                                                                if($actual>$factual){
                                                                                    echo "-";
                                                                                }else{
                                                                             $fec = strtotime($year."-".$nom31);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                  
                                                                                $num_fec = $personalr['T31']; 
                                                                                $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                  $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                  $inactividadr = mysqli_num_rows($inactividad);
                                                                                  if($inactividadr>0){
                                                                                     $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                     $motivor = mysqli_fetch_assoc($motivo);
                                                                                     $e_motivo = $motivor['motiv'];
                                                                                     echo $e_motivo;
                                                                                   }else{
                                                                                     echo "F";
                                                                                   }
                                                                                }else{
                                                                                   $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                   $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                   $sigla = $modalidadr['cod'];
                                                                                   echo $sigla;
                                                                                }
                                                                               }
                                                                              }?></td>
                                            <?php
                                            }else{
                                                if(($mes=='4' || $mes=='6') || ($mes=='9' || $mes=='11')){?>

                                                <td style="font-size: 10px;"><?php $actual=$year."-".$nom29;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom29);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{
                                                                                $num_fec = $personalr['T29'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               } 
                                                                              }?></td>

                                                <td style="font-size: 10px;"><?php $actual=$year."-".$nom30;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom30);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T30']; 
                                                                                  $indicador = $personalr['correo'];
                                                                                $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                                } 
                                                                              }?></td>
                                             <?php                   
                                                }else{
                                                    if($mes=='2'){?>
                                                        <td style="font-size: 10px;"><?php $actual=$year."-".$nom29;
                                                                                 if($actual>$factual){
                                                                                     echo "-";
                                                                                 }else{
                                                                             $fec = strtotime($year."-".$nom29);
                                                                             $dia = date("D",$fec);
                                                                             $cons = mysqli_query($conection, "SELECT * FROM Parametros WHERE acciones='5' AND valorp='$dia'");
                                                                             $consr = mysqli_num_rows($cons);
                                                                              if($consr>0){
                                                                                  echo "";
                                                                              }else{ 
                                                                                $num_fec = $personalr['T29'];
                                                                                  $indicador = $personalr['correo'];
                                                                                 $cons_reg = mysqli_query($conection, "SELECT * FROM asistencia a, persona p  WHERE p.idusuario=a.user AND a.fregistro='$num_fec' AND p.idusuario='$indicador'");
                                                                                 $cons_regr = mysqli_num_rows($cons_reg);
                                                                                 if($cons_regr==0){
                                                                                   $inactividad = mysqli_query($conection, "SELECT * FROM persona WHERE idusuario='$indicador' AND estatus='Inactivo'");
                                                                                   $inactividadr = mysqli_num_rows($inactividad);
                                                                                   if($inactividadr>0){
                                                                                      $motivo = mysqli_query($conection, "SELECT me.motivo as motiv FROM usuario u, motivoestado me, persona p WHERE u.MotivoEstado=me.idME AND p.idusuario=u.usuario AND p.idusuario='$indicador'");
                                                                                      $motivor = mysqli_fetch_assoc($motivo);
                                                                                      $e_motivo = $motivor['motiv'];
                                                                                      echo $e_motivo;
                                                                                    }else{
                                                                                      echo "F";
                                                                                    }
                                                                                 }else{
                                                                                    $modalidad = mysqli_query($conection, "SELECT mt.sigla as cod FROM modalidad_trabajo mt, persona p WHERE p.modalidad=mt.id AND p.idusuario='$indicador'");
                                                                                    $modalidadr = mysqli_fetch_assoc($modalidad);
                                                                                    $sigla = $modalidadr['cod'];
                                                                                    echo $sigla;
                                                                                 }
                                                                               }
                                                                              } ?></td>
                                                    <?php    
                                                    }
                                                }
                                            }?>
                                            <td style="font-size: 10px;">GESTOR</td>
                                            <?php 
                                            $ver_dni = $personalr['correo'];
                                            $proyecto = mysqli_query($conection, "SELECT cc.sDescripcion as proy, p.licencia as licencia FROM persona p, centrocosto cc WHERE p.proyecto=cc.iCodigo AND p.idusuario='$ver_dni'"); 
                                            $proyector = mysqli_fetch_assoc($proyecto);
                                            $proyect = $proyector['proy'];
                                            $lic = $proyector['licencia'];  
                                            ?>
                                            <td style="font-size: 10px;"><?php echo $proyect; ?></td>


                                            <td style="font-size: 10px;text-align: center;"><?php echo $lic; ?></td>
                                            <?php 
                                               $super = $personalr['Supervisor'];
                                               $nom_supervisor = mysqli_query($conection, "SELECT concat(apellido,' ',nombre) as datos FROM persona WHERE idusuario='$super'");
                                               $nom_super=mysqli_fetch_assoc($nom_supervisor);
                                               $nom_sup = $nom_super['datos'];
                                               
                                               if(empty($nom_sup)){
                                                   $new_nom = "No asignado";
                                               }else{
                                                   $new_nom = $nom_sup;
                                               }
                                               
                                            ?>
                                            <td style="font-size: 10px;"><?php echo $new_nom; ?></td>
                                            
                                        </tr>

                                    <?php
                                    }
                                } else {
                                    ?>

                                    <div>
                                        <label for=""><?php $alert = 'No se han encontrado registros en la búsqueda'; ?></label>
                                    </div>

                            <?php
                                }
                            
                            ?>
                        </tbody>

                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>


    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <input type="text" hidden="" id="ID" name="">
                    <div style="display: inline-block">
                        <label class="popup-nombres">Documento</label><br>
                        <input class="consultafecha" name="dni" type="Number" id="dni">
                    </div>
                    &nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Fec.Nac.</label><br>
                        <input class="consultafecha" name="fn" type="text" id="fn" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Costo/Hora</label><br>
                        <input type="" name="" id="ch" class="consultafecha" style="width: 60px">
                        <script>
                                    $("#ch").on({
                                        "focus": function (event) {
                                            $(event.target).select();
                                        },
                                        "keyup": function (event) {
                                            $(event.target).val(function (index, value ) {
                                                return value.replace(/\D/g, "")
                                                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                                            });
                                        }
                                    });
                        </script>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Correo</label><br>
                        <input type="text" name="" id="correo" class="popup-campos">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Apellido</label><br>
                        <input type="text" name="" id="apellido" class="popup-lista">
                    </div> &nbsp;&nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Nombre</label><br>
                        <input type="text" name="" id="nombre" class="popup-lista">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Dirección</label><br>
                        <input type="text" name="" id="direccion" class="popup-lista">
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Telefono</label><br>
                        <input type="Number" name="" id="telefono" class="popup-campos2">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Área</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT * FROM area");?>
                        <select name="BoxArea"  id="boxarea" class="popup-lista">
                        <option selected="true" disabled="disabled">Seleccione...</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idArea'] ?>">
                        <?php echo $datos['Area']; ?>
                        </option>
                        <?php }?>
                         </select>
                
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Cargo</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT * FROM Cargo");?>
                        <select name="BoxCargo" id="boxcargo" class="popup-lista">
                        <option selected="true" disabled="disabled">Seleccione...</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idcargo'] ?>" >
                        <?php echo $datos['cargo']; ?>
                        </option>
                        <?php }?>
                         </select>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Supervisor</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT idusuario, concat(apellido,' ',nombre) as datos FROM persona WHERE TipoTrabajador='SUPERVISOR'");?>   
                                <select name="supervisor" id="supervisor" class="popup-campos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                                <option value="<?php echo $datos['idusuario'] ?>">
                                <?php echo $datos['datos']; ?>
                                </option>
                                <?php }?>
                                </select>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Estado</label><br>
                        <select name="estado" id="estado" class="popup-lista">
                                <option selected="true" disabled="disabled">...</option>
                                <option>Activo</option>
                                <option>Inactivo</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                          $( function() {
                                $("#estado").change( function() {
                                    if ($(this).val() === "Activo") {
                                        $("#boxme").prop("disabled", true);
                                        $("#fnei").prop("disabled", true);
                                        $("#fnef").prop("disabled", true);
                                    } else {
                                        $("#boxme").prop("disabled", false);
                                        $("#fnei").prop("disabled", false);
                                        $("#fnef").prop("disabled", false);
                                    }
                                });
                            });
                    </script>
                    &nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                            <label class="popup-nombres">Motivo-estado</label><br>
                            <?php $consulta = mysqli_query($conection, "SELECT * FROM motivoestado ORDER BY motivo"); ?>
                            <select name="boxme" id="boxme" class="popup-lista" disabled>
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                    <option value="<?php echo $datos['idME'] ?>">
                                        <?php echo $datos['motivo']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br><br>
                        <div style="display: inline-block">
                            <label class="popup-nombres">Fec.ini.estado</label><br>
                            <input class="popup-lista" name="fnei" type="Date" id="fnei" placeholder="yy-mm-dd" disabled>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div style="display: inline-block">
                            <label class="popup-nombres">Fec.fin estado</label><br>
                            <input class="popup-lista" name="fnef" type="Date" id="fnef" placeholder="yy-mm-dd" disabled>
                        </div>
                        
                    <br>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="actualizadatos2" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>

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
    $(document).ready(function() {
        $('#tabla').load('componentes/tabla.php');
        $('#buscador').load('componentes/buscador.php');
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
            idpersona=$('#idpersona').val();
            dni=$('#dni').val();
            fn=$('#fn').val();
            correo=$('#correo').val();
            apellido=$('#apellido').val();
            nombre=$('#nombre').val();
            direccion=$('#direccion').val();
            telefono=$('#telefono').val();
            ch=$('#ch').val();
            boxarea=$('#boxarea').val();
            boxcargo=$('#boxcargo').val();
            supervisor=$('#supervisor').val();
            estado=$('#estado').val();

            agregardatos(nombre,apellido,email,telefono);
        });


        $('#actualizadatos2').click(function() {
            actualizaDatos2();
        });

    });
</script>