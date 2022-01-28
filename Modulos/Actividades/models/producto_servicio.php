<?php
  
  date_default_timezone_set('America/Lima');
  session_start();
  require 'conexion.php';
  $username = $_SESSION['user'];
  
  $ver_usu = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
  $usuar = mysqli_fetch_assoc($ver_usu);
  
  $usuario = $usuar['idusuario'];


  $ver_cargo = mysqli_query($conection, "SELECT idCargo, idArea FROM persona WHERE idusuario='$username'");
  $cargo = mysqli_fetch_assoc($ver_cargo);
  
  $carg = $cargo['idCargo'];
  $area = $cargo['idArea'];

  if($carg=='2' || $carg=='9'){
  
  $blok = "";     
       
  //GRAFICA 01

  $V1 = mysqli_query($conection, "SELECT count(*) as T1 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='PLANIFICADO' AND p.categoria='PRODUCTO'");
  $V1r = mysqli_fetch_assoc($V1);

  $V2 = mysqli_query($conection, "SELECT count(*) as T2 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='PROCESO' AND p.categoria='PRODUCTO'");
  $V2r = mysqli_fetch_assoc($V2);

  $V3 = mysqli_query($conection, "SELECT count(*) as T3 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='FINALIZADO' AND p.categoria='PRODUCTO'");
  $V3r = mysqli_fetch_assoc($V3);

  $V4 = mysqli_query($conection, "SELECT count(*) as T4 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='DETENIDO' AND p.categoria='PRODUCTO'");
  $V4r = mysqli_fetch_assoc($V4);


  //GRAFICA 02


  $Vx1 = mysqli_query($conection, "SELECT count(*) as Tx1 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='PLANIFICADO' AND p.categoria='SERVICIO'");
  $Vx1r = mysqli_fetch_assoc($Vx1);

  $Vx2 = mysqli_query($conection, "SELECT count(*) as Tx2 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='PROCESO' AND p.categoria='SERVICIO'");
  $Vx2r = mysqli_fetch_assoc($Vx2);

  $Vx3 = mysqli_query($conection, "SELECT count(*) as Tx3 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='FINALIZADO' AND p.categoria='SERVICIO'");
  $Vx3r = mysqli_fetch_assoc($Vx3);

  $Vx4 = mysqli_query($conection, "SELECT count(*) as Tx4 FROM producto_servicio p, usuario u, persona per, area ar  WHERE p.responsable=u.idusuario AND u.usuario=per.idusuario AND per.idArea=ar.idArea AND ar.idArea='$area' AND p.estado='DETENIDO' AND p.categoria='SERVICIO'");
  $Vx4r = mysqli_fetch_assoc($Vx4);
  
   }
  else{

  
  //GRAFICA 01
  
  $V1 = mysqli_query($conection, "SELECT count(*) as T1 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' AND pr.participante='$usuario') AND p.estado='PLANIFICADO' AND p.categoria='PRODUCTO'");
  $V1r = mysqli_fetch_assoc($V1);

  $V2 = mysqli_query($conection, "SELECT count(*) as T2 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' AND pr.participante='$usuario') AND p.estado='PROCESO' AND p.categoria='PRODUCTO'");
  $V2r = mysqli_fetch_assoc($V2);

  $V3 = mysqli_query($conection, "SELECT count(*) as T3 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' AND pr.participante='$usuario') AND p.estado='FINALIZADO' AND p.categoria='PRODUCTO'");
  $V3r = mysqli_fetch_assoc($V3);

  $V4 = mysqli_query($conection, "SELECT count(*) as T4 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' AND pr.participante='$usuario') AND p.estado='DETENIDO' AND p.categoria='PRODUCTO'");
  $V4r = mysqli_fetch_assoc($V4);


  //GRAFICA 02


  $Vx1 = mysqli_query($conection, "SELECT count(*) as Tx1 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' OR pr.participante='$usuario') AND p.estado='PLANIFICADO' AND p.categoria='SERVICIO'");
  $Vx1r = mysqli_fetch_assoc($Vx1);

  $Vx2 = mysqli_query($conection, "SELECT count(*) as Tx2 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' OR pr.participante='$usuario') AND p.estado='PROCESO' AND p.categoria='SERVICIO'");
  $Vx2r = mysqli_fetch_assoc($Vx2);

  $Vx3 = mysqli_query($conection, "SELECT count(*) as Tx3 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$usuario' OR pr.participante='$usuario') AND p.estado='FINALIZADO' AND p.categoria='SERVICIO'");
  $Vx3r = mysqli_fetch_assoc($Vx3);

  $Vx4 = mysqli_query($conection, "SELECT count(*) as Tx4 FROM producto_servicio p, participantes pr WHERE p.idps=pr.idps AND (p.responsable='$username' OR pr.participante='$username') AND p.estado='DETENIDO' AND p.categoria='SERVICIO'");
  $Vx4r = mysqli_fetch_assoc($Vx4);
  }


  if($carg=='2' || $carg=='9'){
  
  $blok = "";  
      
  }else{
      
    $blok = "disabled"; 
      
  }

  //LISTA_EMPRESAS

  $empresa = mysqli_query($conection, "SELECT iCodigo as codigo, sDescripcion as descripcion FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC");

  //LISTA_AREA
 $username = $_SESSION['user'];
  $a_usu = mysqli_query($conection, "SELECT a.idArea as id, a.Area as area FROM area a, persona p WHERE a.idArea=p.idArea AND p.idusuario='$username'");
  $a_usur = mysqli_fetch_assoc($a_usu);
  
  $a_id=$a_usur['id'];

  $area = mysqli_query($conection, "SELECT idArea as id, Area as area FROM area WHERE idArea!='$a_id' ORDER BY Area ASC");


  //LISTA TRABAJADORES
  
  $trabajad = mysqli_query($conection, "SELECT u.idusuario as usuario,concat(p.apellido,' ',p.nombre) as datos, p.idArea as area FROM persona p, usuario u WHERE u.usuario=p.idusuario AND p.idusuario='$username' AND p.estatus='Activo' and p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC");
  $trabajadr = mysqli_fetch_assoc($trabajad);

  $t_id= $trabajadr['usuario'];
  $t_area = $trabajadr['area'];

  $trabajadores = mysqli_query($conection, "SELECT u.idusuario as usuario,concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u WHERE u.usuario=p.idusuario AND p.idArea='$t_area' AND u.idusuario!='$t_id' AND p.estatus='Activo' and p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC");


  $consulta_nombre = mysqli_query($conection, "SELECT concat(SUBSTRING_INDEX(apellido,' ',1),' ',SUBSTRING_INDEX(nombre,' ',1)) as datoo FROM persona WHERE idusuario='$username'");
  $consulta_nombrer = mysqli_fetch_assoc($consulta_nombre);



  ?>
  