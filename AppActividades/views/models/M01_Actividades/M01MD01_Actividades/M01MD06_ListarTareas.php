<?php
   session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../../config/configuracion.php";
   include_once "../../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
   
   $data = array();
   $dataList = array();

   $username = $_SESSION['usu'];
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    $ids = $consulta_idr['idusuario'];


if(isset($_POST['ListarTareas'])){

    $Codigo = $_POST['txtIDActividadTareas'];

    $query = mysqli_query($conection, "
        SELECT 
        tr.idtareas as id,
        tr.nombre as nombre,
        tr.descripcion as descripcion,
        (if(MONTH(tr.fechaRegistro)>0,concat(tr.fechaRegistro,' - ', date_format(tr.horaRegistro, '%H:%i')),concat(tr.fecha,' - ', date_format(tr.Horaini, '%H:%i')))) as registro, 
        concat(tr.fecha,' - ',date_format(tr.Horaini, '%H:%i')) as inicio,
        concat(tr.fechafin,' - ',date_format(tr.Horafin, '%H:%i')) as termino,
        tr.estado as estado,
        ge.nombre as descEstado,
        concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as responsable
        FROM tareas tr, usuario usu, persona per, gestion_estados ge
        WHERE tr.responsable=usu.idusuario
        AND tr.estado=ge.idgestione
        AND usu.usuario=per.idusuario
        AND tr.vinculo='$Codigo' AND tr.estado!='5'
        ORDER BY tr.fecha DESC , ge.idgestione ASC
    ");

     if ($query->num_rows > 0) {
        while ($row = $query->fetch_assoc()) {
            $data['status'] = 'ok';
            array_push($dataList, $row
            );}

        $data['data'] = $dataList;
    } else {
        $data['status'] = 'ok';
        $data['data'] = $dataList;
    }
    header('Content-type: text/javascript');
    echo json_encode($data, JSON_PRETTY_PRINT);

}

