<?php

   //session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../config/configuracion.php";
   require_once "../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
    //CONEXIÓN A BD
    $username = $_SESSION['usu'];
    
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    
    $ids = $consulta_idr['idusuario'];


    $consultar_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario='$username'");
    $respuesta_area = mysqli_fetch_assoc($consultar_area);
    $area = $respuesta_area['area'];
    
    //controlar edicion de registros - cumplimiento - actividades
     
    $act_estado = mysqli_query($conection, "UPDATE autoriza_edicion_supervisor SET estado='2' WHERE idusuario='$ids'");

    

    //contador de proyectos registrados para el usuario logeado

    //Total de Actividades 
    $consultax = mysqli_query($conection, "SELECT count(a.idactividades) as total FROM actividades a, usuario u, persona p  WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado!='5'");
    $consultaax = mysqli_fetch_assoc($consultax);
    
        //Total de Actividades detenidos
        $consultad = mysqli_query($conection, "SELECT count(a.idactividades) as totalPd FROM actividades a, usuario u, persona p  WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PROPIO' AND a.identificador='DIARIO' AND a.estado='4'");
        $consultaad = mysqli_fetch_assoc($consultad);
        
        //Total de Actividades eliminados
        $consulta_eliminados_act = mysqli_query($conection, "SELECT count(a.idactividades) as total FROM actividades a, usuario u, persona p WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PROPIO' AND a.estado='5'");
        $consulta_eliminados_actr = mysqli_fetch_assoc($consulta_eliminados_act);
   //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   
   
    //Total de Actividades participante
    $consultaPA = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalPA FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids') AND a.estado!='5'");
    $consultaaPA = mysqli_fetch_assoc($consultaPA);
    
        //Total de Actividades participante detenidos
        $consultaPAd = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalPAd FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids') AND a.estado='4'");
        $consultaaPAd = mysqli_fetch_assoc($consultaPAd);
        
        //Total de Actividades participante eliminado
        $consulta_eliminados_part = mysqli_query($conection, "SELECT count(pt.idparticipante) as total FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids') AND a.estado='5'");
        $consulta_eliminados_partr = mysqli_fetch_assoc($consulta_eliminados_part);
        
    $tot_participante = $consultaaPA['totalPA'];
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Productos
    $consultaP = mysqli_query($conection, "SELECT count(*) as totalPr FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='PRODUCTO' AND ps.estado!='ELIMINADO'");
    $consultaaP = mysqli_fetch_assoc($consultaP);
    
        //Total de Productos detenidos
        $consultaPd = mysqli_query($conection, "SELECT count(*) as totalPrd FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='PRODUCTO' AND ps.estado='DETENIDO'");
        $consultaaPd = mysqli_fetch_assoc($consultaPd);
        
        //Total de Productos eliminados
        $consulta_eliminados_prod = mysqli_query($conection, "SELECT count(*) as total FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='PRODUCTO' AND ps.estado='ELIMINADO'");
        $consulta_eliminados_prodr = mysqli_fetch_assoc($consulta_eliminados_prod);
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Servicios
    $consultaF = mysqli_query($conection, "SELECT count(*) as totalPf FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='SERVICIO' AND ps.estado!='ELIMINADO'");
    $consultaaF = mysqli_fetch_assoc($consultaF);
    
        //Total de Servicios detenidos
        $consultaFd = mysqli_query($conection, "SELECT count(*) as totalPfd FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='SERVICIO' AND ps.estado='DETENIDO'");
        $consultaaFd = mysqli_fetch_assoc($consultaFd);
        
        //Total de Servicios eliminados
        $consulta_eliminados_serv = mysqli_query($conection, "SELECT count(*) as total FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=ps.responsable AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.categoria='SERVICIO' AND ps.estado='ELIMINADO'");
        $consulta_eliminados_servr = mysqli_fetch_assoc($consulta_eliminados_serv);
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    
    

   //VARIABLES MES Y AÑO
   
        function fechaCastellano ($fecha) {
          $fecha = substr($fecha, 0, 10);
          $mes = date('F', strtotime($fecha));
          $meses_ES = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
          $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
          return $nombreMes;
        }
  
    $des_year = date('Y');
    $des_mes = fechaCastellano(date('Y-m-d'));



    //Variables GRAFICA 01 - ACTIVIDADES
  

   $consultaAN = mysqli_query($conection, "SELECT count(a.idactividades) as AN FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
   AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado='1'");
   $consultaaAN = mysqli_fetch_assoc($consultaAN);

    $consultaAE = mysqli_query($conection, "SELECT count(a.idactividades) AS AE FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado='2'");
    $consultaaAE = mysqli_fetch_assoc($consultaAE);

    $consultaAF = mysqli_query($conection, "SELECT count(a.idactividades) AS AF FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND estado='3'");
    $consultaaAF = mysqli_fetch_assoc($consultaAF);

    


    //Variables GRAFICA 02 - ACTIVIDADES PARTICIPANTES

  //PLANIFICADO
   $consultaAPAN = mysqli_query($conection, "SELECT count(pt.idparticipante) as APAN FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids')  AND a.estado='1'");
   $consultaaAPAN = mysqli_fetch_assoc($consultaAPAN);
   
   $nume1 = $consultaaAPAN['APAN'];
    
    $suma_planificado = $nume1;
   
   //PROCESO
    $consultaAPAE = mysqli_query($conection, "SELECT count(pt.idparticipante) as APAE FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids') AND a.estado='2'");
    $consultaaAPAE = mysqli_fetch_assoc($consultaAPAE);
    
    $nume3 = $consultaaAPAE['APAE'];
    
    $suma_proceso = $nume3;
    
    
    //FINALIZADO
    $consultaAPAF = mysqli_query($conection, "SELECT count(pt.idparticipante) as APAF FROM actividades a, participantes_tareas pt, persona per, usuario u WHERE a.idactividades=pt.idactividad AND per.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.participante!=a.responsable AND (per.idJefeInmediato='$username' OR a.responsable='$ids') AND a.estado='3'");
    $consultaaAPAF = mysqli_fetch_assoc($consultaAPAF);
    
    $nume5 = $consultaaAPAF['APAF'];

    $suma_finalizado= $nume5;
    
    $suma_total_part = $suma_planificado + $suma_proceso + $suma_finalizado;
    
    $tot_participante=$suma_total_part;

    //Variables GRAFICA 03 - PRODUCTOS

    //Productos
    $consultaPN = mysqli_query($conection, "SELECT count(*) AS PN FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario
    AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='PLANIFICADO' AND ps.categoria='PRODUCTO'");
    $consultaaPN = mysqli_fetch_assoc($consultaPN);

    $consultaPE = mysqli_query($conection, "SELECT count(*) AS PE FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='PROCESO' AND ps.categoria='PRODUCTO'");
    $consultaaPE = mysqli_fetch_assoc($consultaPE);

    $consultaPF = mysqli_query($conection, "SELECT count(*) AS PF FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
    $consultaaPF = mysqli_fetch_assoc($consultaPF);

   


    //Variables GRAFICA 04 - SERVICIOS

     //Productos
     $consultaSN = mysqli_query($conection, "SELECT count(*) AS SN FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario 
     AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='PLANIFICADO' AND ps.categoria='SERVICIO'");
     $consultaaSN = mysqli_fetch_assoc($consultaSN);

     $consultaSE = mysqli_query($conection, "SELECT count(*) AS SE FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario 
     AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='PROCESO' AND ps.categoria='SERVICIO'");
     $consultaaSE = mysqli_fetch_assoc($consultaSE);

     $consultaSF = mysqli_query($conection, "SELECT count(*) AS SF FROM producto_servicio ps, usuario u, persona p WHERE u.usuario=p.idusuario AND ps.responsable=u.idusuario 
     AND (p.idJefeInmediato='$username' OR ps.responsable='$ids') AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $consultaaSF = mysqli_fetch_assoc($consultaSF);

    



    ?>