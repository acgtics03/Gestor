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
	
	if($boxestado!="PLANIFICADO"){
	    $idp = mysqli_query($conection, "SELECT vinculo FROM actividades WHERE idactividades='$ID'");
	    $idpr = mysqli_fetch_assoc($idp);
	    
	    $IDps = $idpr['vinculo'];
	    
	    $tot_reg = mysqli_query($conection, "SELECT * FROM actividades WHERE vinculo='$IDps' AND estado!='ELIMINADO'");
	    $tot_regr = mysqli_num_rows($tot_reg);
	    
	    $tot_pf = mysqli_query($conection, "SELECT * FROM actividades WHERE vinculo='$IDps' AND estado='PLANIFICADO'");
	    $tot_pfr = mysqli_num_rows($tot_pf);
	    
	    if($tot_regr == $tot_pfr){
	  
	    $actualiza_estado = mysqli_query($conection, "UPDATE producto_servicio SET estado = 'PROCESO' WHERE idps='$IDps'");
	    
	    }
	}else{
	   $idp = mysqli_query($conection, "SELECT vinculo FROM actividades WHERE idactividades='$ID'");
	    $idpr = mysqli_fetch_assoc($idp);
	    
	    $IDps = $idpr['vinculo'];
	    
	    $tot_reg = mysqli_query($conection, "SELECT * FROM actividades WHERE vinculo='$IDps' AND estado!='ELIMINADO'");
	    $tot_regr = mysqli_num_rows($tot_reg);
	    
	    $tot_pf = mysqli_query($conection, "SELECT * FROM actividades WHERE vinculo='$IDps' AND estado='PLANIFICADO'");
	    $tot_pfr = mysqli_num_rows($tot_pf);
	    
	    if($tot_regr != $tot_pfr){
	  
	    $actualiza_estado = mysqli_query($conection, "UPDATE producto_servicio SET estado = 'PLANIFICADO' WHERE idps='$IDps'");
	    
	    } 
	}

	$consulta = "UPDATE actividades SET nombre='$nombre2', descripcion='$descripcion2', responsable='$bxResp', estado='$boxestado', 
	fecha='$fecinicio', fechafin='$fecfinal', Horaini='$horainicio', Horafin='$horafinal' WHERE idactividades='$ID'";
	echo $result=mysqli_query($conection,$consulta);

 ?>