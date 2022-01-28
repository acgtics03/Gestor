<?php
	//Activar sesión
	session_start();

	//Recuperar variable de usuario
	$account=$_SESSION['user'];
	
	//Conexión con BD
    require_once 'conexion.php';
        
    $consulta = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$account' AND idPerfil='3'");
    $dato = mysqli_num_rows($consulta);
    
    if($dato>0){
        header('location: SelectorAdmin.php');
    }

    $consulta2 = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$account' AND idPerfil='1'");
    $dato2 = mysqli_num_rows($consulta2);

    if($dato2>0){
        header('location: ../Modulo_administrador/HomeAdmin.php');
      }

    $consulta3 = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario='$account' AND (idPerfil='2' OR idPerfil='4')");
    $dato3 = mysqli_num_rows($consulta3);

    if($dato3>0){
        header('location: SelectorIni.php');
      }
    

?>