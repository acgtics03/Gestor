<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
session_start();
date_default_timezone_set('America/Lima');
$usr = "";
if (!empty($_SESSION['usu'])) {
    $usr = $_SESSION['usu'];
}
require_once "../../../../config/configuracion.php";
require_once "../../../../config/conexion_app.php";
require_once "../../../../config/sesion.php";
require_once "../../../controllers/ControllerCategorias.php";
require_once "../../models/M02_Supervisar/M02MD01_Supervisar/datos_supervisor.php";
$fecha_hoy = date('Y-m-d');
$URL= "";
$URL = $HOST;

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link  rel="icon"   href="../../../../views/assets/images/logoacg2.jpg" type="image/png" />
    <title><?php echo $NOM_APP_1; ?></title>
    <!-- Custom CSS -->
    <link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="../../estilo_act.css?v=<?php echo time(); ?>">
    <link href="../../dist/css/style.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="../../dist/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css?v=<?php echo time(); ?>">

    <!-- LIBRERIAS LOADING PROCESANDO -->
    <link rel="stylesheet" type="text/css" href="../../css/LoadingProcesandoGeneral.css?v=<?php echo time(); ?>">
    <!-- LIBRERIAS ALERTA MENSAJES -->
    <link rel="stylesheet" type="text/css" href="../../css/sweetalert.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="../../main.css">
    <script src="../../js/popup_act.js"></script>

    <link rel="stylesheet" href="../../datatables/datatables.min.css" />
    <link rel="stylesheet" href="../../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="../../datatables/select/css/select.bootstrap4.min.css" />

</head>

