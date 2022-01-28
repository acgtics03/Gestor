<?php
session_start();
require '../conexion.php';
$username = $_SESSION['user'];

$hora = time();
$fec = date('Y-m-d');

if (isset($_POST['btnañadir'])) {
$particip = $_POST['boxtrabajador'];

if(!empty($particip)){
$vercontrol = mysqli_query($conection, "SELECT * FROM control WHERE user='$username'");
$vercontrolrr = mysqli_fetch_assoc($vercontrol);

 $resultadps = $vercontrolrr['valor'];
 $variable = $resultadps;

$consultR = mysqli_query($conection, "SELECT * FROM participantes WHERE participante='$particip' AND idps='$variable'");
$ver = mysqli_num_rows($consultR);
if($ver>0){
    echo '<script> alert("ERROR! El trabajador seleccionado ya se encuentra registrado como participante."); window.history.go(-1); </script>';
}else{
    //Insertar Participante
    $insertPart = mysqli_query($conection, "INSERT participantes(participante, idps, estado, horaregistro, fecharegistro) VALUES ('$particip','$variable','activo','$hora','$fec')");

    $consultReg = mysqli_query($conection, "SELECT * FROM participantes WHERE participante='$particip' AND idps='$variable'");
    $verf = mysqli_num_rows($consultReg);

    if($verf>0){
        echo '<script> alert("El trabajador seleccionado a sido registrado como participante!"); location.href ="../Views/Seguimiento_ps.php";</script>';
    }else{
        echo '<script> alert("ERROR! El registro no fue completado. Intente nuevamente."); window.history.go(-1); </script>';
    }
  }
}else{
    echo '<script> alert("ERROR! Seleccione un participante."); window.history.go(-1); </script>';
}
}
?>