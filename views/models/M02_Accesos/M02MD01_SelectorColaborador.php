<?php

session_start();
require_once "../../config/conexion.php";
require_once "../../config/configuracion.php";
include_once "../../resources/MGeneral/MG01_ControlSession.php";

	//Recuperar variable de usuario
	$account=$_SESSION['idUser'];
	$ocultar = 'hidden=""';
    $_SESSION["timeout"] = time();
    $sql3 = "";
	
	//Consulta de variables
		$sql3 = "SELECT * FROM usuario WHERE idusuario ='$account' and idPerfil IN ('2','3','4')";
		$result3 = mysqli_query($conection, $sql3);
		$mostrar3 = mysqli_num_rows($result3);

		//ValidaciÃ³n de estado
		if($mostrar3 == 0){
			$ocultar = 'hidden=""';
		}else{
			$ocultar = 'button';
		}
		
		if($account=="admin@acg.com.pe"){
		    $ocultar = 'button';
		}

        if(isset($_POST['btnAdmin'])){

            header('location: '.$HOST.'');
    
        }


        if(!empty($_POST)){

            if(isset($_POST['btnAsistencia'])){
                header("location: M02SM03_SelectorAsistencia.php");
            }
        
            if(isset($_POST['btnVisitas'])){
                header("location: SelectorVisitas.php");
            }

            if(isset($_POST['btnActividades'])){
                header("location: Actividades/Views/index.php");
            }

            if(isset($_POST['btnControl'])){
                header("location: HomeControl.php");
            }



        }


?>