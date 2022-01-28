<?php

session_start();
require_once "../../config/conexion.php";
require_once "../../config/configuracion.php";
include_once "../../resources/MGeneral/MG01_ControlSession.php";

if (!empty($_POST)) {

    if (isset($_POST['btnSalir'])) {

        include_once "../../resources/MGeneral/MG03_Salir.php";
    }


    if(isset($_POST['btnOperativo'])){

        header('location: '.$HOST.'views/M02_Accesos/M02SM01_SelectorColaborador.php');

    }

    if(isset($_POST['btnAdmin'])){

        header('location: '.$HOST.'');

    }

}

?>