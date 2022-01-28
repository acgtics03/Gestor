<!DOCTYPE html>
<html lang="en">

<head><meta charset="big5">
  <meta http-equiv=§Content-Type§ content=§text/html; charset=UTF-8∪ />
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
  <script src="../Js/actividades.js"></script>

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
  ?>

  <script src="code/highcharts.js"></script>
  <script src="code/modules/data.js"></script>
  <script src="code/modules/drilldown.js"></script>
  <script src="code/modules/exporting.js"></script>
  <script src="code/modules/export-data.js"></script>
  <script src="code/modules/accessibility.js"></script>
  <?php require('models/header.php');
        require_once "validar_cuenta.php";
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
                <div class="card-header">CUMPLIMIENTO DE ACTIVIDADES PROPIAS Y/O PARTICIPANTES
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="table-responsive" style="margin-left: -3%; width: 100%">
                          
                            <form action="" method="POST">
                            <div class="row" <?php echo $campo_busqueda; ?>><br>
                              <div class="col">
                                  <label>A&ntilde;o : </label>
                                  <select name="bxanio" id="bxanio" class="form-control" required>
                                      <option class="f-box" selected="true" disabled="disabled"><?php echo $nom_anio; ?></option>
                                    <option class="f-box" value="2021">2021</option>
                                    <option class="f-box" value="2020">2020</option>
                                    <option class="f-box" value="2019">2019</option>
                                    <option class="f-box" value="1">Todos</option>
                                </select>
                            </div>
                              <div class="col">
                                  <label>Mes : </label>
                                  <select name="bxmes" id="bxmes" class="form-control" required>
                                    <option class="f-box" selected="true" disabled="disabled"><?php echo $nom_mes; ?></option>
                                    <option class="f-box" value="01">enero</option>
                                    <option class="f-box" value="02">febrero</option>
                                    <option class="f-box" value="03">marzo</option>
                                    <option class="f-box" value="04">abril</option>
                                    <option class="f-box" value="05">mayo</option>
                                    <option class="f-box" value="06">junio</option>
                                    <option class="f-box" value="07">julio</option>
                                    <option class="f-box" value="08">agosto</option>
                                    <option class="f-box" value="09">septiembre</option>
                                    <option class="f-box" value="10">octubre</option>
                                    <option class="f-box" value="11">noviembre</option>
                                    <option class="f-box" value="12">diciembre</option>
                                    <option class="f-box" value="13">Todos</option>
                                  </select>
                             </div>
                              <div class="col">
                                  <label>Area : </label>
                                  <?php
                                  $Datos = mysqli_query($conection, "SELECT idArea as id, Area as area FROM area ORDER BY Area ASC");
                                  ?>
                                  <select name="bxarea" id="bxarea" class="form-control" required>
                                    <option class="f-box" selected="true" disabled="disabled"><?php echo $nom_area; ?></option>
                                    <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                                      <option class="f-box" value="<?php echo $valoo['id']; ?>">
                                        <?php echo $valoo['area']; ?>
                                      </option>
                                    <?php } ?>
                                  </select>
                              </div>
                              <div class="col">
                                  <label>Supervisores : </label>
                                    <?php $consulta = mysqli_query($conection,"SELECT idusuario, concat(SUBSTRING_INDEX(nombre,' ',1),' ',SUBSTRING_INDEX(apellido,' ',1)) as datos FROM persona WHERE TipoTrabajador='SUPERVISOR' AND estatus='Activo' ORDER BY nombre");?>
                                    <select name="bxsupervisor" id="bxsupervisor" class="form-control">
                                        <option class="f-box" selected="true" disabled="disabled"><?php echo $nom_super; ?></option>
                                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                                        <option class="f-box" value="<?php echo $datos['idusuario'] ?>">
                                        <?php echo $datos['datos']; ?>
                                        </option>
                                        <?php }?>
                                     </select>
                              </div>
                              <div class="col">
                                  <label style="color: #e9bf4000">boton :</label><br>
                                  <input type="submit" class="form-control btn btn-success" style="background-color: blue; height: 55%;" value="Buscar" name="btnBuscar" id="btnBuscar">
                              </div>
                              <div class="col">
                                  <label style="color: #e9bf4000">boton :</label><br>
                                  <input type="submit" class="form-control btn btn-secondary" style="background-color: #919191; height: 55%;" value="Limpiar" name="btnLimpiar" id="btnLimpiar">
                              </div>
                              </div>
                              </form>
                              
                          <br>
                          <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                            <thead>
                              <tr>
                                <th class="th1"></th>                                
                                <th class="th1">INICIO</th>
                                <th class="th1">TERMINO</th>
                                <th class="th1"></th>                                
                                <th class="th1">NOMBRE</th>
                                <th class="th1 col-2">DESCRIPCION</th>
                                <th class="th1">RESPONSABLE</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                   
                                    while ($ps2 = mysqli_fetch_assoc($consultaAct2)) {
                                
                                      $datos23 = $ps2['ID'] . "||" .
                                                  $ps2['nom'] . "||" .          
                                                  $ps2['descripcion'] . "||" .
                                                  $ps2['fecha'] . "||" .
                                                  $ps2['fechafin'] . "||" .
                                                  $ps2['hini'] . "||" .
                                                  $ps2['hfin'] . "||" .
                                                  $ps2['estado'] . "||" .
                                                  $ps2['respons'];

                                            $idacti = $ps2['ID'];

                                            //consultar cantidad de tareas vs tareas finalizadas por actividad
                                          $consultar_tareas = mysqli_query($conection, "SELECT count(*) as total FROM tareas WHERE vinculo='$idacti' AND estado!='ELIMINADO'");
                                          $ct = mysqli_fetch_assoc($consultar_tareas);
                                          
                                          $consultar_tareasF = mysqli_query($conection, "SELECT count(*) as total FROM tareas WHERE vinculo='$idacti' AND estado='FINALIZADO'");
                                          $ctf = mysqli_fetch_assoc($consultar_tareasF);
                                          
                                          $a = $ctf['total'];
                                          $b = $ct['total'];

                                          $parte3="TrabajadorCodigo('$datos23')";

                                          $parte1 = '#modalEdicion2';
                                          $parte2 = "TrabajadorACT_AE('$datos23')";

                                          //consultar id usuario
                                          $consulta_idusu = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                                          $consulta_idusur = mysqli_fetch_assoc($consulta_idusu);

                                          $idtrab = $consulta_idusur['id'];

                                          //Verificar estado de codigo de autorizacion
                                          $consulta_codigoAE = mysqli_query($conection, "SELECT estado as est FROM autoriza_edicion_supervisor WHERE idusuario='$idtrab'");
                                          $consulta_codigoAEr = mysqli_fetch_assoc($consulta_codigoAE);

                                          $estad = $consulta_codigoAEr['est'];
                                          $parte0 = "";
                                          $partee0 = 'hidden=""';
                                          if($estad=='1'){
                                            $partee0 = "";
                                            $parte0 = 'hidden=""';
                                          }

                                    ?>
                                        <tr style="font-size: 12px;">
                                            <td>
                                            <a href=""  data-toggle="modal" <?php echo $parte0; ?> data-target="#CodigoAutorizacion" onclick="<?php echo $parte3; ?>"><img src="image/editar22.png" width="35px" height="35px" alt=""></a>

                                            <a href="" data-toggle="modal" <?php echo $partee0; ?> data-target="<?php echo $parte1; ?>" onclick="<?php echo $parte2; ?>"><img src="image/editar2.png" width="35px" height="35px" alt=""></a>

                                            &nbsp;&nbsp;&nbsp;<?php echo "<a href='SegActividadesSuperv.php?CA=".$ps2['ID']."'><img src='image/detalle.png' width='35px' height='35px' alt=''></a>"; ?></td>

                                            <td><?php echo $ps2['fecha'].' '.$ps2['hini']; ?></td>
                                            <td><?php echo $ps2['fechafin'].' '.$ps2['hfin']; ?></td>
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
                                            <td><?php echo $a.' / '.$b.' - '.$ps2['nombre']; ?></td>
                                            <td class="col-2"><?php echo $ps2['descripcion']; ?></td>                                            
                                            <td><?php echo $ps2['responsable']; ?></td>
                                            
                                        </tr>
                                    <?php }
                                    ?>
                            </tbody>
                          </table>
                          <br>
                        </div>
                        <br><br><br>
                        
                          <!-- POP UP INGRESAR CODIGO -->
                          <div class="modal fade" id="CodigoAutorizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                        
                                    <div class="modal-content ach">
                                        <div class="modal-header">
                                            <h4 class="modal-title t-titulo" id="myModalLabel">Autorizar Edicion</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                        
                                        </div>
                                        <div class="modal-body">
                                          <form action="" method="post">
                                            <center>
                                            <input type="text" hidden="" id="ID_c" name="ID_c">
                                            <div style="display: inline-block">
                                                <label class="titulo">Ingrese su c籀digo de autorizaci籀n</label><br>
                                            </div>
                                            <br><br>
                                            <div style="display: inline">
                                                <label class="titulo">Codigo : </label>
                                                <input class="cam-fecha" name="codigo" type="password" id="codigo" placeholder="******" required>
                                            </div>                        
                                            <br><br>
                                            <button type="button" class="btn btn-warning" id="autorizar" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Autorizar</button>
                                            </center>
                                            </form>
                                          </div>
                        
                                    </div>
                                </div>
                          </div>

                          <!-- POP UP EDITAR ACTIVIDAD -->
                          <div class="modal fade" id="modalEdicion2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                        
                                    <div class="modal-content ach">
                                        <div class="modal-header">
                                            <h4 class="modal-title t-titulo" id="myModalLabel">Actualizar datos</h4>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                                        </div>
                                        <div class="modal-body">
                        
                                            <input type="text" hidden=""  id="ID_act" name="ID_act">
                                            <div style="display: inline-block">
                                                <label class="titulo">Nombre</label><br>
                                                <?php
                                                  $ver_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario='$username'");
                                                  $ver_arear = mysqli_fetch_assoc($ver_area);
                                                  
                                                  $are = $ver_arear['area'];
                                                  
                                                  $noms = mysqli_query($conection, "SELECT nombre as nombre, idgestion as id FROM tipos WHERE estado='Activo' AND 
                                                  (((categoria='ACTIVIDAD' AND area='$are') OR (categoria='Todos' AND area='$are')) OR ((categoria='ACTIVIDAD' AND area='Todos') OR (categoria='Todos' AND area='Todos')))");
                                                  ?>
                                                  <select name="nombre_act" id="nombre_act" class="combo-box" style="width: 350px" required>
                                                    <option class="f-box" selected="true" disabled="disabled">Ninguno</option>
                                                    <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                                                      <option class="f-box" value="<?php echo $val['id']; ?>">
                                                        <?php echo $val['nombre']; ?>
                                                      </option>
                                                    <?php } ?>
                                               </select>
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block">
                                                <label class="titulo">Descripcion</label><br>
                                                <textarea name="descripcion_act" type="Text" id="descripcion_act" class="c-campos"></textarea>
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block;">
                                                <label class="titulo">Estado</label><br>
                                                <select name="estado_act" id="estado_act" class="combo-box">
                                                    <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                                        <option class="f-box">PLANIFICADO</option>
                                                        <option class="f-box">PROCESO</option>
                                                        <option class="f-box">FINALIZADO</option>
                                                        <option class="f-box">DETENIDO</option>
                                                </select>
                                            </div>
                                            
                                            <br><br>
                                            <div style="display: inline-block">
                                                <label class="titulo">Fecha inicio</label><br>
                                                <input class="cam-fecha" name="fecha_act" type="Date" id="fecha_act" placeholder="yy-mm-dd">
                                            </div>
                                            &nbsp;&nbsp;
                                            <div style="display: inline-block">
                                                <label class="titulo">Hora inicio</label><br>
                                                <input class="cam-fecha" name="Hini_act" type="Time" id="Hini_act" placeholder="yy-mm-dd">
                                            </div>
                                            <br><br>
                                            <div style="display: inline-block">
                                                <label class="titulo">Fecha termino</label><br>
                                                <input class="cam-fecha" name="fechafin_act" type="Date" id="fechafin_act" placeholder="yy-mm-dd">
                                            </div>
                                            &nbsp;&nbsp;
                                            <div style="display: inline-block">
                                                <label class="titulo">Hora termino</label><br>
                                                <input class="cam-fecha" name="Hfin_act" type="Time" id="Hfin_act" placeholder="yy-mm-dd">
                                            </div>
                        
                        
                                            <br><br>
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

      <!-- c頠�digo JS prop頞這-->
      <script type="text/javascript" src="../main.js"></script>

     

</body>

</html>


<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
         
        });


        $('#actualizadatos').click(function() {
            actualizarActividad_AE();
        });

        $('#autorizar').click(function() {
            AutorizarEdicion();
        });

    });
</script>