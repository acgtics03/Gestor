<?php
 


if(!empty($_POST)){
    if(isset($_POST['btnSalir'])){    

      $data['status'] = "ok";
      $data['data'] = $HOST;
     
      header('Content-type: text/javascript');
      echo json_encode($data,JSON_PRETTY_PRINT);

    }
}
    

?>