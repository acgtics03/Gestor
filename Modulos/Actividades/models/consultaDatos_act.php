<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

$hora = time();
$fec = date('Y-m-d');

$variable_ruta = $_GET['CA'];

$consulta_dato = mysqli_query($conection, "SELECT valor as valor FROM control_act WHERE user='$username'");
$consulta_dator = mysqli_num_rows($consulta_dato);
$consulta_datos= mysqli_fetch_assoc($consulta_dato);

if(empty($variable_ruta)){
    $nueva_variable = $consulta_datos['valor'];
}else{
    if($consulta_dator > 0){
        $actualiza = mysqli_query($conection, "UPDATE control_act SET valor='$variable_ruta' WHERE user='$username'");
        $consulta_valor = mysqli_query($conection, "SELECT valor as valor FROM control_act WHERE user='$username'");
        $consulta_valorr = mysqli_fetch_assoc($consulta_valor);
        
        $nueva_variable = $consulta_valorr['valor'];
        
    }else{
        $insertar = mysqli_query($conection, "INSERT INTO control_act(valor, user) VALUES ('$variable_ruta','$username')");
        $consulta_valor2 = mysqli_query($conection, "SELECT valor as valor FROM control WHERE user='$username'");
        $consulta_valor2r = mysqli_fetch_assoc($consulta_valor2);
        
        $nueva_variable = $consulta_valor2r['valor'];
    }
    }
    
    $variable_act = $nueva_variable;
    
    $consulta = mysqli_query($conection, "SELECT a.idactividades as IDact, p.idusuario as IDper, t.nombre as nombre, a.descripcion as descripcion, a.responsable as respons, concat(p.apellido,' ',p.nombre) as datos ,
    cc.sDescripcion as cliente, ar.Area as tipo, a.estado as estado, a.fecha as fecini, a.fechafin as fecfin, date_format(a.Horaini, '%H:%i') as horainicio, date_format(a.Horafin, '%H:%i') as Horafin, a.responsable as respons FROM actividades a, persona p, usuario u, 
    area ar, centrocosto cc, tipos t WHERE t.idgestion=a.nombre AND a.responsable=u.idusuario AND u.usuario=p.idusuario AND p.idArea=ar.idArea AND cc.iCodigo=a.empresa 
    AND a.idactividades='$variable_act'");
    $consultar = mysqli_fetch_assoc($consulta);
    
    $estado = $consultar['estado'];
    $nomps = $consultar['nombre'];
    $tp = $consultar['tipo'];
    $rep= $consultar['respons'];
    $ida = $consultar['IDper'];
    
    $_SESSION['est'] = $estado;
    $_SESSION['tipo']= $tp;
    $_SESSION['nomps']= $nomps;
    $_SESSION['rp']= $rep;
    $_SESSION['idact']=$ida;
      
    $consult = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, usuario u WHERE u.usuario=p.idusuario AND p.estatus='Activo' and p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC");
    
    $verParticipantes = mysqli_query($conection, "SELECT idparticipante as IDp, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as datos, a.Area as area, p.idusuario as user 
    FROM participantes_tareas ap, actividades ps, persona p, area a , usuario u
    WHERE  ps.idactividades=ap.idactividad AND ap.participante=u.idusuario AND u.usuario=p.idusuario AND p.idarea=a.idArea AND ap.estado='activo' AND ap.idactividad='$variable_act'");
    
    
    //GRAFICAS
    
     $datodia = date('Y-m-d');
    
     $ind1 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE fecha='$fec' AND estado='PLANIFICADO' AND vinculo='$variable_act'");
     $ind11 = mysqli_fetch_assoc($ind1);
    
     $ind2 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE fecha='$fec' AND estado='PROCESO' AND vinculo='$variable_act'");
     $ind22 = mysqli_fetch_assoc($ind2);
    
     $ind3 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE fecha='$fec' AND estado='FINALIZADO' AND vinculo='$variable_act'");
     $ind33 = mysqli_fetch_assoc($ind3);
    
     $ind4 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE fecha='$fec' AND estado='DETENIDO' AND vinculo='$variable_act'");
     $ind44 = mysqli_fetch_assoc($ind4);
    
     //02
    
     $datomes = date('M');
    
     $ind5 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE estado='PLANIFICADO' AND vinculo='$variable_act'");
     $ind55 = mysqli_fetch_assoc($ind5);
    
     $ind6 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE estado='PROCESO' AND vinculo='$variable_act'");
     $ind66 = mysqli_fetch_assoc($ind6);
    
     $ind7 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE estado='FINALIZADO' AND vinculo='$variable_act'");
     $ind77 = mysqli_fetch_assoc($ind7);
    
     $ind8 = mysqli_query($conection, "SELECT COUNT(*) as total FROM tareas WHERE estado='DETENIDO' AND vinculo='$variable_act'");
     $ind88 = mysqli_fetch_assoc($ind8);
    
    
     $con = mysqli_query($conection, "SELECT p.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p, participantes_tareas pr  
                                      WHERE p.idusuario=pr.participante AND pr.idactividad='$variable_act' ORDER BY p.apellido ASC");



?>