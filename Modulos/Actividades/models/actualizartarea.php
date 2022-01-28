<?php 
	require_once "conexion.php";
	
	$ID=$_POST['ID'];
	$nombre2=$_POST['nombre2'];
	$descripcion2=$_POST['descripcion2'];
	$bxResp=$_POST['bxResp'];
	$boxestado=$_POST['boxestado'];
	$fecinicio=$_POST['fecinicio'];
	$horainicio=$_POST['horainicio'];
	$fecfinal=$_POST['fecfinal'];
	$horafinal=$_POST['horafinal'];
	
	if($boxestado!='PLANIFICADO'){
	    
    	$vinc = mysqli_query($conection, "SELECT vinculo FROM tareas WHERE idtareas='$ID'");
    	$vincr = mysqli_fetch_assoc($vinc);
    	
    	$idvinc = $vincr['vinculo'];
    	    
    	$total_tareas =  mysqli_query($conection, "SELECT count(*) FROM tareas WHERE vinculo='$idvinc' AND estado!='ELIMINADO'");
    	
    	$total_tareasf = mysqli_query($conection, "SELECT count(*) FROM tareas WHERE vinculo='$idvinc' AND estado='PLANIFICADO'");
    	
        	if($total_tareas == $total_tareasf){
        	    
        	    $actualiza_act = mysqli_query($conection, "UPDATE actividades SET estado='PROCESO' WHERE idactividades='$idvinc'");
        	    
        	}
    	
	}else{
	    
	   $vinc = mysqli_query($conection, "SELECT vinculo FROM tareas WHERE idtareas='$ID'");
	   
    	$vincr = mysqli_fetch_assoc($vinc);
    	
    	$idvinc = $vincr['vinculo'];
    	    
    	$total_tareas =  mysqli_query($conection, "SELECT count(*) FROM tareas WHERE vinculo='$idvinc' AND estado!='ELIMINADO'");
    	
    	$total_tareasf = mysqli_query($conection, "SELECT count(*) FROM tareas WHERE vinculo='$idvinc' AND estado='PLANIFICADO'");
    	
        	if($total_tareas != $total_tareasf){
        	    
        	    $actualiza_act = mysqli_query($conection, "UPDATE actividades SET estado='PLANIFICADO' WHERE idactividades='$idvinc'");
    	    
    	    }
	}
	$consulta = "UPDATE tareas SET nombre='$nombre2', descripcion='$descripcion2', responsable='$bxResp', estado='$boxestado', 
	fecha='$fecinicio', fechafin='$fecfinal', Horaini='$horainicio', Horafin='$horafinal' WHERE idtareas='$ID'";
	echo $result=mysqli_query($conection,$consulta);

 ?>