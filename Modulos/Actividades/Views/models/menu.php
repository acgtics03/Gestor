<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link  rel="icon"   href="image/logo.jpg" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/pace.min.css" rel="stylesheet"/>
</head>
<body>
     
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" style="background-color: #16375B;">
     <div class="brand-logo" style="background-color: white;">
      <a href="http://acg-soft.com/ti/extranet/Gestor/Modulos/Actividades/Views/index.php" style="color: white; font-weight: bold; font-size: 20px;">
       <img src="image/logoacg.png" width="170px">       
     </a>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MENU DE NAVEGACION</li>
      <li>
        <a href="index.php">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Inicio</span>
        </a>
      </li>

      <li>
        <a href="ProductosServicios.php">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Productos y/o Servicios</span>
        </a>
      </li>

     <li>
        <a href="SeguimientoActividades.php">
          <i class="zmdi zmdi-grid"></i> <span>Actividades</span>
        </a>
      </li>
<!-- 
      <li>
        <a href="SeguimientoActividades.php">
          <i class="zmdi zmdi-grid"></i> <span>Seguimiento</span>
        </a>
      </li>
--> 
     
     <?php 
	date_default_timezone_set('America/Lima');
    session_start();
    $hora = date("H:i:s", time());;
    $fecha = date('Y-m-d');
    //CONEXIÓN A BD
    require '../conexion.php';
    $username = $_SESSION['user'];
    
	$consultaa = mysqli_query($conection, "SELECT p.idCargo as cargo, u.idPerfil as perf FROM persona p, usuario u WHERE p.idusuario=u.usuario AND p.idusuario='$username'");
	$consultaar = mysqli_fetch_assoc($consultaa);
	
	$id = $consultaar['cargo'];
	$ip = $consultaar['perf'];
	
	$in = '';
	if($id=='2' || $id=='9' || $id=='6'){
	    $in = '';
	}else{
	    $in = 'hidden=""';
	}
	
	$consultarr = mysqli_query($conection, "SELECT p.TipoTrabajador as tp FROM persona p, usuario u WHERE p.idusuario=u.usuario AND p.idusuario='$username'");
	$consultass = mysqli_fetch_assoc($consultarr);
	$perff = $consultass['tp'];
	if($perff=="SUPERVISOR"){
	    $in = '';
	}
	
	$ins = '';
	if($ip=='4'){
	    $ins = '';
	}else{
	    $ins = 'hidden=""';
	}
	

    ?>
     
      <li <?php echo $in; ?>>
        <a href="Supervisar.php">
          <i class="zmdi zmdi-calendar-check"></i> <span>Supervisar</span>
        </a>
      </li> 
      <!-- 
     <li>
        <a href="">
          <i class="zmdi zmdi-calendar-check"></i> <span>Reasignar</span>
        </a>
      </li> 
       -->
       <li <?php echo $ins; ?>>
        <a href="Tipos.php">
          <i class="zmdi zmdi-calendar-check"></i> <span>Tipos</span>
        </a>
      </li> 
  <!-- 
      <li>
        <a href="profile.html">
          <i class="zmdi zmdi-face"></i> <span>Perfil</span>
        </a>
      </li>

       <li>
        <a href="register.html" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Registration</span>
        </a>
      </li>

-->
      <li class="sidebar-header">Estados</li>
      <li><a><img src="image/planificado.png" width="20px" height="20px" alt=""><span> &nbsp;&nbsp;Planificado</span></a></li>
      <li><a><img src="image/proceso.png" width="20px" height="20px" alt=""><span> &nbsp;&nbsp;Proceso</span></a></li>
      <li><a><img src="image/finalizado.png" width="20px" height="20px" alt=""><span> &nbsp;&nbsp;Finalizado</span></a></li>
      <li><a><img src="image/detenido.png" width="20px" height="20px" alt=""><span> &nbsp;&nbsp;Detenido</span></a></li>
    </ul>
   
   </div>
   <!--End sidebar-wrapper-->
</body>
</html>