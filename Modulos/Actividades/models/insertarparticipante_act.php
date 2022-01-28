<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

$hora = time();
$fec = date('Y-m-d');

if (isset($_POST['añadir'])) {
$particip = $_POST['boxt'];

if(!empty($particip)){
$verc = mysqli_query($conection, "SELECT * FROM control_act WHERE user='$username'");
$vercrr = mysqli_fetch_assoc($verc);

 $resultados = $vercrr['valor'];
 $variable2 = $resultados;

$consultR = mysqli_query($conection, "SELECT * FROM participantes_tareas WHERE participante='$particip' AND idactividad='$variable2'");
$ver = mysqli_num_rows($consultR);
if($ver>0){
    echo '<script> alert("Error! El trabajador seleccionado ya se encuentra como participante"); window.history.go(-1); </script>';
}else{
    //Insertar Participante
    $insertPart = mysqli_query($conection, "INSERT participantes_tareas(participante, idactividad, estado, horaregistro, fecharegistro) VALUES ('$particip','$variable2','activo','$hora','$fec')");

    $consultReg = mysqli_query($conection, "SELECT * FROM participantes_tareas WHERE participante='$particip' AND idactividad='$variable2'");
    $verf = mysqli_num_rows($consultReg);

    if($verf>0){
        echo '<script> alert("El trabajador seleccionado a sido registrado como participante!"); location.href ="../Views/SegActividades.php";</script>';
    }else{
        echo '<script> alert("Error de registro! Intente nuevamente."); window.history.go(-1); </script>';
    }
  }
}else{
    echo '<script> alert("Error! Seleccione un participante."); window.history.go(-1); </script>';
}
}
?>