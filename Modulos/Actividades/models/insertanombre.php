<?php
session_start();
require '../conexion.php';
$username = $_SESSION['user'];

$hora = date("H:i:s", time());;
$fecha = date('Y-m-d');

$nom = isset($_POST['nombre']) ? $_POST['nombre'] : Null;
$nomr = trim($nom);

$categoria = isset($_POST['bxxcategoria']) ? $_POST['bxxcategoria'] : Null;
$categoriar = trim($categoria);

$area = isset($_POST['bxxarea']) ? $_POST['bxxarea'] : Null;
$arear = trim($area);

if (isset($_POST['btnCrear'])) {


        $consultarre = mysqli_query($conection, "SELECT * FROM tipos WHERE nombre='$nomr' AND categoria='$categoriar' AND arear='$arear'");
        $resul = mysqli_num_rows($consultarre);
        
        $consulta_id = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
        $consulta_idr = mysqli_fetch_assoc($consulta_id);
        
        $id = $consulta_idr['id'];

        if ($resul == 0) {

            $insertar = mysqli_query($conection, "INSERT INTO tipos(nombre, gestor,fecharegistro, horaregistro, area, categoria) VALUES ('$nomr','$id','$fecha','$hora','$arear','$categoriar')");

            $consultarreg = mysqli_query($conection, "SELECT * FROM tipos WHERE nombre='$nomr' AND categoria='$categoriar' AND area='$arear'");
            $result = mysqli_num_rows($consultarreg);

            if ($result > 0) {
                echo '<script type="text/javascript"> 
                      alert("Registro completado!")
                      location.href="../Views/Tipos.php";
                      </script>';
            } else {
                echo '<script type="text/javascript">
                      alert("ERROR! El registro no pudo ser completado. Intente nuevamente. Gracias");
                      window.history.go(-1);
                      </script>';
            }
        }else{
            echo '<script type="text/javascript">
                      alert("ERROR! El nombre ingresado ya existe. Intente con otro.");
                      window.history.go(-1);
                      </script>';
        }
}
                
?>