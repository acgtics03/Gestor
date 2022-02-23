<?php
session_start();
date_default_timezone_set('America/Lima');
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');
$data = array();
$dataList= array();

$username = $_SESSION['usu'];
$consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
$consulta_idr = mysqli_fetch_assoc($consulta_id);
$ids = $consulta_idr['idusuario'];

$consultar_area = mysqli_query($conection, "SELECT idArea as area FROM persona WHERE idusuario = '$username'");
$respuesta_area = mysqli_fetch_assoc($consultar_area);
$area = $respuesta_area['area'];

if (isset($_POST['btnListarTipoCarpeta'])) {

    $query = mysqli_query($conection, "SELECT texto1 as valor, nombre_corto as texto FROM configuracion_detalle WHERE codigo_tabla ='_TIPO_CARPETA' AND estado='ACTI' ORDER BY codigo_item ASC");

   /* array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);*/

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}


if (isset($_POST['btnListarTiposActividad'])) {

    $query = mysqli_query($conection, "SELECT idgestion as valor, nombre as texto FROM tipos WHERE estado='Activo' AND (area='$area' OR area='Todos') AND (categoria='ACTIVIDAD'  OR categoria='Todos')  ORDER BY nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['btnListarResponsables'])) {

    $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u WHERE p.idusuario=u.usuario AND (idJefeInmediato='$username' OR p.idusuario='$username') AND p.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['btnListarFiltroResponsables'])) {

    if($username=='jcucho@acg.com.pe'){
         $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u WHERE p.idusuario=u.usuario AND p.idusuario!='$username' AND p.estatus='Activo' AND u.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");
    }else{
        $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u WHERE p.idusuario=u.usuario AND (idJefeInmediato='$username' OR p.idusuario='$username') AND p.estatus='Activo' AND u.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");
    }
    array_push($dataList, [
        'valor' => 'todos',
        'texto' => 'TODOS',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['btnListarTiposActividadPopup'])) {

    $query = mysqli_query($conection, "SELECT idgestion as valor, nombre as texto FROM tipos WHERE estado='Activo' AND (area='$area' OR area='Todos') AND (categoria='ACTIVIDAD'  OR categoria='Todos')  ORDER BY nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['btnListarResponsablesPopup'])) {

    $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u WHERE p.idusuario=u.usuario AND (p.idJefeInmediato='$username' OR p.idusuario='$username') AND p.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}


if (isset($_POST['btnListarTiposActividadTarea'])) {

    $query = mysqli_query($conection, "SELECT idgestion as valor, nombre as texto FROM tipos WHERE estado='Activo' AND (area='$area' OR area='Todos') AND (categoria='ACTIVIDAD'  OR categoria='Todos')  ORDER BY nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}

if (isset($_POST['btnListarResponsablesTarea'])) {

    $idact = $_POST['idactividad'];

    $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u, participantes_tareas pt WHERE p.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.idactividad='$idact' AND p.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}


if (isset($_POST['btnListarResponsablesTareaEditar'])) {

    $idact = $_POST['idactividad'];

    $consultar_idacti = mysqli_query($conection, "SELECT vinculo as id FROM tareas WHERE idtareas='$idact'");
    $respuesta_idacti = mysqli_fetch_assoc($consultar_idacti);
    $idactividades = $respuesta_idacti['id'];

    $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u, participantes_tareas pt WHERE p.idusuario=u.usuario AND u.idusuario=pt.participante AND pt.idactividad='$idactividades' AND p.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar',
    ]);

    if ($query->num_rows > 0) {

        while ($row = $query->fetch_assoc()) {
            array_push($dataList, [
                'valor' => $row['valor'],
                'texto' => $row['texto'],
            ]);}
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    } else {
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}


?>