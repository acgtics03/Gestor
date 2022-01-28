<?php
//INICIAR VARIABLES DE SESIÓN
date_default_timezone_set('America/Lima');
session_start();

//CONEXIÓN A BD
require '../Modulos/conexion.php';
$UserName = $_SESSION['user'];
$time = time();
$freg = date('Y-m-d');
$Hora = date("H:i:s", $time);

if(empty($UserName)){
                session_destroy();
                echo '<script type="text/javascript">';
                echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
                echo '</script>';
                echo '<script type="text/javascript">';
                echo 'location.href="../index.php"';
                echo '</script>'; 
    }

//VARIABLE DE FECHA
$factual = date('Y-m-d');
$fayer = date("Y-m-d", strtotime("-1 day", strtotime($factual)));


// Variables tipo Hidden

  // $txt = 'hidden';
  //$txt6 = 'visibility:hidden';
  //$btn='hidden';
  //$btn2='submit';
  // $label = 'visibility:hidden';
                           
    $txt = '';
    $txt6 = '';
    $btn='submit';
    $btn2='hidden';
    $label = '';
                           
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="icon" href="../img/logoacg2.jpg" type="image/png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/Estilo_AdminAsistenciaControl.css">
    <link rel="stylesheet" type="text/css" href="../css/StyleH.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/StyleTablas.css?v=<?php echo time(); ?>">

    <title>Usuarios - Personal ACG</title>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="dist/Chart.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">

    <script src="../librerias/jquery-3.2.1.min.js"></script>
    <script src="../Js/funciones2.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.js"></script>
    <script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

     <!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->

    <br>

    <div class="fonConsulta">
        <form action="AdminUsuarios.php" method="GET">

            <div><br>
                <div>
                    <center><label style="font-size: 18px; font-weight: bold;">REGISTRO DE TRABAJADOR</label></center><br>
                </div>

                <div style="display: inline">

                    <div style="display: inline">

                        <div style="display:inline; margin-left: 25%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Documento</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                                <input class="consultacampos" name="dni" id="label_dni" placeholder="Ejemplo: DNI" required>
                            </div>
                        </div>

                        <div style="display:inline; margin-left: 2%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Correo</label>
                            </div>

                            <div style="display:inline-block; margin-left: 2%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                            <input class="consultacampos" type="text" name="correo" placeholder="correo@acg.com.pe" required>
                            </div>

                        </div>


                    </div><br><br>
                    <div style="display: inline">

                        <div style="display:inline; margin-left: 25%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Apellidos</label>
                            </div>

                            <div style="display:inline-block; margin-left: 2%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                                <input class="consultacampos" type="text" name="apellidos" id="apellidos" required>
                            </div>
                        </div>

                        <div style="display:inline; margin-left: 2%">

                            <div style="display:inline-block;">
                                <label class="consultatitulos">Nombres</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block; margin-left: 1%">
                            <input class="consultacampos" type="text" name="nombres" id="nombres" required>
                            </div>

                        </div>


                    </div><br><br>

                    <div style="display: inline">

                        <div style="display:inline; margin-left: 25%">

                            <div style="display:inline-block;">
                                <?php $areas = mysqli_query($conection, "SELECT idArea, Area FROM area"); ?>
                                <label class="consultatitulos">Supervisor</label>
                            </div>

                            <div style="display:inline-block;margin-left: 1.5%">
                                <label class="consultatitulos">:</label>
                            </div>
                               
                            <div style="display:inline-block;margin-left: 1%">
                            <?php $consulta = mysqli_query($conection,"SELECT idusuario, concat(apellido,' ',nombre) as datos FROM persona WHERE TipoTrabajador='SUPERVISOR'");?>   
                                <select name="supervisor" id="lista_area" class="consultacampos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                                <option value=" <?php echo $datos['idusuario'] ?> ">
                                <?php echo $datos['datos']; ?>
                                </option>
                                <?php }?>
                                </select>
                            </div>
                        </div>

                        <div style="display:inline; margin-left: 2%">
                            <div style="display:inline-block;">
                                <!-- LISTA DESPLEGABLE - ESTADO DE LA ASISTENCIA -->
                                <label class="consultatitulos">Costo/Hora</label>
                            </div>
                            <div style="display:inline-block;">
                                <label class="consultatitulos">:</label>
                            </div>

                            <div style="display:inline-block;margin-left: 1%">
                                <input class="consultacampos" type="text" name="cxh" id="cxh" required>
                                <script>
                                    $("#cxh").on({
                                        "focus": function (event) {
                                            $(event.target).select();
                                        },
                                        "keyup": function (event) {
                                            $(event.target).val(function (index, value ) {
                                                return value.replace(/\D/g, "")
                                                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                                            });
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="text-align: center;">
                    <br>


                        <?php
                        
                        
                            // VARABLES DE LOS FILTROS
                            $dni = isset($_GET['dni']) ? $_GET['dni'] : Null;
                            $dnir = trim($dni);

                            $correo = isset($_GET['correo']) ? $_GET['correo'] : Null;
                            $correor = trim($correo);

                            $apellido= isset($_GET['apellidos']) ? $_GET['apellidos'] : Null;
                            $apellidor = trim($apellido);

                            $nombre = isset($_GET['nombres']) ? $_GET['nombres'] : Null;
                            $nombrer = trim($nombre);

                            $super= isset($_GET['supervisor']) ? $_GET['supervisor'] : Null;
                            $superr = trim($super);

                            $cxh = isset($_GET['cxh']) ? $_GET['cxh'] : Null;
                            $cxhr = trim($cxh);

                            //echo '-'.$dnir.'-'.$fecha_inicior.'-'.$fecha_finr.'-'.$arear.'-'.$empresar.'-'.$tipo_asistenciar.'-';


                            
                            //FUNCIONALIDAD DEL BOTÓN CONSULTA

                            //INICIALIZAR LA VARIABLE EN BLANCO
                            $where = '';
                            $valoor = 0;

                            //CONDICIONALES DE FILTROS
                            if (isset($_GET['boton_consulta'])) {

                                $consulta = mysqli_query($conection, "SELECT * FROM persona WHERE DNI='$dnir'");
                                $cont = mysqli_num_rows($consulta);
                               
                               if(!empty($_GET['supervisor'])){
                               
                                if($cont<=0){
                                   $inserta = mysqli_query($conection, "INSERT INTO persona(DNI,idusuario,apellido,nombre,idJefeInmediato,CostoxHora,estatus,EstadoCuenta) VALUES ('$dnir','$correor','$apellidor','$nombrer','$superr','$cxhr','Activo','PENDIENTE')");
                                    $insertar_usuario = mysqli_query($conection, "INSERT INTO usuario(usuario) VALUES ('$correor')"); 
                                    $alert = 'REGISTRO DE TRABAJADOR EXITOSO!';
                                    $dnir='';
                                    $correor='';
                                    $apellidor='';
                                    $nombrer='';
                                    $superr='';
                                    $cxhr='';
                                    
                               
                                    
                                }else{
                                    $alert = 'Error! No puede registrar mas de una vez el mismo trabajador!';
                                }
                               }else{
                                    $alert = 'Error! Completar todos los campos!';
                                }
                            }
                        ?>
                        <div style="text-align: center; font-size: 14px; font-weight: bold; color: red"><?php echo isset($alert) ? $alert : ''; ?> </div>

                        <input style="margin-bottom: 10px;border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 160px;
                            padding: 5px; cursor: pointer; font-weight: bold" id="boton_consulta" name="boton_consulta" type="<?php echo $btn; ?>" value="GRABAR">
                            
                        <input style="margin-bottom: 10px;border-radius: 11px 11px 11px 11px; background-color: #098DC2; color: white; margin-top: 20px; width: 160px;
                            padding: 5px; cursor: pointer; font-weight: bold" id="boton_nuevo" name="boton_nuevo" type="<?php echo $btn2; ?>" value="NUEVO">

                </div><br>
            </div>
        </form>
    </div><br>


    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div>

                    <table id="example" class="table table-striped table-bordered" cellspacing="0" style="font-size: 14px;">
                        <!-- CABEZERA DE LA TABLA -->
                        <thead>

                            <tr>
                                <th class="th1" style="width: 180px">USUARIO</th>
                                <th class="th1" style="width: 170px">APELLIDO</th>
                                <th class="th1" style="width: 160px">NOMBRE</th>
                                <th class="th1">DNI</th>
                                <th class="th1">CXH</th>
                                <th class="th1">ESTADO</th>
                                <th class="th1">MOTIVO</th>
                                <th class="th1" style="width: 80px"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- CUERPO DE LA TABLA -->
                            <!--<tbody style="overflow-y: scroll; height: 130px">-->
                            <?php
                                //CONSULTA BD                          
                                $personal = mysqli_query($conection, "SELECT 
                                p.idcliente as ID,
                                p.idusuario as correo, 
                                p.apellido as apellido, 
                                p.nombre as nombre, 
                                p.DNI as DNI,
                                p.Telefono as telefono,
                                p.direccion as direccion, 
                                p.CostoxHora as cxh,
                                p.EstadoCuenta as er, 
                                p.estatus as estado, 
                                p.idJefeInmediato as supervisor, 
                                p.FechaNacimiento as fn, 
                                p.idArea as area,
                                p.idCargo as cargo, 
                                me.motivo as motivo, 
                                u.MotivoEstado as idme, 
                                u.FecIniEstado as fi, 
                                u.FecFinEstado AS ff 
                                FROM persona p , usuario u, motivoestado me 
                                WHERE p.idusuario=u.usuario and u.MotivoEstado=me.idME ORDER BY p.ControlRegistro, p.idusuario ");

                                if (mysqli_num_rows($personal) <> 0) {

                                    while ($personalr = mysqli_fetch_assoc($personal)) {

                                        $datosTrab = $personalr['ID'] . "||" .
                                                    $personalr['DNI'] . "||" .
                                                    $personalr['fn'] . "||" .
                                                    $personalr['correo'] . "||" .
                                                    $personalr['apellido'] . "||" .
                                                    $personalr['nombre'] . "||" .
                                                    $personalr['direccion'] . "||" .
                                                    $personalr['telefono'] . "||" .
                                                    $personalr['cxh'] . "||" .
                                                    $personalr['area'] . "||" .
                                                    $personalr['cargo'] . "||" .
                                                    $personalr['supervisor'] . "||" .
                                                    $personalr['estado'] . "||" .
                                                    $personalr['idme'] . "||" .
                                                    $personalr['fi'] . "||" .
                                                    $personalr['ff'];

                            ?>

                                        <tr>
                                           
                                            <td class="td1"><?php echo $personalr['correo']; ?></td>
                                            <td class="td1"><?php echo $personalr['apellido']; ?></td>
                                            <td class="td1"><?php echo $personalr['nombre']; ?></td>
                                            <td class="cuerpotabla"><?php echo $personalr['DNI']; ?></td>
                                            <td class="cuerpotabla"><?php echo $personalr['cxh']; ?></td>
                                            <td class="cuerpotabla"><?php echo $personalr['estado']; ?></td>
                                            <td class="cuerpotabla"><?php echo $personalr['motivo']; ?></td>
                                            <td style="text-align: center; width: 50px; font-size: 80%">
                                                
                                                &nbsp;&nbsp;
                                            
                                                <?php 
                                                
                                                $ocultar = '';
                                                $ocultar2 = 'hidden=""';

                                                //idusuario
                                                $cuenta = $personalr['correo'];
                                                $idcuenta = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$cuenta'");
                                                $idcuentar = mysqli_fetch_assoc($idcuenta);

                                                $idusuario = $idcuentar['id'];

                                                //idregister

                                                $idregister = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$UserName'");
                                                $idregisterr = mysqli_fetch_assoc($idregister);

                                                $register = $idregisterr['id'];


                                                $consulta_permiso = mysqli_query($conection, "SELECT * FROM autorizacion_control WHERE idusuario='$idusuario' AND fecha='$freg'");
                                                $consulta_per = mysqli_num_rows($consulta_permiso); 

                                                if($consulta_per>0){
                                                     $ocultar = 'hidden=""';
                                                     $ocultar2 = '';
                                                }

                                                ?>
                                                
                                                <button <?php echo "$ocultar2"; ?> class="button-edit" data-toggle="modal" data-target="#modalEdicion" onclick="Trabajador('<?php echo $datosTrab; ?>')"><img src="../img/editar.png" alt="" width="24px" height="24px" style="cursor: pointer;"></button>

                                                <button <?php echo "$ocultar"; ?>  class="button-edit" data-toggle="modal" data-target="#modalAutorizacion" onclick="Trabajador2('<?php echo $datosTrab; ?>')"><img src="../img/candado.png" alt="" width="24px" height="24px"  style="cursor: pointer;"></button>

                                            </td>
                                        </tr>

                                    <?php
                                    }
                                } else {
                                    ?>

                                    <div>
                                        <label for=""><?php $alert = 'No se han encontrado registros en la búsqueda'; ?></label>
                                    </div>

                            <?php
                                }
                            
                            ?>
                        </tbody>

                    </table>
                    <br><br>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Actualizar datos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <input type="text" hidden="" id="ID" name="">
                    <div style="display: inline-block">
                        <label class="popup-nombres">Documento</label><br>
                        <input class="consultafecha" name="dni" type="Number" id="dni">
                    </div>
                    &nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Fec.Nac.</label><br>
                        <input class="consultafecha" name="fn" type="text" id="fn" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Costo/Hora</label><br>
                        <input type="" name="" id="ch" class="consultafecha" style="width: 60px">
                        <script>
                                    $("#ch").on({
                                        "focus": function (event) {
                                            $(event.target).select();
                                        },
                                        "keyup": function (event) {
                                            $(event.target).val(function (index, value ) {
                                                return value.replace(/\D/g, "")
                                                            .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                                            .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                                            });
                                        }
                                    });
                        </script>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Correo</label><br>
                        <input type="text" name="" id="correo" class="popup-campos">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Apellido</label><br>
                        <input type="text" name="" id="apellido" class="popup-lista">
                    </div> &nbsp;&nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Nombre</label><br>
                        <input type="text" name="" id="nombre" class="popup-lista">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Dirección</label><br>
                        <input type="text" name="" id="direccion" class="popup-lista">
                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Telefono</label><br>
                        <input type="Number" name="" id="telefono" class="popup-campos2">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Área</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT * FROM area");?>
                        <select name="BoxArea"  id="boxarea" class="popup-lista">
                        <option selected="true" disabled="disabled">Seleccione...</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idArea'] ?>">
                        <?php echo $datos['Area']; ?>
                        </option>
                        <?php }?>
                         </select>
                
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="popup-nombres">Cargo</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT * FROM Cargo");?>
                        <select name="BoxCargo" id="boxcargo" class="popup-lista">
                        <option selected="true" disabled="disabled">Seleccione...</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idcargo'] ?>" >
                        <?php echo $datos['cargo']; ?>
                        </option>
                        <?php }?>
                         </select>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Supervisor</label><br>
                        <?php $consulta = mysqli_query($conection,"SELECT idusuario, concat(apellido,' ',nombre) as datos FROM persona WHERE TipoTrabajador='SUPERVISOR'");?>   
                                <select name="supervisor" id="supervisor" class="popup-campos">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                                <option value="<?php echo $datos['idusuario'] ?>">
                                <?php echo $datos['datos']; ?>
                                </option>
                                <?php }?>
                                </select>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="popup-nombres">Estado</label><br>
                        <select name="estado" id="estado" class="popup-lista">
                                <option selected="true" disabled="disabled">...</option>
                                <option>Activo</option>
                                <option>Inactivo</option>
                        </select>
                    </div>
                    <script type="text/javascript">
                          $( function() {
                                $("#estado").change( function() {
                                    if ($(this).val() === "Activo") {
                                        $("#boxme").prop("disabled", true);
                                        $("#fnei").prop("disabled", true);
                                        $("#fnef").prop("disabled", true);
                                    } else {
                                        $("#boxme").prop("disabled", false);
                                        $("#fnei").prop("disabled", false);
                                        $("#fnef").prop("disabled", false);
                                    }
                                });
                            });
                    </script>
                    &nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                            <label class="popup-nombres">Motivo-estado</label><br>
                            <?php $consulta = mysqli_query($conection, "SELECT * FROM motivoestado ORDER BY motivo"); ?>
                            <select name="boxme" id="boxme" class="popup-lista" disabled>
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                    <option value="<?php echo $datos['idME'] ?>">
                                        <?php echo $datos['motivo']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br><br>
                        <div style="display: inline-block">
                            <label class="popup-nombres">Fec.ini.estado</label><br>
                            <input class="popup-lista" name="fnei" type="Date" id="fnei" placeholder="yy-mm-dd" disabled>
                        </div>
                        &nbsp;&nbsp;&nbsp;
                        <div style="display: inline-block">
                            <label class="popup-nombres">Fec.fin estado</label><br>
                            <input class="popup-lista" name="fnef" type="Date" id="fnef" placeholder="yy-mm-dd" disabled>
                        </div>
                        
                    <br>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="actualizadatos2" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAutorizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Autorizar Edición Registro</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                <form action="" method="post">
                <input type="text" hidden="" id="ID2" name="ID2">
                <input class="consultafecha" hidden="" name="dni2" type="Number" id="dni2">
                <input class="consultafecha" hidden="" name="fn2" type="text" id="fn2" placeholder="yy-mm-dd">
                <input type="Text" hidden="" name="ch2" id="ch2">
                <input type="text" hidden="" name="correo2" id="correo2" class="popup-campos">
                <input type="text" hidden="" name="apellido2" id="apellido2" class="popup-lista">
                <input type="text" hidden="" name="nombre2" id="nombre2" class="popup-lista">
                <input type="text"  hidden=""name="direccion2" id="direccion2" class="popup-lista">
                <input type="Number" hidden="" name="telefono2" id="telefono2" class="popup-campos2">
                <select name="BoxArea2"  hidden="" id="boxarea2" class="popup-lista"></select>
                <select name="BoxCargo2"  hidden="" id="boxcargo2" class="popup-lista"></select>
                <select name="supervisor2"  hidden="" id="supervisor2" class="popup-lista"></select>
                <select name="estado2" hidden="" id="estado2" class="popup-lista"></select>
                <select name="boxme2" hidden="" id="boxme2" class="popup-lista"></select>
                <input class="popup-lista" hidden="" name="fnei2" type="Date" id="fnei2">
                <input class="popup-lista" hidden="" name="fnef2" type="Date" id="fnef2">

                    <div style="display: inline-block">
                            <label class="popup-nombres">Encargado</label><br>
                            <?php
                            
                            $consulta = mysqli_query($conection, "SELECT u.idusuario as id, concat(p.apellido,' ',p.nombre) as datos FROM usuario u, persona p WHERE u.usuario=p.idusuario AND u.estatus='Activo' AND idPerfil='3'"); 
                            
                            ?>
                            <select name="boxencargado" id="boxencargado" class="popup-lista-2">
                                <option selected="true" disabled="disabled">Seleccione...</option>
                                <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                    <option value="<?php echo $datos['id']; ?>">
                                        <?php echo $datos['datos']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br><br>
                        <div style="display: inline-block">
                            <label class="popup-nombres">Código</label><br>
                            <input class="popup-lista-2" name="codigo" type="password" id="codigo" placeholder="">
                        </div>
                        
                    <br><br>
                </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="Autorizar" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Autorizar</button>

                </div>

            </div>
        </div>
    </div>

    <script src="popup.js"></script>


    <script type="text/javascript" src="../Js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../Js/jquery-ui.min.js"></script>
    <script>
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
        $("#datepicker3").datepicker();
    </script>
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>

    <!-- para usar botones en datatables JS -->
    <script src="../datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="../datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

    <!-- código JS propìo-->
    <script type="text/javascript" src="../main.js"></script>




</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tabla').load('componentes/tabla.php');
        $('#buscador').load('componentes/buscador.php');
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
            idpersona=$('#idpersona').val();
            dni=$('#dni').val();
            fn=$('#fn').val();
            correo=$('#correo').val();
            apellido=$('#apellido').val();
            nombre=$('#nombre').val();
            direccion=$('#direccion').val();
            telefono=$('#telefono').val();
            ch=$('#ch').val();
            boxarea=$('#boxarea').val();
            boxcargo=$('#boxcargo').val();
            supervisor=$('#supervisor').val();
            estado=$('#estado').val();

            agregardatos(nombre,apellido,email,telefono);
        });


        $('#actualizadatos2').click(function() {
            actualizaDatos2();
        });

        $('#Autorizar').click(function() {
            Autorizar();
        });

    });
</script>