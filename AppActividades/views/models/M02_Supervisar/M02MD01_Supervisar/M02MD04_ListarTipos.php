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

if (isset($_POST['ReturnListaMiembros'])) {
    $id_area = $_POST['area'];
    $query = mysqli_query($conection, "SELECT u.idusuario as valor, concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as texto FROM persona p, usuario u WHERE p.idusuario=u.usuario 
    AND p.idArea='$id_area' AND p.DNI!='10010010' AND p.estatus='Activo' GROUP BY u.usuario ORDER BY p.nombre");

    array_push($dataList, [
        'valor' => '',
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

?>