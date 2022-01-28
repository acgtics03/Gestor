<?php
date_default_timezone_set('America/Lima');
session_start();
require '../conexion.php';
$username = $_SESSION['user'];
$hora = date("H:i:s", time());
$fecha = date('Y-m-d');

$ID = isset($_POST['ID_c']) ? $_POST['ID_c'] : Null;
$IDr = trim($ID);

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : Null;
$codigor = trim($codigo);

$consulta_usuario = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
$consulta_usuarior = mysqli_fetch_assoc($consulta_usuario);

$ID_USER = $consulta_usuarior['id'];

$consultaseguimiento = mysqli_query($conection, "SELECT * FROM autoriza_edicion_supervisor WHERE codigo='$codigor' AND idusuario='$ID_USER'");
$ress = mysqli_num_rows($consultaseguimiento);

if ($ress > 0) {

    $insertaseg = "UPDATE autoriza_edicion_supervisor SET estado='1' WHERE idusuario='$ID_USER'";
    echo $result = mysqli_query($conection, $insertaseg);

} else {
    $insertaseg = "UPDATE autoriza_edicion_supervisor SET estado='1' WHERE idus";
    echo $result = mysqli_query($conection, $insertaseg);
}