<body>

    <script src="../../code/highcharts.js"></script>
    <script src="../../code/modules/exporting.js"></script>
    <script src="../../code/modules/export-data.js"></script>
    <script src="../../code/modules/accessibility.js"></script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <?php include_once "../../../resources/header.php"; ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <?php include_once "../../../resources/menu.php"; ?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <br>
            <div class="breadcrumb-ancho">
                <ol class="breadcrumb breadcrumb-arrow">
                    <li><a class="enlace" href="javascript:void(0)">Supervisar</a></li>
                    <li><a class="enlace" href="javascript:void(0)">Reasignar Actividades</a></li>
                </ol>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
            <input type="hidden" name="" id="txtRuta" value="<?php echo $URL; ?>">      
            <div class="col-12 col-lg-12">
              <div class="card reg-tab2" style="color: white;">
                <div class="card-header"><a href="M01SM02_Supervisar.php" style="color: white"><img src="../../image/espalda.png" width="30px" height="30px"> Volver a Supervisar</a></div>
                <div class="card-header">Buscar:
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                           <form action="" method="post">
                                        <div class="modal-body" style="text-align: center">

                                            <div style="display: inline-block">
                                                <label style="color: white">Inicio :</label><br>
                                                <input type="Date" class="filtros" name="fecini" id="fecini">
                                            </div>

                                            <div style="display: inline-block; margin-left: 2%">
                                                <label style="color: white">Termino :</label><br>
                                                <input type="Date" class="filtros" name="fecfin" id="fecfin">
                                            </div>

                                            <div style="display: inline-block; margin-left: 2%">
                                                <label style="color: white">Responsable :</label><br>

                                                <select name="boxresponsable" id="boxresponsable" class="combo-box filtros">
                                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>

                                                </select>

                                            </div>

                                            <div style="display: inline-block; margin-left: 2%">
                                                <label style="color: white">Tipo :</label><br>

                                                <select name="boxtipo" id="boxtipo" class="combo-box filtros">
                                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                                        <option class="f-box">PRODUCTO</option>
                                                        <option class="f-box">SERVICIO</option>
                                                        <option class="f-box">Todos</option>
                                                </select>

                                            </div>
                                            <div style="display: inline-block; margin-left: 2%">
                                                <label style="color: white">Estado :</label><br>

                                                <select name="boxestado" id="boxestado" class="combo-box filtros">
                                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                                </select>

                                            </div>
                                            <br><br>
                                            <div style="display: inline-block;">
                                            <input type="submit" class="btn btn-warning btnreport" id="btnReasignar" name="btnReasignar" value="Reasignar">
                                            </div>
                                            <br>
                                        </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
              </div>

            </div>
            <!--End Row-->

          </div>
          <!-- End container-fluid-->

          <div class="row">
            <div class="col-12 col-lg-12">
              <div class="card reg-tab2">
                <div class="card-header titulos_super" style="color: white;">REASIGNAR ACTIVIDADES PROPIAS</div>
                <div class="card-header">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive" style="color: white;">
                          <br>
                          <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px; color: white;">
                            <thead>
                              <tr>
                                <th class="th1"></th>
                                <th class="th1">NOMBRE</th>
                                <th class="th1">DESCRIPCION</th>
                                <th class="th1">INICIO</th>
                                <th class="th1">TERMINO</th>
                                <th class="th1">RESPONSABLE</th>
                                <th class="th1">ESTADO</th>
                              </tr>
                            </thead>
                            <tbody style="color: white;">
                              <?php

                                    //COMPLETAR TABLA
                                    $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , a.Horaini as hini,
                                    a.fechafin as fechafin, a.Horafin as hfin, a.estado as estado, concat(p.apellido,' ',p.nombre) as responsable FROM actividades a, persona p, usuario u, tipos t
                                    WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario AND t.idgestion=a.nombre
                                    AND p.idJefeInmediato='$usr' AND a.identificador='DIARIO' AND (a.estado!='FINALIZADO' AND a.estado!='ELIMINADO')");
                                    while ($ps2 = mysqli_fetch_assoc($consultaAct2)) {

                                        $datos2 = $ps2['ID'] . "||" .
                                            $ps2['nombre'] . "||" .
                                            $ps2['descripcion'] . "||" .
                                            $ps2['responsable'];

                                    ?>
                                        <tr style="font-size: 12px;">
                                            <td><a href="" data-toggle="modal" data-target="#modalEdicion2" onclick="Trabajador('<?php echo $datos2; ?>')"><img src="image/reasignarr.png" width="35px" height="35px" alt=""></a>
                                            </td>
                                            <td><?php echo $ps2['nombre']; ?></td>
                                            <td><?php echo $ps2['descripcion']; ?></td>
                                            <td><?php echo $ps2['fecha'].' / '.$ps2['hini']; ?></td>
                                            <td><?php echo $ps2['fechafin'].' / '.$ps2['hfin']; ?></td>
                                            <td><?php echo $ps2['responsable']; ?></td>
                                            <td class="centrar"><?php $valorestado=$ps2['estado'];
                                                if($valorestado=='PLANIFICADO'){
                                                   echo '<img src="../Views/image/planificado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }else{
                                                    if($valorestado=='PROCESO'){
                                                    echo '<img src="../Views/image/proceso.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }else{
                                                    if($valorestado=='FINALIZADO'){
                                                    echo '<img src="../Views/image/finalizado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }else{
                                                    if($valorestado=='DETENIDO'){
                                                    echo '<img src="../Views/image/detenido.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }
                                                }}}
                                            ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                            </tbody>
                          </table>
                        </div>

                                 <div class="modal fade" id="modalEdicion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">

                                    <div class="modal-content ach">
                                        <div class="modal-header">
                                            <h4 class="modal-title t-titulo" id="myModalLabel">Datos Actividad</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                        </div>
                                        <div class="modal-body">
                                            <input type="text" hidden="" id="ID3" name="ID3">
                                            <div style="display: inline-block">
                                                <label class="titulo">Nombre</label><br>
                                                <input name="nombre3" type="Text" id="nombre3" class="c-campos" disabled>
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block">
                                                <label class="titulo">Descripcion</label><br>
                                                <textarea name="descripcion3" type="Text" id="descripcion3" class="c-campos" disabled></textarea>
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block">
                                                <label class="titulo">Responsable actual</label><br>
                                                <input name="nombre4" type="Text" id="nombre4" class="c-campos" disabled>
                                            </div>
                                            <br><br>

                                            <div style="display: inline-block">
                                                <label class="titulo" style="color: red">Reasignar a :</label><br>
                                                <?php $consulta = mysqli_query($conection, "SELECT idusuario as ID, concat(apellido,' ',nombre) as datos FROM persona ORDER BY apellido ASC"); ?>
                                                <select name="bxresponsable" id="bxresponsable" class="combo-box" style="width: 55%;">
                                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                                    <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                                        <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                                            <?php echo $datos['datos']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Reasignar</button>
                                            </div>

                                            <br><br>
                                        </div>
                                        <div class="modal-footer">

                                        </div>
                                    </div>
                                </div>
                            </div>


                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!--End Row-->

          </div>
          <!-- End container-fluid-->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../../assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="../../dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="../../dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="../../assets/libs/flot/excanvas.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.time.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="../../assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="../../assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../dist/js/pages/chart/chart-page-init.js"></script>

    <!-- datatables JS paginado ajax -->
    <script src="../../datatables/paginado/datatables.bundle.js" type="text/javascript"></script>

    <!-- datatables JS -->
    <script src="../../datatables/datatables.min.js " type="text/javascript"></script>

    <!-- datatables JS SELECCIONA FILA -->
    <script src='../../datatables/select/js/dataTables.select.min.js'></script>
    <!-- datatables JS RECORRE FILA CON TECLADO -->
    <script src='../../datatables/paginado/dataTables.keyTable.min.js'></script>


    <!-- para usar botones en datatables JS -->
    <script src="../../datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="../../datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../../datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <!-- c¨®digo JS prop¨¬o-->
    <script type="text/javascript" src="../../main.js"></script>

    <script src="../../js/M01_Actividades/M01JS01_Actividades/M01JS01_Actividades.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/jquery.blockUI.min.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/utilitario.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/sweetalert.min.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/dialogs.js?v=1.1.1"></script>
    <input type="hidden" id="__FECHA_ACTUAL" value="<?php echo strftime("%Y-%m-%d"); ?>">

</body>

</html>
