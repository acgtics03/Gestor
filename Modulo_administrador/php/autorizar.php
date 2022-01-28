<?php 
    date_default_timezone_set('America/Lima');
	require_once "../../Modulos/conexion.php";
	
    $correo=$_POST['correo2'];
    $boxencargado=$_POST['boxencargado'];
    $codigo=$_POST['codigo'];
    
    $UserName = $_SESSION['user'];
    $time = time();
    $freg = date('Y-m-d');
    $Hora = date("H:i:s", $time);


    $ver_c = mysqli_query($conection,"SELECT * FROM autorizacion WHERE idusuario='$boxencargado' AND codigo='$codigo'");
    $ver_cr = mysqli_num_rows($ver_c);

    if($ver_cr>0){
        $funcion = "autorizacion_control(idautoriza,idusuario,idregister,fecha,hora)";
    }
	 //idusuario
     $cuenta = $correo;
     $idcuenta = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$cuenta'");
     $idcuentar = mysqli_fetch_assoc($idcuenta);

     $idusuario = $idcuentar['id'];

     //idregister

     $idregister = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$UserName'");
     $idregisterr = mysqli_fetch_assoc($idregister);

     $register = $idregisterr['id'];

    $insertar="INSERT INTO $funcion VALUES ('$boxencargado','$idusuario','$register','$freg','$Hora')";

    echo $result=mysqli_query($conection,$insertar);
	

 ?>