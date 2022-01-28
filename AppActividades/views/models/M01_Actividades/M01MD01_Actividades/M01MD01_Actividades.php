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


   //$varlor=$_POST['nombre'];
if(!empty($_POST)){


     $Start=intval($_POST['start']);
     $Length=intval($_POST['length']);
     if ($Length > 0)
     {
         $Start = (($Start / $Length) + 1);
     }
     if($Start==0){
         $Start=1;
        }

    //echo json_encode($data);
    $query = mysqli_query($conection,"call pa_listar_actividadesdiarias('$ids','$fecha','$Start','$Length','')"); 

    if($query->num_rows > 0){
     
        while($row = $query->fetch_assoc()) {
            
            $data['recordsTotal'] = intval($row["TotalRegistros"]);
            $data['recordsFiltered'] = intval($row["TotalRegistros"]);

            array_push($dataList,[
                'id' => $row['id'],
                'contador' => $row['contador'],
                'estado' => $row['estado'],
                'descEstado' => $row['descEstado'],
                'empresa' => $row['empresa'],
                'nombre' => $row['nombre'],
                'tiempo' => $row['tiempo']
            ]);}
            
        $data['data'] = $dataList;
        header('Content-type: text/javascript');
        echo json_encode($data,JSON_PRETTY_PRINT) ;

    }else{
        
        $data['recordsTotal'] = 0;
            $data['recordsFiltered'] = 0;
            $data['data'] = $dataList;
            header('Content-type: text/javascript');
            echo json_encode($data,JSON_PRETTY_PRINT) ;
    }
}
