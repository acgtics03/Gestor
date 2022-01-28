<?php

date_default_timezone_set('America/Lima');
session_start();
 require 'conexion.php';
 $username = $_SESSION['user'];
 $hora = date("H:i:s", time());;
 $fecha = date('Y-m-d');



 $txt_comentario = $_POST['comentario'];

   $id_tarea = $_SESSION['idtarea'];
   $id_usuario = $_SESSION['idusuar'];

   if(isset($_POST['comentar'])){

    if(!empty($txt_comentario)){

        //consulta id actividad
        $consulta_actividad = mysqli_query($conection, "SELECT vinculo as id FROM tareas WHERE idtareas='$id_tarea'");
        $consulta_actividadr = mysqli_fetch_assoc($consulta_actividad);

        $idact = $consulta_actividadr['id'];

        //consultar color de participante
        $consulta_idcolor = mysqli_query($conection, "SELECT idcolor as id FROM participantes_tareas WHERE idactividad='$idact' AND participante='$id_usuario'");
        $consulta_idcolores = mysqli_fetch_assoc($consulta_idcolor);

        $id_color = $consulta_idcolores['id'];
       
        $insertar_coment = mysqli_query($conection, "INSERT INTO coment_tareas(idtarea, comentario, idusuario, fecha, hora, user_registro, idcolor) VALUES ('$id_tarea','$txt_comentario','$id_usuario','$fecha','$hora','$username','$id_color')");

        $consulta_comentario = mysqli_query($conection, "SELECT * FROM coment_tareas WHERE idusuario='$id_usuario' AND comentario='$txt_comentario'");

        $consulta_comentarior = mysqli_num_rows($consulta_comentario);

        if($consulta_comentarior>0){
            echo '<script>alert("REGISTRO COMPLETADO! El comentario fue grabado exitosamente.");
            location.href ="../Views/ComentariosTareas.php";</script>';
        }else{
            echo '<script>alert("Error! El registro no fue completado. Intente nuevamente, Gracias.");
            window.history.go(-1);</script>';
        }
    }else{
     echo '<script>alert("Error! Ingrese un comentario.");
     window.history.go(-1);</script>';
    }

   }

?>