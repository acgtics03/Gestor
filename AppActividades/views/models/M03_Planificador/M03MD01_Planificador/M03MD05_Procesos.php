<?php

session_start();
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
include_once "../../../../../config/conexion_cn_planificador.php";
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');
$fecha_hoy = date('Y-m-d');
$mes = date('m');
$anio = date('Y');
$primer_dia = $anio."-".$mes."-01";
$data = array();
$dataList= array();

/* CONSULTA A CAJA NEGRA */

if (isset($_POST['btnConsultarCajaNegra'])) {
   //CONSULTAR REGISTROS EN CAJA NEGRA
   $query = mysqli_query($conection_cn, "SELECT TC_CODIGO as codigo, TC_NOMBRE as nombre FROM tipo_carpeta");

   if ($query->num_rows > 0) {      
      $cont = 0;
      while ($row = mysqli_fetch_assoc($query)) {
         $CODIGO = $row['codigo'];
         $NOMBRE = $row['nombre'];
         //Actualizar carpeta fuente de Actividades
         $consultar_registros = mysqli_query($conection, "SELECT MAX(codigo_item) as codigo FROM configuracion_detalle WHERE codigo_tabla='_TIPO_CARPETA'");
         $respuesta = mysqli_fetch_assoc($consultar_registros);
         $c_item="";
         $c_item = $respuesta['codigo'];
         if(empty($c_item)){$c_item=0;}
         $cont = $c_item + 1;

         $respuesta_registros = mysqli_num_rows($consultar_registros);
         if($respuesta_registros>0){
            $data['valor'] = $cont;
            $verificar = mysqli_query($conection, "SELECT idconfig_detalle FROM configuracion_detalle WHERE nombre_corto='$NOMBRE' AND texto1='$CODIGO'");
            $respuestas = mysqli_num_rows($verificar);
            
            if($respuestas<=0){
               $actualizar = mysqli_query($conection, "INSERT INTO configuracion_detalle(empresa, codigo_tabla, codigo_sunat, codigo_item, nombre_corto, nombre_largo, texto1) VALUES ('000','_TIPO_CARPETA','$cont','$cont','$NOMBRE','$NOMBRE','$CODIGO')");
            }else{
               $data['valor'] = "No hay actualizaciones";
            }

         }else{
            $data['valor'] = "nuevos";
            $actualizar = mysqli_query($conection, "INSERT INTO configuracion_detalle(empresa, codigo_tabla, codigo_sunat, codigo_item, nombre_corto, nombre_largo, texto1) VALUES ('000','_TIPO_CARPETA','$cont','$cont','$NOMBRE','$NOMBRE','$CODIGO')");
         }
      }
      

   } else {
         $data['status'] = 'bad';
         if (!$query) {
            $data['dataDB'] = mysqli_error($conection);
         }
         $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
   }

   header('Content-type: text/javascript');
   echo json_encode($data, JSON_PRETTY_PRINT);
}

