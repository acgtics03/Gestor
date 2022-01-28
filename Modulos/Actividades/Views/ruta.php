<?php

$valor = $_SESSION['ruta'];

if($valor=="principal"){
    header('location: Seguimiento_ps.php');
}else{
    header('location: Seguimiento_subps.php');
}

?>