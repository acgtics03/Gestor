<?php
session_start();
require 'conexion.php';
$username = $_SESSION['user'];

   $variable = $_GET['no'];
   
       $elimina = "DELETE FROM tipos WHERE idgestion='$variable'";
       mysqli_query($conection, $elimina);
   
   
    echo '<script type="text/javascript"> 
                      alert("Registro eliminado!")
                      location.href="../Views/Tipos.php";
                      </script>';
                
?>