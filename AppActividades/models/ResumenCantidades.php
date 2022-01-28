<?php

    date_default_timezone_set('America/Lima');
    //session_start();
    $hora = date("H:i:s", time());;
    $fecha = date('Y-m-d');
    //CONEXIÓN A BD
    require '../config/conexion_app.php';
    $username = $_SESSION['usu'];
    
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    
    $ids = $consulta_idr['idusuario'];

    //GENERAL ACTIVIDADES PROPIAS

        //TOTAL ACTIVIDADES
        $consultax = mysqli_query($conection, "SELECT count(idactividades) as total FROM actividades  WHERE responsable='$ids' AND estado!='5'");
        $consultaax = mysqli_fetch_assoc($consultax);
    
        //Total de Actividades detenidos
        $consultad = mysqli_query($conection, "SELECT count(idactividades) as totalPd FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='4'");
        $consultaad = mysqli_fetch_assoc($consultad);
        
        //Total de Actividades eliminados
        $consulta_eliminados_act = mysqli_query($conection, "SELECT count(idactividades) as total FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='5'");
        $consulta_eliminados_actr = mysqli_fetch_assoc($consulta_eliminados_act);

   //GENERAL ACTIVIDADES EN PARTICIPACION
       
        //Total de Actividades participante
        $consultaActPart = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPart FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado!='5'");
        $consultaActParticipacion = mysqli_fetch_assoc($consultaActPart);

        $suma_actividadesp = $consultaActParticipacion['totalActPart'];

    
        //Total de Actividades participante detenidos
        $consultaActPartDet = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPart FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='4'");
        $consultaActParticipacionDet = mysqli_fetch_assoc($consultaActPartDet);

        $total_actividadesd = $consultaActParticipacionDet['totalActPart'];
        

        //Total de Actividades participante eliminado
        $consultaActPartEli = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPartEli FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='5'");
        $consultaActParticipacionEli = mysqli_fetch_assoc($consultaActPartEli);

        $total_actividadese = $consultaActParticipacionEli['totalActPartEli'];

    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Productos
    $consultaP = mysqli_query($conection, "SELECT count(idps) as totalPr FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado!='ELIMINADO'");
    $consultaaP = mysqli_fetch_assoc($consultaP);
    
        //Total de Productos detenidos
        $consultaPd = mysqli_query($conection, "SELECT count(idps) as totalPrd FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado='DETENIDO'");
        $consultaaPd = mysqli_fetch_assoc($consultaPd);
        
        //Total de Productos eliminados
        $consulta_eliminados_prod = mysqli_query($conection, "SELECT count(idps) as total FROM producto_servicio WHERE responsable='$ids' AND categoria='PRODUCTO' AND estado='ELIMINADO'");
        $consulta_eliminados_prodr = mysqli_fetch_assoc($consulta_eliminados_prod);
        
    //-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    
    

    //Total de Servicios
    $consultaF = mysqli_query($conection, "SELECT count(idps) as totalPf FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado!='ELIMINADO'");
    $consultaaF = mysqli_fetch_assoc($consultaF);
    
        //Total de Servicios detenidos
        $consultaFd = mysqli_query($conection, "SELECT count(idps) as totalPfd FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado='DETENIDO'");
        $consultaaFd = mysqli_fetch_assoc($consultaFd);
        
        //Total de Servicios eliminados
        $consulta_eliminados_serv = mysqli_query($conection, "SELECT count(idps) as total FROM producto_servicio WHERE responsable='$ids' AND categoria='SERVICIO' AND estado='ELIMINADO'");
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
  
    $consultaAT = mysqli_query($conection, "SELECT count(idactividades) as ATT FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids'");
    $consultaaAT = mysqli_fetch_assoc($consultaAT);

   $consultaAN = mysqli_query($conection, "SELECT count(idactividades) as AN FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='1'");
   $consultaaAN = mysqli_fetch_assoc($consultaAN);

    $consultaAE = mysqli_query($conection, "SELECT count(idactividades) AS AE FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='2'");
    $consultaaAE = mysqli_fetch_assoc($consultaAE);

    $consultaAF = mysqli_query($conection, "SELECT count(idactividades) AS AF FROM actividades WHERE tipo_actividad='PROPIO' AND responsable='$ids' AND estado='3'");
    $consultaaAF = mysqli_fetch_assoc($consultaAF);

    //Resumen tabla - Actividades

        //dia
        
        $consultaDP = mysqli_query($conection, "SELECT count(idactividades) as TotDP FROM actividades WHERE tipo_actividad='PROPIO' AND fecha='$fecha' AND responsable='$ids' AND estado='1'");
        $consultaaDP = mysqli_fetch_assoc($consultaDP);

        $consultaDPC = mysqli_query($conection, "SELECT count(idactividades) as TotDPC FROM actividades WHERE tipo_actividad='PROPIO' AND fecha='$fecha' AND responsable='$ids' AND estado='2'");
        $consultaaDPC = mysqli_fetch_assoc($consultaDPC);

        $consultaDF = mysqli_query($conection, "SELECT count(idactividades) as TotDF FROM actividades WHERE tipo_actividad='PROPIO' AND fechafin='$fecha' AND responsable='$ids' AND estado='3'");
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

        $consultaSemP = mysqli_query($conection, "SELECT count(idactividades) as TotSemP FROM actividades WHERE tipo_actividad='PROPIO' AND fecha BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='1'");
        $consultaaSemP = mysqli_fetch_assoc($consultaSemP);

        $consultaSemPC = mysqli_query($conection, "SELECT count(idactividades) as TotSemPC FROM actividades WHERE tipo_actividad='PROPIO' AND fecha BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='2'");
        $consultaaSemPC = mysqli_fetch_assoc($consultaSemPC);

        $consultaSemF = mysqli_query($conection, "SELECT count(idactividades) as TotSemF FROM actividades WHERE tipo_actividad='PROPIO' AND fechafin BETWEEN '$inicio' AND '$final'  AND responsable='$ids' AND estado='3'");
        $consultaaSemF = mysqli_fetch_assoc($consultaSemF);

        $SUMAASem = $consultaaSemP['TotSemP'] + $consultaaSemF['TotSemF'];

        //Mes

        $consultaMesP = mysqli_query($conection, "SELECT count(idactividades) as TotMesP FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND estado='1'");
        $consultaaMesP = mysqli_fetch_assoc($consultaMesP);

        $consultaMesPC = mysqli_query($conection, "SELECT count(idactividades) as TotMesPC FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fecha) = MONTH('$fecha') and responsable='$ids' AND estado='2'");
        $consultaaMesPC = mysqli_fetch_assoc($consultaMesPC);

        $consultaMesF = mysqli_query($conection, "SELECT count(idactividades) as TotMesF FROM actividades WHERE tipo_actividad='PROPIO' AND MONTH(fechafin) = MONTH('$fecha') and responsable='$ids' AND estado='3'");
        $consultaaMesF = mysqli_fetch_assoc($consultaMesF);

        $SUMAAMes = $consultaaMesP['TotMesP'] + $consultaaMesF['TotMesF'];


    //Variables GRAFICA 02 - ACTIVIDADES PARTICIPANTES
    
        // Estado : TOTAL
        
        $consultaACT = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado!='5'");
        $consultaaACT = mysqli_fetch_assoc($consultaACT);
        
        
        $SUM1 = $consultaaACT['totalActPar'];
        
        
        // Estado : PLANIFICADO
        
        $consultaACT2= mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='1'");
        $consultaaACT2 = mysqli_fetch_assoc($consultaACT2);
        
        
        $totalSUM2 = $consultaaACT2['totalActPar'];
        
        
        // Estado : PROCESO

        $consultaACT3 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='2'");
        $consultaaACT3= mysqli_fetch_assoc($consultaACT3);
        
        $totalSUM3 = $consultaaACT3['totalActPar'];
        
        // Estado : FINALIZADO
    
        $consultaACT4 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='3'");
        $consultaaACT4 = mysqli_fetch_assoc($consultaACT4);
        
        $totalSUM4 = $consultaaACT4['totalActPar'];
         
        $tot_participante = $totalSUM2 + $totalSUM3 + $totalSUM4;
  
    //Resumen tabla

        //dia

        $consultaAPDPC1 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='1' AND act.fecha='$fecha'");
        $consultaaAPDPC1 = mysqli_fetch_assoc($consultaAPDPC1);


        $s1 =  $consultaaAPDPC1['totalActPar'];


        $consultaAPDPCs = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='2' AND act.fecha='$fecha'");
        $consultaaAPDPCs = mysqli_fetch_assoc($consultaAPDPCs);

        $s2 = $consultaaAPDPCs['totalActPar'];


        $consultaAPDPC2 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='3' AND act.fecha='$fecha'");
        $consultaaAPDPC2 = mysqli_fetch_assoc($consultaAPDPC2);

        $s3 = $consultaaAPDPC2['totalActPar'];

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

        $consultaAPSemP = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='1' AND act.fecha BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemP = mysqli_fetch_assoc($consultaAPSemP);

        $s4 = $consultaaAPSemP['totalActPar'];


        $consultaAPSemPC = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='2' AND act.fecha BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemPC = mysqli_fetch_assoc($consultaAPSemPC);

        $s5 = $consultaaAPSemPC['totalActPar'];



        $consultaAPSemF = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='3' AND act.fechafin BETWEEN '$inicio2' AND '$final2'");
        $consultaaAPSemF = mysqli_fetch_assoc($consultaAPSemF);
        
        $s6 = $consultaaAPSemF['totalActPar'];


        $SUMAAPSem =  $s4 + $s5 + $s6;

        //mes

        $consultaAPMesP = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='1' AND MONTH(fecha) = MONTH('$fecha')");
        $consultaaAPMesP = mysqli_fetch_assoc($consultaAPMesP);  

        $s7 = $consultaaAPMesP['totalActPar'];


        $consultaAPMesPC = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='2' AND MONTH(fecha) = MONTH('$fecha')");
        $consultaaAPMesPC = mysqli_fetch_assoc($consultaAPMesPC);  

        $s8= $consultaaAPMesPC['totalActPar'];


        $consultaAPMesF = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act WHERE pt.idactividad=act.idactividades AND act.responsable!=pt.participante AND pt.participante='$ids' AND act.estado='3' AND MONTH(fechafin) = MONTH('$fecha')");
        $consultaaAPMesF = mysqli_fetch_assoc($consultaAPMesF);  

        $s9 = $consultaaAPMesF['totalActPar'];


        $SUMAAPMes =  $s7 + $s8 + $s9;


    //Variables GRAFICA 03 - PRODUCTOS

    //Productos
    $consultaPN = mysqli_query($conection, "SELECT count(idps) AS PN FROM producto_servicio WHERE responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
    $consultaaPN = mysqli_fetch_assoc($consultaPN);

    $consultaPE = mysqli_query($conection, "SELECT count(idps) AS PE FROM producto_servicio WHERE responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
    $consultaaPE = mysqli_fetch_assoc($consultaPE);

    $consultaPF = mysqli_query($conection, "SELECT count(idps) AS PF FROM producto_servicio WHERE responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
    $consultaaPF = mysqli_fetch_assoc($consultaPF);

    //Resumen tabla

        //mensual

        $consultaMensP = mysqli_query($conection, "SELECT count(idps) as TotMensP FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaMensP = mysqli_fetch_assoc($consultaMensP);
        
        $consultaMensPC = mysqli_query($conection, "SELECT count(idps) as TotMensPC FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaMensPC = mysqli_fetch_assoc($consultaMensPC);

        $consultaMensF = mysqli_query($conection, "SELECT count(idps) as TotMensF FROM producto_servicio WHERE MONTH(fecfin) = MONTH('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
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

        $consultaTrimP = mysqli_query($conection, "SELECT count(idps) as TotTrimP FROM producto_servicio WHERE fecinicio BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaTrimP = mysqli_fetch_assoc($consultaTrimP);
        
        $consultaTrimPC = mysqli_query($conection, "SELECT count(idps) as TotTrimPC FROM producto_servicio WHERE fecinicio BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaTrimPC = mysqli_fetch_assoc($consultaTrimPC);

        $consultaTrimF = mysqli_query($conection, "SELECT count(idps) as TotTrimF FROM producto_servicio WHERE fecfin BETWEEN '$fini' AND '$ffin' AND responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
        $consultaaTrimF = mysqli_fetch_assoc($consultaTrimF);

        $SUMAProTrim = $consultaaTrimP['TotTrimP'] + $consultaaTrimF['TotTrimF'];


        //anual

        $consultaAnualP = mysqli_query($conection, "SELECT count(idps) as TotAnualP FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='PRODUCTO'");
        $consultaaAnualP = mysqli_fetch_assoc($consultaAnualP);
        
        $consultaAnualPC = mysqli_query($conection, "SELECT count(idps) as TotAnualPC FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='PRODUCTO'");
        $consultaaAnualPC = mysqli_fetch_assoc($consultaAnualPC);

        $consultaAnualF = mysqli_query($conection, "SELECT count(idps) as TotAnualF FROM producto_servicio WHERE YEAR(fecfin) = YEAR('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='PRODUCTO'");
        $consultaaAnualF = mysqli_fetch_assoc($consultaAnualF);

        $SUMAProAnual = $consultaaAnualP['TotAnualP'] + $consultaaAnualF['TotAnualF'];


    //Variables GRAFICA 04 - SERVICIOS

     //Productos
     $consultaSN = mysqli_query($conection, "SELECT count(idps) AS SN FROM producto_servicio WHERE responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
     $consultaaSN = mysqli_fetch_assoc($consultaSN);

     $consultaSE = mysqli_query($conection, "SELECT count(idps) AS SE FROM producto_servicio WHERE responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
     $consultaaSE = mysqli_fetch_assoc($consultaSE);

     $consultaSF = mysqli_query($conection, "SELECT count(idps) AS SF FROM producto_servicio WHERE responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
     $consultaaSF = mysqli_fetch_assoc($consultaSF);

     //Resumen tabla

      //mensual

      $consultaSrvMensP = mysqli_query($conection, "SELECT count(idps) as TotSrvMensP FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
      $consultaaSrvMensP = mysqli_fetch_assoc($consultaSrvMensP);
      
      $consultaSrvMensPC = mysqli_query($conection, "SELECT count(idps) as TotSrvMensPC FROM producto_servicio WHERE MONTH(fecinicio) = MONTH('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvMensPC = mysqli_fetch_assoc($consultaSrvMensPC);

      $consultaSrvMensF = mysqli_query($conection, "SELECT count(idps) as TotSrvMensF FROM producto_servicio WHERE MONTH(fecfin) = MONTH('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
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

      $consultaSrvTrimP = mysqli_query($conection, "SELECT count(idps) as TotSrvTrimP FROM producto_servicio WHERE fecinicio BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='PLANIFICADO'  AND categoria='SERVICIO'");
      $consultaaSrvTrimP = mysqli_fetch_assoc($consultaSrvTrimP);
      
      $consultaSrvTrimPC = mysqli_query($conection, "SELECT count(idps) as TotSrvTrimPC FROM producto_servicio WHERE fecinicio BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvTrimPC = mysqli_fetch_assoc($consultaSrvTrimPC);

      $consultaSrvTrimF = mysqli_query($conection, "SELECT count(idps) as TotSrvTrimF FROM producto_servicio WHERE fecfin BETWEEN '$fini2' AND '$ffin2' AND responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
      $consultaaSrvTrimF = mysqli_fetch_assoc($consultaSrvTrimF);

      $SUMASrvTrim = $consultaaSrvTrimP['TotSrvTrimP'] + $consultaaSrvTrimF['TotSrvTrimF'];


      //anual

      $consultaSrvAnualP = mysqli_query($conection, "SELECT count(idps) as TotSrvAnualP FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PLANIFICADO' AND categoria='SERVICIO'");
      $consultaaSrvAnualP = mysqli_fetch_assoc($consultaSrvAnualP);
      
      $consultaSrvAnualPC = mysqli_query($conection, "SELECT count(idps) as TotSrvAnualPC FROM producto_servicio WHERE YEAR(fecinicio) = YEAR('$fecha') and responsable='$ids' AND estado='PROCESO' AND categoria='SERVICIO'");
      $consultaaSrvAnualPC = mysqli_fetch_assoc($consultaSrvAnualPC);

      $consultaSrvAnualF = mysqli_query($conection, "SELECT count(idps) as TotSrvAnualF FROM producto_servicio WHERE YEAR(fecfin) = YEAR('$fecha') and responsable='$ids' AND estado='FINALIZADO' AND categoria='SERVICIO'");
      $consultaaSrvAnualF = mysqli_fetch_assoc($consultaSrvAnualF);

      $SUMASrvAnual = $consultaaSrvAnualP['TotSrvAnualP'] + $consultaaSrvAnualF['TotSrvAnualF'];


//TABLA GENERAL - CONSOLIDADO


      //sistemas
      $nombre_area = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '1'");
      $td1 = mysqli_fetch_assoc($nombre_area);

      $personal = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='1'");
      $td2 = mysqli_fetch_assoc($personal);

      $actividad_a1 = mysqli_query($conection, "SELECT COUNT(a.idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='1' AND a.estado='3'");
      $td3 = mysqli_fetch_assoc($actividad_a1);

      $actividadp_a2 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='1' AND act.estado='3'");
      $td44 = mysqli_fetch_assoc($actividadp_a2);

      $actividadp_a22 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='1' AND t.estado='FINALIZADO'");
      $td444 = mysqli_fetch_assoc($actividadp_a22);

      $td4 = $td44['totalActPar'];


      $productos_a1 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='1' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
      $td5 = mysqli_fetch_assoc($productos_a1);

      $servicios_a1 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='1' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
      $td6 = mysqli_fetch_assoc($servicios_a1);

    $totala1 =$td3['total'] + $td4 + $td5['total'] + $td6['total'];



     //contabilidad
     $nombre_area2 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '2'");
     $td7 = mysqli_fetch_assoc($nombre_area2);

     $personal2 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='2'");
     $td8 = mysqli_fetch_assoc($personal2);

     $actividad_a2 = mysqli_query($conection, "SELECT COUNT(idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='2' AND a.estado='3'");
     $td9 = mysqli_fetch_assoc($actividad_a2);

     $actividadp_a2 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='2' AND act.estado='3'");
     $td100 = mysqli_fetch_assoc($actividadp_a2);

     $actividadp_a22 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='2' AND t.estado='FINALIZADO'");
     $td1000 = mysqli_fetch_assoc($actividadp_a22);

    $td10 = $td100['totalActPar'];

     $productos_a2 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='2' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td11 = mysqli_fetch_assoc($productos_a2);

     $servicios_a2 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='2' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td12 = mysqli_fetch_assoc($servicios_a2);

     $totala2 =$td9['total'] + $td10 + $td11['total'] + $td12['total'];



     //legal
     $nombre_area3 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '3'");
     $td13 = mysqli_fetch_assoc($nombre_area3);

     $personal3 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='3'");
     $td14 = mysqli_fetch_assoc($personal3);

     $actividad_a3 = mysqli_query($conection, "SELECT COUNT(idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='3' AND a.estado='3'");
     $td15 = mysqli_fetch_assoc($actividad_a3);

     $actividadp_a3 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='3' AND act.estado='3'");
     $td166 = mysqli_fetch_assoc($actividadp_a3);

     $actividadp_a33 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='3' AND t.estado='FINALIZADO'");
     $td1666 = mysqli_fetch_assoc($actividadp_a33);

     $td16 = $td166['totalActPar'];


     $productos_a3 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='3' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td17 = mysqli_fetch_assoc($productos_a3);

     $servicios_a3 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='3' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td18 = mysqli_fetch_assoc($servicios_a3);

     $totala3 =$td15['total'] + $td16 + $td17['total'] + $td18['total'];


     //comercial
     $nombre_area4 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '4'");
     $td19= mysqli_fetch_assoc($nombre_area4);

     $personal4 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='4'");
     $td20 = mysqli_fetch_assoc($personal4);

     $actividad_a4 = mysqli_query($conection, "SELECT COUNT(idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='4' AND a.estado='3'");
     $td21 = mysqli_fetch_assoc($actividad_a4);

     $actividadp_a4 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='4' AND act.estado='3'");
     $td222 = mysqli_fetch_assoc($actividadp_a4);

     $actividadp_a44 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='4' AND t.estado='FINALIZADO'");
     $td2222 = mysqli_fetch_assoc($actividadp_a44);

     $td22 = $td222['totalActPar'];


     $productos_a4 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='4' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td23 = mysqli_fetch_assoc($productos_a4);

     $servicios_a4 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='4' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td24 = mysqli_fetch_assoc($servicios_a4);

     $totala4 =$td21['total'] + $td22 + $td23['total'] + $td24['total'];



     //administracion
     $nombre_area5 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '5'");
     $td25= mysqli_fetch_assoc($nombre_area5);

     $personal5 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='5'");
     $td26 = mysqli_fetch_assoc($personal5);

     $actividad_a5 = mysqli_query($conection, "SELECT COUNT(idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='5' AND a.estado='3'");
     $td27 = mysqli_fetch_assoc($actividad_a5);

     $actividadp_a5 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='5' AND act.estado='3'");
     $td288 = mysqli_fetch_assoc($actividadp_a5);

     $actividadp_a55 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='5' AND t.estado='FINALIZADO'");
     $td2888 = mysqli_fetch_assoc($actividadp_a55);

     $td28 = $td288['totalActPar'];

     $productos_a5 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='5' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td29 = mysqli_fetch_assoc($productos_a5);

     $servicios_a5 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='5' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td30 = mysqli_fetch_assoc($servicios_a5);

     $totala5 =$td27['total'] + $td28 + $td29['total'] + $td30['total'];



     //costos
     $nombre_area7 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '7'");
     $td31 = mysqli_fetch_assoc($nombre_area7);

     $personal7 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='7'");
     $td32 = mysqli_fetch_assoc($personal7);

     $actividad_a7 = mysqli_query($conection, "SELECT COUNT(*) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='7' AND a.estado='3'");
     $td33 = mysqli_fetch_assoc($actividad_a7);

     $actividadp_a7 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='7' AND act.estado='3'");
     $td344 = mysqli_fetch_assoc($actividadp_a7);

     $actividadp_a7 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='7' AND t.estado='FINALIZADO'");
     $td3444 = mysqli_fetch_assoc($actividadp_a7);


     $td34 = $td344['totalActPar'];


     $productos_a7 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='7' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td35 = mysqli_fetch_assoc($productos_a7);

     $servicios_a7 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='7' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td36 = mysqli_fetch_assoc($servicios_a7);

     $totala7 =$td33['total'] + $td34 + $td35['total'] + $td36['total'];



     //gerencia
     $nombre_area9 = mysqli_query($conection, "SELECT Area FROM area WHERE idArea = '9'");
     $td37 = mysqli_fetch_assoc($nombre_area9);

     $personal9 = mysqli_query($conection, "SELECT COUNT(idcliente) as datos FROM persona WHERE idArea='9'");
     $td38 = mysqli_fetch_assoc($personal9);

     $actividad_a9 = mysqli_query($conection, "SELECT COUNT(idactividades) AS total FROM actividades a, persona p, usuario u WHERE p.idusuario=u.usuario AND a.responsable=u.idusuario AND p.idArea='9' AND a.estado='3'");
     $td39 = mysqli_fetch_assoc($actividad_a9);

     $actividadp_a9 = mysqli_query($conection, "SELECT count(pt.idparticipante) as totalActPar FROM participantes_tareas pt, actividades act, persona per, usuario usu WHERE pt.idactividad=act.idactividades AND usu.usuario=per.idusuario AND pt.participante=usu.idusuario AND per.idArea='9' AND act.estado='3'");
     $td400 = mysqli_fetch_assoc($actividadp_a9);

     $actividadp_a99 = mysqli_query($conection, "SELECT COUNT(idtareas) AS total FROM tareas t, persona p, usuario u WHERE p.idusuario=u.usuario AND t.responsable=u.idusuario AND p.idArea='9' AND t.estado='FINALIZADO'");
     $td4000 = mysqli_fetch_assoc($actividadp_a99);

     $td40 = $td400['totalActPar'];

     $productos_a9 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='9' AND ps.estado='FINALIZADO' AND ps.categoria='PRODUCTO'");
     $td41 = mysqli_fetch_assoc($productos_a9);

     $servicios_a9 = mysqli_query($conection, "SELECT COUNT(idps) AS total FROM producto_servicio ps, persona p, usuario u WHERE p.idusuario=u.usuario AND ps.responsable=u.idusuario AND p.idArea='9' AND ps.estado='FINALIZADO' AND ps.categoria='SERVICIO'");
     $td42 = mysqli_fetch_assoc($servicios_a9);

     $totala9 =$td39['total'] + $td40 + $td41['total'] + $td42['total'];




    ?>