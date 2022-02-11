<?php

session_start();
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');
$data = array();
$dataList= array();

if (isset($_POST['btnCargarComentariosActividad'])) {
   
 
       $IdReg = $_POST['IdRegistro'];
   

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
          act.responsable as responsable,
		  act.area as tipo,
          act.estado as estado
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

if (isset($_POST['btnCargarComentariosTareas'])) {
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

?>