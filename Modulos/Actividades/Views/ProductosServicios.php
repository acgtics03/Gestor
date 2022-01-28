<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
  
  <link  rel="icon"   href="image/logo.jpg" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Productos y Servicios</title>
  <!-- loader
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>-->
  <!-- simplebar CSS--><link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <!-- Bootstrap core CSS--><link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS--><link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS--><link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Sidebar CSS--><link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <!-- Custom Style--><link href="assets/css/app-style.css" rel="stylesheet" />
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
  require('../models/producto_servicio.php');
  ?>

<script src="code/highcharts.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/drilldown.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>
<?php require('models/header.php'); ?>


  <!-- Start wrapper-->
  <div id="wrapper">
    <div class="clearfix"></div>

    <div class="content-wrapper fondo">
      <div class="container-fluid">

        <div class="row mt-3">

          <div class="col-lg-6">
            <div class="card graf-1">
              <div class="card-body">
                <div class="card-header h-div">Productos - <?php echo $consulta_nombrer['datoo']; ?>
                </div>
                <div class="card-body" style="background-color: white;">
      
                    <figure class="highcharts-figure">
                        <div id="container" style="width: 100%; height: 200px"></div>
                    </figure>

                </div>

                <script type="text/javascript">

                  var Tot1 = parseInt('<?php echo $V1r['T1']; ?>');
                  var Tot2 = parseInt('<?php echo $V2r['T2']; ?>');
                  var Tot3 = parseInt('<?php echo $V3r['T3']; ?>');
                  var Tot4 = parseInt('<?php echo $V4r['T4']; ?>');

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
                          y: Tot1,
                          drilldown: "Planificado"
                        },
                        {
                          name: "Proceso",
                          color: '#FEF47C',
                          y: Tot2,
                          drilldown: "Proceso"
                        },
                        {
                          name: "Finalizado",
                          color: '#8CFF89',
                          y: Tot3,
                          drilldown: "Finalizado"
                        },
                        {
                          name: "Detenido",
                          color: '#FF8574',
                          y: Tot4,
                          drilldown: "Detenido"
                        }
                      ]
                    }]
                  });
                </script>
                <br><br>
                <div class="card-header h-div">Servicios - <?php echo $consulta_nombrer['datoo']; ?>
                </div>
                <div class="card-body" style="background-color: white;">
                <figure class="highcharts-figure">
                        <div id="container2" style="width: 100%; height: 200px"></div>
                    </figure>

                </div>

                <script type="text/javascript">

                  var Totx1 = parseInt('<?php echo $Vx1r['Tx1']; ?>');
                  var Totx2 = parseInt('<?php echo $Vx2r['Tx2']; ?>');
                  var Totx3 = parseInt('<?php echo $Vx3r['Tx3']; ?>');
                  var Totx4 = parseInt('<?php echo $Vx4r['Tx4']; ?>');

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
                          y: Totx1,
                          drilldown: "Planificado"
                        },
                        {
                          name: "Proceso",
                          color: '#FEF47C',
                          y: Totx2,
                          drilldown: "Proceso"
                        },
                        {
                          name: "Finalizado",
                          color: '#8CFF89',
                          y: Totx3,
                          drilldown: "Finalizado"
                        },
                        {
                          name: "Detenido",
                          color: '#FF8574',
                          y: Totx4,
                          drilldown: "Detenido"
                        }
                      ]
                    }]
                  });
                </script>
                <br>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card reg-fond">
              <div class="card-body">
                <h5 class="card-title">REGISTRO DE PRODUCTO Y/O SERVICIO</h5>
                <div class="table-responsive">
                <form action="../models/insertarps.php" method="post">
                <div class="form-group">
                    <div style="display: inline-block;">
                        <label for="input-4">Tipo (*)</label>
                       
                        <select name="categoria" id="categoria" class="form-control" style="width: 200px" required>
                          <option selected="true" class="f-box" disabled="disabled">Ninguno</option>
                            <option class="f-box" value="PRODUCTO">PRODUCTO</option>
                            <option class="f-box" value="SERVICIO">SERVICIO</option>
                        </select>
                    </div>
                    <div style="display: inline-block; margin-left: 5%">
                          <label for="input-4">Cliente (*)</label>
                          <select name="cliente" id="cliente" class="form-control" style="width: 240px" required>
                            <option selected="true" class="f-box" disabled="disabled">Ninguno</option>
                            <?php while ($valor1 = mysqli_fetch_assoc($empresa)) { ?>
                              <option class="f-box" value="<?php echo $valor1['codigo']; ?>">
                                <?php echo $valor1['descripcion']; ?>
                              </option>
                            <?php } ?>
                          </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="input-1">Nombre (*)</label>
                    <select id="nombre_ps" name="nombre_ps" class="form-control" disabled="">
                      <option value="" class="f-box" selected="true">Ninguno</option>
                    </select>
                    
                    <script type="text/javascript">
                          $(document).ready(function(){
                            var nombre = $('#nombre_ps');
                            var nombre_sel = $('#nombre_sel');
                    
                            $('#categoria').change(function(){
                              var tipo_id = $(this).val(); //obtener el id seleccionado
                    
                              if(tipo_id !== ''){ //verificar haber seleccionado una opcion valida
                    
                                /*Inicio de llamada ajax*/
                                $.ajax({
                                  data: {tipo_id:tipo_id}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                  dataType: 'html', //tipo de datos que esperamos de regreso
                                  type: 'POST', //mandar variables como post o get
                                  url: '../models/get_tipos.php' //url que recibe las variables
                                }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             
                    
                                  nombre.html(data); //establecemos el contenido html de nombres con la informacion que regresa ajax             
                                  nombre.prop('disabled', false); //habilitar el select
                                });
                                /*fin de llamada ajax*/
                    
                              }else{ //en caso de seleccionar una opcion no valida
                                nombre.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                nombre.prop('disabled', true); //deshabilitar el select
                              }    
                            });
                    
                    
                            //mostrar una leyenda con el nombre seleccionado
                            $('#nombre').change(function(){
                              $('#nombre_sel').html($(this).val() + ' - ' + $('#nombre option:selected').text());
                            });
                    
                          });
                    </script>    
                    
                  </div>
                  <div class="form-group">
                    <label for="input-1">Descripcion (*)</label>
                    <textarea name="descripcion_ps" id="descripcion_ps" class="form-control" id="input-1" maxlength="290" placeholder="Describa la actividad" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="input-4">Area</label>
                    <select name="area_ps" id="area_ps" class="form-control">
                      <option class="f-box" value="<?php echo $a_id; ?>"><?php echo $a_usur['area']; ?></option>
                      <?php 
                      while ($valor2 = mysqli_fetch_assoc($area)) { ?>
                      
                        <option class="f-box" value="<?php echo $valor2['id']; ?>">
                          <?php echo $valor2['area']; ?>
                        </option>
                        
                      <?php } ?>
                      
                    </select>
                  </div>
                  
                  <script type="text/javascript">
                          $(document).ready(function(){
                            var responsable = $('#responsable_ps');
                            var responsable_sel = $('#responsable_sel');
                    
                            $('#area_ps').change(function(){
                              var area_id = $(this).val(); //obtener el id seleccionado
                    
                              if(area_id !== ''){ //verificar haber seleccionado una opcion valida
                    
                                /*Inicio de llamada ajax*/
                                $.ajax({
                                  data: {area_id:area_id}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                  dataType: 'html', //tipo de datos que esperamos de regreso
                                  type: 'POST', //mandar variables como post o get
                                  url: '../models/get_responsable.php' //url que recibe las variables
                                }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             
                    
                                  responsable.html(data); //establecemos el contenido html de nombres con la informacion que regresa ajax             
                                  resonsable.prop('disabled', false); //habilitar el select
                                });
                                /*fin de llamada ajax*/
                    
                              }else{ //en caso de seleccionar una opcion no valida
                                responsable.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                responsable.prop('disabled', true); //deshabilitar el select
                              }    
                            });
                    
                    
                            //mostrar una leyenda con el nombre seleccionado
                            $('#responsable_ps').change(function(){
                              $('#responsable_sel').html($(this).val() + ' - ' + $('#responsable option:selected').text());
                            });
                    
                          });
                    </script>  
                  

                  <div class="form-group">
                    <label for="input-4">Responsable (*)</label>
                    <select name="responsable_ps" id="responsable_ps" class="form-control">
                      <option class="f-box" value="<?php echo $t_id; ?>"><?php echo $trabajadr['datos']; ?></option>
                      <?php 
                      while ($valor3 = mysqli_fetch_assoc($trabajadores)) { ?>
                        <option class="f-box" value="<?php echo $valor3['usuario']; ?>">
                          <?php echo $valor3['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de inicio (*)</label>
                      <input type="Date" name="fechaini" class="form-control" id="input-1" required>
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Fecha de inicio real</label>
                      <input type="Date" name="fechainir" class="form-control" id="input-1">
                    </div>                  
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de termino (*)</label>
                      <input type="Date" name="fechafin" class="form-control" id="input-1">
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Fecha de termino real</label>
                      <input type="Date" name="fechafinr" class="form-control" id="input-1">
                    </div>                  
                  </div>

                  <br>
                  <input type="submit" class="btn btn-light px-5 btnRegistrar" name="btnRegistrar" id="btnRegistrar" value="Grabar">
                  <label for="" style="margin-left: 25%; font-size: 12px;">Campos obligatorios (*)</label>
                  <br>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--End Row-->
      </div>

      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card reg-tab2">
            <div class="card-header">PRODUCTOS Y SERVICIOS
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <br>

                      <table id="example" class="table table-striped table-bordered" cellspacing="0">
                        <thead>
                          <tr>
                            <th class="centrar"></th>
                            <th class="th1 centrar">INICIO</th>
                            <th class="th1 centrar">TERMINO</th>
                            <th class="th1 centrar"></th>
                            <th class="th1 centrar">TIPO</th>
                            <th class="th1 centrar">CLIENTE</th>
                            <th class="th1 centrar">NOMBRE</th>
                            <th class="th1 centrar">RESPONSABLE</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            require('../models/SegProductoServicio.php');
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

      </div>
      <!-- End container-fluid-->

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