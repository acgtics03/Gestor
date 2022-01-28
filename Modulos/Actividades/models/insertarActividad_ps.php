<?php
session_start();
require '../conexion.php';
$username = $_SESSION['user'];

$vercontrol = mysqli_query($conection, "SELECT * FROM control WHERE user='$username'");
$vercontrolrr = mysqli_fetch_assoc($vercontrol);

 $resultadps = $vercontrolrr['valor'];
 $variable = $resultadps;

$hora = date("H:i:s", time());;
$fecha = date('Y-m-d');

$nom = isset($_POST['nombre']) ? $_POST['nombre'] : Null;
$nomr = trim($nom);

$desc = isset($_POST['descripcion']) ? $_POST['descripcion'] : Null;
$descr = trim($desc);

$responsable = isset($_POST['boxresponsable']) ? $_POST['boxresponsable'] : Null;
$responsabler = trim($responsable);

$fechaini = isset($_POST['fechaini']) ? $_POST['fechaini'] : Null;
$fechainir = trim($fechaini);

$horaini = isset($_POST['Horaini']) ? $_POST['Horaini'] : Null;
$horainir = trim($horaini);

$Minini = isset($_POST['Minini']) ? $_POST['Minini'] : Null;
$Mininir = trim($Minini);

$time_inicio = $horainir.':'.$Mininir.':00';

$fechafin = isset($_POST['fechafin']) ? $_POST['fechafin'] : Null;
$fechafinr = trim($fechafin);

$horafin = isset($_POST['Horafin']) ? $_POST['Horafin'] : Null;
$horafinr = trim($horafin);

$minfin = isset($_POST['Minfin']) ? $_POST['Minfin'] : Null;
$minfinr = trim($minfin);

$time_fin = $horafinr.':'.$minfinr.':00';

$tip = $_SESSION['tipo'];

if (isset($_POST['btnGrabar'])) {

    if (!empty($responsabler) && !empty($nomr) ) {

        $consultarre = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsabler' AND nombre='$nomr' AND vinculo='$variable' AND descripcion='$descr' AND estado!='ELIMINADO'");
        $resul = mysqli_num_rows($consultarre);
        
        $consultaps = mysqli_query($conection, "SELECT responsable FROM producto_servicio WHERE idps='$variable'");
        $consultapss = mysqli_fetch_assoc($consultaps);

        if ($resul == 0) {
            $ps_responsable = $consultapss['responsable'];
            if($ps_responsable == $responsabler){
                $tipoa = 'PROPIO';
            }else{
                $tipoa = 'PARTICIPANTE';
            }
            
            $insertar = mysqli_query($conection, "INSERT INTO actividades(nombre, descripcion, fecha, fechafin, Horaini, Horafin, estado, responsable, horaRegistro, fechaRegistro, userRegistro, 
            identificador, vinculo, tipo_actividad) VALUES ('$nomr', '$descr', '$fechainir', '$fechafinr','$time_inicio','$time_fin','PLANIFICADO','$responsabler','$hora','$fecha','$username','$tip',
            '$variable', '$tipoa')");
            
            $consultarreg = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsabler' AND nombre='$nomr' AND vinculo='$variable' AND descripcion='$descr'");
            $result = mysqli_num_rows($consultarreg);

            if ($result > 0) {
                echo '<script type="text/javascript"> 
                      alert("Registro completado!")
                      location.href ="../Views/Seguimiento_ps.php";
                      </script>';
            } else {
                echo '<script type="text/javascript">
                      alert("ERROR! No puede registrar más de una vez la misma actividad.");
                      window.history.go(-1);
                      </script>';
            }
        }
    } else {
        echo '<script type="text/javascript">
             alert("ERROR! Completar todos los campos.");
             window.history.go(-1);
             </script>';
    }
}
                
?>