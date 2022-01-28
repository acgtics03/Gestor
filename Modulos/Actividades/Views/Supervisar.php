<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
  
  <link rel="icon" href="image/logo.jpg" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ACG - Actividades</title>
  <!-- loader
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>-->
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
  <link rel="stylesheet" href="main.css" />
  <link rel="stylesheet" href="datatables/datatables.min.css" />
  <link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
</head>

<body class="bg-theme fondo">
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <?php
  require('models/menu.php');
  ?>

  <script src="code/highcharts.js"></script>
  <script src="code/modules/data.js"></script>
  <script src="code/modules/drilldown.js"></script>
  <script src="code/modules/exporting.js"></script>
  <script src="code/modules/export-data.js"></script>
  <script src="code/modules/accessibility.js"></script>
  <?php require('models/header.php');
  require('../models/datos_supervisor.php');
  ?>


  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>

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
                      <h5 class="text-white mb-0"><?php echo $tot_participante; ?><span class="float-right"><i><img src="image/ind4.png" class="iconproy"></i></span></h5>
                      <div class="progress my-3" style="height:3px;">
                        <div class="progress-bar" style="width:55%"></div>
                      </div>
                      <p class="mb-0 text-white small-font"> Actividades en Participacion</p>
                      <p class="mb-0 text-white small-font" style="font-size: 11px"> Detenidos : <?php echo $consultaaPAd['totalPAd']; ?> /  Eliminados : <?php echo $consulta_eliminados_partr['total']; ?></p>
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
        <div class="row mt-3">
          <div class="col-12 col-lg-4 col-xl-4">
            <div class="card graf-11">
              <div class="card-body">
                <div class="card-header h-div">REASIGNAR</div><br>
                <div style="color: blue; text-align: center">
                <img src="image/reasignar.png" width="100px" height="100px" alt=""><br><br><br>
                <button class='btn-1'><a href="reasignar_ps.php" class="rutas">Productos y/o Servicios</a></button><br><br>
                <button class='btn-1'><a href="Reasignar.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-4 col-xl-4">
              <div class="card graf-11">
                <div class="card-body">
                  <div class="card-header h-div">ELIMINADOS</div><br>
                 <div style="color: blue; text-align: center">
                     
                <img src="image/eliminados.png" width="100px" height="100px" alt=""><br><br> <br>    
                <button class='btn-1'><a href="eliminados_ps.php" class="rutas">Productos y/o Servicios</a></button><br><br>
                <button class='btn-1'><a href="eliminados_apap.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                 </div>
                </div>
              </div>
            </div>
         
            <div class="col-12 col-lg-4 col-xl-4">
              <div class="card graf-11">
                <div class="card-body">
                  <div class="card-header h-div">CUMPLIMIENTO</div><br>
                 <div style="color: blue; text-align: center">
                     
                <img src="image/cumplimiento.png" width="100px" height="100px" alt=""><br><br> <br>
                <button class='btn-1'><a href="cumplimiento_ps.php" class="rutas">Productos y/o Servicios</a></button><br><br>
                <button class='btn-1'><a href="cumplimiento_apap.php" class="rutas">Actividades Propias y/o Participantes</a></button><br><br>
                 </div>
                </div>
              </div>
            </div>

        </div>
       </div>
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

      <!-- Custom scripts -->
      <script src="assets/js/app-script.js"></script>


      <!-- jQuery, Popper.js, Bootstrap JS -->
      <script src="jquery/jquery-3.3.1.min.js"></script>

      <!-- datatables JS -->
      <script type="text/javascript" src="../datatables/datatables.min.js"></script>

      <!-- para usar botones en datatables JS -->
      <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
      <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
      <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
      <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
      <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

      <!-- código JS propìo-->
      <script type="text/javascript" src="../main.js"></script>



</body>

</html>