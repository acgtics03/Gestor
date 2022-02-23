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


    if (isset($_POST['btnValidarPerfil'])) {

      $query = mysqli_query($conection, "SELECT TipoTrabajador as perfil FROM persona WHERE idusuario='$username'");
      $respuesta_query = mysqli_fetch_assoc($query);
      $perfil = $respuesta_query['perfil'];

      if($perfil == "SUPERVISOR"){
          $data['status'] = "ok";
          $data['data'] = "Correcto";

      }else{
          $data['status'] = "bad";
          $data['data'] = "Error";
      }

      header('Content-type: text/javascript');
      echo json_encode($data,JSON_PRETTY_PRINT);
    }


?>