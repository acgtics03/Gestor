<?php
    date_default_timezone_set('America/Lima');
    require_once '../conexion.php';
    session_start();
    setlocale(LC_TIME, "spanish");
    $username = $_SESSION['user'];
   
    if(!empty($username)){                              
    $campo_busqueda = 'hidden=""';                                
          
    $consultar_usuario = mysqli_query($conection, "SELECT idusuario as usu FROM usuario WHERE usuario='$username'");
    $respuesta_usuario = mysqli_fetch_assoc($consultar_usuario);
    
    $idusu = $respuesta_usuario['usu'];
    
    $valor = 0;
    $nom_mes = "";
    $nom_area = "";
    $nom_super = "";
    $nom_mes= strftime("%B");
    $nom_area = "Seleccionar";
    $nom_super = "Seleccionar";
    $mes = date("m");
    $year= strftime("%Y");
    $nom_anio = $year;
    
    if($idusu == '38'){
        
        $campo_busqueda = '';  
        $valor = 1;
                
        if(!empty($_POST)){
            
            if(isset($_POST['btnBuscar'])){
                $contador = 0;
                $query_area = "";
                $query_supervisor = "";
                $query_anio = "";
                $query_mes = "";
                $query_anio = "AND YEAR(a.fecha)='$year'";
                $query_mes = "AND MONTH(a.fecha)='$mes'";
                
                if(!empty($_POST['bxanio'])){
                    $year = $_POST['bxmes'];
                    $contador = 1;
                    $query_anio = "AND YEAR(a.fecha)='$year'";
                    if($year=="1"){
                        $query_anio = "";
                        $nom_anio="Todos";
                    }
                }
                
                if(!empty($_POST['bxmes'])){
                    $mes = $_POST['bxmes'];
                    $contador = 1;
                    $query_mes = "AND MONTH(a.fecha)='$mes'";
                    $nom_mes = strftime("%B", mktime(0, 0, 0, $mes, 10));
                     
                     if($mes=="13"){
                        $query_mes = "";
                        $nom_mes = "Todos";
                    }
                }
                
                if(!empty($_POST['bxarea'])){
                    $idarea = $_POST['bxarea'];
                    $query_area = "AND p.idArea='$idarea'";
                    $contador = 1;
                    $consultar1=mysqli_query($conection, "SELECT idArea as id, Area as area FROM area WHERE idArea='$idarea'");
                    $respuesta1 = mysqli_fetch_assoc($consultar1);
                    $idsuper1 = $respuesta1['area'];
                    $nom_area= $idsuper1;
                }
                
                if(!empty($_POST['bxsupervisor'])){
                    $idsupervisor = $_POST['bxsupervisor'];
                    $consultar=mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$idsupervisor'");
                    $respuesta = mysqli_fetch_assoc($consultar);
                    $idsuper = $respuesta['id'];
                    $query_supervisor = "AND (a.responsable='$idsuper' OR p.idJefeInmediato='$idsupervisor')";
                    $contador = 1;
                    $consultar2=mysqli_query($conection, "SELECT idusuario, concat(SUBSTRING_INDEX(nombre,' ',1),' ',SUBSTRING_INDEX(apellido,' ',1)) as datos FROM persona WHERE idusuario='$idsupervisor'");
                    $respuesta2 = mysqli_fetch_assoc($consultar2);
                    $idsuper2 = $respuesta2['datos'];
                    $nom_super = $idsuper2;
                   
                }
                
                
                
                if($contador > 0){
                    
                    $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , date_format(a.Horaini, '%H:%i') as hini,
                    a.fechafin as fechafin, date_format(a.Horafin, '%H:%i') as hfin, a.estado as estado, t.idgestion as nom, 
                    concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable, a.responsable as respons 
                    FROM actividades a, persona p ,usuario u, tipos t, gestion_estados ge
                    WHERE u.usuario=p.idusuario AND ge.nombre=a.estado AND a.responsable=u.idusuario AND t.idgestion=a.nombre $query_area $query_supervisor $query_anio $query_mes AND a.identificador='DIARIO' ORDER BY  ge.idgestione, a.fecha ASC");
            
                }
                
            }else{
                $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , date_format(a.Horaini, '%H:%i') as hini,
                    a.fechafin as fechafin, date_format(a.Horafin, '%H:%i') as hfin, a.estado as estado, t.idgestion as nom, 
                    concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable, a.responsable as respons 
                    FROM actividades a, persona p ,usuario u, tipos t, gestion_estados ge
                    WHERE u.usuario=p.idusuario AND ge.nombre=a.estado AND a.responsable=u.idusuario AND t.idgestion=a.nombre AND a.responsable ='$idusu' AND MONTH(a.fecha)='$mes' AND YEAR(a.fecha)='$year' AND a.identificador='DIARIO' ORDER BY  ge.idgestione, a.fecha ASC");
            
            }
            
            if(isset($_POST['btnLimpiar'])){
            
                $nom_mes= strftime("%B");
                $nom_area = "Seleccionar";
                $nom_super = "Seleccionar";
                $year= strftime("%Y");
                $nom_anio = $year;
                  
                $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , date_format(a.Horaini, '%H:%i') as hini,
                    a.fechafin as fechafin, date_format(a.Horafin, '%H:%i') as hfin, a.estado as estado, t.idgestion as nom, 
                    concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable, a.responsable as respons 
                    FROM actividades a, persona p ,usuario u, tipos t, gestion_estados ge
                    WHERE u.usuario=p.idusuario AND ge.nombre=a.estado AND a.responsable=u.idusuario AND t.idgestion=a.nombre AND a.responsable ='$idusu' AND MONTH(a.fecha)='$mes' AND YEAR(a.fecha)='$year' AND a.identificador='DIARIO' ORDER BY  ge.idgestione, a.fecha ASC");
            
                
            }
            
        }
    }else{
        
        $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , date_format(a.Horaini, '%H:%i') as hini,
        a.fechafin as fechafin, date_format(a.Horafin, '%H:%i') as hfin, a.estado as estado, t.idgestion as nom, 
        concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable, a.responsable as respons FROM actividades a, persona p ,usuario u, tipos t, gestion_estados ge
        WHERE u.usuario=p.idusuario AND ge.nombre=a.estado AND a.responsable=u.idusuario AND t.idgestion=a.nombre AND p.idJefeInmediato='$username' AND YEAR(a.fecha)='$year' AND MONTH(a.fecha)='$mes' AND a.identificador='DIARIO' ORDER BY  ge.idgestione, a.fecha ASC");
        
    }
    }else{
            session_destroy();
            echo '<script type="text/javascript">';
            echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
            echo '</script>';
            echo '<script type="text/javascript">';
            echo 'location.href="../../../index.php"';
            echo '</script>';
    } 
?>
