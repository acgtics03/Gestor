<?php

    date_default_timezone_set('America/Lima');
    session_start();
    $hora = date("H:i:s", time());;
    $fecha = date('Y-m-d');
    //CONEXIÓN A BD
    require 'conexion.php';
    $username = $_SESSION['user'];
    
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    
    $ids = $consulta_idr['idusuario'];
    
    //controlar edicion de registros - cumplimiento - actividades
     
    $act_estado = mysqli_query($conection, "UPDATE autoriza_edicion_supervisor SET estado='2' WHERE idusuario='$ids'");

      if(empty($username)){ 
          session_destroy();
            echo '<script type="text/javascript">';
            echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
            echo '</script>';
            echo '<script type="text/javascript">';
            echo 'location.href="../../../index.php"';
            echo '</script>';
        } 

    //contador de proyectos registrados para el usuario logeado

    //Total de Actividades 
    $consultax = mysqli_query($conection, "SELECT count(*) as total FROM actividades a, usuario u, persona p  WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado!='ELIMINADO'");
    $consultaax = mysqli_fetch_assoc($consultax);
    
        //Total de Actividades detenidos
        $consultad = mysqli_query($conection, "SELECT count(*) as totalPd FROM actividades a, usuario u, persona p  WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PROPIO' AND a.identificador='DIARIO' AND a.estado='DETENIDO'");
        $consultaad = mysqli_fetch_assoc($consultad);
        
        //Total de Actividades eliminados
        $consulta_eliminados_act = mysqli_query($conection, "SELECT count(*) as total FROM actividades a, usuario u, persona p WHERE a.responsable=u.idusuario AND u.usuario=p.idusuario AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PROPIO' AND a.estado='ELIMINADO'");
        $consulta_eliminados_actr = mysqli_fetch_assoc($consulta_eliminados_act);
   //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   
   
    //Total de Actividades participante
    $consultaPA = mysqli_query($conection, "SELECT count(*) as totalPA FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PARTICIPANTE' AND a.estado!='ELIMINADO'");
    $consultaaPA = mysqli_fetch_assoc($consultaPA);
    
        //Total de Actividades participante detenidos
        $consultaPAd = mysqli_query($conection, "SELECT count(*) as totalPAd FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PARTICIPANTE' AND a.estado='DETENIDO'");
        $consultaaPAd = mysqli_fetch_assoc($consultaPAd);
        
        //Total de Actividades participante eliminado
        $consulta_eliminados_part = mysqli_query($conection, "SELECT count(*) as total FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.tipo_actividad='PARTICIPANTE' AND a.estado='ELIMINADO'");
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
  

   $consultaAN = mysqli_query($conection, "SELECT count(*) as AN FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
   AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado='PLANIFICADO'");
   $consultaaAN = mysqli_fetch_assoc($consultaAN);

    $consultaAE = mysqli_query($conection, "SELECT count(*) AS AE FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND a.estado='PROCESO'");
    $consultaaAE = mysqli_fetch_assoc($consultaAE);

    $consultaAF = mysqli_query($conection, "SELECT count(*) AS AF FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND (p.idJefeInmediato='$username' OR a.responsable='$ids') AND a.identificador='DIARIO' AND estado='FINALIZADO'");
    $consultaaAF = mysqli_fetch_assoc($consultaAF);

    


    //Variables GRAFICA 02 - ACTIVIDADES PARTICIPANTES

  //PLANIFICADO
   $consultaAPAN = mysqli_query($conection, "SELECT count(*) as APAN FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
   AND p.idJefeInmediato='$username' AND estado='PLANIFICADO'");
   $consultaaAPAN = mysqli_fetch_assoc($consultaAPAN);
   
   $nume1 = $consultaaAPAN['APAN'];
   
   $consultaTAR2 = mysqli_query($conection, "SELECT count(*) as Total_Tarea2 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable 
     AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username' AND t.estado='PLANIFICADO'");
    $consultaaTAR2 = mysqli_fetch_assoc($consultaTAR2);
    
   $nume2 = $consultaaTAR2['Total_Tarea2'];
    
    $suma_planificado = $nume1 + $nume2;
   
   //PROCESO
    $consultaAPAE = mysqli_query($conection, "SELECT count(*) AS APAE FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND p.idJefeInmediato='$username' AND a.estado='PROCESO'");
    $consultaaAPAE = mysqli_fetch_assoc($consultaAPAE);
    
    $nume3 = $consultaaAPAE['APAE'];
    
    $consultaTAR3 = mysqli_query($conection, "SELECT count(*) as Total_Tarea3 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable 
    AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username' AND t.estado='PROCESO'");
    $consultaaTAR3 = mysqli_fetch_assoc($consultaTAR3);
    
    $nume4 = $consultaaTAR3['Total_Tarea3'];
    
    $suma_proceso = $nume3 + $nume4;
    
    
    //FINALIZADO
    $consultaAPAF = mysqli_query($conection, "SELECT count(*) AS APAF FROM actividades a, usuario u, persona p WHERE u.usuario=p.idusuario AND a.responsable=u.idusuario 
    AND p.idJefeInmediato='$username'  AND a.estado='FINALIZADO'");
    $consultaaAPAF = mysqli_fetch_assoc($consultaAPAF);
    
    $nume5 = $consultaaAPAF['APAF'];

    $consultaTAR4 = mysqli_query($conection, "SELECT count(*) as Total_Tarea4 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable 
    AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username' AND t.estado='FINALIZADO'");
    $consultaaTAR4 = mysqli_fetch_assoc($consultaTAR4);
    
    $nume6 = $consultaaTAR4['Total_Tarea4'];

    $suma_finalizado= $nume5 + $nume6;
    
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