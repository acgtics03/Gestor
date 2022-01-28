<?php

session_start();
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');
$data = array();
$dataList= array();
$fecha_hoy = date('Y-m-d');
$mes = date('m');
$anio = date('Y');
$primer_dia = $anio."-".$mes."-01";


if (isset($_POST['btnCargarDatosActividadReasignar'])) {
   
   
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
          concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as responsable,
          act.estado as estado,
          act.empresa as cliente,
          act.area as tipo
      FROM actividades act, usuario u, persona p
      WHERE u.usuario=p.idusuario AND act.responsable=u.idusuario AND act.idactividades='$IdReg'");
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


if(isset($_POST['btnReasignarActividad'])){

   $IdRegistro = $_POST['IdRegistro'];
   $bxAreaParticipantes = $_POST['bxAreaParticipantes'];
   $bxParticipantes = $_POST['bxParticipantes'];   

    if (!empty($bxAreaParticipantes)) {

	   	if (!empty($bxParticipantes)) {


	   		$reasignar = mysqli_query($conection, "UPDATE actividades SET responsable='$bxParticipantes' WHERE idactividades='$IdRegistro'");

	   		$consultar_act = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE responsable='$bxParticipantes' AND idactividades='$IdRegistro'");
	   		$respuesta_act = mysqli_num_rows($consultar_act);

	   		if($respuesta_act > 0){

	   			 $data['status'] = "ok";
		         $data['data'] = "Se ha reasignado la actividad seleccionada.";
		         $data['id'] = $IdRegistro;

	   		}else{

	   			$data['status'] = "bad";
	        	$data['data'] = "No se completo la reasignación de la actividad.";

	   		}

	   	}else{

	   		$data['status'] = "bad";
	        $data['data'] = "Seleccionar el nuevo responsable. Si no encuentra datos es porque antes tiene que seleccionar el campo Area.";

	   	}
   	
    }else{

   		$data['status'] = "bad";
        $data['data'] = "Seleccionar un valor del campo Area.";

   }

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


if(isset($_POST['btnRestablecerActividad'])){

   $IdRegistro = $_POST['IdRegistro'];
   $bxEstado = $_POST['bxEstadoAct'];

    if (!empty($bxEstado)) {

            $reasignar = mysqli_query($conection, "UPDATE actividades SET estado='$bxEstado' WHERE idactividades='$IdRegistro'");

            $consultar_act = mysqli_query($conection, "SELECT idactividades FROM actividades WHERE estado='$bxEstado' AND idactividades='$IdRegistro'");
            $respuesta_act = mysqli_num_rows($consultar_act);

            if($respuesta_act > 0){

                 $data['status'] = "ok";
                 $data['data'] = "Se ha restablecido la actividad seleccionada.";
                 $data['id'] = $IdRegistro;

            }else{

                $data['status'] = "bad";
                $data['data'] = "No se pudo restablecer la actividad.";

            }

    }else{

        $data['status'] = "bad";
        $data['data'] = "Seleccionar un valor del campo Estado.";

   }

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


if(isset($_POST['btnLlenarFechas'])){

 
    $data['status'] = "ok";
    $data['fecha1'] = $primer_dia;;
    $data['fecha2'] = $fecha_hoy;

   header('Content-type: text/javascript');
   echo json_encode($data,JSON_PRETTY_PRINT);
}


?>