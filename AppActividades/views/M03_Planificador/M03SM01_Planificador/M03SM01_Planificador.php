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
$fecha_hoy = date('Y-m-d');
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
    <link href="../../dist/css/style.min.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="../../dist/css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css?v=<?php echo time(); ?>">

    <!-- LIBRERIAS LOADING PROCESANDO -->
    <link rel="stylesheet" type="text/css" href="../../css/LoadingProcesandoGeneral.css?v=<?php echo time(); ?>">
    <!-- LIBRERIAS ALERTA MENSAJES -->
    <link rel="stylesheet" type="text/css" href="../../css/sweetalert.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" type="text/css" href="../../main.css">
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
                    <li><a class="enlace" href="javascript:void(0)">Actividades</a></li>
                    <li><a class="enlace" href="javascript:void(0)">Planificador de Actividades</a></li>
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
                    <div class="col-md-6">
                        <div class="card tam-pnl">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-md">
                                                <select class="cbx-texto" name="cbxAnio" id="cbxAnio"> 
                                                    <?php
                                                    $Anio = new ControllerCategorias();
                                                    $VerAnio = $Anio->VerAnio();
                                                    foreach ($VerAnio as $TAnio) {
                                                    ?>
                                                    <option value="<?php echo $TAnio['ID']; ?>"><?php echo $TAnio['Nombre']; ?></option>
                                                    <?php }  ?>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <select class="cbx-texto" name="cbxMes" id="cbxMes">
                                                    <?php
                                                    $Mes = new ControllerCategorias();
                                                    $VerMes = $Mes->VerMes();
                                                    foreach ($VerMes as $TMes) {
                                                    ?>
                                                    <option value="<?php echo $TMes['ID']; ?>"><?php echo $TMes['Nombre']; ?></option>
                                                    <?php }  ?>
                                                </select>
                                            </div>
                                            <div class="col-md">
                                                <button id="btnBuscarPlanificados" type="button" class="btn btn-registro-success"><i class="fas fa-search"></i> Buscar</button>
                                            </div>                                               
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover w-100" id="TablaActividadesDiariasReporte" style="display: none;">
                                                <thead class="cabecera">
                                                    <tr>
                                                        <th>FECHA</th>
                                                        <th>TOTAL</th>
                                                        <th>PLAN.</th>
                                                        <th>PROC.</th>
                                                        <th>FINA.</th>                                                       
                                                    </tr>
                                                </thead>
                                                <tbody class="control-detalle">
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-bordered" cellspacing="0" id="TablaActividadesDiarias">
                                                <thead class="cabecera">
                                                    <tr> 
                                                        <th>FECHA</th>
                                                        <th>TOTAL</th>
                                                        <th>PLAN.</th>
                                                        <th>PROC.</th>
                                                        <th>FINA.</th>                                               
                                                    </tr>
                                                </thead>
                                                <tbody class="control-detalle">
                                                </tbody>
                                            </table>
                                            <br>
                                        </div>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card tam-pnl">
                            <div class="card-body">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title subtit-panel">Planificar Actividad</h4>                 
                                        </div>
                                        <div class="col-md">
                                            <button id="btnGuardarPlanificado" type="button" class="btn btn-registro"><i class="fas fa-save"></i> Guardar</button>          
                                        </div>
                                    </div>                                  
                                    <hr>
                                </div>

                                <div class="form-group row">
                                    <div class="row col">
                                        <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">Generación</label>
                                        <div class="col-sm-7">
                                            <select class="cbx-texto" name="cbxGeneracion" id="cbxGeneracion">
                                                <option selected="true" disabled="disabled">Seleccionar..</option>
                                                <?php
                                                    $TipoGeneracion = new ControllerCategorias();
                                                    $VerTipoGeneracion = $TipoGeneracion->VerTipoGeneracion();
                                                    foreach ($VerTipoGeneracion as $TTipoGeneracion) {
                                                    ?>
                                                    <option value="<?php echo $TTipoGeneracion['ID']; ?>"><?php echo $TTipoGeneracion['Nombre']; ?></option>
                                                <?php }  ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col">
                                        <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">Ejecutar</label>
                                        <div class="col-md-8">
                                            <select class="cbx-texto" name="cbxEjecutar" id="cbxEjecutar" disabled>
                                                <option selected="true" disabled="disabled">Seleccionar..</option>
                                                <?php
                                                    $TiempoEjecutar = new ControllerCategorias();
                                                    $VerTiempoEjecutar = $TiempoEjecutar->VerTiempoEjecutar();
                                                    foreach ($VerTiempoEjecutar as $TTiempoEjecutar) {
                                                    ?>
                                                    <option value="<?php echo $TTiempoEjecutar['ID']; ?>"><?php echo $TTiempoEjecutar['Nombre']; ?></option>
                                                <?php }  ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="row col">
                                        <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">Cant. días</label>
                                        <div class="col-md-7">
                                            <input type="number" class="caja-texto" name="txtCantDias" id="txtCantDias">
                                        </div>
                                    </div>

                                    <div class="row col">
                                        <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">Inicio</label>
                                        <div class="col-md-8">
                                             <input type="date" class="caja-texto" name="txtInicioAct" id="txtInicioAct">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-md-2 text-right control-label col-form-label label-texto-sm">Nombre</label>
                                    <div class="col-md-10">
                                        <select class="cbx-texto" name="cbxNombre" id="cbxNombre">
                                            <option selected="true" disabled="disabled">Seleccionar..</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname" class="col-md-2 text-right control-label col-form-label label-texto-sm">Descripción</label>
                                    <div class="col-md-10">
                                        <textarea id="txtDescripcion" class="caja-texto cbx-tam descripcion" maxlength="200" onkeypress="cancelar()"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="fname" class="col-md-2 text-right control-label col-form-label label-texto-sm">Responsable</label>
                                    <div class="col-md-10">
                                        <select class="cbx-texto" name="cbxResponsable" id="cbxResponsable">
                                            <option selected="true" disabled="disabled">Seleccionar..</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="row col">
                                        <label for="fname" class="col-md-4 text-right control-label col-form-label label-texto-sm">Cliente</label>
                                        <div class="col-md-7">
                                            <select class="cbx-texto" name="cbxCliente" id="cbxCliente">
                                                <option selected="true" disabled="disabled">Seleccionar..</option>
                                                <?php
                                                $Clientes = new ControllerCategorias();
                                                $verClientes = $Clientes->VerClientes();
                                                foreach ($verClientes as $TClientes) {
                                                ?>
                                                <option value="<?php echo $TClientes['ID']; ?>"><?php echo $TClientes['Nombre']; ?></option>
                                                <?php }  ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row col">
                                        <label for="fname" class="col-md-4 text-right control-label col-form-label label-texto-sm">Tipo</label>
                                        <div class="col-md-8">
                                            <select class="cbx-texto" name="cbxTipo" id="cbxTipo">
                                                <option selected="true" disabled="disabled">Seleccionar..</option>
                                                <?php
                                                $Tipos = new ControllerCategorias();
                                                $verTipos = $Tipos->VerTipos();
                                                foreach ($verTipos as $TTipos) {
                                                ?>
                                                <option value="<?php echo $TTipos['ID']; ?>"><?php echo $TTipos['Nombre']; ?></option>
                                                <?php }  ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <fieldset>
                                    <div class="form-group row">
                                        <div class="row col"> 
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="radio" id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Adjuntar Documento</label>
                                            </div>                                           
                                        </div>

                                        <div class="row col">
                                            <label for="fname" class="col-md-4 text-right control-label col-form-label label-texto-sm">Tipo Carpeta</label>
                                            <div class="col-md-8">
                                                <select class="cbx-texto" name="cbxTipoCarpeta" id="cbxTipoCarpeta">
                                                    <option selected="true" disabled="disabled">Seleccionar..</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="row col">                                            
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">Plazo: Desde</label>
                                            <div class="col-md-7">
                                                <input type="date" class="caja-texto" name="txtFecIniAdjunto" id="txtFecIniAdjunto" disabled>
                                            </div>                                            
                                        </div>

                                        <div class="row col">
                                            <label for="fname" class="col-sm-4 text-right control-label col-form-label label-texto-sm">hasta</label>
                                            <div class="col-md-8">
                                                <input type="date" class="caja-texto" name="txtFecTermAdjunto" id="txtFecTermAdjunto" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                                               

                            </div>
                        </div>
                    </div>
                </div>
                <!-- editor -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Control de Actividades Registradas</h4>
                                
                                <div class="border-top">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="row col">
                                                <label for="fname" class="col-sm-4 control-label col-form-label label-texto-sm">Inicio</label>
                                                <input type="date" class="caja-texto" name="txtfiltroFecInicio" id="txtfiltroFecInicio">
                                            </div>
                                            <div class="row col" style="margin-left: 1%;">
                                                <label for="fname" class="col-sm-4 control-label col-form-label label-texto-sm">Termino</label>
                                                <input type="date" class="caja-texto" name="txtfiltroFecTermino" id="txtfiltroFecTermino">
                                            </div>
                                             <div class="row col" style="margin-left: 1%; display: none;" id="FiltroResponsable">
                                                <label for="fname" class="col-sm-5 control-label col-form-label label-texto-sm">Reponsable</label>
                                                <select class="cbx-texto" name="bxfiltroResponsable" id="bxfiltroResponsable">
                                                    <option selected="true" disabled="disabled">TODOS</option>
                                                </select>
                                                
                                            </div>
                                            <div class="row col" style="margin-left: 1%;">
                                                <label for="fname" class="col-sm-4 control-label col-form-label label-texto-sm">Cliente</label>
                                                <select class="cbx-texto" name="bxfiltroCliente" id="bxfiltroCliente">
                                                    <option selected="true" disabled="disabled">TODOS</option>
                                                    <?php
                                                    $FiltroCliente = new ControllerCategorias();
                                                    $verFiltroCliente = $FiltroCliente->VerClientes();
                                                    foreach ($verFiltroCliente as $TFiltroCliente) {
                                                        ?>
                                                        <option value="<?php echo $TFiltroCliente['ID']; ?>"><?php echo $TFiltroCliente['Nombre']; ?></option>
                                                    <?php }  ?>
                                                </select>

                                            </div>
                                            <div class="row col" style="margin-left: 1%;">
                                                <label for="fname" class="col-sm-6 control-label col-form-label label-texto-sm">Identificador</label>
                                                <select class="cbx-texto" name="bxfiltroIdentificador" id="bxfiltroIdentificador">
                                                    <option selected="true" disabled="disabled">TODOS</option>
                                                    <option value="1">PROPIOS</option>
                                                    <option value="2">PARTICIPANTE</option>
                                                </select>
                                            </div>
                                            <div class="row col" style="margin-left: 1%;">
                                                <label for="fname" class="col-sm-4 control-label col-form-label label-texto-sm">Estado</label>
                                                <select class="cbx-texto" name="bxfiltroEstado" id="bxfiltroEstado">
                                                    <option value="todos">TODOS</option>
                                                    <?php
                                                    $Estados = new ControllerCategorias();
                                                    $verEstados = $Estados->VerEstadosFiltro();
                                                    foreach ($verEstados as $TEstados) {
                                                        ?>
                                                        <option value="<?php echo $TEstados['ID']; ?>"><?php echo $TEstados['Nombre']; ?></option>
                                                    <?php }  ?>
                                                </select>                                                
                                            </div>
                                        </div>
                                        <div class="form-group row" style="margin-left: 40%;">
                                            <div class="row col-2">
                                                <button id="btnbuscar" type="button" class="btn btn-registro-success"><i class="fas fa-search"></i> Buscar</button>                                            
                                            </div>
                                            <div class="row col-2" style="margin-left: 1%;">
                                                <button id="btnlimpiar" type="button" class="btn btn-registro-primary"><i class="fas fa-sync-alt"></i> Limpiar</button>                                             
                                            </div>                                           
                                        </div>                                        
                                    </div>
                                </div>

                                <!-- Create the editor container -->
                                <div class="col-md-12" style="margin-top: -2%">
                                    <div class="table-responsive scroll-table mt-1">
                                        <table class="table table-striped table-bordered" id="TablaActividadesReporte"
                                            style="display: none;">
                                            <thead class="cabecera">
                                                <tr>
                                                    <th>REGISTRO</th>
                                                    <th>INICIO</th>
                                                    <th>FIN</th>
                                                    <th>ESTADO</th>                                                    
                                                    <th>CLIENTE</th>
                                                    <th>TAREAS</th>
                                                    <th>NOMBRE</th>                                                    
                                                    <th>RESPONSABLE</th>
                                                </tr>
                                            </thead>
                                            <tbody class="control-detalle">
                                            </tbody>
                                        </table>
                                        <br><br>
                                        <table class="table table-striped table-bordered table-hover w-100" id="TablaActividades"
                                            style="margin-top: -1px !important;">
                                            <thead class="cabecera">
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>REGISTRO</th>
                                                    <th>INICIO</th>
                                                    <th>FIN</th>
                                                    <th>ESTADO</th>                                                    
                                                    <th>CLIENTE</th>
                                                    <th>TAREAS</th>
                                                    <th>NOMBRE</th>                                                    
                                                    <th>RESPONSABLE</th>
                                                </tr>
                                            </thead>
                                            <tbody class="control-detalle">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- POP UP REGISTRO EMPLEADO -->
               <!-- <div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" data-backdrop="static"
                aria-labelledby="myModalLabel">
                    <?php
                    //require_once "pop-up/M01SM01_POPUP_EditarActividad.php";
                    ?>
                </div>
                -->                                       
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

    <script src="../../js/M03_Planificador/M03JS01_Planificador/M03JS01_Planificador.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/jquery.blockUI.min.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/utilitario.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/sweetalert.min.js?v=1.1.1"></script>
    <script src="../../librerias/utilitario/dialogs.js?v=1.1.1"></script>
    <input type="hidden" id="__FECHA_ACTUAL" value="<?php echo strftime("%Y-%m-%d"); ?>">    

</body>

</html>