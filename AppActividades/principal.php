<!DOCTYPE html>
<html dir="ltr" lang="en">
<?php
session_start();
$usr = "";
if (!empty($_SESSION['usu'])) {
    $usr = $_SESSION['usu'];
}
require_once "../config/configuracion.php";
require_once "../config/conexion_app.php";
require_once "../config/sesion.php";
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link  rel="icon"   href="../views/assets/images/logoacg2.jpg" type="image/png" />
    <title><?php echo $NOM_APP_1; ?></title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="views/assets/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="views/assets/libs/jquery-minicolors/jquery.minicolors.css">
    <link rel="stylesheet" type="text/css" href="views/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="views/assets/libs/quill/dist/quill.snow.css">
    <link href="views/dist/css/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="views/css/estilos.css?v=<?php echo time(); ?>">
    <!-- LIBRERIAS LOADING PROCESANDO -->
    <link rel="stylesheet" type="text/css" href="views/css/LoadingProcesandoGeneral.css?v=<?php echo time(); ?>">
    <!-- LIBRERIAS ALERTA MENSAJES -->
    <link rel="stylesheet" type="text/css" href="views/css/sweetalert.css?v=<?php echo time(); ?>">
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <?php

        require('models/ResumenCantidades.php');
    ?>

    <script src="views/code/highcharts.js"></script>
    <script src="views/code/modules/data.js"></script>
    <script src="views/code/modules/drilldown.js"></script>
    <script src="views/code/modules/exporting.js"></script>
    <script src="views/code/modules/export-data.js"></script>
    <script src="views/code/modules/accessibility.js"></script>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <?php include_once "resources/header.php"; ?>
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
                <?php include_once "resources/menu.php"; ?>
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

                <div class="card mt-3 indicadores">
                  <div class="card-content">
                    <div class="row row-group m-0">
                      <div class="col-md-3 border-light">
                        <div class="card-body">
                          <h5 class="text-white mb-0"><?php echo $consultaax['total']; ?><span class="float-right"><i><img src="views/image/ind1.png" class="iconproy"></i></span></h5>
                          <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                          </div>
                          <p class="mb-0 text-white small-font"> Actividades Propias</p>
                          <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaad['totalPd']; ?> /  Eliminados : <?php echo $consulta_eliminados_actr['total']; ?></p>
                        </div>
                      </div>
                      <div class="col-md-3 border-light">
                        <div class="card-body">
                          <h5 class="text-white mb-0"><?php echo $suma_actividadesp; ?><span class="float-right"><i><img src="views/image/ind4.png" class="iconproy"></i></span></h5>
                          <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                          </div>
                          <p class="mb-0 text-white small-font"> Actividades en Participacion</p>
                          <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $total_actividadesd; ?> /  Eliminados : <?php echo $total_actividadese; ?></p>
                        </div>
                      </div>
                      <div class="col-md-3 border-light">
                        <div class="card-body">
                          <h5 class="text-white mb-0"><?php echo $consultaaP['totalPr']; ?><span class="float-right"><i><img src="views/image/ind2.png" class="iconproy"></i></span></h5>
                          <div class="progress my-3" style="height:3px;">
                            <div class="progress-bar" style="width:55%"></div>
                          </div>
                          <p class="mb-0 text-white small-font">Productos</p>
                          <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaPd['totalPrd']; ?> /  Eliminados : <?php echo $consulta_eliminados_prodr['total']; ?></p>
                        </div>
                      </div>
                      <div class="col-md-3 border-light">
                        <div class="card-body">
                          <h5 class="text-white mb-0"><?php echo $consultaaF['totalPf']; ?><span class="float-right"><i><img src="views/image/ind3.png" class="iconproy"></i></span></h5>
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
                                                credits: {
                                                    enabled: false
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
                                             credits: {
                                                    enabled: false
                                                },
                                            tooltip: {
                                              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b><br/>'
                                            },
                                            credits: {
                                                enabled: false
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
                        <div class="card">
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <!-- INICIO CUADRO RESUMEN ACTIVIDADES PROPIAS-->
                                    <div class="card-header divgraf1">
                                          <div style="display: inline-block">
                                              ACTIVIDADES PROPIAS - <?php echo $des_mes; ?> 
                                          </div>
                                      </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center">
                                          <thead class="tabgraf1">
                                            <tr style="font-size: 10px;">
                                              <th>PERIODO</th>
                                              <th>PLANIFICADO</th>
                                              <th>PROCESO</th>
                                              <th>FINALIZADO</th>
                                            </tr>
                                          </thead>
                                          <tbody class="tabtext">
                                            <tr>
                                              <td>Hoy(<?php echo $SUMAADia; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaDP['TotDP'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaDPC['TotDPC'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaDF['TotDF'];?></td>
                                            </tr>
                                            <tr>
                                              <td>Semana (<?php echo $SUMAASem; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaSemP['TotSemP'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaSemPC['TotSemPC'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaSemF['TotSemF'];?></td>
                                            </tr>
                                            <tr>
                                            <td>Mes (<?php echo $SUMAAMes; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaMesP['TotMesP'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaMesPC['TotMesPC'];?></td>
                                              <td style="text-align: center;"><?php echo $consultaaMesF['TotMesF'];?></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    <!-- FIN CUADRO RESUMEN ACTIVIDADES PROPIAS-->
                                    <!-- INICIO CUADRO RESUMEN PRODUCTOS-->
                                    <div class="card-header divgraf3">
                                          <div style="display: inline-block">
                                              PRODUCTOS - <?php echo $des_year; ?> 
                                          </div>
                                      </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center">
                                          <thead class="tabgraf3">
                                            <tr style="font-size: 10px;">
                                              <th>PERIODO</th>
                                              <th>PLANIFICADO</th>
                                              <th>PROCESO</th>
                                              <th>FINALIZADO</th>
                                            </tr>
                                          </thead>
                                          <tbody class="tabtext">
                                            <tr>
                                              <td>Mensual (<?php echo $SUMAProMes; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaMensP['TotMensP']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaMensPC['TotMensPC']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaMensF['TotMensF']; ?></td>
                                            </tr>
                                            <tr>
                                              <td>Trimestral (<?php echo $SUMAProTrim; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaTrimP['TotTrimP']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaTrimPC['TotTrimPC']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaTrimF['TotTrimF']; ?></td>
                                            </tr>
                                            <tr>
                                              <td>Anual (<?php echo $SUMAProAnual; ?>)</td>
                                              <td style="text-align: center;"><?php echo $consultaaAnualP['TotAnualP']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaAnualPC['TotAnualPC']; ?></td>
                                              <td style="text-align: center;"><?php echo $consultaaAnualF['TotAnualF']; ?></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    <!-- FIN CUADRO RESUMEN PRODUCTOS -->
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
                                      var actn = parseInt('<?php echo $totalSUM2; ?>');
                                      var acte = parseInt('<?php echo $totalSUM3; ?>');
                                      var actf = parseInt('<?php echo $totalSUM4; ?>');

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
                                         credits: {
                                                    enabled: false
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
                                         credits: {
                                                    enabled: false
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
                        <div class="card">
                            <div class="card-body">
                                <!-- INICIO CUADRO RESUMEN ACTIVIDADES EN PARTICIPACION-->
                                <div class="card-header divgraf2">
                                   <div style="display: inline-block">
                                          ACTIVIDADES EN PARTICIPACION - <?php echo $des_mes; ?> 
                                      </div>
                                  </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center">
                                      <thead class="tabgraf2">
                                        <tr style="font-size: 10px;">
                                          <th>PERIODO</th>
                                          <th>PLANIFICADO</th>
                                          <th>PROCESO</th>
                                          <th>FINALIZADO</th>
                                        </tr>
                                      </thead>
                                      <tbody class="tabtext">
                                        <tr>
                                          <td>Hoy (<?php echo $SUMAAPDia; ?>)</td>
                                          <td style="text-align: center;"><?php echo $s1; ?></td>
                                          <td style="text-align: center;"><?php echo $s2; ?></td>
                                          <td style="text-align: center;"><?php echo $s3; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Semana (<?php echo $SUMAAPSem; ?>)</td>
                                          <td style="text-align: center;"><?php echo $s4; ?></td>
                                          <td style="text-align: center;"><?php echo $s5; ?></td>
                                          <td style="text-align: center;"><?php echo $s6; ?></td>
                                        </tr>
                                        <tr>
                                           <td>Mes (<?php echo $SUMAAPMes; ?>)</td>
                                          <td style="text-align: center;"><?php echo $s7; ?></td>
                                          <td style="text-align: center;"><?php echo $s8; ?></td>
                                          <td style="text-align: center;"><?php echo $s9; ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                <!-- FIN CUADRO RESUMEN ACTIVIDADES EN PARTICIPACION-->
                                <!-- INICIO CUADRO RESUMEN SERVICIOS-->
                                <div class="card-header divgraf4">
                                     <div style="display: inline-block">
                                          SERVICIOS - <?php echo $des_year; ?>
                                      </div>
                                  </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center">
                                      <thead class="tabgraf4">
                                        <tr style="font-size: 10px;">
                                          <th>PERIODO</th>
                                          <th>PLANIFICADO</th>
                                          <th>PROCESO</th>
                                          <th>FINALIZADO</th>
                                        </tr>
                                      </thead>
                                      <tbody class="tabtext">
                                        <tr>
                                          <td>Mensual (<?php echo $SUMASrvMes; ?>)</td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvMensP['TotSrvMensP']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvMensPC['TotSrvMensPC']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvMensF['TotSrvMensF']; ?></td>
                                          
                                        </tr>
                                        <tr>
                                          <td>Trimestral (<?php echo $SUMASrvTrim; ?>)</td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvTrimP['TotSrvTrimP']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvTrimPC['TotSrvTrimPC']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvTrimF['TotSrvTrimF']; ?></td>
                                        </tr>
                                        <tr>
                                          <td>Anual (<?php echo $SUMASrvAnual; ?>)</td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvAnualP['TotSrvAnualP']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvAnualPC['TotSrvAnualPC']; ?></td>
                                          <td style="text-align: center;"><?php echo $consultaaSrvAnualF['TotSrvAnualF']; ?></td>            
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                <!-- FIN CUADRO RESUMEN SERVICIOS-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- editor -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header tab4-header">Consolidado - <?php echo $des_year; ?>
                                    <div class="card-action">
                                        <div class="dropdown">
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush table-borderless">
                                  <thead class="tab4-thead">
                                    <tr>
                                      <th>Area</th>
                                      <th style="text-align: center;">Personal</th>
                                      <th style="text-align: center;">A. Propia</th>
                                      <th style="text-align: center;">A. Participante</th>
                                      <th style="text-align: center;">Productos</th>
                                      <th style="text-align: center;">Servicios</th>
                                    </tr>
                                  </thead>
                                  <tbody class="tabtext tab4-fond">
                                    <tr>
                                      <td><?php echo $td1['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td2['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td3['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td4; ?></td>
                                      <td style="text-align: center;"><?php echo $td5['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td6['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td7['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td8['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td9['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td10; ?></td>
                                      <td style="text-align: center;"><?php echo $td11['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td12['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td13['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td14['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td15['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td16; ?></td>
                                      <td style="text-align: center;"><?php echo $td17['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td18['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td19['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td20['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td21['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td22; ?></td>
                                      <td style="text-align: center;"><?php echo $td23['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td24['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td25['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td26['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td27['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td28; ?></td>
                                      <td style="text-align: center;"><?php echo $td29['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td30['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td31['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td32['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td33['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td34; ?></td>
                                      <td style="text-align: center;"><?php echo $td35['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td36['total']; ?></td>
                                    </tr>

                                    <tr>
                                      <td><?php echo $td37['Area']; ?></td>
                                      <td style="text-align: center;"><?php echo $td38['datos']; ?></td>
                                      <td style="text-align: center;"><?php echo $td39['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td40; ?></td>
                                      <td style="text-align: center;"><?php echo $td41['total']; ?></td>
                                      <td style="text-align: center;"><?php echo $td42['total']; ?></td>
                                    </tr>

                                  </tbody>
                                    </table>
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
    <script src="views/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="views/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="views/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="views/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="views/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="views/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="views/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="views/dist/js/custom.min.js"></script>
    <!-- This Page JS -->
    <script src="views/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="views/dist/js/pages/mask/mask.init.js"></script>
    <script src="views/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="views/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="views/assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="views/assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="views/assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="views/assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="views/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="views/assets/libs/quill/dist/quill.min.js"></script>

    <script src="views/js/M01_Actividades/M01JS01_Actividades/M01JS01_home.js?v=1.1.1"></script>
    <script src="views/librerias/utilitario/jquery.blockUI.min.js?v=1.1.1"></script>
    <script src="views/librerias/utilitario/utilitario.js?v=1.1.1"></script>
    <script src="views/librerias/utilitario/sweetalert.min.js?v=1.1.1"></script>
    <script src="views/librerias/utilitario/dialogs.js?v=1.1.1"></script>
    <input type="hidden" id="__FECHA_ACTUAL" value="<?php echo strftime("%Y-%m-%d"); ?>">    
</body>

</html>