<?php

session_start();
require_once "../../config/conexion.php";
require_once "../../config/configuracion.php";
include_once "../../resources/MGeneral/MG01_ControlSession.php";

	//Recuperar variable de usuario
	$account=$_SESSION['idUser'];
    $ocultar = 'hidden=""';
    $_SESSION["timeout"] = time();
	
	//Consulta de variables
    $sql3 = "SELECT * FROM usuario WHERE idusuario ='$account' and idPerfil IN ('2','3','4')";
    $result3 = mysqli_query($conection, $sql3);
	$mostrar3 = mysqli_num_rows($result3);

	//Validación de estado
	if($mostrar3 == 0){
		$ocultar = 'hidden=""';
	}else{
		$ocultar = 'button';
	}

	if(!empty($_POST)){

		//Variable de tiempo
		$freg = date('Y-m-d');

        if(isset($_POST['btnIrAsistencia'])){

            $_SESSION['ltd'] = $_POST['txtlatitud'];
            $_SESSION['lng'] = $_POST['txtlongitud'];
            
            header("location: SelectorAsist.php");
        }
		

		if(isset($_POST['btnIrPermiso'])){

			//Consulta BD - permiso
			$sql2 = "SELECT * FROM permiso WHERE fsol='$freg' AND user='$account'";
			$result2 = mysqli_query($conection, $sql2);
			$mostrar2 = mysqli_num_rows($result2);

			//Validación de vista
			if($mostrar2 > 0){
				header('location: SelectorPermiso.php');
			}else{
				header('location: HomePermiso.php');
			}
		}

        if(isset($_POST['btnIrAutorizar'])){
            
            header("location: SelectorAvisoPermiso.php");
        }

	}
	
	
	

?>
