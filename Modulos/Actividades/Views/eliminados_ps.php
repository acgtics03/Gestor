<!DOCTYPE html>
<html lang="en">

<head><meta charset="big5">
  
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
  
  <script src="../Js/popup_ra.js"></script>
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
  <?php require('models/header.php');
  require('../models/consultaActividad_ps.php');
  ?>

<br>
  <!-- Start wrapper-->
  <div id="wrapper fondo">
    <div class="clearfix"></div>

    <div class="content-wrapper fondo">
      <div class="container-fluid">
                
          <div class="row">
            <div class="col-12 col-lg-12">
              <div class="card reg-tab2">
                  <div class="card-header"><a href="Supervisar.php" style="color: rgb(255, 187, 187)"><img src="image/espalda.png" width="30px" height="30px"> Volver a Supervisar</a></div>
                <div class="card-header">PRODUCTOS Y/O SERVICIOS ELIMINADOS
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <br>
                          <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                            <thead>
                              <tr>
                                <th class="th1"></th>
                                <th class="th1">TIPO</th>
                                <th class="th1">NOMBRE</th>
                                <th class="th1">DESCRIPCION</th>
                                <th class="th1">INICIO</th>
                                <th class="th1">TERMINO</th>
                                <th class="th1">RESPONSABLE</th>
                                <th class="th1">MOTIVO</th>
                                <th class="th1">OBSERVACION</th>
                                <th class="th1"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                    require '../conexion.php';
                                    $username = $_SESSION['user'];
                                    $variable = $_SESSION['var'];
                                    
                                    
                                
                                    //COMPLETAR TABLA 
                                    $consultaAct2 = mysqli_query($conection, "SELECT a.idps as ID,a.categoria as tipo,a.descripcion as descripcion, t.nombre as nombre, a.fecinicio as fecha , a.fecfin as fechafin, a.estado as estado, 
                                    concat(p.apellido,' ',p.nombre) as responsable , me.motivo as motivo, a.DescEliminado as deliminado
                                    FROM producto_servicio a, persona p, usuario u, tipos t, motivos_eliminaps me 
                                    WHERE u.usuario=p.idusuario AND t.idgestion=a.nombre AND me.idmeps=a.MotivoEliminado AND a.responsable=u.idusuario AND p.idJefeInmediato='$username' AND a.estado='ELIMINADO'");
                                    while ($ps2 = mysqli_fetch_assoc($consultaAct2)) {
                                
                                        $datos2 = $ps2['ID'] . "||" .
                                            $ps2['nombre'] . "||" .
                                            $ps2['descripcion'] . "||" .
                                            $ps2['responsable'];
                                
                                    ?>
                                        <tr style="font-size: 12px;">
                                            <td><a href="" data-toggle="modal" data-target="#modalEdicion2" onclick="Trabajador2('<?php echo $datos2; ?>')"><img src="image/recuperar.png" width="35px" height="35px" alt=""></a>
                                            </td>
                                            <td><?php echo $ps2['tipo']; ?></td>
                                            <td><?php echo $ps2['nombre']; ?></td>
                                            <td><?php echo $ps2['descripcion']; ?></td>
                                            <td><?php echo $ps2['fecha']; ?></td>
                                            <td><?php echo $ps2['fechafin']; ?></td>
                                            <td><?php echo $ps2['responsable']; ?></td>
                                            <td><?php echo $ps2['motivo']; ?></td>
                                            <td><?php echo $ps2['deliminado']; ?></td>
                                            <td class="centrar"><?php $valorestado=$ps['estado'];
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
                                            <h4 class="modal-title t-titulo" id="myModalLabel">Restablecer Producto y/o Servicio</h4>
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
                                                <input name="resp3" type="Text" id="resp3" class="c-campos" disabled>
                                            </div>
                                            <br><br>
                                            
                                            <div style="display: inline-block">
                                                <button type="button" class="btn btn-warning" id="" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Restablecer</button>
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

      <!-- c車digo JS prop足o-->
      <script type="text/javascript" src="../main.js"></script>

     

</body>

</html>


<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
         
        });


        $('#actualizadatos').click(function() {
            actualizaDatos();
        });

    });
</script>