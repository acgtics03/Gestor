<?php
session_start();
require '../conexion.php';
$username = $_SESSION['user'];
$variable = "";
$vercontrol = mysqli_query($conection, "SELECT * FROM control_act WHERE user='$username'");
$vercontrolrr = mysqli_fetch_assoc($vercontrol);

 $resultadps = $vercontrolrr['valor'];
 $variable = $resultadps;

$hora = date("H:i:s", time());;
$fecha = date('Y-m-d');


   if(empty($username)){
        session_destroy();
        echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="../../../index.php"';
        echo '</script>';
    }


$nom = isset($_POST['nombre']) ? $_POST['nombre'] : Null;
$nomr = trim($nom);

$desc = isset($_POST['descripcion']) ? $_POST['descripcion'] : Null;
$descr = trim($desc);

$responsable = isset($_POST['boxresponsable']) ? $_POST['boxresponsable'] : Null;
$responsabler = trim($responsable);

$fechaini = isset($_POST['fechaini']) ? $_POST['fechaini'] : Null;
$fechainir = trim($fechaini);

//Hora inicio

$horaini = isset($_POST['Horaini']) ? $_POST['Horaini'] : Null;
$horainir = trim($horaini);

$horaini = isset($_POST['Minini']) ? $_POST['Minini'] : Null;
$mininir = trim($horaini);

$timeini = $horainir.":".$mininir.":00";


$fechafin = isset($_POST['fechafin']) ? $_POST['fechafin'] : Null;
$fechafinr = trim($fechafin);

//Hora termino

$horafin = isset($_POST['Horafin']) ? $_POST['Horafin'] : Null;
$horafinr = trim($horafin);

$horafin = isset($_POST['Minfin']) ? $_POST['Minfin'] : Null;
$minfinr = trim($horafin);

$timefin = $horafinr.":".$minfinr.":00";


$tip = $_SESSION['tipo'];

if (isset($_POST['btnGrabar'])) {

    if (!empty($responsabler) && !empty($nomr) ) {

        $consultarre = mysqli_query($conection, "SELECT * FROM tareas WHERE responsable='$responsabler' AND nombre='$nomr' AND vinculo='$variable' AND descripcion='$descr'");
        $resul = mysqli_num_rows($consultarre);
        
        $consultaps = mysqli_query($conection, "SELECT responsable FROM actividades WHERE idps='$variable'");
        $consultapss = mysqli_fetch_assoc($consultaps);

        if ($resul == 0) {
            $ps_responsable = $consultapss['responsable'];
            if($ps_responsable == $responsabler){
                $tipoa = 'PROPIO';
            }else{
                $tipoa = 'PARTICIPANTE';
            }
            
            $insertar = mysqli_query($conection, "INSERT INTO tareas(nombre, descripcion, fecha, fechafin, Horaini, Horafin, estado, responsable, horaRegistro, fechaRegistro, userRegistro, 
            identificador, vinculo, tipo_tarea) VALUES ('$nomr', '$descr', '$fechainir', '$fechafinr','$timeini','$timefin','PLANIFICADO','$responsabler','$hora','$fecha','$username','$tip',
            '$variable', '$tipoa')");
            
            $consultarreg = mysqli_query($conection, "SELECT * FROM tareas WHERE responsable='$responsabler' AND nombre='$nomr' AND vinculo='$variable' AND descripcion='$descr'");
            $result = mysqli_num_rows($consultarreg);

            if ($result > 0) {
                echo '<script type="text/javascript"> 
                      alert("Registro completado!")
                      location.href ="../Views/SegActividades.php";
                      </script>';
            } else {
                echo '<script type="text/javascript">
                      alert("Error al registrar! Revise los datos ingresados.");
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