<?php
//session_start();
include_once "config/configuracion.php";
include_once "config/conexion_app.php";
$hora = date("H:i:s", time());;
$fecha = date('Y-m-d'); 
$control = $fecha." ".$hora;

$nom_user = $_SESSION['usu'];
$consulta_idusu = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$nom_user'");
$respuesta_idusu = mysqli_fetch_assoc($consulta_idusu);
$IdUser=$respuesta_idusu['id'];

$consultar_datos = mysqli_query($conection, "SELECT concat(SUBSTRING_INDEX(p.nombre,' ',1),' ',SUBSTRING_INDEX(p.apellido,' ',1)) as usuario FROM persona p, usuario u WHERE p.idusuario=u.idusuario AND u.idusuario='$IdUser'");
$respuesta_datos = mysqli_fetch_assoc($consultar_datos);
$datos = $respuesta_datos['usuario'];

?>