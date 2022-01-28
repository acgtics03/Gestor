<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link  rel="icon"   href="image/logo.jpg" type="image/png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>ACG - Actividades</title>
  <!-- loader-->
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
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
  <link rel="stylesheet"  href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
</head>

<body class="bg-theme bg-theme1">
<?php
    require('models/menu.php');
    date_default_timezone_set('America/Lima');
    session_start();
    require 'conexion.php';
    $username = $_SESSION['user'];
    
    require('models/header.php');

  ?>

  <!-- Start wrapper-->
  <div id="wrapper">

    <div class="clearfix"></div>

    <div class="content-wrapper fondo">
      <div class="container-fluid">

        <div class="row mt-3">
          <div class="col-lg-6">
            <div class="card reg-tab">
              <div class="card-body">
                <h5 class="card-title">Actividades programadas</h5>
                <div class="table-responsive" style="height: 675px">
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $consulta = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$username' AND identificador='DIARIO' AND estado='NUEVO'");

                      while ($dat = mysqli_fetch_assoc($consulta)) {
                      ?>
                        <tr>
                          <th scope="row"><?php echo '<input type="checkbox" value="selec">' ?></th>
                          <td style="font-size: 12px"><?php echo $dat['nombre']; ?></td>
                          <td style="font-size: 12px"><?php echo $dat['fecha']; ?></td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card reg-fond">
              <div class="card-body">
                <h5 class="card-title">Registrar nuevo</h5>
                <div class="table-responsive">
                  <div class="form-group">
                  <form action="" method="post">
                    <label for="input-1">Nombre</label>
                    <?php
                          $noms = mysqli_query($conection, "SELECT nombre FROM gestionactividad WHERE estado='Activo'");
                          ?>
                          <select name="nombre" id="nombre" class="form-control" required>
                            <option selected="true" disabled="disabled">Ninguno</option>
                            <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                              <option value="<?php echo $val['nombre']; ?>">
                                <?php echo $val['nombre']; ?>
                              </option>
                            <?php } ?>
                          </select>
                  </div>
                  <div class="form-group">
                    <label for="input-1">Descripcion</label>
                    <textarea  name="descripcion" class="form-control" id="input-1" placeholder="Describa la actividad" required></textarea>
                  </div>
                  <div class="form-group">
                  <div style="display: inline-block; ">
                          <label for="input-4">Empresa</label>
                          <?php
                          $Datos = mysqli_query($conection, "SELECT iCodigo as codigo, sDescripcion as descripcion FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC");
                          ?>
                          <select name="empresa" id="lista_empresa" class="form-control" style="width: 240px" required>
                            <option selected="true" disabled="disabled">Ninguno</option>
                            <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                              <option value="<?php echo $valoo['codigo']; ?>">
                                <?php echo $valoo['descripcion']; ?>
                              </option>
                            <?php } ?>
                          </select>
                    </div>
                    <div style="display: inline-block; margin-left: 5%">
                    <label for="input-4">Area</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT idArea as id, Area as area FROM area ORDER BY Area ASC");
                    ?>
                    <select name="area" id="lista_area" class="form-control" style="width: 200px"  required>
                      <option selected="true" disabled="disabled">Ninguno</option>
                      <?php while ($valoo = mysqli_fetch_assoc($Datos)) { ?>
                        <option value="<?php echo $valoo['id']; ?>">
                          <?php echo $valoo['area']; ?>
                        </option>
                      <?php } ?>
                    </select>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label for="input-1">Fecha programada</label>
                    <input type="Date" name="fecha" class="form-control" id="input-1" placeholder="Nombre del proyecto" required>
                  </div>

                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Hora de inicio</label>
                      <input type="time" name="Horaini" class="form-control" style="width: 210px" id="input-1" required>
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Hora de inicio real</label>
                      <input type="time" name="Horainireal" class="form-control" style="width: 210px" id="input-1">
                    </div>                  
                  </div>
                  
                  <div class="form-group">
                    <div style="display: inline-block">
                      <label for="input-1">Hora de termino</label>
                      <input type="time" name="Horafin" class="form-control" style="width: 210px" id="input-1">
                    </div>
                    <div style="display: inline-block; margin-left: 10%">
                      <label for="input-1">Hora de termino real</label>
                      <input type="time" name="Horafinreal" class="form-control" style="width: 210px" id="input-1">
                    </div>                  
                  </div>

                  <div class="form-group">
                    <label for="input-4">Responsable</label>
                    <?php
                    $Datos = mysqli_query($conection, "SELECT idusuario as usuario,concat(apellido,' ',nombre) as datos FROM persona WHERE estatus='Activo' and idusuario='$username' ORDER BY apellido ASC");
                    ?>
                    <select name="responsable" id="lista_responsable" class="form-control">
                      <?php while ($row3 = mysqli_fetch_assoc($Datos)) { ?>
                        <option value="<?php echo $row3['usuario']; ?>">
                          <?php echo $row3['datos']; ?>
                        </option>
                      <?php } ?>
                    </select>
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

                  $fechas = isset($_POST['fecha'])?$_POST['fecha']:Null;
                  $fechasr = trim($fechas);

                  $hini = isset($_POST['Horaini'])?$_POST['Horaini']:Null;
                  $hinir = trim($hini);

                  $hfin= isset($_POST['Horafin'])?$_POST['Horafin']:Null;
                  $hfinr = trim($hfin);

                  $hinireal = isset($_POST['Horainireal'])?$_POST['Horainireal']:Null;
                  $hinirealr = trim($hinireal);

                  $hfinreal = isset($_POST['Horafinreal'])?$_POST['Horafinreal']:Null;
                  $hfinrealr = trim($hfinreal);

                  $respons = isset($_POST['responsable'])?$_POST['responsable']:Null;
                  $responsr = trim($respons);
                  
                  if(isset($_POST['btnRegistrar'])){

                    if(!empty($responsr)){

                      $consultarre = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsr' AND nombre='$nomr'");
                      $resul = mysqli_num_rows($consultarre);

                      if($resul==0){

                      $insertar = mysqli_query($conection, "INSERT INTO actividades(nombre, descripcion, estado, responsable, fecha, Horaini, Horainireal, Horafin, Horafinreal, horaRegistro, fechaRegistro, userRegistro, identificador,empresa, area) VALUES ('$nomr','$descr','NUEVO','$responsr','$fechasr','$hinir','$hinirealr','$hfinr','$hfinrealr','$hora','$fecha','$username','DIARIO','$empresar','$arear')");

                      $consultarreg = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsr' AND nombre='$nomr'");
                      $result = mysqli_num_rows($consultarreg);
                      $res = mysqli_fetch_assoc($consultarreg);

                      $idactividad = $res['idactividades'];


                      if($result>0){

                        $insertaseg = mysqli_query($conection, "INSERT INTO seguimientoactividad(idactividad, estado, fecha, hora, userregistro) VALUES ('$idactividad','NUEVO','$fecha','$hora','$username')");

                        $consultaseguimiento = mysqli_query($conection, "SELECT * FROM seguimientoactividad WHERE idactividad='$idactividad' AND estado='NUEVO'");
                        $ress = mysqli_num_rows($consultaseguimiento);

                        if($ress>0){
                        echo '<script type="text/javascript">';
                        echo 'alert("Registro completado!")';
                        echo '</script>';
                        }
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

                  <input type="submit" class="btn btn-light px-5 btnRegistrar" name="btnRegistrar" id="btnRegistrar" value="Registrar"><br>
                </form>
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