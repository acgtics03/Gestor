<?php

    date_default_timezone_set('America/Lima');
    //session_start();
    $hora = date("H:i:s", time());;
    $fecha = date('Y-m-d');
    //CONEXIÓN A BD
    require 'conexion.php';
    $username = $_SESSION['user'];
    
     if(empty($username)){
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="../../../index.php"';
        echo '</script>';
    }
    
    
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    
    $ids = $consulta_idr['idusuario'];

    //contador de proyectos registrados para el usuario logeado

    //Total de Actividades 
    $consultax = mysqli_query($conection, "SELECT count(*) as total FROM actividades  WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado!='ELIMINADO'");
    $consultaax = mysqli_fetch_assoc($consultax);
    
        //Total de Actividades detenidos
        $consultad = mysqli_query($conection, "SELECT count(*) as totalPd FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND identificador='DIARIO' AND estado='DETENIDO'");
        $consultaad = mysqli_fetch_assoc($consultad);
        
        //Total de Actividades eliminados
        $consulta_eliminados_act = mysqli_query($conection, "SELECT count(*) as total FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='ELIMINADO'");
        $consulta_eliminados_actr = mysqli_fetch_assoc($consulta_eliminados_act);
   //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   $consulta_carg = mysqli_query($conection, "SELECT idCargo as cargo FROM persona WHERE idusuario='$username'");
   $consulta_cg = mysqli_fetch_assoc($consulta_carg);
   
   $ica = $consulta_cg['cargo'];
   
   if($ica=='2' || $ica=='9'){
   
    //Total de Actividades participante
    $consultaPA = mysqli_query($conection, "SELECT count(*) as totalPA FROM actividades a, usuario u, persona p WHERE p.idusuario=u.usuario AND u.idusuario=a.responsable 
    AND p.idJefeInmediato='$username' AND a.estado!='ELIMINADO'");
    $consultaaPA = mysqli_fetch_assoc($consultaPA);

    $consultaPT = mysqli_query($conection, "SELECT count(*) as totalPT FROM tareas t,usuario u, persona p  WHERE p.idusuario=u.usuario AND u.idusuario=t.responsable 
    AND p.idJefeInmediato='$username' AND t.estado!='ELIMINADO'");
    $consultaaPT = mysqli_fetch_assoc($consultaPT);
    
    $var_1 = $consultaaPA['totalPA'];
    $var_2 = $consultaaPT['totalPT'];

    $suma_actividadesp = $var_1 + $var_2;

    
        //Total de Actividades participante detenidos
        $consultaPAd = mysqli_query($conection, "SELECT count(*) as totalPAd FROM actividades a, usuario u, persona p WHERE p.idusuario=u.usuario AND u.idusuario=a.responsable 
        AND p.idJefeInmediato='$username' AND a.tipo_actividad='PARTICIPANTE'  AND a.estado='DETENIDO'");
        $consultaaPAdd = mysqli_fetch_assoc($consultaPAd);

        $consultaPTd = mysqli_query($conection, "SELECT count(*) as totalPTd FROM tareas t,usuario u, persona p  WHERE p.idusuario=u.usuario AND u.idusuario=t.responsable 
        AND p.idJefeInmediato='$username' AND t.estado='DETENIDO'");
        $consultaaPTd = mysqli_fetch_assoc($consultaPTd);

        $vard_1 = $consultaaPAdd['totalPAd'];
        $vard_2 = $consultaaPTd['totalPTd'];

        $total_actividadesd = $vard_1 + $vard_2;
        
        //Total de Actividades participante eliminado
        $consulta_eliminados_part = mysqli_query($conection, "SELECT count(*) as total FROM actividades a, usuario u, persona p WHERE p.idusuario=u.usuario AND u.idusuario=a.responsable AND 
        p.idJefeInmediato='$username' AND tipo_actividad='PARTICIPANTE' AND estado='ELIMINADO'");
        $consulta_eliminados_partr = mysqli_fetch_assoc($consulta_eliminados_part);

        $consulta_eliminados_tareas = mysqli_query($conection, "SELECT count(*) as total FROM tareas t,usuario u, persona p  WHERE p.idusuario=u.usuario AND u.idusuario=t.responsable AND 
        p.idJefeInmediato='$username' AND estado='ELIMINADO'");
        $consulta_eliminados_tareasr = mysqli_fetch_assoc($consulta_eliminados_tareas);

        $vare_1 = $consulta_eliminados_partr['total'];
        $vare_2 = $consulta_eliminados_tareasr['total'];

        $total_actividadese = $vare_1 + $vare_2;

   }else{

        //Total de Actividades participante
   /* $consultaPA = mysqli_query($conection, "SELECT count(*) as totalPA FROM actividades WHERE responsable='$ids' AND identificador!='DIARIO' AND estado!='ELIMINADO'");
    $consultaaPA = mysqli_fetch_assoc($consultaPA);

    $consultaPT = mysqli_query($conection, "SELECT count(*) as totalPT FROM tareas WHERE responsable='$ids' AND estado!='ELIMINADO'");
    $consultaaPT = mysqli_fetch_assoc($consultaPT);*/
    
    $consultaPT = mysqli_query($conection, "SELECT count(*) as APAN FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND (a.estado='PLANIFICADO' OR a.estado='PROCESO' OR a.estado='FINALIZADO') AND a.responsable!='$ids'");
    $consultaaPT = mysqli_fetch_assoc($consultaPT);
    
   // $var_1 = $consultaaPA['totalPA'];
    $var_2 = $consultaaPT['APAN'];

    $suma_actividadesp =  $var_2;

    
        //Total de Actividades participante detenidos
       /* $consultaPAd = mysqli_query($conection, "SELECT count(*) as totalPAd FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND responsable='$ids' AND estado='DETENIDO'");
        $consultaaPAdd = mysqli_fetch_assoc($consultaPAd);

        $consultaPTd = mysqli_query($conection, "SELECT count(*) as totalPTd FROM tareas WHERE responsable='$ids' AND estado='DETENIDO'");
        $consultaaPTd = mysqli_fetch_assoc($consultaPTd);*/
        
        $consultaPTd = mysqli_query($conection, "SELECT count(*) as APAN FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='DETENIDO' AND a.responsable!='$ids'");
        $consultaaPTd = mysqli_fetch_assoc($consultaPTd);
        

        //$vard_1 = $consultaaPAdd['totalPAd'];
        $vard_2 = $consultaaPTd['APAN'];

        $total_actividadesd = $vard_2;
        
        //Total de Actividades participante eliminado
       /* $consulta_eliminados_part = mysqli_query($conection, "SELECT count(*) as total FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND responsable='$ids' AND estado='ELIMINADO'");
        $consulta_eliminados_partr = mysqli_fetch_assoc($consulta_eliminados_part);

        $consulta_eliminados_tareas = mysqli_query($conection, "SELECT count(*) as total FROM tareas WHERE responsable='$ids' AND estado='ELIMINADO'");
        $consulta_eliminados_tareasr = mysqli_fetch_assoc($consulta_eliminados_tareas);*/
        
        $consulta_eliminados_tareas = mysqli_query($conection, " SELECT count(*) as APAN FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='ELIMINADO' AND a.responsable!='$ids'");
        $consulta_eliminados_tareasr = mysqli_fetch_assoc($consulta_eliminados_tareas);

        //$vare_1 = $consulta_eliminados_partr['total'];
        $vare_2 = $consulta_eliminados_tareasr['APAN'];

        $total_actividadese =  $vare_2;
   }   

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Productos
    $consultaP = mysqli_query($conection, "SELECT count(*) as totalPr FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado!='ELIMINADO'");
    $consultaaP = mysqli_fetch_assoc($consultaP);
    
        //Total de Productos detenidos
        $consultaPd = mysqli_query($conection, "SELECT count(*) as totalPrd FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado='DETENIDO'");
        $consultaaPd = mysqli_fetch_assoc($consultaPd);
        
        //Total de Productos eliminados
        $consulta_eliminados_prod = mysqli_query($conection, "SELECT count(*) as total FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado='ELIMINADO'");
        $consulta_eliminados_prodr = mysqli_fetch_assoc($consulta_eliminados_prod);
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Servicios
    $consultaF = mysqli_query($conection, "SELECT count(*) as totalPf FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado!='ELIMINADO'");
    $consultaaF = mysqli_fetch_assoc($consultaF);
    
        //Total de Servicios detenidos
        $consultaFd = mysqli_query($conection, "SELECT count(*) as totalPfd FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado='DETENIDO'");
        $consultaaFd = mysqli_fetch_assoc($consultaFd);
        
        //Total de Servicios eliminados
        $consulta_eliminados_serv = mysqli_query($conection, "SELECT count(*) as total FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado='ELIMINADO'");
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
  
    $consultaAT = mysqli_query($conection, "SELECT count(*) as ATT FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids'");
    $consultaaAT = mysqli_fetch_assoc($consultaAT);

   $consultaAN = mysqli_query($conection, "SELECT count(*) as AN FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='PLANIFICADO'");
   $consultaaAN = mysqli_fetch_assoc($consultaAN);

    $consultaAE = mysqli_query($conection, "SELECT count(*) AS AE FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='PROCESO'");
    $consultaaAE = mysqli_fetch_assoc($consultaAE);

    $consultaAF = mysqli_query($conection, "SELECT count(*) AS AF FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='FINALIZADO'");
    $consultaaAF = mysqli_fetch_assoc($consultaAF);

    //Resumen tabla - Actividades

        //dia
        
        $consultaDP = mysqli_query($conection, "SELECT count(*) as TotDP FROM actividades WHERE tipo_actividad='PROPIO' AND fecha='$fecha' AND responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaDP = mysqli_fetch_assoc($consultaDP);

        $consultaDPC = mysqli_query($conection, "SELECT count(*) as TotDPC FROM actividades WHERE tipo_actividad='PROPIO' AND fecha='$fecha' AND responsable='$ids' AND estado='PROCESO'");
        $consultaaDPC = mysqli_fetch_assoc($consultaDPC);

        $consultaDF = mysqli_query($conection, "SELECT count(*) as TotDF FROM actividades WHERE tipo_actividad='PROPIO' AND fechafin='$fecha' AND responsable='$ids' AND estado='FINALIZADO'");
        $consultaaDF = mysqli_fetch_assoc($consultaDF);

        $SUMAADia = $consultaaDP['TotDP'] + $consultaaDF['TotDF']; 

        //Semana

        $dia = date('l');
        $fechaas = date('Y-m-d');

        if ($dia == 'Monday') {
            $inicio = $fechaas;
            $final = date("Y-m-d", strtotime($fechaas . "+ 4 days"));
            $d = $dia;
        } else {
            if ($dia == 'Tuesday') {
                $inicio = date("Y-m-d", strtotime($fechaas . "- 1 days"));
                $actual = $fechaas;
                $final = date("Y-m-d", strtotime($fechaas . "+ 3 days"));
                $d = $dia;
            } else {
                if ($dia == 'Wednesday') {
                    $inicio = date("Y-m-d", strtotime($fechaas . "- 2 days"));
                    $actual = $fechaas;
                    $final = date("Y-m-d", strtotime($fechaas . "+ 2 days"));
                    $d = $dia;
                } else {
                    if ($dia == 'Thursday') {
                        $inicio = date("Y-m-d", strtotime($fechaas . "- 3 days"));
                        $actual = $fechaas;
                        $final = date("Y-m-d", strtotime($fechaas . "+ 1 days"));
                        $d = $dia;
                    } else {
                        if ($dia == 'Friday') {
                            $inicio = date("Y-m-d", strtotime($fechaas . "- 4 days"));
                            $actual = $fechaas;
                            $final = date("Y-m-d", strtotime($fechaas . "+ 0 days"));
                            $d = $dia;
                        } else {
                            if ($dia == 'Saturday') {
                                $inicio = date("Y-m-d", strtotime($fechaas . "- 5 days"));
                                $actual = $fechaas;
                                $final = date("Y-m-d", strtotime($fechaas . "- 1 days"));
                                $d = $dia;
                            } else {
                                if ($dia == 'Sunday') {
                                    $inicio = date("Y-m-d", strtotime($fechaas . "- 6 days"));
                                    $actual = $fechaas;
                                    $final = date("Y-m-d", strtotime($fechaas . "- 2 days"));
                                    $d = $dia;
                                }
                            }
                        }
                    }
                }
            }
        }

        $consultaSemP = mysqli_query($conection, "SELECT count(*) as TotSemP FROM actividades WHERE tipo_actividad='PROPIO' AND fecha BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaSemP = mysqli_fetch_assoc($consultaSemP);

        $consultaSemPC = mysqli_query($conection, "SELECT count(*) as TotSemPC FROM actividades WHERE tipo_actividad='PROPIO' AND fecha BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='PROCESO'");
        $consultaaSemPC = mysqli_fetch_assoc($consultaSemPC);

        $consultaSemF = mysqli_query($conection, "SELECT count(*) as TotSemF FROM actividades WHERE tipo_actividad='PROPIO' AND fechafin BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='FINALIZADO'");
        $consultaaSemF = mysqli_fetch_assoc($consultaSemF);

        $SUMAASem = $consultaaSemP['TotSemP'] + $consultaaSemF['TotSemF'];

        //Mes

        $consultaMesP = mysqli_query($conection, "SELECT count(*) as TotMesP FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaMesP = mysqli_fetch_assoc($consultaMesP);

        $consultaMesPC = mysqli_query($conection, "SELECT count(*) as TotMesPC FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND estado='PROCESO'");
        $consultaaMesPC = mysqli_fetch_assoc($consultaMesPC);

        $consultaMesF = mysqli_query($conection, "SELECT count(*) as TotMesF FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fechafin) = MONTH('$fecha') and responsable='$ids' AND estado='FINALIZADO'");
        $consultaaMesF = mysqli_fetch_assoc($consultaMesF);

        $SUMAAMes = $consultaaMesP['TotMesP'] + $consultaaMesF['TotMesF'];


    //Variables GRAFICA 02 - ACTIVIDADES PARTICIPANTES
    
    
    $consulta_cargo = mysqli_query($conection, "SELECT idCargo as cargo FROM persona WHERE idusuario='$username'");
    $consulta_cgo = mysqli_fetch_assoc($consulta_cargo);
    
    $icar = $consulta_cgo['cargo'];
    
    if($icar=='2' || $icar=='9'){
        
        
        // Estado : TOTAL
        
        $consultaACT = mysqli_query($conection, "SELECT count(*) as Total_Actividades1 FROM actividades a, persona p , usuario u WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable 
        AND a.tipo_actividad='PARTICIPANTE' AND a.fecha='$fecha' AND (p.idJefeInmediato='$username' OR a.responsable='$ids')");
        $consultaaACT = mysqli_fetch_assoc($consultaACT);
        
        $consultaTAR = mysqli_query($conection, "SELECT count(*) as Total_Tarea1 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable AND t.tipo_tarea='PARTICIPANTE' AND (p.idJefeInmediato='$username' OR t.responsable='$ids')");
        $consultaaTAR = mysqli_fetch_assoc($consultaTAR);
        
        $SUM1 = $consultaaACT['Total_Actividades1'] + $consultaaTAR['Total_Tarea1'];
        
        
        // Estado : PLANIFICADO
        
        $consultaACT2= mysqli_query($conection, "SELECT count(*) as Total_Actividad2 FROM actividades a, persona p , usuario u WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable 
        AND p.idJefeInmediato='$username' AND a.estado='PLANIFICADO'");
        $consultaaACT2 = mysqli_fetch_assoc($consultaACT2);
        
        $consultaTAR2 = mysqli_query($conection, "SELECT count(*) as Total_Tarea2 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable 
        AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username' AND t.estado='PLANIFICADO'");
        $consultaaTAR2 = mysqli_fetch_assoc($consultaTAR2);
        
        $totalSUM2 = $consultaaACT2['Total_Actividad2'] + $consultaaTAR2['Total_Tarea2'];
        
        
        // Estado : PROCESO

        $consultaACT3 = mysqli_query($conection, "SELECT count(*) AS Total_Actividad3 FROM actividades a, persona p , usuario u WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable 
        AND p.idJefeInmediato='$username' AND a.estado='PROCESO'");
        $consultaaACT3= mysqli_fetch_assoc($consultaACT3);
        
        $consultaTAR3 = mysqli_query($conection, "SELECT count(*) as Total_Tarea3 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username'  AND t.estado='PROCESO'");
        $consultaaTAR3 = mysqli_fetch_assoc($consultaTAR3);
        
        $totalSUM3 = $consultaaACT3['Total_Actividad3'] + $consultaaTAR3['Total_Tarea3'];
        
        // Estado : FINALIZADO
    
        $consultaACT4 = mysqli_query($conection, "SELECT count(*) AS Total_Actividad4 FROM actividades a, persona p , usuario u WHERE u.usuario=p.idusuario AND u.idusuario=a.responsable 
        AND p.idJefeInmediato='$username' AND a.estado='FINALIZADO'");
        $consultaaACT4 = mysqli_fetch_assoc($consultaACT4);
        
        $consultaTAR4 = mysqli_query($conection, "SELECT count(*) as Total_Tarea4 FROM tareas t, persona p , usuario u  WHERE u.usuario=p.idusuario AND u.idusuario=t.responsable 
        AND t.tipo_tarea='PARTICIPANTE' AND p.idJefeInmediato='$username' AND t.estado='FINALIZADO'");
        $consultaaTAR4 = mysqli_fetch_assoc($consultaTAR4);
        
        $totalSUM4 = $consultaaACT4['Total_Actividad4'] + $consultaaTAR4['Total_Tarea4'];
         
        $tot_participante = $totalSUM2 + $totalSUM3 + $totalSUM4;
    }else{
    

        $consultaAPAT = mysqli_query($conection, "SELECT count(*) as APATT FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND responsable='$ids'");
        $consultaaAPAT = mysqli_fetch_assoc($consultaAT);

        $SUM1 = $consultaaAPAT['APATT'];

        //ACTIVIDADES EN PARTICIPACION : ESTADO = PLANIFICADO

        /*$consultaAPAN = mysqli_query($conection, "SELECT count(*) as APAN FROM actividades WHERE identificador!='DIARIO' AND responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaAPAN = mysqli_fetch_assoc($consultaAPAN);

        $consultaAPANN = mysqli_query($conection, "SELECT count(*) as APAN FROM tareas WHERE responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaAPANN = mysqli_fetch_assoc($consultaAPANN);*/
        
        $consultaAPPart = mysqli_query($conection, "SELECT count(*) as APAN FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PLANIFICADO' AND a.responsable!='$ids'");
        $consultaaAPPart = mysqli_fetch_assoc($consultaAPPart);
        
        //$SUM2 = $consultaaAPAN['APAN'];
        //$SUM22 = $consultaaAPANN['APAN'];
        $SUM222 = $consultaaAPPart['APAN'];

        $totalSUM2 =  $SUM222;

         //ACTIVIDADES EN PARTICIPACION : ESTADO = PROCESO

        /*$consultaAPAE = mysqli_query($conection, "SELECT count(*) AS APAE FROM actividades WHERE identificador!='DIARIO' AND responsable='$ids' AND estado='PROCESO'");
        $consultaaAPAE = mysqli_fetch_assoc($consultaAPAE);

        $consultaAPAEE = mysqli_query($conection, "SELECT count(*) as APAE FROM tareas WHERE responsable='$ids' AND estado='PROCESO'");
        $consultaaAPAEE = mysqli_fetch_assoc($consultaAPAEE);*/
        
        $consultaAEPart = mysqli_query($conection, "SELECT count(*) as APAE FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PROCESO' AND a.responsable!='$ids'");
        $consultaaAEPart = mysqli_fetch_assoc($consultaAEPart);
        
        //$SUM3 = $consultaaAPAE['APAE'];
        //$SUM33 = $consultaaAPAEE['APAE'];
        $SUM333 = $consultaaAEPart['APAE'];

        $totalSUM3 = $SUM333;

         //ACTIVIDADES EN PARTICIPACION : ESTADO = FINALIZADO
    
        /*$consultaAPAF = mysqli_query($conection, "SELECT count(*) AS APAF FROM actividades WHERE identificador!='DIARIO' AND  responsable='$ids' AND estado='FINALIZADO'");
        $consultaaAPAF = mysqli_fetch_assoc($consultaAPAF);

        $consultaAPAFF = mysqli_query($conection, "SELECT count(*) as APAF FROM tareas WHERE responsable='$ids' AND estado='FINALIZADO'");
        $consultaaAPAFF = mysqli_fetch_assoc($consultaAPAFF);*/
        
        $consultaAFPart = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='FINALIZADO' AND a.responsable!='$ids'");
        $consultaaAFPart = mysqli_fetch_assoc($consultaAFPart);
        
        
        //$SUM4 = $consultaaAPAF['APAF'];
        //$SUM44 = $consultaaAPAFF['APAF'];
        $SUM444 = $consultaaAFPart['APAF'];

        $totalSUM4 = $SUM444;

    }

    //Resumen tabla

        //dia

        $consultaAPDP = mysqli_query($conection, "SELECT count(*) as TotAPDP FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND fecha='$fecha' AND responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaAPDP = mysqli_fetch_assoc($consultaAPDP);

        $consultaAPDPC1 = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PLANIFICADO' AND a.fecha='$fecha' AND a.responsable!='$ids'");
        $consultaaAPDPC1 = mysqli_fetch_assoc($consultaAPDPC1);


        $s1 =  $consultaaAPDPC1['APAF'];


        $consultaAPDPC = mysqli_query($conection, "SELECT count(*) as TotAPDPC FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND fecha='$fecha' AND responsable='$ids' AND estado='PROCESO'");
        $consultaaAPDPC = mysqli_fetch_assoc($consultaAPDPC);

        $consultaAPDPCs = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PROCESO' AND a.fecha='$fecha' AND a.responsable!='$ids'");
        $consultaaAPDPCs = mysqli_fetch_assoc($consultaAPDPCs);

        $s2 = $consultaaAPDPCs['APAF'];



        $consultaAPDF = mysqli_query($conection, "SELECT count(*) as TotAPDF FROM actividades WHERE tipo_actividad='PARTICIPANTE' AND fechafin='$fecha' AND responsable='$ids' AND estado='FINALIZADO'");
        $consultaaAPDF = mysqli_fetch_assoc($consultaAPDF);

        $consultaAPDPC2 = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='FINALIZADO' AND a.fechafin='$fecha' AND a.responsable!='$ids'");
        $consultaaAPDPC2 = mysqli_fetch_assoc($consultaAPDPC2);

        $s3 = $consultaaAPDPC2['APAF'];

        $SUMAAPDia = $s1 + $s2 + $s3;
    
        //semana

        $dia2 = date('l');
        $fecha2 = date('Y-m-d');

        if ($dia2 == 'Monday') {
            $inicio2 = $fecha;
            $final2 = date("Y-m-d", strtotime($fecha2 . "+ 4 days"));
            $d2 = $dia2;
        } else {
            if ($dia2 == 'Tuesday') {
                $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 1 days"));
                $actual2 = $fecha2;
                $final2 = date("Y-m-d", strtotime($fecha2 . "+ 3 days"));
                $d2 = $dia2;
            } else {
                if ($dia2 == 'Wednesday') {
                    $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 2 days"));
                    $actual2 = $fecha2;
                    $final2 = date("Y-m-d", strtotime($fecha2 . "+ 2 days"));
                    $d2 = $dia2;
                } else {
                    if ($dia2 == 'Thursday') {
                        $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 3 days"));
                        $actual2 = $fecha2;
                        $final2 = date("Y-m-d", strtotime($fecha2 . "+ 1 days"));
                        $d2 = $dia2;
                    } else {
                        if ($dia2 == 'Friday') {
                            $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 4 days"));
                            $actual2 = $fecha2;
                            $final2 = date("Y-m-d", strtotime($fecha2 . "+ 0 days"));
                            $d2 = $dia2;
                        } else {
                            if ($dia2 == 'Saturday') {
                                $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 5 days"));
                                $actual2 = $fecha2;
                                $final2 = date("Y-m-d", strtotime($fecha2 . "- 1 days"));
                                $d2 = $dia2;
                            } else {
                                if ($dia2 == 'Sunday') {
                                    $inicio2 = date("Y-m-d", strtotime($fecha2 . "- 6 days"));
                                    $actual2 = $fecha2;
                                    $final2 = date("Y-m-d", strtotime($fecha2 . "- 2 days"));
                                    $d2 = $dia2;
                                }
                            }
                        }
                    }
                }
            }
        }

        $consultaAPSemP = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PLANIFICADO' AND a.responsable!='$ids' AND a.fecha BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemP = mysqli_fetch_assoc($consultaAPSemP);

        $consultaAPSemPC1 = mysqli_query($conection, "SELECT count(*) as TotAPSemPC FROM tareas WHERE fecha BETWEEN '$inicio2' AND '$final2'  AND responsable='$ids' AND estado='PLANIFICADO'");
        $consultaaAPSemPC1 = mysqli_fetch_assoc($consultaAPSemPC1);

        $s4 = $consultaaAPSemP['APAF'];


        $consultaAPSemPC = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PROCESO' AND a.responsable!='$ids' AND a.fecha BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemPC = mysqli_fetch_assoc($consultaAPSemPC);

        $consultaAPSemPCs = mysqli_query($conection, "SELECT count(*) as TotAPSemPC FROM tareas WHERE fecha BETWEEN '$inicio2' AND '$final2'  AND responsable='$ids' AND estado='PROCESO'");
        $consultaaAPSemPCs = mysqli_fetch_assoc($consultaAPSemPCs);

        $s5 = $consultaaAPSemPC['APAF'];



        $consultaAPSemF = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='FINALIZADO' AND a.responsable!='$ids' AND a.fechafin BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemF = mysqli_fetch_assoc($consultaAPSemF);

        $consultaAPSemPC2 = mysqli_query($conection, "SELECT count(*) as TotAPSemPC FROM tareas WHERE fecha BETWEEN '$inicio2' AND '$final2'  AND responsable='$ids' AND estado='FINALIZADO'");
        $consultaaAPSemPC2 = mysqli_fetch_assoc($consultaAPSemPC2);
        
        $s6 = $consultaaAPSemF['APAF'];


        $SUMAAPSem =  $s4 + $s5 + $s6;

        //mes

        $consultaAPMesP = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PLANIFICADO' AND a.responsable!='$ids' AND MONTH(fecha) = MONTH('$fecha')");
        $consultaaAPMesP = mysqli_fetch_assoc($consultaAPMesP);  

        $consultaAPMesPC1 = mysqli_query($conection, "SELECT count(*) as TotAPMesPC FROM tareas WHERE MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND  estado='PLANIFICADO'");
        $consultaaAPMesPC1 = mysqli_fetch_assoc($consultaAPMesPC1);   

        $s7 = $consultaaAPMesP['APAF'];


        $consultaAPMesPC = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='PROCESO' AND a.responsable!='$ids' AND MONTH(fecha) = MONTH('$fecha')");
        $consultaaAPMesPC = mysqli_fetch_assoc($consultaAPMesPC);  

        $consultaAPMesPCs = mysqli_query($conection, "SELECT count(*) as TotAPMesPC FROM tareas WHERE MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND  estado='PROCESO'");
        $consultaaAPMesPCs = mysqli_fetch_assoc($consultaAPMesPCs);  

        $s8= $consultaaAPMesPC['APAF'];


        $consultaAPMesF = mysqli_query($conection, "SELECT count(*) as APAF FROM participantes_tareas pt, actividades a WHERE pt.idactividad=a.idactividades AND pt.participante='$ids' AND a.estado='FINALIZADO' AND a.responsable!='$ids' AND MONTH(fechafin) = MONTH('$fecha')");
        $consultaaAPMesF = mysqli_fetch_assoc($consultaAPMesF);  

        $consultaAPMesPC2 = mysqli_query($conection, "SELECT count(*) as TotAPMesPC FROM tareas WHERE MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND  estado='FINALIZADO'");
        $consultaaAPMesPC2 = mysqli_fetch_assoc($consultaAPMesPC2);  

        $s9 = $consultaaAPMesF['APAF'];


        $SUMAAPMes =  $s7 + $s8 + $s9;


    //Variables GRAFICA 03 - PRODUCTOS

    //Productos
    $consultaPN = mysqli_query($conection, "SELECT count(*) AS PN FROM producto_servicio WHERE responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
    $consultaaPN = mysqli_fetch_assoc($consultaPN);

    $consultaPE = mysqli_query($conection, "SELECT count(*) AS PE FROM producto_servicio WHERE responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
    $consultaaPE = mysqli_fetch_assoc($consultaPE);

    $consultaPF = mysqli_query($conection, "SELECT count(*) AS PF FROM producto_servicio WHERE responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
    $consultaaPF = mysqli_fetch_assoc($consultaPF);

    //Resumen tabla

        //mensual

        $consultaMensP = mysqli_query($conection, "SELECT count(*) as TotMensP FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaMensP = mysqli_fetch_assoc($consultaMensP);
        
        $consultaMensPC = mysqli_query($conection, "SELECT count(*) as TotMensPC FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaMensPC = mysqli_fetch_assoc($consultaMensPC);

        $consultaMensF = mysqli_query($conection, "SELECT count(*) as TotMensF FROM producto_servicio WHERE MONTH(fecfin) = MONTH('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
        $consultaaMensF = mysqli_fetch_assoc($consultaMensF);

        $SUMAProMes = $consultaaMensP['TotMensP'] + $consultaaMensF['TotMensF'];

        //trimestral
    
        $dia3 = intval(date('m'));
        $año = date('Y');


        if('01' < $dia3 && $dia3 <'04'){
           $fini= $año.'-01-01';
           $ffin= $año.'-03-31';
        }else{
            if('03' < $dia3 && $dia3 <'07'){
                $fini= $año.'-04-01';
                $ffin= $año.'-06-30';
            }else{
                if('6' < $dia3 && $dia3 <'10'){
                    $fini= $año.'-07-01';
                    $ffin= $año.'-09-30';
                }else{
                    if('9' < $dia3 && $dia3 <'13'){
                        $fini= $año.'-10-01';
                        $ffin= $año.'-12-31';
                    }
                }
            }
        }

        $consultaTrimP = mysqli_query($conection, "SELECT count(*) as TotTrimP FROM producto_servicio WHERE fecinicio BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaTrimP = mysqli_fetch_assoc($consultaTrimP);
        
        $consultaTrimPC = mysqli_query($conection, "SELECT count(*) as TotTrimPC FROM producto_servicio WHERE fecinicio BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaTrimPC = mysqli_fetch_assoc($consultaTrimPC);

        $consultaTrimF = mysqli_query($conection, "SELECT count(*) as TotTrimF FROM producto_servicio WHERE fecfin BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
        $consultaaTrimF = mysqli_fetch_assoc($consultaTrimF);

        $SUMAProTrim = $consultaaTrimP['TotTrimP'] + $consultaaTrimF['TotTrimF'];


        //anual

        $consultaAnualP = mysqli_query($conection, "SELECT count(*) as TotAnualP FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaAnualP = mysqli_fetch_assoc($consultaAnualP);
        
        $consultaAnualPC = mysqli_query($conection, "SELECT count(*) as TotAnualPC FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaAnualPC = mysqli_fetch_assoc($consultaAnualPC);

        $consultaAnualF = mysqli_query($conection, "SELECT count(*) as TotAnualF FROM producto_servicio WHERE YEAR(fecfin) = YEAR('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
        $consultaaAnualF = mysqli_fetch_assoc($consultaAnualF);

        $SUMAProAnual = $consultaaAnualP['TotAnualP'] + $consultaaAnualF['TotAnualF'];


    //Variables GRAFICA 04 - SERVICIOS

     //Productos
     $consultaSN = mysqli_query($conection, "SELECT count(*) AS SN FROM producto_servicio WHERE responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
     $consultaaSN = mysqli_fetch_assoc($consultaSN);

     $consultaSE = mysqli_query($conection, "SELECT count(*) AS SE FROM producto_servicio WHERE responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
     $consultaaSE = mysqli_fetch_assoc($consultaSE);

     $consultaSF = mysqli_query($conection, "SELECT count(*) AS SF FROM producto_servicio WHERE responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
     $consultaaSF = mysqli_fetch_assoc($consultaSF);

     //Resumen tabla

      //mensual

      $consultaSrvMensP = mysqli_query($conection, "SELECT count(*) as TotSrvMensP FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
      $consultaaSrvMensP = mysqli_fetch_assoc($consultaSrvMensP);
      
      $consultaSrvMensPC = mysqli_query($conection, "SELECT count(*) as TotSrvMensPC FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvMensPC = mysqli_fetch_assoc($consultaSrvMensPC);

      $consultaSrvMensF = mysqli_query($conection, "SELECT count(*) as TotSrvMensF FROM producto_servicio WHERE MONTH(fecfin) = MONTH('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
      $consultaaSrvMensF = mysqli_fetch_assoc($consultaSrvMensF);

      $SUMASrvMes = $consultaaSrvMensP['TotSrvMensP'] + $consultaaSrvMensF['TotSrvMensF'];

      //trimestral
  
      $dia4 = intval(date('m'));
      $año = date('Y');


      if('01' < $dia4 && $dia4 <'04'){
         $fini2= $año.'-01-01';
         $ffin2= $año.'-03-31';
      }else{
          if('03' < $dia4 && $dia4 <'07'){
              $fini2= $año.'-04-01';
              $ffin2= $año.'-06-30';
          }else{
              if('6' < $dia4 && $dia4 <'10'){
                  $fini2= $año.'-07-01';
                  $ffin2= $año.'-09-30';
              }else{
                  if('9' < $dia4 && $dia4 <'13'){
                      $fini2= $año.'-10-01';
                      $ffin2= $año.'-12-31';
                  }
              }
          }
      }

      $consultaSrvTrimP = mysqli_query($conection, "SELECT count(*) as TotSrvTrimP FROM producto_servicio WHERE fecinicio BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='PLANIFICADO'  AND categoria='SERVICIO'");
      $consultaaSrvTrimP = mysqli_fetch_assoc($consultaSrvTrimP);
      
      $consultaSrvTrimPC = mysqli_query($conection, "SELECT count(*) as TotSrvTrimPC FROM producto_servicio WHERE fecinicio BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvTrimPC = mysqli_fetch_assoc($consultaSrvTrimPC);

      $consultaSrvTrimF = mysqli_query($conection, "SELECT count(*) as TotSrvTrimF FROM producto_servicio WHERE fecfin BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
      $consultaaSrvTrimF = mysqli_fetch_assoc($consultaSrvTrimF);

      $SUMASrvTrim = $consultaaSrvTrimP['TotSrvTrimP'] + $consultaaSrvTrimF['TotSrvTrimF'];


      //anual

      $consultaSrvAnualP = mysqli_query($conection, "SELECT count(*) as TotSrvAnualP FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
      $consultaaSrvAnualP = mysqli_fetch_assoc($consultaSrvAnualP);
      
      $consultaSrvAnualPC = mysqli_query($conection, "SELECT count(*) as TotSrvAnualPC FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvAnualPC = mysqli_fetch_assoc($consultaSrvAnualPC);

      $consultaSrvAnualF = mysqli_query($conection, "SELECT count(*) as TotSrvAnualF FROM producto_servicio WHERE YEAR(fecfin) = YEAR('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
      $consultaaSrvAnualF = mysqli_fetch_assoc($consultaSrvAnualF);

      $SUMASrvAnual = $consultaaSrvAnualP['TotSrvAnualP'] + $consultaaSrvAnualF['TotSrvAnualF'];


//TABLA GENERAL - CONSOLIDADO


      //sistemas
      $nombre_area = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '1'");
      $td1 = mysqli_fetch_assoc($nombre_area);

      $personal = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='1'");
      $td2 = mysqli_fetch_assoc($personal);

      $actividad_a1 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='1' AND a.estado='FINALIZADO'");
      $td3 = mysqli_fetch_assoc($actividad_a1);

      $actividadp_a2 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='1' AND a.estado='FINALIZADO'");
      $td44 = mysqli_fetch_assoc($actividadp_a2);

      $actividadp_a22 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='1' AND t.estado='FINALIZADO'");
      $td444 = mysqli_fetch_assoc($actividadp_a22);

      $td4 = $td44['total'] + $td444['total'];


      $productos_a1 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='1' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
      $td5 = mysqli_fetch_assoc($productos_a1);

      $servicios_a1 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='1' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
      $td6 = mysqli_fetch_assoc($servicios_a1);

    $totala1 =$td3['total'] + $td4 + $td5['total'] + $td6['total'];



     //contabilidad
     $nombre_area2 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '2'");
     $td7 = mysqli_fetch_assoc($nombre_area2);

     $personal2 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='2'");
     $td8 = mysqli_fetch_assoc($personal2);

     $actividad_a2 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='2' AND a.estado='FINALIZADO'");
     $td9 = mysqli_fetch_assoc($actividad_a2);

     $actividadp_a2 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='2' AND a.estado='FINALIZADO'");
     $td100 = mysqli_fetch_assoc($actividadp_a2);

     $actividadp_a22 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='2' AND t.estado='FINALIZADO'");
     $td1000 = mysqli_fetch_assoc($actividadp_a22);

    $td10 = $td100['total'] + $td1000['total'];

     $productos_a2 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='2' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td11 = mysqli_fetch_assoc($productos_a2);

     $servicios_a2 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='2' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td12 = mysqli_fetch_assoc($servicios_a2);

     $totala2 =$td9['total'] + $td10 + $td11['total'] + $td12['total'];



     //legal
     $nombre_area3 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '3'");
     $td13 = mysqli_fetch_assoc($nombre_area3);

     $personal3 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='3'");
     $td14 = mysqli_fetch_assoc($personal3);

     $actividad_a3 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='3' AND a.estado='FINALIZADO'");
     $td15 = mysqli_fetch_assoc($actividad_a3);

     $actividadp_a3 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='3' AND a.estado='FINALIZADO'");
     $td166 = mysqli_fetch_assoc($actividadp_a3);

     $actividadp_a33 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='3' AND t.estado='FINALIZADO'");
     $td1666 = mysqli_fetch_assoc($actividadp_a33);

     $td16 = $td166['total'] + $td1666['total'];


     $productos_a3 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='3' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td17 = mysqli_fetch_assoc($productos_a3);

     $servicios_a3 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='3' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td18 = mysqli_fetch_assoc($servicios_a3);

     $totala3 =$td15['total'] + $td16 + $td17['total'] + $td18['total'];


     //comercial
     $nombre_area4 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '4'");
     $td19= mysqli_fetch_assoc($nombre_area4);

     $personal4 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='4'");
     $td20 = mysqli_fetch_assoc($personal4);

     $actividad_a4 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='4' AND a.estado='FINALIZADO'");
     $td21 = mysqli_fetch_assoc($actividad_a4);

     $actividadp_a4 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='4' AND a.estado='FINALIZADO'");
     $td222 = mysqli_fetch_assoc($actividadp_a4);

     $actividadp_a44 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='4' AND t.estado='FINALIZADO'");
     $td2222 = mysqli_fetch_assoc($actividadp_a44);

     $td22 = $td222['total'] + $td2222['total'];


     $productos_a4 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='4' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td23 = mysqli_fetch_assoc($productos_a4);

     $servicios_a4 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='4' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td24 = mysqli_fetch_assoc($servicios_a4);

     $totala4 =$td21['total'] + $td22 + $td23['total'] + $td24['total'];



     //administracion
     $nombre_area5 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '5'");
     $td25= mysqli_fetch_assoc($nombre_area5);

     $personal5 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='5'");
     $td26 = mysqli_fetch_assoc($personal5);

     $actividad_a5 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='5' AND a.estado='FINALIZADO'");
     $td27 = mysqli_fetch_assoc($actividad_a5);

     $actividadp_a5 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='5' AND a.estado='FINALIZADO'");
     $td288 = mysqli_fetch_assoc($actividadp_a5);

     $actividadp_a55 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='5' AND t.estado='FINALIZADO'");
     $td2888 = mysqli_fetch_assoc($actividadp_a55);

     $td28 = $td288['total'] + $td2888['total'];

     $productos_a5 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='5' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td29 = mysqli_fetch_assoc($productos_a5);

     $servicios_a5 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='5' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td30 = mysqli_fetch_assoc($servicios_a5);

     $totala5 =$td27['total'] + $td28 + $td29['total'] + $td30['total'];



     //costos
     $nombre_area7 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '7'");
     $td31 = mysqli_fetch_assoc($nombre_area7);

     $personal7 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='7'");
     $td32 = mysqli_fetch_assoc($personal7);

     $actividad_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='7' AND a.estado='FINALIZADO'");
     $td33 = mysqli_fetch_assoc($actividad_a7);

     $actividadp_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='7' AND a.estado='FINALIZADO'");
     $td344 = mysqli_fetch_assoc($actividadp_a7);

     $actividadp_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='7' AND t.estado='FINALIZADO'");
     $td3444 = mysqli_fetch_assoc($actividadp_a7);


     $td34 = $td344['total'] + $td3444['total'];


     $productos_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='7' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td35 = mysqli_fetch_assoc($productos_a7);

     $servicios_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='7' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td36 = mysqli_fetch_assoc($servicios_a7);

     $totala7 =$td33['total'] + $td34 + $td35['total'] + $td36['total'];



     //gerencia
     $nombre_area9 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '9'");
     $td37 = mysqli_fetch_assoc($nombre_area9);

     $personal9 = mysqli_query($conection, "SELECT COUNT(*) as datos FROM persona WHERE idArea='9'");
     $td38 = mysqli_fetch_assoc($personal9);

     $actividad_a9 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PROPIO' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='9' AND a.estado='FINALIZADO'");
     $td39 = mysqli_fetch_assoc($actividad_a9);

     $actividadp_a9 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE a.tipo_actividad='PARTICIPANTE' AND  p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='9' AND a.estado='FINALIZADO'");
     $td400 = mysqli_fetch_assoc($actividadp_a9);

     $actividadp_a99 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='9' AND t.estado='FINALIZADO'");
     $td4000 = mysqli_fetch_assoc($actividadp_a99);

     $td40 = $td400['total'] + $td4000['total'];

     $productos_a9 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='9' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td41 = mysqli_fetch_assoc($productos_a9);

     $servicios_a9 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='9' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td42 = mysqli_fetch_assoc($servicios_a9);

     $totala9 =$td39['total'] + $td40 + $td41['total'] + $td42['total'];




    ?>