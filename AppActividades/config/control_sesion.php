<?php
    //session_start();
    date_default_timezone_set('America/Lima');
    $time = time();
    $fecha = date('Y-m-d');
    $hora = date("H:i:s", $time);

    //consultar id usuario
    $consultar_idusuario = mysqli_query($conection, "SELECT idusuario as id, idperfil as perfil  FROM usuario WHERE user='$valor_user'");
    $respuesta_idusuario = mysqli_fetch_assoc($consultar_idusuario);
    $idusuario = $respuesta_idusuario['id'];
    $idperfil = $respuesta_idusuario['perfil'];

    //consultar la session actual
    $consultar_sesion = mysqli_query($conection, "SELECT max(id) as id FROM system_loginusuario WHERE user='$idusuario'");
    $respuesta_sesion = mysqli_fetch_assoc($consultar_sesion);

    $idmax = $respuesta_sesion['id'];

    //verificar estado de session
    $consultar_estado = mysqli_query($conection, "SELECT estado as estad, idempresa as empresa FROM system_loginusuario WHERE id='$idmax'");
    $respuesta_estado = mysqli_fetch_assoc($consultar_estado);

    $estado = $respuesta_estado['estad'];
    $empresa = $respuesta_estado['empresa'];

    //ver empresa
    $consultar_empresa = mysqli_query($conection, "SELECT nombre as nom_empresa,ruc,razon_social,direccion FROM configuracion_empresas WHERE id='$empresa'");
    $respuesta_empresa = mysqli_fetch_assoc($consultar_empresa);
    $nombre_empresa = $respuesta_empresa['nom_empresa'];
    $ruc_empresa = $respuesta_empresa['ruc'];
    $razon_social_empresa = $respuesta_empresa['razon_social'];
    $direccion_empresa = $respuesta_empresa['direccion'];

    $_SESSION['nom_empresa'] = "";
    $_SESSION['ruc_empresa'] = "";
    $_SESSION['razon_social'] = "";
    $_SESSION['direccion'] = "";
    $_SESSION['id_empresa'] = "";
        
    $_SESSION['nom_empresa'] = $nombre_empresa;
    $_SESSION['ruc_empresa'] = $ruc_empresa;
    $_SESSION['razon_social'] = $razon_social_empresa;
    $_SESSION['direccion'] = $direccion_empresa;
    $_SESSION['id_empresa'] = $empresa;

    $mes="";
    $año = "";

    //ver periodo
    $consultar_periodo = mysqli_query($conection, "SELECT mes_desc as mes, año as año FROM planilla_mes WHERE estado='1' AND idempresa='$empresa'");
    $respuesta_periodo = mysqli_fetch_assoc($consultar_periodo);
    $cont_periodo = mysqli_num_rows($consultar_periodo);

    if($cont_periodo>0){
    $mes = $respuesta_periodo['mes'];
    $año = $respuesta_periodo['año'];
    }
    $_SESSION['periodo'] = $año." - ".$mes;
    
    //Consultar Perfil-Accesos
    $consultar_perfil = mysqli_query($conection, "SELECT estado as est FROM configuracion_perfiles_modulos WHERE idperfil='$idperfil' AND idmodulo='M001' AND idsubmodulo='SM01'");
    $respuesta_perfil = mysqli_fetch_assoc($consultar_perfil);

    //MODULO EMPRESA
    $input_ocultar = "";
    $mod01 = $respuesta_perfil['est']; 
    if($mod01=="0"){$input_ocultar="hidden";}
    
    $tipocambio = "0.00";
    $rmv = "0.00";
    $uit="0.00";
    
    //VER DATO TIPO DE CAMBIO
    $query = mysqli_query($conection,"SELECT max(item) as item FROM configuracion_tipocambio WHERE idempresa='$empresa' AND fectermino>='$fecha'");
       $query_max = mysqli_fetch_assoc($query);
       $idmax = $query_max['item'];
        
       if(!empty($idmax)){
           
        $query_tipocambio = mysqli_query($conection,"SELECT monto as monto FROM configuracion_tipocambio WHERE idempresa='$empresa' AND item='$idmax'");
        $query_tipocambiovalor = mysqli_fetch_assoc($query_tipocambio);
        $tipocambio = $query_tipocambiovalor['monto'];
        
       }else{
           
           $tipocambio ="0.00";
       }
       
      //RMV
       $query = mysqli_query($conection,"SELECT max(item) as item FROM configuracion_rmv WHERE idempresa='$empresa'");
       $query_max = mysqli_fetch_assoc($query);
       $idmax = $query_max['item'];
        
       if(!empty($idmax)){
           
        $query_rmv = mysqli_query($conection,"SELECT monto as monto FROM configuracion_rmv WHERE idempresa='$empresa' AND item='$idmax'");
        $query_rmvvalor = mysqli_fetch_assoc($query_rmv);
        $rmv = $query_rmvvalor['monto'];
        
       }else{
           
           $rmv ="0.00";
       }
       
       
       //UIT
       $query = mysqli_query($conection,"SELECT max(item) as item FROM configuracion_uit WHERE idempresa='$empresa'");
       $query_max = mysqli_fetch_assoc($query);
       $idmax = $query_max['item'];
        
       if(!empty($idmax)){
           
        $query_uit = mysqli_query($conection,"SELECT monto as monto FROM configuracion_uit WHERE idempresa='$empresa' AND item='$idmax'");
        $query_uitvalor = mysqli_fetch_assoc($query_uit);
        $uit = $query_uitvalor['monto'];
        
       }else{
           
           $uit ="0.00";
       }

    
    /*
    if(empty($_SESSION['id_empresa'])){
        
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="https://acg-soft.com/ti/extranet/Nominas/"';
        echo '</script>';
        
    }
    */

?>