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

    if(empty($username)){
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="../../../index.php"';
        echo '</script>';
    }

$data = array();
$dataList = array();


if(isset($_POST['ListarParticipantes'])){

    $Codigo = $_POST['idactividadPart'];

    $query = mysqli_query($conection, "SELECT ptar.idparticipante as id,
        concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as participante
        FROM participantes_tareas ptar, usuario usu, persona per
        WHERE ptar.participante=usu.idusuario
        AND usu.usuario=per.idusuario
        AND ptar.idactividad='$Codigo' AND ptar.estado='activo'
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

