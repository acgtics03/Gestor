<?php
 
   session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../../config/configuracion.php";
   include_once "../../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
   
	$username = $_SESSION['usu'];
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    $ids = $consulta_idr['idusuario'];  


if(!empty($_POST)){
    if(isset($_POST['btnRegistrar'])){


        $bxTipoActividad = isset($_POST['bxTipoActividad']) ? $_POST['bxTipoActividad'] : Null;
        $bxTipoActividadr = trim($bxTipoActividad);   

        $txtDescripcion = isset($_POST['txtDescripcion']) ? $_POST['txtDescripcion'] : Null;
        $txtDescripcionr = trim($txtDescripcion); 

        $bxResponsable = isset($_POST['bxResponsable']) ? $_POST['bxResponsable'] : Null;
        $bxResponsabler = trim($bxResponsable); 

        $bxCliente = isset($_POST['bxCliente']) ? $_POST['bxCliente'] : Null;
        $bxClienter = trim($bxCliente); 

        $bxTipo = isset($_POST['bxTipo']) ? $_POST['bxTipo'] : Null;
        $bxTipor = trim($bxTipo); 

        $txtFechaInicio = isset($_POST['txtFechaInicio']) ? $_POST['txtFechaInicio'] : Null;
        $txtFechaInicior = trim($txtFechaInicio); 

        $txtFechaTermino = isset($_POST['txtFechaTermino']) ? $_POST['txtFechaTermino'] : Null;
        $txtFechaTerminor = trim($txtFechaTermino); 

        $txtHoraInicio = isset($_POST['txtHoraInicio']) ? $_POST['txtHoraInicio'] : Null;
        $txtHoraInicior = trim($txtHoraInicio); 

        $txtMinutosInicio = isset($_POST['txtMinutosInicio']) ? $_POST['txtMinutosInicio'] : Null;
        $txtMinutosInicior = trim($txtMinutosInicio); 

        $txtHoraFin = isset($_POST['txtHoraFin']) ? $_POST['txtHoraFin'] : Null;
        $txtHoraFinr = trim($txtHoraFin); 

        $txtMinutosFin = isset($_POST['txtMinutosFin']) ? $_POST['txtMinutosFin'] : Null;
        $txtMinutosFinr = trim($txtMinutosFin); 

        $txtHoraInicioReal = isset($_POST['txtHoraInicioReal']) ? $_POST['txtHoraInicioReal'] : Null;
        $txtHoraInicioRealr = trim($txtHoraInicioReal); 

        $txtMinutosInicioReal = isset($_POST['txtMinutosInicioReal']) ? $_POST['txtMinutosInicioReal'] : Null;
        $txtMinutosInicioRealr = trim($txtMinutosInicioReal); 

        $txtHoraFinReal = isset($_POST['txtHoraFinReal']) ? $_POST['txtHoraFinReal'] : Null;
        $txtHoraFinRealr = trim($txtHoraFinReal); 

        $txtMinutosFinReal = isset($_POST['txtMinutosFinReal']) ? $_POST['txtMinutosFinReal'] : Null;
        $txtMinutosFinRealr = trim($txtMinutosFinReal); 

        $hora_inicio = "";
        $hora_termino = "";

        $hora_inicio_real = "";
        $hora_termino_real = "";

        $hora_inicio = $txtHoraInicior.":".$txtMinutosInicior.":00";
        $hora_termino = $txtHoraFinr.":".$txtMinutosFinr.":00";       

        $var_horas = 0;

        if(!empty($bxTipoActividadr)){

           if(!empty($txtDescripcionr)){

               if(!empty($bxResponsabler)){

                  if(!empty($bxClienter)){

                     if(!empty($bxTipor)){

                        if(!empty($txtFechaInicior) && !empty($txtFechaTerminor)){

                           if(!empty($txtHoraInicior) && !empty($txtHoraFinr)){

                              if($txtFechaInicior <= $txtFechaTerminor){


                                 if($txtFechaInicior < $txtFechaTerminor){

                                    if(empty($txtHoraInicioRealr)){

                                       $hora_inicio_real = $hora_inicio;

                                    }else{
                                       $hora_inicio_real = $txtHoraInicioRealr.":".$txtMinutosInicioRealr.":00";
                                    }

                                    if(empty($txtHoraFinRealr)){

                                       $hora_termino_real = $hora_termino;

                                    }else{
                                       $hora_termino_real = $txtHoraFinRealr.":".$txtMinutosFinRealr.":00";
                                    }

                                     $var_horas = 1;

                                 }else{
                                    if ($txtFechaInicior == $txtFechaTerminor) {
                                       if (($txtHoraInicior < $txtHoraFinr) || (($txtHoraInicior == $txtHoraFinr) && ($txtMinutosInicior < $txtMinutosFinr))) {
                                          if(empty($txtHoraInicioRealr)){

                                             $hora_inicio_real = $hora_inicio;

                                          }else{
                                             $hora_inicio_real = $txtHoraInicioRealr.":".$txtMinutosInicioRealr.":00";
                                          }

                                          if(empty($txtHoraFinRealr)){

                                             $hora_termino_real = $hora_termino;

                                          }else{
                                             $hora_termino_real = $txtHoraFinRealr.":".$txtMinutosFinRealr.":00";
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

                                    $consultar_actividad = mysqli_query($conection, "SELECT idactividades as id FROM actividades WHERE nombre='$bxTipoActividadr' AND descripcion='$txtDescripcionr' AND fecha='$txtFechaInicior' AND responsable='$bxResponsabler' AND empresa='$bxClienter'");
                                    $respuesta_actividad = mysqli_num_rows($consultar_actividad);

                                    if($respuesta_actividad==0){           

                                       $insertar_actividad = mysqli_query($conection, "INSERT INTO actividades(nombre, descripcion, fecha, fechafin, Horaini, Horafin, Horainireal, Horafinreal, estado, responsable, identificador, empresa, area, tipo_actividad, horaRegistro, fechaRegistro) VALUES 
                                          ('$bxTipoActividadr','$txtDescripcionr','$txtFechaInicior','$txtFechaTerminor','$hora_inicio','$hora_termino', '$hora_inicio_real', '$hora_termino_real','1','$bxResponsabler','DIARIO','$bxClienter','$bxTipor','PROPIO', '$hora', '$fecha')");

                                       $consultar_actividad_2 = mysqli_query($conection, "SELECT idactividades as id FROM actividades WHERE nombre='$bxTipoActividadr' AND descripcion='$txtDescripcionr' AND fecha='$txtFechaInicior' AND responsable='$bxResponsabler' AND empresa='$bxClienter' AND estado='1'");
                                       $respuesta_act = mysqli_fetch_assoc($consultar_actividad_2);
                                       $idactividad = $respuesta_act['id'];


                                       $consultar_jefeinmediato = mysqli_query($conection, "SELECT idJefeInmediato as jefe FROM persona p, usuario u WHERE p.idusuario=u.usuario AND u.idusuario='$bxResponsabler'");
                                       $respuesta_jefeinmediato = mysqli_fetch_assoc($consultar_jefeinmediato);
                                       $jefe = $respuesta_jefeinmediato['jefe'];
                                       
                                       $consultar_idjefeinmediato = mysqli_query($conection, "SELECT idusuario as idjefe FROM usuario u WHERE u.usuario='$jefe'");
                                       $respuesta_idjefeinmediato = mysqli_fetch_assoc($consultar_idjefeinmediato);
                                       $idjefe = $respuesta_jefeinmediato['idjefe'];


                                       $insertar_participantes = mysqli_query($conection, "INSERT INTO participantes_tareas(participante, idactividad, estado, horaregistro, fecharegistro) VALUES 
                                          ('$bxResponsabler','$idactividad','activo','$hora','$fecha'),
                                          ('$idjefe','$idactividad','activo','$hora','$fecha')");

                                       
                                       $respuesta_actividad_2 = mysqli_num_rows($consultar_actividad_2);

                                       if($respuesta_actividad_2>0){

                                          $data['status'] = "ok";
                                          $data['data'] = "Se registro al actividad.";

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
                                    $data['data'] = "La fecha de inicio no puede ser mayor a la fecha de termino.";
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
            
               }else{
                  $data['status'] = "bad";
                  $data['data'] = "Seleccionar el responsable de la Actividad.";
               }
            
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
}
    

?>