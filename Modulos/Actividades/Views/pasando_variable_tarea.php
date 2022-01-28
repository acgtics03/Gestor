<?php
    date_default_timezone_set('America/Lima');
    session_start();
    require 'conexion.php';
    $username = $_SESSION['user'];
    if(!empty($_GET)){
    $variable = $_GET['Jyk'];
    }
     //CONSULTAR ID USUARIO 

     $consulta_idusuario = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
     $consulta_idusuarior = mysqli_fetch_assoc($consulta_idusuario);

     $iduser = $consulta_idusuarior['id'];

     if(!empty($variable)){
     //CONSULTAR ID EN TABLA CONTROL COMENTARIOS

     $consultar_idcoment = mysqli_query($conection, "SELECT idtarea AS id FROM control_coment WHERE idusuario='$iduser'");
     $consultar_idcomentr = mysqli_fetch_assoc($consultar_idcoment);

     $cont_coment = $consultar_idcomentr['id'];

     if(!empty($cont_coment)){
 
        //ACTUALIZA ID ACTIVIDAD PARA EL USUARIO
        $actualiza_id = mysqli_query($conection, "UPDATE control_coment SET idtarea='$variable' WHERE idusuario='$iduser'");

     }else{

        //INSERTAR ID ACTIVIDAD PARA EL USUARIO
        $inserta_id = mysqli_query($conection, "UPDATE control_coment SET idtarea='$variable' WHERE idusuario='$iduser'");

     }
    }

     $consultar_idcom = mysqli_query($conection, "SELECT idtarea as id FROM control_coment WHERE idusuario='$iduser'");
     $consultar_idcomr = mysqli_fetch_assoc($consultar_idcom);
 
     $idactiv = $consultar_idcomr['id'];

     //variables globales
     $_SESSION['idtarea'] = $idactiv;
     $_SESSION['idusuar'] = $iduser;

     $consulta = mysqli_query($conection, "SELECT t.idtareas as IDact, 
     p.idusuario as IDper,  
     t.descripcion as descripcion, 
     t.responsable as respons, 
     t.nombre as nombre,
     concat(p.apellido,' ',p.nombre) as datos ,
     t.estado as estado, 
    t.fecha as fecini, t.fechafin as fecfin, 
    date_format(t.Horaini, '%H:%i') as horainicio, 
    date_format(t.Horafin, '%H:%i') as Horafin, 
    t.responsable as respons 
    FROM tareas t, persona p, usuario u, 
    area ar WHERE t.responsable=u.idusuario AND u.usuario=p.idusuario
    AND t.idtareas='$variable'");
    $consultar = mysqli_fetch_assoc($consulta);   

?>