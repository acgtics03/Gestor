<!DOCTYPE html>
<html lang="en">

<head><meta charset="gb18030">
  
  <link  rel="icon"   href="image/logo.jpg" type="image/png" />
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
  <link rel="stylesheet"  href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
</head>

<body class="bg-theme fondo">
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
          
          <div class="col-12 col-lg-12">
            <div class="card reg-tab2">
              <div class="card-body">
                <h5 class="card-title">CREAR TIPO</h5>

                <form action="../models/insertanombre.php" method="post">
                    <div style="display: inline-block">
                        <label for="input-1">Nombre</label>
                        <input type="text" name="nombre" class="form-control" style="width: 350px" id="input-1" maxlength="60" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" placeholder="Nombre" required>
                    </div>  
                    <div style="display: inline-block; margin-left: 10px">
                        <label for="input-1">Categoria</label><br>
                        <select name="bxxcategoria" id="bxxcategoria" class="form-control f-2-box">
                                <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                <option class="f-box">PRODUCTO</option>
                                <option class="f-box">SERVICIO</option>
                                <option class="f-box">ACTIVIDAD</option>
                                <option class="f-box">Todos</option>
                        </select>
                    </div>
                    <div style="display: inline-block; margin-left: 10px">
                        <label for="input-1">Area</label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT idArea as ID, Area as area FROM area"); ?>
                        <select name="bxxarea" id="bxxarea" class="form-control f-2-box">
                            <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                    <?php echo $datos['area']; ?>
                                </option>
                            <?php } ?>
                                <option class="f-box">Todos</option>
                        </select>
                    </div>
                    
                    <input type="submit" class="btn btn-light px-5 btnRegistrar" name="btnCrear" id="btnCrear" value="Crear">
                    
                </form>
                <br>
              </div>
            </div>
          </div> 
            
            
            
          <div class="col-12 col-lg-12">
            <div class="card reg-tab2">
              <div class="card-body">
                <h5 class="card-title">LISTADO</h5>

                <br>
                <div class="table-responsive" style="height: 100%">
                  <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px">
                    <thead>
                      <tr>
                        <th class="centrar"></th>
                        <th class="centrar">Categoria</th>
                        <th class="centrar">Nombre</th>
                        <th class="centrar">Gestor</th>
                        <th class="centrar">Area</th>
                        <th class="centrar">Registrado</th>
                        <th class="centrar"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                       $consulta_i = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                       $consulta_ir = mysqli_fetch_assoc($consulta_i);
        
                       $id_trabajador = $consulta_ir['id'];

                      $consulta = mysqli_query($conection, "SELECT t.idgestion as id ,t.nombre as nombre, t.estado as estado, t.fecharegistro as fecha, t.gestor as gestor, t.categoria as categoria, 
                      t.area as area, t.horaregistro as horaregistro, concat(p.apellido,' ',p.nombre) as datos, a.Area as areas, t.controlregistro FROM tipos t, usuario u, persona p, area a WHERE t.gestor=u.idusuario 
                      AND t.gestor='$id_trabajador' AND u.usuario=p.idusuario AND (t.area=a.idArea  OR t.area='Todos') AND estado='Activo' GROUP BY t.idgestion ORDER BY t.controlregistro DESC");

                      while ($dat = mysqli_fetch_assoc($consulta)) {
                      ?>
                        <tr>
                        <?php echo "<td> <a href='../models/eliminartipo.php?no=".$dat['id']."'><img src='image/eliminar.png' width='35px' height='35px'></a>
                          </td>"; ?>
                          <td ><?php echo $dat['categoria']; ?></td>
                          <td ><?php echo $dat['nombre']; ?></td>
                          <td ><?php echo $dat['datos']; ?></td>
                          <td ><?php
                          $a = $dat['area'];
                          if($a=="Todos"){
                              echo 'Todos';
                          }else{
                          echo $dat['areas']; 
                          }
                          ?></td>
                          <td class="centrar"><?php echo $dat['fecha'].' / '.$dat['horaregistro']; ?></td>
                          <td class="centrar"><?php $valorestado=$dat['estado'];
                                                if($valorestado='Activo'){
                                                   echo '<img src="image/finalizado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }else{
                                                    if($valorestado='Inactivo'){
                                                    echo '<img src="image/detenido.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                                                }
                                                }
                            ?></td>
                        </tr>
                      <?php }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
         
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