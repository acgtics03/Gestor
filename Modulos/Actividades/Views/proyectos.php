<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ACG - Actividades</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
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
  <link rel="stylesheet" href="../main.css" />
  <link rel="stylesheet" href="../datatables/datatables.min.css" />
  <link rel="stylesheet" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
</head>

<body class="bg-theme bg-theme1">


  <?php
  require('models/menu.php');
  date_default_timezone_set('America/Lima');
  session_start();
  require '../Controllers/Database/conexion.php';
  $username = $_SESSION['user'];
  ?>

<script src="code/highcharts.js"></script>
<script src="code/modules/data.js"></script>
<script src="code/modules/drilldown.js"></script>
<script src="code/modules/exporting.js"></script>
<script src="code/modules/export-data.js"></script>
<script src="code/modules/accessibility.js"></script>


  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <!-- Start wrapper-->
  <div id="wrapper">
    <!--Start topbar header-->
    <header class="topbar-nav">
      <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link toggle-menu" href="javascript:void();">
              <i class="icon-menu menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <form class="search-bar">
              <input type="text" class="form-control" placeholder="Enter keywords">
              <a href="javascript:void();"><i class="icon-magnifier"></i></a>
            </form>
          </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
          <li class="nav-item dropdown-lg">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
              <i class="fa fa-envelope-open-o"></i></a>
          </li>
          <li class="nav-item dropdown-lg">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
              <i class="fa fa-bell-o"></i></a>
          </li>
          <li class="nav-item language">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();"><i class="fa fa-flag"></i></a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
              <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
              <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
              <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
              <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item user-details">
                <a href="javaScript:void();">
                  <div class="media">
                    <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                    <div class="media-body">
                      <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
                      <p class="user-subtitle">mccoy@example.com</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <!--End topbar header-->

    <div class="clearfix"></div>

    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="row mt-3">

          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="card-header" style="background-color: rgb(0, 29, 190)">Mis Servicios
                </div>
                <div class="card-body" style="background-color: white;">
      
                    <figure class="highcharts-figure">
                        <div id="container" style="width: 100%; height: 200px"></div>
                    </figure>

                </div>

                <?php 
                
                $V1 = mysqli_query($conection, "SELECT count(*) as T1 FROM servicios WHERE responsable='$username' AND estado='NUEVO'");
                $V1r = mysqli_fetch_assoc($V1);

                $V2 = mysqli_query($conection, "SELECT count(*) as T2 FROM servicios WHERE responsable='$username' AND estado='EN PROCESO'");
                $V2r = mysqli_fetch_assoc($V2);

                $V3 = mysqli_query($conection, "SELECT count(*) as T3 FROM servicios WHERE responsable='$username' AND estado='FINALIZADO'");
                $V3r = mysqli_fetch_assoc($V3);

                $V4 = mysqli_query($conection, "SELECT count(*) as T4 FROM servicios WHERE responsable='$username' AND estado='DETENIDO'");
                $V4r = mysqli_fetch_assoc($V4);

                ?>

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
                        text: 'Cantidad'
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
                          name: "Nuevo",
                          color: '#0C5FB8',
                          y: Tot1,
                          drilldown: "Nuevo"
                        },
                        {
                          name: "En proceso",
                          color: '#F3DE0C',
                          y: Tot2,
                          drilldown: "En proceso"
                        },
                        {
                          name: "Finalizado",
                          color: '#08CB49',
                          y: Tot3,
                          drilldown: "Finalizado"
                        },
                        {
                          name: "Detenido",
                          color: '#CC1907',
                          y: Tot4,
                          drilldown: "Detenido"
                        }
                      ]
                    }]
                  });
                </script>
                <br><br>
                <div class="card-header" style="background-color: rgb(0, 29, 190)">Participando en Servicios
                </div>
                <div class="card-body" style="background-color: white;">
                <figure class="highcharts-figure">
                        <div id="container2" style="width: 100%; height: 200px"></div>
                    </figure>

                </div>
                <?php 
                
                $Vx1 = mysqli_query($conection, "SELECT count(*) as Tx1 FROM servicios s, gestionparticipantes gp WHERE s.idservicio=gp.PS AND gp.participante='$username' AND s.estado='NUEVO' AND gp.estado='ACTIVO'");
                $Vx1r = mysqli_fetch_assoc($Vx1);

                $Vx2 = mysqli_query($conection, "SELECT count(*) as Tx2 FROM servicios s, gestionparticipantes gp WHERE s.idservicio=gp.PS AND gp.participante='$username' AND s.estado='EN PROCESO' AND gp.estado='ACTIVO'");
                $Vx2r = mysqli_fetch_assoc($Vx2);

                $Vx3 = mysqli_query($conection, "SELECT count(*) as Tx3 FROM servicios s, gestionparticipantes gp WHERE s.idservicio=gp.PS AND gp.participante='$username' AND s.estado='FINALIZADO' AND gp.estado='ACTIVO'");
                $Vx3r = mysqli_fetch_assoc($Vx3);

                $Vx4 = mysqli_query($conection, "SELECT count(*) as Tx4 FROM servicios s, gestionparticipantes gp WHERE s.idservicio=gp.PS AND gp.participante='$username' AND s.estado='DETENIDO' AND gp.estado='ACTIVO'");
                $Vx4r = mysqli_fetch_assoc($Vx4);

                ?>
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
                        text: 'Cantidad'
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
                          name: "Nuevo",
                          color: '#0C5FB8',
                          y: Totx1,
                          drilldown: "Nuevo"
                        },
                        {
                          name: "En proceso",
                          color: '#F3DE0C',
                          y: Totx2,
                          drilldown: "En proceso"
                        },
                        {
                          name: "Finalizado",
                          color: '#08CB49',
                          y: Totx3,
                          drilldown: "Finalizado"
                        },
                        {
                          name: "Detenido",
                          color: '#CC1907',
                          y: Totx4,
                          drilldown: "Detenido"
                        }
                      ]
                    }]
                  });
                </script>
                <br><br>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card" style="width: 100%; height: 95.5%;">
              <div class="card-body">
                <h5 class="card-title">Registrar nuevo</h5>
                <div class="table-responsive">
                  <div class="form-group">
                    <form action="" method="post">
                    <label for="input-1">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="input-1" placeholder="Nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="input-1">Descripcion</label>
                    <textarea name="descripcion" class="form-control" id="input-1" placeholder="Describa la actividad" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="input-4">Empresa</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT iCodigo as codigo, sDescripcion as descripcion FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC");
                    ?>
                    <select name="empresa" id="lista_empresa" class="form-control" required>
                      <option selected="true" disabled="disabled">Ninguno</option>
                      <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                        <option value="<?php echo $valoo['codigo']; ?>">
                          <?php echo $valoo['descripcion']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="input-4">Area</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT idArea as id, Area as area FROM area ORDER BY Area ASC");
                    ?>
                    <select name="area" id="lista_area" class="form-control" required>
                      <option selected="true" disabled="disabled">Ninguno</option>
                      <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                        <option value="<?php echo $valoo['id']; ?>">
                          <?php echo $valoo['area']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="input-4">Responsable</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT idusuario as usuario,concat(apellido,' ',nombre) as datos FROM persona WHERE estatus='Activo' ORDER BY apellido ASC");
                    ?>
                    <select name="responsable" id="lista_responsable" class="form-control" required>
                      <option selected="true" disabled="disabled">Ninguno</option>
                      <?php while ($row3 = mysqli_fetch_assoc($Datos)) { ?>
                        <option value="<?php echo $row3['usuario']; ?>">
                          <?php echo $row3['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de inicio</label>
                      <input type="Date" name="fechaini" class="form-control" id="input-1" required>
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Fecha de inicio real</label>
                      <input type="Date" name="fechainir" class="form-control" id="input-1">
                    </div>                  
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Fecha de termino</label>
                      <input type="Date" name="fechafin" class="form-control" id="input-1">
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Fecha de termino real</label>
                      <input type="Date" name="fechafinr" class="form-control" id="input-1">
                    </div>                  
                  </div>

                  <br>

                  <?php 
                  
                  $hora = date("H:i:s", time());;
                  $fecha = date('Y-m-d');

                  $nom = isset($_POST['nombre'])?$_POST['nombre']:Null;
                  $nomr = trim($nom);

                  $desc = isset($_POST['descripcion'])?$_POST['descripcion']:Null;
                  $descr = trim($desc);

                  $empresa = isset($_POST['empresa'])?$_POST['empresa']:Null;
                  $empresar = trim($empresa);

                  $area = isset($_POST['area'])?$_POST['area']:Null;
                  $arear = trim($area);

                  $responsable = isset($_POST['responsable'])?$_POST['responsable']:Null;
                  $responsabler = trim($responsable);

                  $fecini = isset($_POST['fechaini'])?$_POST['fechaini']:Null;
                  $fecinir = trim($fecini);

                  $fecinireal = isset($_POST['fechainireal'])?$_POST['fechainireal']:Null;
                  $fecinirealr = trim($fecinireal);

                  $fecfin = isset($_POST['fechafin'])?$_POST['fechafin']:Null;
                  $fecfinr = trim($fecfin);
                  
                  $fecfinreal = isset($_POST['fechafinreal'])?$_POST['fechafinreal']:Null;
                  $fecfinrealr = trim($fecfinreal);
                  
                  if(isset($_POST['btnRegistrar'])){

                    if(!empty($responsabler)){

                      $consultarre = mysqli_query($conection, "SELECT * FROM servicios WHERE responsable='$responsabler' AND nombre='$nomr'");
                      $resul = mysqli_num_rows($consultarre);

                      if($resul == 0){

                      $insertar = mysqli_query($conection, "INSERT INTO servicios(nombre, descripcion, estado, empresa, area, responsable, fecinicio, fecinicioreal, fecfin, fecfinreal, horaRegistro, fechaRegistro, userRegistro) VALUES ('$nomr','$descr','NUEVO','$empresar','$arear','$responsabler','$fecinir','$fecinireal','$fecfinr','$fecfinrealr','$hora','$fecha','$username')");

                      $consultarreg = mysqli_query($conection, "SELECT * FROM servicios WHERE responsable='$responsabler' AND nombre='$nomr'");
                      $result = mysqli_num_rows($consultarreg);

                      if($result>0){
                        echo '<script type="text/javascript">';
                        echo 'alert("Registro completado!")';
                        echo '</script>';
                      }else{
                        echo '<script type="text/javascript">';
                        echo 'alert("ERROR! El registro no pudo ser completado. Intente nuevamente. Gracias)';
                        echo '</script>';
                      }
                    }

                  }else{
                    echo '<script type="text/javascript">';
                    echo 'alert("ERROR! Todo Producto requiere de un Responsable. Vuelva a ingresar los datos.")';
                    echo '</script>';
                  }
                  
                  }

                  ?>


                  <input type="submit" class="btn btn-light px-5" name="btnRegistrar" id="btnRegistrar" value="Registrar"><br><br>
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
          <div class="card">
            <div class="card-header">Seguimiento de Servicios
              <br>
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <br>

                      <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px">
                        <thead>
                          <tr>
                            <th class="th1"></th>
                            <th class="th1">NOMBRE</th>
                            <th class="th1">ESTADO</th>
                            <th class="th1">EMPRESA</th>
                            <th class="th1">AREA</th>
                            <th class="th1">INICIO</th>
                            <th class="th1">FIN</th>
                            <th class="th1">RESPONSABLE</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          $consultaAct = mysqli_query($conection, "SELECT s.nombre as nombre, s.estado as estado, cc.sDescripcion as empresa, a.Area as area, s.fecinicio as inicio, s.fecfin as final, concat(pr.apellido,' ',pr.nombre) as responsable FROM servicios s, area a, centrocosto cc, persona pr WHERE s.area=a.idArea AND s.empresa=cc.iCodigo AND s.responsable=pr.idusuario AND s.responsable='$username'");
                          while ($acti = mysqli_fetch_assoc($consultaAct)) {
                          ?>
                            <tr>
                              <td></td>
                              <td ><?php echo $acti['nombre']; ?></td>
                              <td><?php echo $acti['estado']; ?></td>
                              <td><?php echo $acti['empresa']; ?></td>
                              <td><?php echo $acti['area']; ?></td>
                              <td><?php echo $acti['inicio']; ?></td>
                              <td><?php echo $acti['final']; ?></td>
                              <td><?php echo $acti['responsable']; ?></td>
                            </tr>
                          <?php }
                          ?>
                        </tbody>
                      </table>
                      <br>
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
    <!--End content-wrapper-->
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    <footer class="footer">
      <div class="container">
        <div class="text-center">
          ACG © 2020
        </div>
      </div>
    </footer>
    <!--End footer-->


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
  <script src="../jquery/jquery-3.3.1.min.js"></script>
  <script src="../popper/popper.min.js"></script>

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