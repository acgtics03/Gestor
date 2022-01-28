<?php

//session_start();

include_once "../config/configuracion.php";
include_once "../config/conexion_2.php";
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');
$data = array();
$dataList= array();

if (isset($_POST['ReturnListaEmpresas'])) {
    $usu = $_POST['usuario'];

    $consultar_id = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE user='$usu'");
    $respuesta_id = mysqli_fetch_assoc($consultar_id);
    
    $iduser = $respuesta_id['id'];
    
    if($iduser==1){
        $query = mysqli_query($conection, "SELECT id as valor, nombre as texto FROM configuracion_empresas ORDER BY nombre asc");
    }else{
        $query = mysqli_query($conection, "SELECT id as valor, nombre as texto FROM configuracion_empresas WHERE responsable='$iduser' ORDER BY nombre asc");
    }

    

    array_push($dataList, [
        'valor' => '',
        'texto' => 'Seleccionar Empresa',
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