if (isset($_POST['btnValidarGeneracionn'])) {
   $cbxGeneracion = $_POST['cbxGeneracion'];
   $query = mysqli_query($conection, "SELECT
      cd.codigo_item as codigo
   FROM configuracion_detalle cd
   WHERE cd.idconfig_detalle='$cbxGeneracion' AND codigo_tabla='_TIPO_GENERACION'");
   if ($query->num_rows > 0) {
       $resultado = $query->fetch_assoc();
       $data['status'] = 'ok';
       $data['data'] = $resultado;
   } else {
       $data['status'] = 'bad';
       if (!$query) {
           $data['dataDB'] = mysqli_error($conection);
       }
       $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
   }
   header('Content-type: text/javascript');
   echo json_encode($data, JSON_PRETTY_PRINT);
}

/* FIN DE CONSULTA CAJA NEGRA */



if(isset($_POST['btnLlenarFechas'])){

 
   $data['status'] = "ok";
   $data['fecha1'] = $primer_dia;;
   $data['fecha2'] = $fecha_hoy;
   $data['mes']=$mes;

  header('Content-type: text/javascript');
  echo json_encode($data,JSON_PRETTY_PRINT);
}

if (isset($_POST['btnValidarGeneracion'])) {
   $cbxGeneracion = $_POST['cbxGeneracion'];
   $query = mysqli_query($conection, "SELECT
      cd.codigo_item as codigo
   FROM configuracion_detalle cd
   WHERE cd.idconfig_detalle='$cbxGeneracion' AND codigo_tabla='_TIPO_GENERACION'");
   if ($query->num_rows > 0) {
       $resultado = $query->fetch_assoc();
       $data['status'] = 'ok';
       $data['data'] = $resultado;
   } else {
       $data['status'] = 'bad';
       if (!$query) {
           $data['dataDB'] = mysqli_error($conection);
       }
       $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
   }
   header('Content-type: text/javascript');
   echo json_encode($data, JSON_PRETTY_PRINT);
}


if (isset($_POST['btnCargarDatosActividad'])) {
   
   $IdReg = "0"; 
   if(!empty($_POST['IdRegistro'])){
       $IdReg = $_POST['IdRegistro'];
   }

   //Consultar estado de la actividad

   $consultar_estado_actividad = mysqli_query($conection, "SELECT estado as est FROM actividades WHERE idactividades='$IdReg'");
   $respuesta_estado_actividad = mysqli_fetch_assoc($consultar_estado_actividad);
   $estado_actividad = $respuesta_estado_actividad['est'];

   if($estado_actividad!='3'){

       $query = mysqli_query($conection, "SELECT
          act.idactividades as id,
          act.nombre as nombre,
          act.descripcion as descripcion,
          act.fecha as fechaini,
          act.fechafin as fechafin,
          date_format(act.Horaini, '%H') as Horaini,
          date_format(act.Horaini, '%i') as Minutosini,
          date_format(act.Horafin, '%H') as Horafin,
          date_format(act.Horafin, '%i') as Minutosfin,
          date_format(act.Horainireal, '%H') as Horainireal,
          date_format(act.Horainireal, '%i') as Minutosinireal,
          date_format(act.Horafinreal, '%H') as Horafinreal,
          date_format(act.Horafinreal, '%i') as Minutosfinreal,
          act.responsable as responsable,
          act.estado as estado,
          act.empresa as cliente,
          act.area as tipo
      FROM actividades act
      WHERE act.idactividades='$IdReg'");
       if ($query->num_rows > 0) {
           $resultado = $query->fetch_assoc();
           $data['status'] = 'ok';
           $data['data'] = $resultado;
       } else {
           $data['status'] = 'bad';
           if (!$query) {
               $data['dataDB'] = mysqli_error($conection);
           }
           $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
       }

    }else{

       $data['status'] = "bad";
       $data['data'] = "La actividad no puede editarse más ya que su estado actual es 'FINALIZADO'.";

    }

    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

if(isset($_POST['btnActualizarActividad'])){

        $txtIDActividadPopup = isset($_POST['txtIDActividadPopup']) ? $_POST['txtIDActividadPopup'] : Null;
        $txtIDActividadPopupr = trim($txtIDActividadPopup);   

        $bxNombreActividadPopup = isset($_POST['bxNombreActividadPopup']) ? $_POST['bxNombreActividadPopup'] : Null;
        $bxNombreActividadPopupr = trim($bxNombreActividadPopup);   

        $txtDescripcionPopup = isset($_POST['txtDescripcionPopup']) ? $_POST['txtDescripcionPopup'] : Null;
        $txtDescripcionPopupr = trim($txtDescripcionPopup); 

        $bxResponsablePopup = isset($_POST['bxResponsablePopup']) ? $_POST['bxResponsablePopup'] : Null;
        $bxResponsablePopupr = trim($bxResponsablePopup); 

        $bxClientePopup = isset($_POST['bxClientePopup']) ? $_POST['bxClientePopup'] : Null;
        $bxClientePopupr = trim($bxClientePopup); 

        $bxTipoPopup = isset($_POST['bxTipoPopup']) ? $_POST['bxTipoPopup'] : Null;
        $bxTipoPopupr = trim($bxTipoPopup); 

        $txtFechaInicioPopup = isset($_POST['txtFechaInicioPopup']) ? $_POST['txtFechaInicioPopup'] : Null;
        $txtFechaInicioPopupr = trim($txtFechaInicioPopup); 

        $txtFechaTerminoPopup = isset($_POST['txtFechaTerminoPopup']) ? $_POST['txtFechaTerminoPopup'] : Null;
        $txtFechaTerminoPopupr = trim($txtFechaTerminoPopup); 

        $txtHoraInicioPopup = isset($_POST['txtHoraInicioPopup']) ? $_POST['txtHoraInicioPopup'] : Null;
        $txtHoraInicioPopupr = trim($txtHoraInicioPopup); 

        $txtMinutosInicioPopup = isset($_POST['txtMinutosInicioPopup']) ? $_POST['txtMinutosInicioPopup'] : Null;
        $txtMinutosInicioPopupr = trim($txtMinutosInicioPopup); 

        $txtHoraTerminoPopup = isset($_POST['txtHoraTerminoPopup']) ? $_POST['txtHoraTerminoPopup'] : Null;
        $txtHoraTerminoPopupr = trim($txtHoraTerminoPopup); 

        $txtMinutosTerminoPopup = isset($_POST['txtMinutosTerminoPopup']) ? $_POST['txtMinutosTerminoPopup'] : Null;
        $txtMinutosTerminoPopupr = trim($txtMinutosTerminoPopup); 

        $txtHoraInicioRealPopup = isset($_POST['txtHoraInicioRealPopup']) ? $_POST['txtHoraInicioRealPopup'] : Null;
        $txtHoraInicioRealPopupr = trim($txtHoraInicioRealPopup); 

        $txtMinutosInicioRealPopup = isset($_POST['txtMinutosInicioRealPopup']) ? $_POST['txtMinutosInicioRealPopup'] : Null;
        $txtMinutosInicioRealPopupr = trim($txtMinutosInicioRealPopup); 

        $txtHoraTerminoRealPopup = isset($_POST['txtHoraTerminoRealPopup']) ? $_POST['txtHoraTerminoRealPopup'] : Null;
        $txtHoraTerminoRealPopupr = trim($txtHoraTerminoRealPopup); 

        $txtMinutosTerminoRealPopup = isset($_POST['txtMinutosTerminoRealPopup']) ? $_POST['txtMinutosTerminoRealPopup'] : Null;
        $txtMinutosTerminoRealPopupr = trim($txtMinutosTerminoRealPopup); 

        $bxEstadoPopup = isset($_POST['bxEstadoPopup']) ? $_POST['bxEstadoPopup'] : Null;
        $bxEstadoPopupr = trim($bxEstadoPopup); 

        $hora_inicio = "";
        $hora_termino = "";

        $hora_inicio_real = "";
        $hora_termino_real = "";

        $hora_inicio = $txtHoraInicioPopupr.":".$txtMinutosInicioPopupr.":00";
        $hora_termino = $txtHoraTerminoPopupr.":".$txtMinutosTerminoPopupr.":00";

        $var_horas = 0;

        if(!empty($bxNombreActividadPopupr)){

           if(!empty($txtDescripcionPopupr)){

              // if(!empty($bxResponsablePopupr)){

                  if(!empty($bxClientePopupr)){

                     if(!empty($bxTipoPopupr)){

                        if(!empty($txtFechaInicioPopupr) && !empty($txtFechaTerminoPopupr)){

                           if(!empty($txtHoraInicioPopupr) && !empty($txtHoraTerminoPopupr)){

                              if($txtFechaInicioPopupr < $txtFechaTerminoPopupr){

                                    if(empty($txtHoraInicioRealPopupr)){

                                       $hora_inicio_real = $hora_inicio;

                                    }else{
                                       $hora_inicio_real = $txtHoraInicioRealPopupr.":".$txtMinutosInicioRealPopupr.":00";
                                    }

                                    if(empty($txtHoraTerminoRealPopupr)){

                                       $hora_termino_real = $hora_termino;

                                    }else{
                                       $hora_termino_real = $txtHoraTerminoRealPopupr.":".$txtMinutosTerminoRealPopupr.":00";
                                    }

                                     $var_horas = 1;

                                 }else{
                                    if ($txtFechaInicioPopupr == $txtFechaTerminoPopupr) {
                                       if (strtotime($hora_inicio) < strtotime($hora_termino)) {
                                          if(empty($txtHoraInicioRealPopupr)){

                                             $hora_inicio_real = $hora_inicio;

                                          }else{
                                             $hora_inicio_real = $txtHoraInicioRealPopupr.":".$txtMinutosInicioRealPopupr.":00";
                                          }

                                          if(empty($txtHoraTerminoRealPopupr)){

                                             $hora_termino_real = $hora_termino;

                                          }else{
                                             $hora_termino_real = $txtHoraTerminoRealPopupr.":".$txtMinutosTerminoRealPopupr.":00";
                                          }

                                          $var_horas = 1;
                                       }else{

                                          $var_horas = 0;
                                          $data['status'] = "bad";
                                          $data['data'] = "Ingrese una hora de termino superior a la hora de inicio de la actividad.";

                                       }
                                    }
                                 }

                                 if($var_horas>0){

                                    $consultar_actividadd = mysqli_query($conection, "SELECT idactividades as id FROM actividades WHERE idactividades='$txtIDActividadPopupr'");
                                    $respuesta_actividadd = mysqli_num_rows($consultar_actividadd);

                                    if($respuesta_actividadd>0){

                                       $actualizar_actividad = mysqli_query($conection, "UPDATE actividades SET 
                                          nombre='$bxNombreActividadPopupr', 
                                          descripcion='$txtDescripcionPopupr', 
                                          fecha='$txtFechaInicioPopupr', 
                                          fechafin='$txtFechaTerminoPopupr', 
                                          Horaini='$hora_inicio', 
                                          Horafin='$hora_termino',
                                          Horainireal='$hora_inicio_real',
                                          Horafinreal='$hora_termino_real', 
                                          estado='$bxEstadoPopupr',  
                                          empresa='$bxClientePopupr', 
                                          area='$bxTipoPopupr' 
                                       WHERE idactividades='$txtIDActividadPopupr'");


                                       $consultar_actividad_2 = mysqli_query($conection, "SELECT idactividades as id FROM actividades WHERE idactividades='$txtIDActividadPopupr'");

                                       $respuesta_actividad_2 = mysqli_num_rows($consultar_actividad_2);

                                       if($respuesta_actividad_2>0){

                                          $data['status'] = "ok";
                                          $data['data'] = "Se actualizó los datos de la actividad.";

                                       }else{
                                          $data['status'] = "bad";
                                          $data['data'] = "La Actividad no pudo ser registrada.";
                                       }

                                    }else{
                                       $data['status'] = "bad";
                                       $data['data'] = "Ya existe la actividad ingresada";
                                    }

                                 }
            
                           }else{
                              $data['status'] = "bad";
                              $data['data'] = "Ingresar hora de inicio y de termino";
                           }
            
                        }else{
                           $data['status'] = "bad";
                           $data['data'] = "Ingresar fecha de inicio y de termino";
                        }
               
                     }else{
                        $data['status'] = "bad";
                        $data['data'] = "Seleccionar tipo de la Actividad.";
                     }
            
                  }else{
                     $data['status'] = "bad";
                     $data['data'] = "Seleccionar cliente de la Actividad.";
                  }
            
               /*}else{
                  $data['status'] = "bad";
                  $data['data'] = "Seleccionar el responsable de la Actividad.";
               }*/
            
           }else{
               $data['status'] = "bad";
               $data['data'] = "Ingresar la descripcion de la Actividad.";
           } 
        }else{
            $data['status'] = "bad";
            $data['data'] = "Seleccionar el Nombre de la Actividad.";
        }
         
        header('Content-type: text/javascript');
        echo json_encode($data,JSON_PRETTY_PRINT);

    }



    if (isset($_POST['btnCargarDatosActividadTarea'])) {
    $IdReg = $_POST['IdRegistro'];
    $query = mysqli_query($conection, "SELECT
       act.idactividades as id,
       act.nombre as nombre,
       act.descripcion as descripcion,
       act.fecha as fechaini,
       act.fechafin as fechafin,
       act.estado as estado,
       act.empresa as cliente
   FROM actividades act
   WHERE act.idactividades='$IdReg'");
    if ($query->num_rows > 0) {
        $resultado = $query->fetch_assoc();
        $data['status'] = 'ok';
        $data['data'] = $resultado;
    } else {
        $data['status'] = 'bad';
        if (!$query) {
            $data['dataDB'] = mysqli_error($conection);
        }
        $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
    }
    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

if (isset($_POST['btnCargarDatosActividadParticipantes'])) {
   
   
    $IdReg = $_POST['IdRegistro'];

    $consultar_estado_actividad = mysqli_query($conection, "SELECT estado as est FROM actividades WHERE idactividades='$IdReg'");
   $respuesta_estado_actividad = mysqli_fetch_assoc($consultar_estado_actividad);
   $estado_actividad = $respuesta_estado_actividad['est'];

   if($estado_actividad!='3'){

       $query = mysqli_query($conection, "SELECT
          act.idactividades as id,
          act.nombre as nombre,
          act.descripcion as descripcion,
          act.fecha as fechaini,
          act.fechafin as fechafin,
          date_format(act.Horaini, '%H') as Horaini,
          date_format(act.Horaini, '%i') as Minutosini,
          date_format(act.Horafin, '%H') as Horafin,
          date_format(act.Horafin, '%i') as Minutosfin,
          date_format(act.Horainireal, '%H') as Horainireal,
          date_format(act.Horainireal, '%i') as Minutosinireal,
          date_format(act.Horafinreal, '%H') as Horafinreal,
          date_format(act.Horafinreal, '%i') as Minutosfinreal,
          act.responsable as responsable,
          act.estado as estado,
          act.empresa as cliente,
          act.area as tipo
      FROM actividades act
      WHERE act.idactividades='$IdReg'");
       if ($query->num_rows > 0) {
           $resultado = $query->fetch_assoc();
           $data['status'] = 'ok';
           $data['data'] = $resultado;
       } else {
           $data['status'] = 'bad';
           if (!$query) {
               $data['dataDB'] = mysqli_error($conection);
           }
           $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
       }

   }else{

          $data['status'] = "bad";
          $data['data'] = "No es posible añadir participantes a la actividad seleccionada debido a que su estado actual es 'FINALIZADO'.";

    }

    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

if(isset($_POST['btnRegistrarTarea'])){

    $txtIDActividadTareas = isset($_POST['txtIDActividadTareas']) ? $_POST['txtIDActividadTareas'] : Null;
    $txtIDActividadTareasr = trim($txtIDActividadTareas);   

    $txtNombreTarea = isset($_POST['txtNombreTarea']) ? $_POST['txtNombreTarea'] : Null;
    $txtNombreTarear = trim($txtNombreTarea);   

    $bxResponsableTarea = isset($_POST['bxResponsableTarea']) ? $_POST['bxResponsableTarea'] : Null;
    $bxResponsableTarear = trim($bxResponsableTarea); 

    $txtFechaInicioTarea = isset($_POST['txtFechaInicioTareas']) ? $_POST['txtFechaInicioTareas'] : Null;
    $txtFechaInicioTarear = trim($txtFechaInicioTarea); 

    $txtFechaTerminoTarea = isset($_POST['txtFechaTerminoTareas']) ? $_POST['txtFechaTerminoTareas'] : Null;
    $txtFechaTerminoTarear = trim($txtFechaTerminoTarea); 

    $txtHoraInicioTarea = isset($_POST['txtHoraInicioTarea']) ? $_POST['txtHoraInicioTarea'] : Null;
    $txtHoraInicioTarear = trim($txtHoraInicioTarea); 

    $txtMinutosInicioTarea = isset($_POST['txtMinutosInicioTarea']) ? $_POST['txtMinutosInicioTarea'] : Null;
    $txtMinutosInicioTarear = trim($txtMinutosInicioTarea); 

    $txtHoraTerminoTarea = isset($_POST['txtHoraTerminoTarea']) ? $_POST['txtHoraTerminoTarea'] : Null;
    $txtHoraTerminoTarear = trim($txtHoraTerminoTarea); 

    $txtMinutosTerminoTarea = isset($_POST['txtMinutosTerminoTarea']) ? $_POST['txtMinutosTerminoTarea'] : Null;
    $txtMinutosTerminoTarear = trim($txtMinutosTerminoTarea); 

    $txtDescripcionTarea = isset($_POST['txtDescripcionTarea']) ? $_POST['txtDescripcionTarea'] : Null;
    $txtDescripcionTarear = trim($txtDescripcionTarea); 


    $hora_inicio = "";
    $hora_termino = "";

    $hora_inicio_real = "";
    $hora_termino_real = "";

    $hora_inicio = $txtHoraInicioTarear.":".$txtMinutosInicioTarear.":00";
    $hora_termino = $txtHoraTerminoTarear.":".$txtMinutosTerminoTarear.":00";

    $var_horas = 0;

    if(!empty($txtNombreTarear)){

       if(!empty($txtDescripcionTarear)){

         if(!empty($bxResponsableTarear)){

            if(!empty($txtFechaInicioTarear) && !empty($txtFechaTerminoTarear)){

               if(!empty($txtHoraInicioTarear) && !empty($txtHoraTerminoTarear)){

              

                     $consultar_actividadd = mysqli_query($conection, "SELECT idtareas as id FROM tareas WHERE vinculo='$txtIDActividadTareasr' AND nombre='$txtNombreTarear' AND descripcion='$txtDescripcionTarear' AND fecha='$txtFechaInicioTarear'");
                     $respuesta_actividadd = mysqli_num_rows($consultar_actividadd);

                     if($respuesta_actividadd==0){

                        $actualizar_actividad = mysqli_query($conection, "INSERT INTO tareas(nombre, descripcion, fecha, fechafin, Horaini, Horafin, estado, responsable, vinculo, horaregistro, fecharegistro) VALUES ('$txtNombreTarear','$txtDescripcionTarear','$txtFechaInicioTarear','$txtFechaTerminoTarear','$hora_inicio','$hora_termino','1','$bxResponsableTarear','$txtIDActividadTareasr','$hora','$fecha')"); 
                           

                        $consultar_actividad_2 = mysqli_query($conection, "SELECT idtareas as id FROM tareas WHERE vinculo='$txtIDActividadTareasr' AND nombre='$txtNombreTarear' AND descripcion='$txtDescripcionTarear' AND fecha='$txtFechaInicioTarear'");

                        $respuesta_actividad_2 = mysqli_num_rows($consultar_actividad_2);

                        if($respuesta_actividad_2>0){

                           $data['status'] = "ok";
                           $data['data'] = "Se registro la tarea.";
                           $data['id'] = $txtIDActividadTareasr;

                        }else{
                           $data['status'] = "bad";
                           $data['data'] = "La Tarea no pudo ser registrada.";
                        }

                     }else{
                        $data['status'] = "bad";
                        $data['data'] = "Ya existe la Tarea ingresada";
                     }

                  

               }else{
                  $data['status'] = "bad";
                  $data['data'] = "Ingresar hora de inicio y de termino";
               }
               
            }else{
               $data['status'] = "bad";
               $data['data'] = "Ingresar fecha de inicio y de termino";
            }


         }else{
            $data['status'] = "bad";
            $data['data'] = "Seleccionar el responsable de la Tarea.";
         }

      }else{
         $data['status'] = "bad";
         $data['data'] = "Ingresar la descripcion de la Tarea.";
      } 
   }else{
      $data['status'] = "bad";
      $data['data'] = "Ingresar el Nombre de la Tarea.";
   }

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


if (isset($_POST['btnCargarDatosTarea'])) {
    $IdReg = $_POST['IdRegistro'];
    $query = mysqli_query($conection, "SELECT
       act.idtareas as id,
       act.nombre as nombre,
       act.descripcion as descripcion,
       act.fecha as fechaini,
       act.fechafin as fechafin,
       date_format(act.Horaini, '%H') as Horaini,
       date_format(act.Horaini, '%i') as Minutosini,
       date_format(act.Horafin, '%H') as Horafin,
       date_format(act.Horafin, '%i') as Minutosfin,
       act.estado as estado,
       act.responsable as responsable,
       act.vinculo as idactividad
   FROM tareas act
   WHERE act.idtareas='$IdReg'");
    if ($query->num_rows > 0) {
        $resultado = $query->fetch_assoc();
        $data['status'] = 'ok';
        $data['data'] = $resultado;
    } else {
        $data['status'] = 'bad';
        if (!$query) {
            $data['dataDB'] = mysqli_error($conection);
        }
        $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
    }
    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

if(isset($_POST['btnActualizarTarea'])){

    $txtIDActividadTareas2 = isset($_POST['txtIDActividadTareas2']) ? $_POST['txtIDActividadTareas2'] : Null;
    $txtIDActividadTareas2r = trim($txtIDActividadTareas2);   

    $txtNombreTarea2 = isset($_POST['txtNombreTarea2']) ? $_POST['txtNombreTarea2'] : Null;
    $txtNombreTarea2r = trim($txtNombreTarea2);   

    $bxResponsableTarea2 = isset($_POST['bxResponsableTarea2']) ? $_POST['bxResponsableTarea2'] : Null;
    $bxResponsableTarea2r = trim($bxResponsableTarea2); 

    $txtFechaInicioTarea2 = isset($_POST['txtFechaInicioTarea2']) ? $_POST['txtFechaInicioTarea2'] : Null;
    $txtFechaInicioTarea2r = trim($txtFechaInicioTarea2); 

    $txtFechaTerminoTarea2 = isset($_POST['txtFechaTerminoTarea2']) ? $_POST['txtFechaTerminoTarea2'] : Null;
    $txtFechaTerminoTarea2r = trim($txtFechaTerminoTarea2); 

    $txtHoraInicioTarea2 = isset($_POST['txtHoraInicioTarea2']) ? $_POST['txtHoraInicioTarea2'] : Null;
    $txtHoraInicioTarea2r = trim($txtHoraInicioTarea2); 

    $txtMinutosInicioTarea2 = isset($_POST['txtMinutosInicioTarea2']) ? $_POST['txtMinutosInicioTarea2'] : Null;
    $txtMinutosInicioTarea2r = trim($txtMinutosInicioTarea2); 

    $txtHoraTerminoTarea2 = isset($_POST['txtHoraTerminoTarea2']) ? $_POST['txtHoraTerminoTarea2'] : Null;
    $txtHoraTerminoTarea2r = trim($txtHoraTerminoTarea2); 

    $txtMinutosTerminoTarea2 = isset($_POST['txtMinutosTerminoTarea2']) ? $_POST['txtMinutosTerminoTarea2'] : Null;
    $txtMinutosTerminoTarea2r = trim($txtMinutosTerminoTarea2); 

    $txtDescripcionTarea2 = isset($_POST['txtDescripcionTarea2']) ? $_POST['txtDescripcionTarea2'] : Null;
    $txtDescripcionTarea2r = trim($txtDescripcionTarea2); 

    $bxEstadoTarea2 = isset($_POST['bxEstadoTarea2']) ? $_POST['bxEstadoTarea2'] : Null;
    $bxEstadoTarea2r = trim($bxEstadoTarea2); 

    $hora_inicio = "";
    $hora_termino = "";

    $hora_inicio_real = "";
    $hora_termino_real = "";

    $hora_inicio = $txtHoraInicioTarea2r.":".$txtMinutosInicioTarea2r.":00";
    $hora_termino = $txtHoraTerminoTarea2r.":".$txtMinutosTerminoTarea2r.":00";

    $var_horas = 0;

    if(!empty($txtNombreTarea2r)){

       if(!empty($txtDescripcionTarea2r)){

         if(!empty($bxResponsableTarea2r)){

            if(!empty($txtFechaInicioTarea2r) && !empty($txtFechaTerminoTarea2r)){

               if(!empty($txtHoraInicioTarea2r) && !empty($txtHoraTerminoTarea2r)){


                     $consultar_actividadd = mysqli_query($conection, "SELECT idtareas as id FROM tareas WHERE idtareas='$txtIDActividadTareas2r'");
                     $respuesta_actividadd = mysqli_num_rows($consultar_actividadd);

                     if($respuesta_actividadd>0){


                          //consultar idactividad
                       $consultar_idactiv = mysqli_query($conection, "SELECT vinculo as idactividad FROM tareas WHERE idtareas='$txtIDActividadTareas2r'");
                        $respuesta_idactiv = mysqli_fetch_assoc($consultar_idactiv);
                        $valor_idactividadd = $respuesta_idactiv['idactividad'];

                       //consultar total tareas
                        $consultar_total_tr = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE vinculo='$valor_idactividadd' AND estado!='5'");
                        $respuesta_total_tr= mysqli_num_rows($consultar_total_tr);

                        //consultar total tareas planificadas
                       $consultar_total_tareas_pl = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE vinculo='$valor_idactividadd' AND estado='1'");
                        $respuesta_total_tareas_pl = mysqli_num_rows($consultar_total_tareas_pl);

                        if($respuesta_total_tr == $respuesta_total_tareas_pl){
                           if($bxEstadoTarea2r == '2' || $bxEstadoTarea2r == '3'){                           
                              $actualizar_estado_actividad = mysqli_query($conection,  "UPDATE actividades SET estado='2' WHERE idactividades='$valor_idactividadd'");  
                           }
                        }
   

                        $actualizar_actividad = mysqli_query($conection, "UPDATE tareas SET 
                           nombre='$txtNombreTarea2r', 
                           descripcion='$txtDescripcionTarea2r', 
                           fecha='$txtFechaInicioTarea2r', 
                           fechafin='$txtFechaTerminoTarea2r', 
                           Horaini='$hora_inicio', 
                           Horafin='$hora_termino',
                           estado='$bxEstadoTarea2r', 
                           responsable='$bxResponsableTarea2r' 
                           WHERE idtareas='$txtIDActividadTareas2r'");

                      
                        $consultar_actividad_2 = mysqli_query($conection, "SELECT idtareas as id, vinculo as idact FROM tareas WHERE idtareas='$txtIDActividadTareas2r'");

                        $respuesta_actividad_2 = mysqli_num_rows($consultar_actividad_2);
                        $respuesta_actividadd_2 = mysqli_fetch_assoc($consultar_actividad_2);
                        $idactivi = $respuesta_actividadd_2['idact'];

                        if($respuesta_actividad_2>0){

                           $data['status'] = "ok";
                           $data['data'] = "Se actualizó los datos de la Tarea.";
                           $data['id'] = $idactivi;

                        }else{
                           $data['status'] = "bad";
                           $data['data'] = "La Tarea no pudo ser registrada.";
                        }

                     }else{
                        $data['status'] = "bad";
                        $data['data'] = "Ya existe la Tarea ingresada";
                     }

                  
                  
               }else{
                  $data['status'] = "bad";
                  $data['data'] = "Ingresar hora de inicio y de termino";
               }
               
            }else{
               $data['status'] = "bad";
               $data['data'] = "Ingresar fecha de inicio y de termino";
            }
            
            
         }else{
            $data['status'] = "bad";
            $data['data'] = "Seleccionar el responsable de la Tarea.";
         }
         
      }else{
         $data['status'] = "bad";
         $data['data'] = "Ingresar la descripcion de la Tarea.";
      } 
   }else{
      $data['status'] = "bad";
      $data['data'] = "Seleccionar el Nombre de la Tarea.";
   }

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}

if(isset($_POST['btnRegistrarParticipante'])){

    $txtidActividadParticipantesr = $_POST['txtidActividadParticipantes'];   
    $bxParticipantesr = $_POST['bxParticipantes'];   

 
    //CONSULTAR IDMAX DE COLOR DE PARTICIPANTE ACTIVO
    $consultar_maxparticipante = mysqli_query($conection, "SELECT max(idcolor) as color FROM participantes_tareas WHERE idactividad='$txtidActividadParticipantesr' AND estado='activo'");
    $respuesta_maxparticipante = mysqli_fetch_assoc($consultar_maxparticipante);
    $idmax_color = $respuesta_maxparticipante['color'];

    if(empty($idmax_color)){
       $max_color = 1;  
    }else{
       $max_color = $idmax_color + 1;
    }
    if(!empty($bxParticipantesr)){

         $consultar_participante = mysqli_query($conection, "SELECT idparticipante FROM participantes_tareas WHERE participante='$bxParticipantesr' AND idactividad='$txtidActividadParticipantesr'");
         $respuesta_participante = mysqli_num_rows($consultar_participante);

         if($respuesta_participante==0){

            $insertar_participante = mysqli_query($conection, "INSERT INTO participantes_tareas(participante, idactividad,  estado, horaregistro, fecharegistro, idcolor) VALUES ('$bxParticipantesr','$txtidActividadParticipantesr','activo','$hora','$fecha','$max_color')");

            $consulta_participante=mysqli_query($conection, "SELECT idparticipante FROM participantes_tareas WHERE participante='$bxParticipantesr' AND idactividad='$txtidActividadParticipantesr'");
            $respuesta_participante = mysqli_num_rows($consulta_participante);

            if($respuesta_participante>0){

               $data['status'] = "ok";
               $data['data'] = "Se registro al participante seleccionado.";
               $data['id'] = $txtidActividadParticipantesr;

            }else{
               $data['status'] = "bad";
               $data['data'] = "El participante no pudo ser registrado, intente nuevamente.";
            }

         }else{
            $data['status'] = "bad";
            $data['data'] = "El participante que desea registrar ya existe.";
         }
         
    }else{

        $data['status'] = "bad";
        $data['data'] = "Seleccione el participante que desea registrar.";
    } 
                         
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


if(isset($_POST['btnVerificarEliminarParticipante'])){

   $idpart = $_POST['idp'];

   // Consultar id de la actividad en referencia
   $consulta_idActividad = mysqli_query($conection, "SELECT idactividad as id, participante as participante FROM participantes_tareas WHERE idparticipante='$idpart'");
   $respuesta_idActividad = mysqli_fetch_assoc($consulta_idActividad);
   $id_actividad = $respuesta_idActividad['id'];
   $id_participante = $respuesta_idActividad['participante'];
  
   //Consultar si es dueño de la actividad
   $consulta_responsable_actividad = mysqli_query($conection, "SELECT responsable as responsable FROM actividades WHERE idactividades='$id_actividad'");
   $respuesta_responsable_actividad = mysqli_fetch_assoc($consulta_responsable_actividad);
   $id_responsable = $respuesta_responsable_actividad['responsable'];

    //consultar si es jefe inmediato
   $consultar_jefe = mysqli_query($conection, "SELECT idJefeInmediato FROM persona WHERE idusuario='$id_responsable' AND idJefeInmediato='$id_participante'");
   $respuesta_jefe = mysqli_num_rows($consultar_jefe);

   if($respuesta_jefe == 0){
      if($id_participante != $id_responsable){

         $data['status'] = "ok";
         $data['id'] = $idpart;

      }else{

         $data['status'] = "bad";
         $data['data'] = "El participante seleccionado no puede ser eliminado, debido a que es el responsable de la actividad.";

      }
   }else{

      $data['status'] = "bad";
      $data['data'] = "El participante seleccionado no puede ser eliminado, debido a que es el Jefe Inmediato del responsable de la actividad.";

   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}

if(isset($_POST['btnEliminarParticipante'])){

   $idparticipante = $_POST['idparticipante'];   

   $consultar_participante = mysqli_query($conection, "SELECT idparticipante as id, idactividad idact FROM participantes_tareas WHERE idparticipante='$idparticipante' AND estado='activo'");
   $respuesta_participante = mysqli_num_rows($consultar_participante);
   $respuesta_datos = mysqli_fetch_assoc($consultar_participante);

   $idactividad = $respuesta_datos['idact'];


   if($respuesta_participante>0){

      $eliminar_participante = mysqli_query($conection, "UPDATE participantes_tareas SET estado='inactivo' WHERE idparticipante='$idparticipante'");

      $consultar_estado_participante = mysqli_query($conection, "SELECT idparticipante FROM participantes_tareas WHERE idparticipante='$idparticipante' AND estado='inactivo'");
      $respuesta_estado_participante = mysqli_num_rows($consultar_estado_participante);

      if($respuesta_estado_participante>0){

         $data['status'] = "ok";
         $data['data'] = "Se ha eliminado al participante seleccionado.";
         $data['id'] = $idactividad;

      }else{
         $data['status'] = "bad";
         $data['data'] = "No se pudo eliminar al participante seleccionado.";
      }

   }else{
      $data['status'] = "bad";
      $data['data'] = "El registro seleccionado no puede ser eliminado";
   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


//ELIMINAR ACTIVIDAD

if (isset($_POST['btnCargarDatosEliminarActividad'])) {
    $IdReg = $_POST['IdRegistro'];

    $consultar_estado_actividad = mysqli_query($conection, "SELECT estado as est FROM actividades WHERE idactividades='$IdReg'");
   $respuesta_estado_actividad = mysqli_fetch_assoc($consultar_estado_actividad);
   $estado_actividad = $respuesta_estado_actividad['est'];

   if($estado_actividad!='3'){

       $query = mysqli_query($conection, "SELECT
          act.idactividades as id,
          act.nombre as nombre,
          act.descripcion as descripcion,
          act.fecha as fechaini,
          act.fechafin as fechafin,
          act.estado as estado,
          act.empresa as cliente,
          concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as responsable
      FROM actividades act, persona per, usuario usu
      WHERE per.idusuario=usu.usuario AND act.responsable=usu.idusuario AND act.idactividades='$IdReg'");
       if ($query->num_rows > 0) {
           $resultado = $query->fetch_assoc();
           $data['status'] = 'ok';
           $data['data'] = $resultado;
       } else {
           $data['status'] = 'bad';
           if (!$query) {
               $data['dataDB'] = mysqli_error($conection);
           }
           $data['data'] = 'Ocurrió un problema, pongase en contacto con soporte por favor.';
       }

    }else{

          $data['status'] = "bad";
          $data['data'] = "No es posible eliminar la actividad seleccionada debido a que su estado actual es 'FINALIZADO'.";

    }


    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);
}

if(isset($_POST['btnVerificarEliminarActividad'])){

   $idactividad = $_POST['idactividad'];

   //Verificar si existen tareas para la actividad seleccionada
   $consultar_total_tareas_finalizadas = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE vinculo='$idactividad' AND estado='3'");
   $total_tareas_finalizadas = mysqli_num_rows($consultar_total_tareas_finalizadas);

   $tareas_finalizadas = "";
   if($total_tareas_finalizadas>0){
      $tareas_finalizadas = " y de las cuales ".$total_tareas_finalizadas." con estado 'FINALIZADO'";
   }


   $consultar_total_tareas = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE vinculo='$idactividad' AND estado!='5'");
   $respuesta_total_tareas = mysqli_num_rows($consultar_total_tareas);

   if($respuesta_total_tareas > 0){

      $data['status'] = "ok";
      $data['data'] = "¿Esta seguro que desea eliminar la actividad?, tenga presente que la actividad cuenta con $respuesta_total_tareas tarea(s) registrada(s)$tareas_finalizadas.";
      $data['id'] = $idactividad;

   }else{

      $data['status'] = "bad";
      $data['data'] = "La actividad puede ser eliminada";
      $data['id'] = $idactividad;

   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}

if(isset($_POST['btnEliminarActividad'])){

   $idactividad = $_POST['idactividad'];
   $bxMotivoEliminarActividad = $_POST['bxMotivoEliminarActividad'];
   $txtDescripcionActivi = $_POST['txtDescripcionActivi'];  

   if(!empty($bxMotivoEliminarActividad)){

      if(!empty($txtDescripcionActivi)){

         $consultar_actividad = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE idactividades='$idactividad' AND estado!='5'");
         $respuesta_actividad = mysqli_num_rows($consultar_actividad);

         if($respuesta_actividad > 0){

            $eliminar_actividad = mysqli_query($conection, "UPDATE actividades SET estado='5' WHERE idactividades='$idactividad'");

            $consultar_estado_actividad = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE idactividades='$idactividad' AND estado='5'");
            $respuesta_estado_actividad = mysqli_num_rows($consultar_estado_actividad);

            if($respuesta_estado_actividad > 0){

               $data['status'] = "ok";
               $data['data'] = "Se ha eliminado la actividad seleccionada.";

            }else{
               $data['status'] = "bad";
               $data['data'] = "No se pudo eliminar la actividad seleccionada.";
            }

         }else{
            $data['status'] = "bad";
            $data['data'] = "El registro seleccionado no puede ser eliminado";
         }
      }else{
               $data['status'] = "bad";
               $data['data'] = "Escriba una breve descripcion del motivo seleccionado.";
            }

   }else{
      $data['status'] = "bad";
      $data['data'] = "Seleccione el motivo por el cual esta eliminando la actividad.";
   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


//FINALIZAR ACTIVIDAD

if(isset($_POST['btnVerificarFinalizarActividad'])){

   $idactividad = $_POST['IdRegistro'];

   //Verificar si existen tareas para la actividad seleccionada
   $consultar_total_finalizadas = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE idactividades='$idactividad' AND estado='3'");
   $total_actividades_finalizadas = mysqli_num_rows($consultar_total_finalizadas);


   if($total_actividades_finalizadas == 0){

      //VALIDAR CANTIDAD DE TAREAS FINALIZADAS / REGISTRADAS

      $consultar_tareasfinalizadas = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE vinculo='$idactividad' AND estado='3'");
      $respuesta_tareasfinalizadas = mysqli_num_rows($consultar_tareasfinalizadas);


      $consultar_totaltareas = mysqli_query($conection, "SELECT idtareas  FROM tareas WHERE vinculo='$idactividad' AND estado!='5'");
      $respuesta_totaltareas = mysqli_num_rows($consultar_totaltareas);

      if($respuesta_totaltareas>0){

         if($respuesta_totaltareas == $respuesta_tareasfinalizadas){

            $data['status'] = "ok";
            $data['data'] = "¿Esta seguro que desea finalizar la actividad?, tenga presente que una vez finalizada no podrá modificar, eliminar o añadir participantes al registro. Sin embargo si podrá seguir añadiendo tareas.";
            $data['id'] = $idactividad;

         }else{

            $data['status'] = "bad";
            $data['data'] = "La actividad no puede ser finalizada hasta que todas las tareas asociadas a la actividad tengan estado 'FINALIZADO'.";
         } 

      }else{

         $data['status'] = "bad";
         $data['data'] = "Para que la actividad pueda ser finalizada debe tener como mínimo una tarea asociada y dicha tarea debe de tener estado 'FINALIZADO'.";
      }      

   }else{

      $data['status'] = "bad";
      $data['data'] = "La actividad ya fue finalizada";

   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


if(isset($_POST['btnFinalizarActividad'])){

   $idactividad = $_POST['idactividad'];


   $consultar_actividade1 = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE idactividades='$idactividad' AND estado='4'");
   $respuesta_actividade1 = mysqli_num_rows($consultar_actividade1);

   if($respuesta_actividade1 == 0){


      $eliminar_actividad = mysqli_query($conection, "UPDATE actividades SET estado='3' WHERE idactividades='$idactividad'");

      $consultar_estado_actividad = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE idactividades='$idactividad' AND estado='3'");
      $respuesta_estado_actividad = mysqli_num_rows($consultar_estado_actividad);

      if($respuesta_estado_actividad > 0){

         $data['status'] = "ok";
         $data['data'] = "La Actividad seleccionada fue FINALIZADA";

      }else{
         $data['status'] = "bad";
         $data['data'] = "No se pudo finalizar la actividad seleccionada. Intente nuevamente.";
      }


   }else{
      $data['status'] = "bad";
      $data['data'] = "La actividad no puede ser finalizada, antes es necesario que su estado haya cambiado a 'Planificado' o 'Proceso'";
   }

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


//ELIMINAR TAREA
if(isset($_POST['btnEliminarTarea'])){

   $idtarea = $_POST['idtarea'];   

   $consultar_tarea = mysqli_query($conection, "SELECT idtareas as id, vinculo as idactividad FROM tareas WHERE idtareas='$idtarea' AND estado!='5'");
   $respuesta_tarea = mysqli_num_rows($consultar_tarea);
   $respuesta_ttarea = mysqli_fetch_assoc($consultar_tarea);
   $idact = $respuesta_ttarea['idactividad'];


   if($respuesta_tarea>0){

      $eliminar_participante = mysqli_query($conection, "UPDATE tareas SET estado='5' WHERE idtareas='$idtarea'");

      $consultar_tareas = mysqli_query($conection, "SELECT idtareas FROM tareas WHERE idtareas='$idtarea' AND estado='5'");
      $respuesta_tareas = mysqli_num_rows($consultar_tareas);

      if($respuesta_tareas>0){

         $data['status'] = "ok";
         $data['data'] = "Se ha eliminado la tarea seleccionada.";
         $data['id'] = $idact;

      }else{
         $data['status'] = "bad";
         $data['data'] = "No se pudo eliminar la tarea seleccionada. Intente nuevamente";
      }

   }else{
      $data['status'] = "bad";
      $data['data'] = "No encontramos el registro que desea eliminar. Actualice la pagina e intente nuevamente.";
   }
   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


?>