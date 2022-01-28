<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
  
  <link  rel="icon"   href="image/icon.png" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <title>Actividades</title>
  <!-- loader
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>-->

  <!-- Vector CSS --><link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- simplebar CSS--><link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS--><link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Icons CSS--><link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS--><link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style--><link href="assets/css/app-style.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>">

</head>

<body class="bg-theme bg-theme9">
  <!-- Start wrapper-->
  <div id="wrapper">

    <?php
    require('models/menu.php');
    require('../models/ResumenCantidades.php');
    ?>

<script src="code/highcharts.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/drilldown.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>
<?php require('models/header.php'); ?>

    
    <div class="content-wrapper fondo">
      <div class="container-fluid">
        <!--Resumen de Cantidades Act - ActParti - Products - Services-->
        <div class="card mt-3 indicadores">
          <div class="card-content">
            <div class="row row-group m-0">
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $consultaax['total']; ?><span class="float-right"><i><img src="image/ind1.png" class="iconproy"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font"> Actividades Propias</p>
                  <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaad['totalPd']; ?> /  Eliminados : <?php echo $consulta_eliminados_actr['total']; ?></p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $suma_actividadesp; ?><span class="float-right"><i><img src="image/ind4.png" class="iconproy"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font"> Actividades en Participacion</p>
                  <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $total_actividadesd; ?> /  Eliminados : <?php echo $total_actividadese; ?></p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $consultaaP['totalPr']; ?><span class="float-right"><i><img src="image/ind2.png" class="iconproy"></i></span></h5>
                  <div class="progress my-3" style="height:3px;">
                    <div class="progress-bar" style="width:55%"></div>
                  </div>
                  <p class="mb-0 text-white small-font">Productos</p>
                  <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaPd['totalPrd']; ?> /  Eliminados : <?php echo $consulta_eliminados_prodr['total']; ?></p>
                </div>
              </div>
              <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body">
                  <h5 class="text-white mb-0"><?php echo $consultaaF['totalPf']; ?><span class="float-right"><i><img src="image/ind3.png" class="iconproy"></i></span></h5>
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
          <div class="col-lg-6">
            <div class="card graf-11">
                
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
          </div>

          <div class="col-lg-6">
            <div class="card graf-2">
                
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

          <div class="col-lg-6">
            <div class="card graf-3">
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
                    <tr>
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
          </div>
          

          <div class="col-lg-6">
            <div class="card graf-4">
            <!-- INICIO CUADRO RESUMEN ACTIVIDADES EN PARTICIPACION-->
            <div class="card-header divgraf2">
               <div style="display: inline-block">
                      ACTIVIDADES EN PARTICIPACION - <?php echo $des_mes; ?> 
                  </div>
              </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                  <thead class="tabgraf2">
                    <tr>
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
                    <tr>
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
        <!--End Row-->

        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="card">
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
        <!--End Row-->
      </div>
      <!-- End container-fluid-->

    </div>
    <!--End content-wrapper-->
  </div>
  <!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->

  <script src="assets/plugins/Chart.js/Chart.min.js"></script>

  <!-- Index js -->
  <script src="assets/js/index.js"></script>


</body>

</html>