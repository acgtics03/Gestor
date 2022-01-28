<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

$hora = time();
$fec = date('Y-m-d');

$vap = $_GET['SV'];

$vercontrol = mysqli_query($conection, "SELECT * FROM control WHERE user='$username'");
$vercontrolr = mysqli_num_rows($vercontrol);
$vercontrolrr = mysqli_fetch_assoc($vercontrol);

if(empty($vap)){

    $resultadps = $vercontrolrr['valor'];
}else{
    if($vercontrolr > 0){
        $actualiza = mysqli_query($conection, "UPDATE control SET valor='$vap' WHERE user='$username'");
        $vervalor = mysqli_query($conection, "SELECT valor FROM control WHERE user='$username'");
        $vervalorr = mysqli_fetch_assoc($vervalor);
        
        $resultadps = $vervalorr['valor'];
        
    }else{
        $inserta = mysqli_query($conection, "INSERT INTO control(user, valor) VALUES ('$username', '$vap')");
        $vervalor2 = mysqli_query($conection, "SELECT valor FROM control WHERE user='$username'");
        $vervalor2r = mysqli_fetch_assoc($vervalor2);
        
        $resultadps = $vervalor2r['valor'];
    }
}

$variable = $resultadps;

$consulta = mysqli_query($conection, "SELECT ps.idps as ID,  ps.categoria as tipo, t.nombre as nombre, ps.estado as estado, concat(p.apellido,' ',p.nombre) as responsable, ps.descripcion as descripcion, ps.fecinicio as inicio, 
ps.fecfin as final, ps.fecinicioReal as inicioreal, ps.fecfinReal as finreal, cc.sDescripcion as empresa, a.Area as area, ps.responsable as respons FROM producto_servicio ps, tipos t,persona p, usuario u, centrocosto cc, area a WHERE ps.area=a.idArea 
AND ps.empresa=cc.iCodigo AND ps.responsable=u.idusuario AND t.idgestion=ps.nombre AND u.usuario=p.idusuario AND ps.idps='$variable'");
$consultar = mysqli_fetch_assoc($consulta);

$estado = $consultar['estado'];
$nomps = $consultar['nombre'];
$tp = $consultar['tipo'];
$resp = $consultar['respons'];
$idd = $consultar['ID'];

$_SESSION['est'] = $estado;
$_SESSION['tipo']= $tp;
$_SESSION['nomps']= $nomps;
$_SESSION['re'] = $resp;
$_SESSION['idds'] = $idd;

$_SESSION['id_principal']=$variable;
  
$consult = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u WHERE u.usuario=p.idusuario AND p.estatus='Activo' and p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC");

$verParticipantes = mysqli_query($conection, "SELECT concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as datos, a.Area as area, p.idusuario as correo FROM participantes ap, producto_servicio ps, persona p, usuario u, area a WHERE ps.idps=ap.idps 
AND ap.participante=u.idusuario AND u.usuario=p.idusuario AND p.idarea=a.idArea AND ap.estado='activo' AND ap.idps='$variable'");


//GRAFICAS

 $datodia = date('Y-m-d');

 $ind1 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE fecha='$fec' AND identificador='$tp' AND estado='PLANIFICADO' AND vinculo='$variable'");
 $ind11 = mysqli_fetch_assoc($ind1);

 $ind2 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE fecha='$fec' AND identificador='$tp' AND estado='PROCESO' AND vinculo='$variable'");
 $ind22 = mysqli_fetch_assoc($ind2);

 $ind3 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE fecha='$fec' AND identificador='$tp' AND estado='FINALIZADO' AND vinculo='$variable'");
 $ind33 = mysqli_fetch_assoc($ind3);

 $ind4 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE fecha='$fec' AND identificador='$tp' AND estado='DETENIDO' AND vinculo='$variable'");
 $ind44 = mysqli_fetch_assoc($ind4);

 //02

 $datomes = date('M');

 $ind5 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE identificador='$tp' AND estado='PLANIFICADO' AND vinculo='$variable'");
 $ind55 = mysqli_fetch_assoc($ind5);

 $ind6 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE identificador='$tp' AND estado='PROCESO' AND vinculo='$variable'");
 $ind66 = mysqli_fetch_assoc($ind6);

 $ind7 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE identificador='$tp' AND estado='FINALIZADO' AND vinculo='$variable'");
 $ind77 = mysqli_fetch_assoc($ind7);

 $ind8 = mysqli_query($conection, "SELECT COUNT(*) as total FROM actividades WHERE identificador='$tp' AND estado='DETENIDO' AND vinculo='$variable'");
 $ind88 = mysqli_fetch_assoc($ind8);


 $con = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u, participantes pr  
                                  WHERE p.idusuario=u.usuario AND u.idusuario=pr.participante AND pr.idps='$variable' ORDER BY p.apellido ASC");

$estadospsa = mysqli_query($conection, "SELECT idpsa as ID, nombre as datos FROM estados_psa WHERE (idpsa='1' OR idpsa='2') AND estado='Activo' ORDER BY nombre ASC"); 


                                                
 $ver_Area = mysqli_query($conection, "SELECT idArea FROM persona WHERE idusuario='$username'");
 $ver_Arear = mysqli_fetch_assoc($ver_Area);
                                                
 $idArea = $ver_Arear['idArea'];
                                               
 $consulta = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u WHERE p.idusuario=u.usuario AND  p.estatus='Activo' AND p.idArea='$idArea' ORDER BY p.apellido ASC"); 


//FILTROS DE BUSQUEDA

     $finicio = $_POST['fecini'];
    $finicio = $_POST['fecini'];
    $ffin = $_POST['fecfin'];
    $boxresponsable = $_POST['boxresponsable'];
    $boxtipo = $_POST['boxtipo'];
    $boxestado = $_POST['boxestado'];
 
                              
                              if(isset($_POST['btnReasignar'])){
 
 
                                      if((empty($ffin) && empty($boxresponsable)) && (empty($boxtipo) && empty($boxestado))){
                                          $variable_1 = "AND ps.fecinicio > '$finicio'";
                                        }else{
                                            if((empty($finicio) && empty($boxresponsable)) && (empty($boxtipo) && empty($boxestado))){
                                             $variable_2 = "AND ps.fecinicio < '$ffin'";
                                            }else{
                                                if(empty($boxresponsable) && (empty($boxtipo) && empty($boxestado))){
                                                  $variable_3 = "AND ps.fecinicio BETWEEN '$finicio' AND '$ffin'";
                                                }else{
                                                   if((empty($finicio) && empty($ffin)) && (empty($boxtipo) && empty($boxestado))){
                                                      if($boxresponsable=="Todos"){ 
                                                         $variable_4 = "";
                                                      }else{
                                                         $variable_4 = "AND ps.responsable='$boxresponsable'";
                                                      }
                                                    }else{
                                                      if((empty($finicio) && empty($ffin)) && (empty($boxresponsable) && empty($boxestado))){
                                                              if($boxtipo=="Todos"){ 
                                                                $variable_5 = "AND (ps.categoria='PRODUCTO' OR ps.categoria='SERVICIO')";
                                                              }else{
                                                                $variable_5 = "AND ps.categoria='$boxtipo'";  
                                                              }
                                                          }else{
                                                             if((empty($finicio) && empty($ffin)) && (empty($boxresponsable) && empty($boxtipo))){
                                                                  if($boxestado=="Todos"){ 
                                                                    $variable_5 = "AND (ps.estado='PLANIFICADO' OR ps.estado='PROCESO')";
                                                                  }else{
                                                                    $variable_5 = "AND ps.estado='$boxestado'";  
                                                                  }
                                                              }else{
                                                                 
                                                             }
                                                         }   
                                                    } 
                                                }
                                            }
                                        }
                                     
                                         //COMPLETAR TABLA 
                                        $consultaAct2 = mysqli_query($conection, "SELECT ps.idps as ID, ps.categoria as tipo, cc.sDescripcion as cliente, t.nombre as nombre, concat(p.apellido,' ',p.nombre) as responsable, 
                                        ps.fecinicio as inicio, ps.fecfin as termino, ps.descripcion as descripcion, ps.estado as estado  FROM producto_servicio ps, persona p, centrocosto cc, usuario u, tipos t WHERE p.idusuario=u.usuario AND 
                                        ps.responsable=u.idusuario AND t.idgestion=ps.nombre AND ps.empresa=cc.iCodigo AND (ps.estado!='FINALIZADO' AND ps.estado!='DETENIDO' AND ps.estado!='ELIMINADO') AND (p.idJefeInmediato='$username' OR p.idusuario='$username')
                                        $variable_1 $variable_2 $variable_3 $variable_4 $variable_5 ORDER BY ps.fecinicio ASC");
                                    
                                    }                      




?>