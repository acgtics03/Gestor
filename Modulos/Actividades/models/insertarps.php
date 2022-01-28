<?php
session_start();
// Definir zona horaria
date_default_timezone_set('America/Lima');
require '../Views/conexion.php';
$username = $_SESSION['user'];

$hora = date("H:i:s", time());;
$fecha = date('Y-m-d');


$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : Null;
$categoriar = trim($categoria);

$cliente = isset($_POST['cliente']) ? $_POST['cliente'] : Null;
$clienter = trim($cliente);

$nombre_ps = isset($_POST['nombre_ps']) ? $_POST['nombre_ps'] : Null;
$nombre_psr = trim($nombre_ps);

$descripcion_ps = isset($_POST['descripcion_ps']) ? $_POST['descripcion_ps'] : Null;
$descripcion_psr = trim($descripcion_ps);

$area_ps = isset($_POST['area_ps']) ? $_POST['area_ps'] : Null;
$area_psr = trim($area_ps);

$responsable_ps = isset($_POST['responsable_ps']) ? $_POST['responsable_ps'] : Null;
$responsable_psr = trim($responsable_ps);

$fecini = isset($_POST['fechaini']) ? $_POST['fechaini'] : Null;
$fecinir = trim($fecini);

$fecinireal = isset($_POST['fechainireal']) ? $_POST['fechainireal'] : Null;
$fecinirealr = trim($fecinireal);

$fecfin = isset($_POST['fechafin']) ? $_POST['fechafin'] : Null;
$fecfinr = trim($fecfin);

$fecfinreal = isset($_POST['fechafinreal']) ? $_POST['fechafinreal'] : Null;
$fecfinrealr = trim($fecfinreal);

if (isset($_POST['btnRegistrar'])) {

    if(!empty($categoriar) || !empty($clienter)){

    if (!empty($responsable_psr)) {

        $consultarre = mysqli_query($conection, "SELECT * FROM producto_servicio WHERE responsable='$responsabler' AND nombre='$nombre_psr' AND categoria='$categoriar' AND empresa='$clienter'");
        $resul = mysqli_num_rows($consultarre);

        if ($resul == 0) {

                $insertar = mysqli_query($conection, "INSERT INTO producto_servicio(nombre, descripcion, estado, empresa, area, responsable, fecinicio, fecinicioReal, fecfin, fecfinReal, 
                horaRegistro, fechaRegistro, userRegistro,categoria) VALUES ('$nombre_psr','$descripcion_psr','PLANIFICADO','$clienter','$area_psr','$responsable_psr','$fecinir','$fecinireal','$fecfinr','$fecfinrealr',
                '$hora','$fecha','$username','$categoriar')");

                $consultarreg = mysqli_query($conection, "SELECT * FROM producto_servicio WHERE responsable='$responsable_psr' AND nombre='$nombre_psr' AND categoria='$categoriar' AND empresa='$clienter'");
                $result = mysqli_num_rows($consultarreg);
                $refconsul = mysqli_fetch_assoc($consultarreg);

                if ($result > 0) {
                    
                    $valorid = $refconsul['idps'];
                    $insertapart = mysqli_query($conection, "INSERT INTO participantes(participante, idps, estado, horaregistro, fecharegistro) VALUES ('$responsable_psr','$valorid','activo','$hora','$fecha')");
                    
                    echo '<script type="text/javascript"> 
                        alert("Registro completado!")
                        location.href ="../Views/ProductosServicios.php";
                        </script>';
                } else {
                    echo '<script type="text/javascript">
                        alert("ERROR! El registro no pudo ser completado. Intente nuevamente. Gracias");
                        window.history.go(-1);
                        </script>';
                }
            
            } else {
                echo '<script type="text/javascript">
                    alert("ERROR! Ya existe un '.$tipor.' con el mismo nombre.");
                    window.history.go(-1);
                    </script>';
            }
        }else {
            echo '<script type="text/javascript">
                alert("ERROR! Seleccione un responsable");
                window.history.go(-1);
                </script>';
        }
    }else {
        echo '<script type="text/javascript">
            alert("ERROR! Seleccionar Tipo y Empresa.");
            window.history.go(-1);
            </script>';
    }
}
                
?>