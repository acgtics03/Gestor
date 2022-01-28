<?php
    date_default_timezone_set('America/Lima');
   // session_start();
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

     $consultar_idcoment = mysqli_query($conection, "SELECT idcontrolcoment AS id FROM control_coment WHERE idusuario='$iduser'");
     $cont_coment = mysqli_num_rows($consultar_idcoment);

     if($cont_coment > 0){
 
        //ACTUALIZA ID ACTIVIDAD PARA EL USUARIO
        $actualiza_id = mysqli_query($conection, "UPDATE control_coment SET idactividad='$variable' WHERE idusuario='$iduser'");

     }else{

        //INSERTAR ID ACTIVIDAD PARA EL USUARIO
        $inserta_id = mysqli_query($conection, "INSERT INTO control_coment(idactividad, idusuario, userRegistro) VALUES ('$variable','$iduser','$username')");

     }
    }

     $consultar_idcom = mysqli_query($conection, "SELECT idactividad as id FROM control_coment WHERE idusuario='$iduser'");
     $consultar_idcomr = mysqli_fetch_assoc($consultar_idcom);
 
     $idactiv = $consultar_idcomr['id'];

     //variables globales
     $_SESSION['idactividad'] = $idactiv;
     $_SESSION['idusuar'] = $iduser;

     $consulta = mysqli_query($conection, "SELECT a.idactividades as IDact, p.idusuario as IDper, t.nombre as nombre, a.descripcion as descripcion, a.responsable as respons, concat(p.apellido,' ',p.nombre) as datos ,a.estado as estado,
    cc.sDescripcion as cliente, ar.Area as tipo, a.fecha as fecini, a.fechafin as fecfin, date_format(a.Horaini, '%H:%i') as horainicio, date_format(a.Horafin, '%H:%i') as Horafin, a.responsable as respons FROM actividades a, persona p, usuario u, 
    area ar, centrocosto cc, tipos t WHERE t.idgestion=a.nombre AND a.responsable=u.idusuario AND u.usuario=p.idusuario AND p.idArea=ar.idArea AND cc.iCodigo=a.empresa 
    AND a.idactividades='$idactiv'");
    $consultar = mysqli_fetch_assoc($consulta);   

?>