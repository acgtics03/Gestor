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
  
  <script src="../Js/popup_ra.js"></script>
  <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
	<script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>
  
</head>

<body class="bg-theme fondo">
  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

  <?php
  require('models/menu.php');
  require('../models/producto_servicio.php');
  require 'conexion.php';
  $username = $_SESSION['user'];
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
                <div class="card-header"><a href="Supervisar.php" style="color: white"><img src="image/espalda.png" width="30px" height="30px"> Volver a Supervisar</a></div>   
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
                                                    <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                                        <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                                            <?php echo $datos['datos']; ?>
                                                        </option>
                                                    <?php } ?>
                                                         <option class="f-box">Todos</option>
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
                                                    <?php while ($datos = mysqli_fetch_assoc($estadospsa)) { ?>
                                                        <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                                            <?php echo $datos['datos']; ?>
                                                        </option>
                                                    <?php } ?>
                                                    <option class="f-box">Todos</option>
                                                </select>
                                               
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block;">
                                            <input type="submit" class="btn btn-warning btnreport" id="btnReasignar" name="btnReasignar" value="Buscar">
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
                <div class="card-header titulos_super">REASIGNAR PRODUCTOS Y/O SERVICIOS</div>   
                <div class="card-header">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive">
                          <br><br>
                          <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                            <thead>
                              <tr>
                                <th class="th1"></th>
                                <th class="th1">TIPO</th>
                                <th class="th1">CLIENTE</th>
                                <th class="th1">NOMBRE</th>
                                <th class="th1">DESCRIPCION</th>
                                <th class="th1">RESPONSABLE</th>
                                <th class="th1">INICIO</th>
                                <th class="th1">FIN</th>
                                <th class="th1"></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                      
                                 $consultar_ps = mysqli_query($conection, "SELECT ps.categoria as tipo, cc.sDescripcion as cliente, t.nombre as nombre, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable, 
                                 ps.descripcion as descripcion, ps.fecinicio as inicio, ps.fecfin as termino, ps.estado as estado, concat(p.apellido,' ',p.nombre) as dat
                                 FROM producto_servicio ps, centrocosto cc, tipos t, usuario u, persona p
                                 WHERE ps.empresa=cc.iCodigo AND t.idgestion=ps.nombre AND u.idusuario=ps.responsable AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' || p.idusuario='$username')");
                                    while ($ps2 = mysqli_fetch_assoc($consultar_ps)) {
                                
                                 $datos2 = $ps2['ID'] . "||" .
                                            $ps2['nombre'] . "||" .
                                            $ps2['descripcion'] . "||" .
                                            $ps2['dat'];
                                
                                
                                    ?>
                                        <tr style="font-size: 12px;">
                                            <td><a href="" data-toggle="modal" data-target="#modalEdicion2" onclick="Trabajador('<?php echo $datos2; ?>')"><img src="image/reasignarr.png" width="35px" height="35px" alt=""></a>
                                            </td>
                                            <td><?php echo $ps2['tipo']; ?></td>
                                            <td><?php echo $ps2['cliente']; ?></td>
                                            <td><?php echo $ps2['nombre']; ?></td>
                                            <td><?php echo $ps2['descripcion']; ?></td>
                                            <td><?php echo $ps2['responsable']; ?></td>
                                            <td><?php echo $ps2['inicio']; ?></td>
                                            <td><?php echo $ps2['termino']; ?></td>
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
                                            <h4 class="modal-title t-titulo" id="myModalLabel">Reasignar Producto y/o Servicio</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                                        </div>
                                        <form action="" method="post">
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
                                                <?php 
                                               
                                                $consulta = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u 
                                                                                        WHERE p.idusuario=u.usuario AND  p.estatus='Activo' ORDER BY p.apellido ASC"); ?>
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
                                        </form>
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
            actualizarDatos();
        });

    });
</script>