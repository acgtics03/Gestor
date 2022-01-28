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
  <link rel="stylesheet" type="text/css" href="views/assets/libs/select2/dist/css/select2.min.css">
  <link rel="stylesheet" type="text/css" href="views/assets/libs/jquery-minicolors/jquery.minicolors.css">
  <link rel="stylesheet" type="text/css" href="views/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" type="text/css" href="views/assets/libs/quill/dist/quill.snow.css">
  <link href="views/dist/css/style.min.css" rel="stylesheet">
  <link rel="stylesheet" href="views/css/estilos.css?v=<?php echo time(); ?>">

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
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->

  <?php
    require_once "../../models/M02_Supervisar/M02MD01_Supervisar/datos_supervisor.php";
  ?>

  <script src="../../code/highcharts.js"></script>
  <script src="../../code/modules/exporting.js"></script>
  <script src="../../code/modules/export-data.js"></script>
  <script src="../../code/modules/accessibility.js"></script>
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
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <input type="hidden" name="" id="txtRuta" value="<?php echo $URL; ?>">
        <div class="card mt-3 indicadores">
          <div class="card-content">
            <div class="card mt-3 indicadores">
              <div class="card-content">
                <div class="row row-group m-0">
                  <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo $consultaax['total']; ?><span class="float-right"><i><img src="../../image/ind1.png" class="iconproy"></i></span></h5>
                      <div class="progress my-3" style="height:3px;">
                        <div class="progress-bar" style="width:55%"></div>
                      </div>
                      <p class="mb-0 text-white small-font"> Actividades Propias</p>
                      <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaad['totalPd']; ?> /  Eliminados : <?php echo $consulta_eliminados_actr['total']; ?></p>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo $tot_participante; ?><span class="float-right"><i><img src="../../image/ind4.png" class="iconproy"></i></span></h5>
                      <div class="progress my-3" style="height:3px;">
                        <div class="progress-bar" style="width:55%"></div>
                      </div>
                      <p class="mb-0 text-white small-font"> Actividades en Participacion</p>
                      <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaPAd['totalPAd']; ?> /  Eliminados : <?php echo $consulta_eliminados_partr['total']; ?></p>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo $consultaaP['totalPr']; ?><span class="float-right"><i><img src="../../image/ind2.png" class="iconproy"></i></span></h5>
                      <div class="progress my-3" style="height:3px;">
                        <div class="progress-bar" style="width:55%"></div>
                      </div>
                      <p class="mb-0 text-white small-font">Productos</p>
                      <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaPd['totalPrd']; ?> /  Eliminados : <?php echo $consulta_eliminados_prodr['total']; ?></p>
                    </div>
                  </div>
                  <div class="col-12 col-lg-6 col-xl-3 border-light">
                    <div class="card-body">
                      <h5 class="text-white mb-0"><?php echo $consultaaF['totalPf']; ?><span class="float-right"><i><img src="../../image/ind3.png" class="iconproy"></i></span></h5>
                      <div class="progress my-3" style="height:3px;">
                        <div class="progress-bar" style="width:55%"></div>
                      </div>
                      <p class="mb-0 text-white small-font">Servicios</p>
                      <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaFd['totalPfd']; ?> /  Eliminados : <?php echo $consulta_eliminados_servr['total']; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>


        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <form class="form-horizontal">
                <div class="card-body">
                  <!-- INICIO GRAFICA ACTIVIDADES PROPIAS-->
                  <div class="card-header divgraf1">ACTIVIDADES PROPIAS</div>
                  <div class="card-body div1graf1">
                    <figure class="highcharts-figure">
                      <div id="container"></div>
                    </figure>

                    <script type="text/javascript">
                                        // Variables
                                        var actn = parseInt('<?php echo $consultaaAN['AN']; ?>');
                                        var acte = parseInt('<?php echo $consultaaAE['AE']; ?>');
                                        var actf = parseInt('<?php echo $consultaaAF['AF']; ?>');

                                        var fec = '<?php echo date('Y-m-d'); ?>';

                                        // Create the chart
                                        Highcharts.chart('container', {
                                          chart: {
                                            type: 'column'
                                          },
                                          title: {
                                            text: ''
                                          },
                                          accessibility: {
                                            announceNewData: {
                                              enabled: true
                                            }
                                          },
                                          xAxis: {
                                            type: 'category'
                                          },
                                          yAxis: {
                                            title: {
                                              text: ''
                                            }

                                          },
                                          legend: {
                                            enabled: false
                                          },
                                          plotOptions: {
                                            series: {
                                              borderWidth: 0,
                                              dataLabels: {
                                                enabled: true,
                                                format: '{point.y}'
                                              }
                                            }
                                          },

                                          tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                                          },

                                          series: [{
                                            name: "Estados",
                                            colorByPoint: true,
                                            data: [{
                                              name: "Planificado",
                                              color: '#FFC074',
                                              y: actn,
                                              drilldown: "Planificado"
                                            },
                                            {
                                              name: "Proceso",
                                              color: '#FEF47C',
                                              y: acte,
                                              drilldown: "Proceso"
                                            },
                                            {
                                              name: "Finalizado",
                                              color: '#8CFF89',
                                              y: actf,
                                              drilldown: "Finalizado"
                                            }
                                            ]
                                          }]
                                        });
                                      </script>
                                    </div>
                                    <!-- FIN GRAFICA ACTIVIDADES PROPIAS-->
                                    <!-- INICIO GRAFICA PRODUCTOS-->
                                    <div class="card-header divgraf3">PRODUCTOS</div>
                                    <div class="card-body div3graf3">

                                      <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                      </figure>

                                      <script type="text/javascript">

                                       // Variables
                                       var prodn = parseInt('<?php echo $consultaaPN['PN']; ?>');
                                       var prode = parseInt('<?php echo $consultaaPE['PE']; ?>');
                                       var prodf = parseInt('<?php echo $consultaaPF['PF']; ?>');

                                        // Create the chart
                                        Highcharts.chart('container2', {
                                          chart: {
                                            type: 'column'
                                          },
                                          title: {
                                            text: ''
                                          },
                                          accessibility: {
                                            announceNewData: {
                                              enabled: true
                                            }
                                          },
                                          xAxis: {
                                            type: 'category'
                                          },
                                          yAxis: {
                                            title: {
                                              text: ''
                                            }

                                          },
                                          legend: {
                                            enabled: false
                                          },
                                          plotOptions: {
                                            series: {
                                              borderWidth: 0,
                                              dataLabels: {
                                                enabled: true,
                                                format: '{point.y}'
                                              }
                                            }
                                          },

                                          tooltip: {
                                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                                          },

                                          series: [{
                                            name: "Estados",
                                            colorByPoint: true,
                                            data: [{
                                              name: "Planificado",
                                              color: '#FFC074',
                                              y: prodn,
                                              drilldown: "Planificado"
                                            },
                                            {
                                              name: "Proceso",
                                              color: '#FEF47C',
                                              y: prode,
                                              drilldown: "Proceso"
                                            },
                                            {
                                              name: "Finalizado",
                                              color: '#8CFF89',
                                              y: prodf,
                                              drilldown: "Finalizado"
                                            }
                                            ]
                                          }]
                                        });
                                      </script>
                                    </div>
                                    <!-- FIN GRAFICA PRODUCTOS-->
                                  </div>
                                </form>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="card">
                                <div class="card-body">
                                  <!-- INICIO GRAFICA ACTIVIDADES EN PARTICIPACION-->
                                  <div class="card-header divgraf2">ACTIVIDADES EN PARTICIPACION</div>
                                  <div class="card-body div2graf2">
                                    <figure class="highcharts-figure">
                                      <div id="container4"></div>
                                    </figure>


                                    <script type="text/javascript">
                                    // Variables
                                    var actn = parseInt('<?php echo $suma_planificado; ?>');
                                    var acte = parseInt('<?php echo $suma_proceso; ?>');
                                    var actf = parseInt('<?php echo $suma_finalizado; ?>');

                                    var fec2 = '<?php echo date('Y-m-d'); ?>';

                                    // Create the chart
                                    Highcharts.chart('container4', {
                                      chart: {
                                        type: 'column'
                                      },
                                      title: {
                                        text: ''
                                      },
                                      accessibility: {
                                        announceNewData: {
                                          enabled: true
                                        }
                                      },
                                      xAxis: {
                                        type: 'category'
                                      },
                                      yAxis: {
                                        title: {
                                          text: ''
                                        }

                                      },
                                      legend: {
                                        enabled: false
                                      },
                                      plotOptions: {
                                        series: {
                                          borderWidth: 0,
                                          dataLabels: {
                                            enabled: true,
                                            format: '{point.y}'
                                          }
                                        }
                                      },

                                      tooltip: {
                                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                                      },

                                      series: [{
                                        name: "Estados",
                                        colorByPoint: true,
                                        data: [{
                                          name: "Planificado",
                                          color: '#FFC074',
                                          y: actn,
                                          drilldown: "Planificado"
                                        },
                                        {
                                          name: "Proceso",
                                          color: '#FEF47C',
                                          y: acte,
                                          drilldown: "Proceso"
                                        },
                                        {
                                          name: "Finalizado",
                                          color: '#8CFF89',
                                          y: actf,
                                          drilldown: "Finalizado"
                                        }
                                        ]
                                      }]
                                    });
                                  </script>
                                </div>
                                <!-- FIN GRAFICA ACTIVIDADES EN PARTICIPACION-->
                                <!-- INICIO GRAFICA SERVICIOS -->
                                <div class="card-header divgraf4">SERVICIOS</div>
                                <div class="card-body div4graf4">
                                  <figure class="highcharts-figure">
                                    <div id="container3"></div>
                                  </figure>

                                  <script type="text/javascript">
                                   // Variables
                                   var servn = parseInt('<?php echo $consultaaSN['SN']; ?>');
                                   var serve = parseInt('<?php echo $consultaaSE['SE']; ?>');
                                   var servf = parseInt('<?php echo $consultaaSF['SF']; ?>');
                                   // Create the chart
                                   Highcharts.chart('container3', {
                                    chart: {
                                      type: 'column'
                                    },
                                    title: {
                                      text: ''
                                    },
                                    accessibility: {
                                      announceNewData: {
                                        enabled: true
                                      }
                                    },
                                    xAxis: {
                                      type: 'category'
                                    },
                                    yAxis: {
                                      title: {
                                        text: ''
                                      }

                                    },
                                    legend: {
                                      enabled: false
                                    },
                                    plotOptions: {
                                      series: {
                                        borderWidth: 0,
                                        dataLabels: {
                                          enabled: true,
                                          format: '{point.y}'
                                        }
                                      }
                                    },

                                    tooltip: {
                                      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                      pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                                    },

                                    series: [{
                                      name: "Estados",
                                      data: [{
                                        name: "Planificado",
                                        color: '#FFC074',
                                        y: servn,
                                        drilldown: "Planificado"
                                      },
                                      {
                                        name: "Proceso",
                                        color: '#FEF47C',
                                        y: serve,
                                        drilldown: "Proceso"
                                      },
                                      {
                                        name: "Finalizado",
                                        color: '#8CFF89',
                                        y: servf,
                                        drilldown: "Finalizado"
                                      }
                                      ]
                                    }]
                                  });
                                </script>
                              </div>
                              <!-- FIN GRAFICA SERVICIOS-->
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- editor -->
                      <div class="row">
                        <div class="col-12">
                          <div class="card">

                            <div class="row mt-3">
                              <div class="col-12 col-lg-4 col-xl-4">
                                <div class="card graf-11">
                                  <div class="card-body">
                                    <div class="card-header h-div" style="color: white;">REASIGNAR</div><br>
                                    <div style="color: blue; text-align: center">
                                      <img src="../../image/reasignar.png" width="100px" height="100px" alt=""><br><br><br>
                                      <button class='btn-1'><a href="reasignar_ps.php" class="rutas">Productos y/o Servicios</a></button><br><br>
                                      <button class='btn-1'><a href="M01SM03_Reasignar.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12 col-lg-4 col-xl-4">
                                <div class="card graf-11">
                                  <div class="card-body">
                                    <div class="card-header h-div" style="color: white;">ELIMINADOS</div><br>
                                    <div style="color: blue; text-align: center">

                                      <img src="../../image/eliminados.png" width="100px" height="100px" alt=""><br><br> <br>
                                      <button class='btn-1'><a href="#" class="rutas">Productos y/o Servicios</a></button><br><br>
                                      <button class='btn-1'><a href="M01SM04_Eliminados.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-12 col-lg-4 col-xl-4">
                                <div class="card graf-11">
                                  <div class="card-body">
                                    <div class="card-header h-div" style="color: white;">CUMPLIMIENTO</div><br>
                                    <div style="color: blue; text-align: center">

                                      <img src="../../image/cumplimiento.png" width="100px" height="100px" alt=""><br><br> <br>
                                      <button class='btn-1'><a href="cumplimiento_ps.php" class="rutas">Productos y/o Servicios</a></button><br><br>
                                      <button class='btn-1'><a href="cumplimiento_apap.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
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
                    <!-- ============================================================== -->
                    <!-- End Container fluid  -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- footer -->
                    <!-- ============================================================== -->
                    <footer class="footer text-center">

                    </footer>
                    <!-- ============================================================== -->
                    <!-- End footer -->
                    <!-- ============================================================== -->
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
