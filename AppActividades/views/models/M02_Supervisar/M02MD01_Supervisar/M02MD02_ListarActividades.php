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

   //$varlor=$_POST['nombre'];
if(isset($_POST['ReturnListaActividades'])){

    /*  $data = array();
    $dataList = array();*/

    $responsable="";
    $cliente = "";
    $estado = "";
    $fecinicio = "";
    $fectermino = "";

    $txtfiltroFecInicio = isset($_POST['txtfiltroFecInicio']) ? $_POST['txtfiltroFecInicio'] : Null;
    $txtfiltroFecInicior = trim($txtfiltroFecInicio);

    $txtfiltroFecTermino = isset($_POST['txtfiltroFecTermino']) ? $_POST['txtfiltroFecTermino'] : Null;
    $txtfiltroFecTerminor = trim($txtfiltroFecTermino);

    $bxfiltroEstado = isset($_POST['bxfiltroEstado']) ? $_POST['bxfiltroEstado'] : Null;
    $bxfiltroEstador = trim($bxfiltroEstado);

    $bxfiltroIdentificador = isset($_POST['bxfiltroIdentificador']) ? $_POST['bxfiltroIdentificador'] : Null;
    $bxfiltroIdentificadorr = trim($bxfiltroIdentificador);

    $bxfiltroCliente = isset($_POST['bxfiltroCliente']) ? $_POST['bxfiltroCliente'] : Null;
    $bxfiltroClienter = trim($bxfiltroCliente);

    $bxfiltroResponsable = isset($_POST['bxfiltroResponsable']) ? $_POST['bxfiltroResponsable'] : Null;
    $bxfiltroResponsabler = trim($bxfiltroResponsable);
  
    $querys = "";
    $query_empresa = "";
    $query_fecha2 = "";
    $query_fecha = "";
    $estado = "";
    $responsable = "";

    if(!empty($bxfiltroIdentificadorr)){

        if($bxfiltroIdentificadorr=='1'){

            if(empty($bxfiltroResponsabler)){ $responsable=$ids; }else{ $responsable=$bxfiltroResponsabler; }

            if(empty($bxfiltroEstador)){ $estado="AND a.estado IN ('1','2')"; }else{ $estado="AND a.estado='$bxfiltroEstador'"; }
            if($bxfiltroEstador == "todos"){ $estado = ""; }
            //if(empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="a.fecha='$fecha'"; }

            if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fechafin='$txtfiltroFecTerminor'"; }

            if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha='$txtfiltroFecInicior'"; }

            if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor'"; }

            if(!empty($bxfiltroClienter)){$query_empresa = "AND a.empresa='$bxfiltroClienter'";}

            //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";

            $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                        concat(a.fecha,' - ', a.Horaini) as fecha, 
                        concat(a.fechafin,' - ',a.Horafin) as fechafin, 
                        a.descripcion as descripcion, 
                        a.Horaini as Horaini, 
                        a.Horafin as Horafin,
                        a.estado as estado, 
                        ge.nombre as descEstado,
                        concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as dato,
                        concat((Select count(idtareas) From tareas WHERE vinculo=a.idactividades and estado='3'),' / ',(Select count(idtareas) From tareas WHERE vinculo=a.idactividades AND estado!='5')) as tareas
                        FROM actividades a, usuario u, persona p, tipos t, centrocosto cc, gestion_estados ge
                        WHERE a.responsable=u.idusuario 
                        AND u.usuario=p.idusuario
                        AND a.nombre=t.idgestion
                        AND a.empresa=cc.iCodigo
                        AND a.estado=ge.idgestione 
                        AND a.responsable='$responsable'
                        $query_fecha2
                        $estado
                        $query_empresa
                        ORDER BY ge.idgestione, a.fecha ASC";

        }else{
            if(empty($bxfiltroResponsabler)){ $responsable=$ids; }else{ $responsable=$bxfiltroResponsabler; }
            if(empty($bxfiltroEstador)){ $estado="AND a.estado IN ('1','2')"; }else{ $estado="AND a.estado='$bxfiltroEstador'"; }
            if($bxfiltroEstador == "todos"){ $estado = ""; }

            //if(empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="a.fecha='$fecha'"; }

            if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fechafin='$txtfiltroFecTerminor'"; }

            if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha='$txtfiltroFecInicior'"; }

            if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor'"; }

            if(!empty($bxfiltroClienter)){$query_empresa = "AND a.empresa='$bxfiltroClienter'";}

            //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";

            $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                        concat(a.fecha,' - ', a.Horaini) as fecha, 
                        concat(a.fechafin,' - ',a.Horafin) as fechafin, 
                        a.descripcion as descripcion, 
                        a.Horaini as Horaini, 
                        a.Horafin as Horafin,
                        a.estado as estado, 
                        ge.nombre as descEstado,
                        concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as dato,
                        concat((Select count(idtareas) From tareas WHERE vinculo=a.idactividades and estado='3'),' / ',(Select count(idtareas) From tareas WHERE vinculo=a.idactividades AND estado!='5')) as tareas
                        FROM actividades a, usuario u, persona p, tipos t, centrocosto cc, gestion_estados ge, tareas tr
                        WHERE a.responsable=u.idusuario 
                        AND u.usuario=p.idusuario
                        AND a.nombre=t.idgestion
                        AND a.empresa=cc.iCodigo
                        AND a.estado=ge.idgestione 
                        AND a.idactividades=tr.vinculo
                        AND a.responsable!='$responsable'
                        AND tr.responsable='$responsable'
                        $query_fecha2
                        $estado
                        $query_empresa
                        ORDER BY ge.idgestione, a.fecha ASC";


        }        

    }else{

        if(empty($bxfiltroResponsabler)){ $responsable=$ids; }else{ $responsable=$bxfiltroResponsabler; }
        if(empty($bxfiltroEstador)){ $estado="AND a.estado IN ('1','2')"; }else{ $estado="AND a.estado='$bxfiltroEstador'"; }
        if($bxfiltroEstador == "todos"){ $estado = ""; }

        //if(empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fecha='$fecha'"; }

        if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fechafin='$txtfiltroFecTerminor'"; }

        if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fecha='$txtfiltroFecInicior'"; }

        if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor'"; }

        if(!empty($bxfiltroClienter)){$query_empresa = "AND a.empresa='$bxfiltroClienter'";}

        //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";


        $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                        concat(a.fecha,' - ', a.Horaini) as fecha, 
                        concat(a.fechafin,' - ',a.Horafin) as fechafin, 
                        a.descripcion as descripcion, 
                        a.Horaini as Horaini, 
                        a.Horafin as Horafin,
                        a.estado as estado, 
                        ge.nombre as descEstado,
                        concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as dato,
                        concat((Select count(idtareas) From tareas WHERE vinculo=a.idactividades and estado='3'),' / ',(Select count(idtareas) From tareas WHERE vinculo=a.idactividades AND estado!='5')) as tareas
                        FROM actividades a, usuario u, persona p, tipos t, centrocosto cc, gestion_estados ge
                        WHERE a.responsable=u.idusuario 
                        AND u.usuario=p.idusuario
                        AND a.nombre=t.idgestion
                        AND a.empresa=cc.iCodigo
                        AND a.estado=ge.idgestione 
                        AND a.responsable='$responsable'
                        $query_fecha
                        $estado
                        $query_empresa
                        ORDER BY ge.idgestione, a.fecha ASC";

    }
     
    //echo json_encode($data);
    $query = mysqli_query($conection, $querys); 

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


if(isset($_POST['ReturnListaTareas'])){

    $Codigo = $_POST['Codigo'];

    $query = mysqli_query($conection, "
        SELECT 
        tr.idtareas as id,
        tr.nombre as nombre,
        tr.descripcion as descripcion,
        (if(MONTH(tr.fechaRegistro)>0,concat(tr.fechaRegistro,' - ', date_format(tr.horaRegistro, '%H:%i')),concat(tr.fecha,' - ', date_format(tr.Horaini, '%H:%i')))) as registro, 
        concat(tr.fecha,' - ',date_format(tr.Horaini, '%H:%i')) as inicio,
        concat(tr.fechafin,' - ',date_format(tr.Horafin, '%H:%i')) as termino,
        tr.estado as estado,
        ge.nombre as descEstado,
        concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as responsable
        FROM tareas tr, usuario usu, persona per, gestion_estados ge
        WHERE tr.responsable=usu.idusuario
        AND tr.estado=ge.idgestione
        AND usu.usuario=per.idusuario
        AND tr.vinculo='$Codigo' AND tr.estado!='5'
        ORDER BY tr.fecha DESC , ge.idgestione ASC
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


if(isset($_POST['ReturnListaParticipantes'])){

    $Codigo = $_POST['area'];

    $query = mysqli_query($conection, "
        SELECT 
        u.idusuario as valor,
        concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as texto
        FROM persona per, usuario u
        WHERE per.idusuario = u.usuario  
        AND per.idArea='$Codigo' AND per.estatus='Activo'
        ORDER BY per.nombre
    ");

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
