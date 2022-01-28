<?php
   session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../../config/configuracion.php";
   include_once "../../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
   $mes = date('m');
   $anio = date('Y');
   
    $fecha_hoy = date('Y-m-d');
    $mes = date('m');
    $anio = date('Y');
    $primer_dia = $anio."-".$mes."-01";

   $username = $_SESSION['usu'];
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    $ids = $consulta_idr['idusuario'];


    $consultar_perfil = mysqli_query($conection, "SELECT TipoTrabajador as tipo, idArea as area FROM persona WHERE idusuario='$username'");
    $respuesta_perfil = mysqli_fetch_assoc($consultar_perfil);

    $tipo = $respuesta_perfil['tipo'];
    $area = $respuesta_perfil['area'];

    
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
if(isset($_POST['ReturnListaActividadesc'])){

    /*  $data = array();
    $dataList = array();*/

    $responsable="";
    $cliente = "";
    $estado = "";
    $fecinicio = "";
    $fectermino = "";

    $txtfiltroFecInicio = isset($_POST['txtfiltroFecInicioc']) ? $_POST['txtfiltroFecInicioc'] : Null;
    $txtfiltroFecInicior = trim($txtfiltroFecInicio);

    $txtfiltroFecTermino = isset($_POST['txtfiltroFecTerminoc']) ? $_POST['txtfiltroFecTerminoc'] : Null;
    $txtfiltroFecTerminor = trim($txtfiltroFecTermino);

    $bxfiltroEstado = isset($_POST['bxfiltroEstadoc']) ? $_POST['bxfiltroEstadoc'] : Null;
    $bxfiltroEstador = trim($bxfiltroEstado);

    $bxfiltroIdentificador = isset($_POST['bxfiltroIdentificadorc']) ? $_POST['bxfiltroIdentificadorc'] : Null;
    $bxfiltroIdentificadorr = trim($bxfiltroIdentificador);

    $bxfiltroCliente = isset($_POST['bxfiltroClientec']) ? $_POST['bxfiltroClientec'] : Null;
    $bxfiltroClienter = trim($bxfiltroCliente);

    $bxfiltroResponsable = isset($_POST['bxfiltroResponsablec']) ? $_POST['bxfiltroResponsablec'] : Null;
    $bxfiltroResponsabler = trim($bxfiltroResponsable);
    
    $bxfiltroAreac = isset($_POST['bxfiltroAreac']) ? $_POST['bxfiltroAreac'] : Null;
    $bxfiltroAreac = trim($bxfiltroAreac);
  
    $querys = "";
    $query_empresa = "";
    $query_fecha2 = "";
    $query_fecha = "";
    $estado = "";
    $responsable = "";
    $query_jefe="";
    $query_area="";

    if(!empty($bxfiltroIdentificadorr)){

        if($bxfiltroIdentificadorr=='1' || $bxfiltroIdentificadorr=='todos'){

            if($tipo == "SUPERVISOR"){
                if($username=="jcucho@acg.com.pe"){

                    if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                        $responsable=""; 
                    }else{ 
                        $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; 
                    }

                    if(empty($bxfiltroAreac) || $bxfiltroAreac == "todos"){ 
                        $query_area=""; 
                    }else{ 
                        $query_area="AND p.idArea='$bxfiltroAreac'"; 
                    }

                }else{
                    if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                        $responsable=""; 
                        $query_jefe="AND (p.idJefeInmediato='".$username."' OR a.responsable='".$ids."')"; 
                    }else{ 
                        $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; 
                        $query_jefe="AND p.idJefeInmediato='".$username."'"; 
                    }
                }                
            }else{
                if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                    $responsable="AND a.responsable='".$ids."'"; 
                }else{ 
                    $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; 
                }
            }
                        

            if(empty($bxfiltroEstador)){ $estado="AND a.estado IN ('1','2')"; }else{ $estado="AND a.estado='$bxfiltroEstador'"; }
            if($bxfiltroEstador == "todos"){ $estado = ""; }
            
            $primer_dia = $anio."-".$mes."-01";
            
            if(empty($query_fecha2)){$query_fecha2="AND ((a.fecha BETWEEN '$primer_dia' AND '$fecha_hoy') OR (a.fecha<='$fecha_hoy' AND a.estado IN (1,2)))"; }

            if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fechafin='$txtfiltroFecTerminor'"; }

            if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha='$txtfiltroFecInicior'"; }

            if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ 
                $query_fecha2="AND ((a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor') OR (a.fecha<='$txtfiltroFecTerminor' AND a.estado IN (1,2)))"; 
            }

            if(empty($bxfiltroClienter) || ($bxfiltroClienter=="todos")){ $query_empresa="";}else{$query_empresa = "AND a.empresa='$bxfiltroClienter'";}

            //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";

            $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                       (if(MONTH(a.fechaRegistro)>0,concat(a.fechaRegistro,' - ', date_format(a.horaRegistro, '%H:%i')),concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')))) as registro, 
                        concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')) as fecha, 
                        concat(a.fechafin,' - ',date_format(a.Horafin, '%H:%i')) as fechafin,  
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
                        AND p.estatus='Activo' AND u.estatus='Activo'
                        AND a.estado!=5
                        $query_area
                        $query_jefe 
                        $responsable
                        $query_fecha2
                        $estado
                        $query_empresa
                        ORDER BY a.fecha DESC , ge.idgestione ASC";

        }else{

            if($tipo == "SUPERVISOR"){
                if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                    $responsable=""; 
                    $responsable2="";
                }else{ 
                    $responsable="AND a.responsable='".$bxfiltroResponsabler."'";
                    $responsable2="AND tr.responsable!='".$bxfiltroResponsabler."'";  
                }
                if(empty($bxfiltroAreac) || $bxfiltroAreac == "TODOS"){ $query_area=""; }else{ $query_area="AND p.idArea='$bxfiltroAreac'"; }
                
            }else{
                if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                    $responsable="AND a.responsable='".$ids."'"; 
                    $responsable2="AND tr.responsable!='".$ids."'";
                }else{ 
                    $responsable="AND a.responsable='".$bxfiltroResponsabler."'";
                    $responsable2="AND tr.responsable!='".$bxfiltroResponsabler."'";  
                }
            }
            if(empty($bxfiltroEstador)){ $estado="AND a.estado IN ('1','2')"; }else{ $estado="AND a.estado='$bxfiltroEstador'"; }
            if($bxfiltroEstador == "todos"){ $estado = ""; }

            if(empty($query_fecha2)){$query_fecha2="AND ((a.fecha BETWEEN '$primer_dia' AND '$fecha_hoy') OR (a.fecha<='$fecha_hoy' AND a.estado IN (1,2)))"; }

            if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fechafin='$txtfiltroFecTerminor'"; }

            if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha2="AND a.fecha='$txtfiltroFecInicior'"; }

            if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha2="AND ((a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor') OR (a.fecha<='$txtfiltroFecTerminor' AND a.estado IN (1,2)))"; }

            if(empty($bxfiltroClienter) || ($bxfiltroClienter=="todos")){ $query_empresa="";}else{$query_empresa = "AND a.empresa='$bxfiltroClienter'";}


            //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";

            $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                        (if(MONTH(a.fechaRegistro)>0,concat(a.fechaRegistro,' - ', date_format(a.horaRegistro, '%H:%i')),concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')))) as registro, 
                        concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')) as fecha, 
                        concat(a.fechafin,' - ',date_format(a.Horafin, '%H:%i')) as fechafin,  
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
                        AND p.estatus='Activo' AND u.estatus='Activo'
                        AND a.estado!=5
                        $query_area
                        $responsable
                        $responsable2
                        $query_fecha2
                        $estado
                        $query_empresa
                        ORDER BY a.fecha DESC , ge.idgestione ASC";


        }        

    }else{

         if($tipo == "SUPERVISOR"){
                if($username=='jcucho@acg.com.pe'){

                    if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                        $responsable=""; 
                    }else{ 
                        $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; 
                    }

                    if(empty($bxfiltroAreac) || $bxfiltroAreac == "todos"){ 
                        $query_area=""; 
                    }else{ 
                        $query_area="AND p.idArea='$bxfiltroAreac'"; 
                    }

                }else{
                    if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ 
                        $responsable=""; 
                        $query_jefe="AND (p.idJefeInmediato='".$username."' OR a.responsable='".$ids."')"; 
                    }else{ 
                        $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; 
                        $query_jefe="AND p.idJefeInmediato='".$username."'"; 
                    }
                }   
            }else{
                if(empty($bxfiltroResponsabler) || $bxfiltroResponsabler == "todos"){ $responsable="AND a.responsable='".$ids."'"; }else{ $responsable="AND a.responsable='".$bxfiltroResponsabler."'"; }
            }

        if(empty($bxfiltroEstador)){ 
            $estado="AND a.estado IN ('1','2')"; 
        }else{ 
            $estado="AND a.estado='$bxfiltroEstador'"; 
        }

        if($bxfiltroEstador == "todos"){ 
            $estado = ""; 
        }

        if(empty($query_fecha)){$query_fecha="AND ((a.fecha BETWEEN '$primer_dia' AND '$fecha_hoy') OR (a.fecha<='$fecha_hoy' AND a.estado IN (1,2)))"; }

        if(empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fechafin='$txtfiltroFecTerminor'"; }

        if(!empty($txtfiltroFecInicior) && empty($txtfiltroFecTerminor)){ $query_fecha="AND a.fecha='$txtfiltroFecInicior'"; }

        if(!empty($txtfiltroFecInicior) && !empty($txtfiltroFecTerminor)){ $query_fecha="AND ((a.fecha BETWEEN '$txtfiltroFecInicior' AND '$txtfiltroFecTerminor') OR (a.fecha<='$txtfiltroFecTerminor' AND a.estado IN (1,2)))"; }

        if(empty($bxfiltroClienter) || ($bxfiltroClienter=="todos")){ $query_empresa="";}else{$query_empresa = "AND a.empresa='$bxfiltroClienter'";}

        //$querys = "call pa_listar_actividades('$responsable','$bxfiltroClienter','$estado','$fecinicio','$txtfiltroFecTerminor',$Start, $Length, '')";


        $querys = "SELECT 
                        a.idactividades as id,
                        t.nombre as nombre, 
                        cc.sDescripcion as cliente,
                        (if(MONTH(a.fechaRegistro)>0,concat(a.fechaRegistro,' - ', date_format(a.horaRegistro, '%H:%i')),concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')))) as registro, 
                        concat(a.fecha,' - ', date_format(a.Horaini, '%H:%i')) as fecha, 
                        concat(a.fechafin,' - ',date_format(a.Horafin, '%H:%i')) as fechafin, 
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
                        AND p.estatus='Activo' AND u.estatus='Activo'
                        AND a.estado!=5
                        $query_area
                        $query_jefe
                        $responsable
                        $query_fecha
                        $estado
                        $query_empresa
                        ORDER BY a.fecha DESC , ge.idgestione ASC";

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
        ORDER BY ge.idgestione, tr.fecha, tr.Horaini ASC
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
