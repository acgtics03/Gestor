<?php
date_default_timezone_set('America/Lima');
session_start();
require '../conexion.php';
$username = $_SESSION['user'];
$hora = date("H:i:s", time());
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

$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : Null;
$empresar = trim($empresa);

$area = isset($_POST['area']) ? $_POST['area'] : Null;
$arear = trim($area);

$fechas = isset($_POST['fecha']) ? $_POST['fecha'] : Null;
$fechasr = trim($fechas);

$fechafinal = isset($_POST['fechafin']) ? $_POST['fechafin'] : Null;
$fechafinalr = trim($fechafinal);

//HORA DE INICIO

$hini = isset($_POST['Horaini']) ? $_POST['Horaini'] : Null;
$hinir = trim($hini);

$mini = isset($_POST['Minini']) ? $_POST['Minini'] : Null;
$minir = trim($mini);

$hrsinicio = $hinir.":".$minir.":00";

//HORA DE TERMINO

$hfin = isset($_POST['Horafin']) ? $_POST['Horafin'] : Null;
$hfinr = trim($hfin);

$mfin = isset($_POST['Minfin']) ? $_POST['Minfin'] : Null;
$mfinr = trim($mfin);

$hrsfin = $hfinr.":".$mfinr.":00";

//HORA DE INICIO REAL

$hinireal = isset($_POST['Horainireal']) ? $_POST['Horainireal'] : Null;
$hinirealr = trim($hinireal);

$minireal = isset($_POST['Mininireal']) ? $_POST['Mininireal'] : Null;
$minirealr = trim($minireal);

$hrsinireal = $hinirealr.":".$minirealr.":00";

//HORA DE FIN REAL

$hfinreal = isset($_POST['Horafinreal']) ? $_POST['Horafinreal'] : Null;
$hfinrealr = trim($hfinreal);

$mfinreal = isset($_POST['Minfinreal']) ? $_POST['Minfinreal'] : Null;
$mfinrealr = trim($mfinreal);

$hrsfinreal = $hfinrealr.":".$mfinrealr.":00";


$respons = isset($_POST['responsable']) ? $_POST['responsable'] : Null;
$responsr = trim($respons);

if (isset($_POST['btnRegistrar'])) {

    if (!empty($responsr) && !empty($empresar) && !empty($arear)) {

        $consultarre = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsr' AND descripcion='$descr' AND nombre='$nomr' AND identificador='DIARIO'");
        $resul = mysqli_num_rows($consultarre);

        if ($resul == 0) {

            if($fechafinalr >= $fechasr){

            $insertar = mysqli_query($conection, "INSERT INTO actividades(nombre, descripcion, estado, responsable, fecha, fechafin, Horaini, Horainireal, Horafin, Horafinreal, horaRegistro, fechaRegistro, 
            userRegistro, identificador,empresa, area, tipo_actividad) VALUES ('$nomr','$descr','PLANIFICADO','$responsr','$fechasr', '$fechafinalr','$hrsinicio','$hrsinireal','$hrsfin','$hrsfinreal','$hora','$fecha',
            '$username','DIARIO','$empresar','$arear','PROPIO')");

            $consultarreg = mysqli_query($conection, "SELECT * FROM actividades WHERE responsable='$responsr' AND nombre='$nomr' AND descripcion='$descr'");
            $result = mysqli_num_rows($consultarreg);
            $res = mysqli_fetch_assoc($consultarreg);

            $idactividad = $res['idactividades'];


            if ($result > 0) {

                //id de jefe inmediato

                $consulta_jefe = mysqli_query($conection, "SELECT idJefeInmediato as id FROM usuario u, persona p WHERE u.usuario=p.idusuario AND u.idusuario='$responsr'");
                $consulta_jefer = mysqli_fetch_assoc($consulta_jefe);

                $jefe = $consulta_jefer['id'];

                $consulta_idjefe = mysqli_query($conection, "SELECT idusuario as idJI FROM usuario u WHERE usuario='$jefe'");
                $consulta_idjefer = mysqli_fetch_assoc($consulta_idjefe);

                $idjefe = $consulta_idjefer['idJI'];


                $insertasegg = mysqli_query($conection, "INSERT INTO participantes_tareas(participante, idactividad, estado, horaregistro, fecharegistro, idcolor) VALUES ('$idjefe','$idactividad','activo','$hora','$fecha','1')");

                $insertaseg = mysqli_query($conection, "INSERT INTO participantes_tareas(participante, idactividad, estado, horaregistro, fecharegistro, idcolor) VALUES ('$responsr','$idactividad','activo','$hora','$fecha','2')");

                $consultaseguimiento = mysqli_query($conection, "SELECT * FROM participantes_tareas WHERE idactividad='$idactividad' AND estado='activo'");
                $ress = mysqli_num_rows($consultaseguimiento);

                if ($ress > 0) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Registro completado!"); location.href ="../Views/SeguimientoActividades.php";';
                    echo '</script>';
                }
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("ERROR! El registro no pudo ser completado. Intente nuevamente. Gracias"); window.history.go(-1);';
                echo '</script>';
            }
            //---------
            }else{
                
                echo '<script type="text/javascript">';
                echo 'alert("ERROR! La Fecha de Termino no puede ser anterior a la Fecha de Inicio."); window.history.go(-1);';
                echo '</script>';
                
            }
            
        }else {
            echo '<script type="text/javascript">';
            echo 'alert("ERROR! Ya existe una actividad similar registrada."); window.history.go(-1);';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("ERROR! Completar campos obligatorios (*)"); window.history.go(-1);';
        echo '</script>';
    }
}
