<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="big5">

    <link rel="icon" href="image/logo.jpg" type="image/png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ACG - Actividades</title>
    <!-- loader
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>-->
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" />
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="datatables/datatables.min.css" />
    <link rel="stylesheet" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/estilo-coment.css?v=<?php echo time(); ?>" />

    <script src="../Js/actividades.js"></script>
    <script src="../Js/aviso_principal.js"></script>
    <script src="../Js/coment-acti.js"></script>

    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
    <script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>


    <script language="JavaScript">
        function popUp(URL) {
            day = new Date();
            id = day.getTime();
            eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=490');");
        }
    </script>

</head>

<body class="bg-theme fondo">
    <?php
    require('models/menu.php');
    date_default_timezone_set('America/Lima');
    //session_start();
    require 'conexion.php';
    $username = $_SESSION['user'];
    require('models/header.php');

    require('pasando_variable.php');

    ?>

    <script src="code/highcharts.js"></script>
    <script src="code/modules/exporting.js"></script>
    <script src="code/modules/export-data.js"></script>
    <script src="code/modules/accessibility.js"></script>


    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="clearfix"></div>

        <div class="content-wrapper fondo">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-lg-6">
                        <div class="card graf-11" style="height: 745px;"><br>
                            <div class="card-header"><a href="SeguimientoActividades.php" style="color: rgb(22, 55, 91)"><img src="image/espalda.png" width="30px" height="30px"> Volver atrás</a></div>
                            <div class="card-body">
                                <h5 class="card-header h-div">Detalle de la Actividad</h5>
                                <br>
                                <div class="table-responsive tabla-t">

                                    <div>
                                        <label for="" class="font">Nombre : </label>
                                        <label for="" style="color: black;"><?php echo $consultar['nombre']; ?></label>
                                    </div>
                                    <div style="display: inline-block">
                                        <label for="" class="font">Descripcion : </label>
                                        <div style="color: black;display: inline; font-size: 12px"><?php echo $consultar['descripcion']; ?></div>
                                    </div>
                                    <div>
                                        <label for="" class="font">Responsable : </label>
                                        <label for="" style="color: black;"><?php echo $consultar['datos']; ?></label>
                                    </div>

                                    <div>
                                        <label for="" class="font">Cliente : </label>
                                        <label for="" style="color: black;"><?php echo $consultar['cliente']; ?></label>
                                    </div>

                                    <div>
                                        <label for="" class="font">Tipo : </label>
                                        <label for="" style="color: black;"><?php echo $consultar['tipo']; ?></label>
                                    </div>

                                    <div style="display: inline;">
                                        <div style="display: inline-block;">
                                            <label for="" class="font">Fecha Inicio : </label>
                                            <label for="" style="color: black;"><?php echo $consultar['fecini']; ?></label>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div style="display: inline-block;">
                                            <label for="" class="font">Hora inicio : </label>
                                            <label for="" style="color: black;"><?php echo $consultar['horainicio']; ?></label>
                                        </div>
                                    </div><br>
                                    <div style="display: inline;">
                                        <div style="display: inline-block;">
                                            <label for="" class="font">Fecha Termino : </label>
                                            <label for="" style="color: black;"><?php echo $consultar['fecfin']; ?></label>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <div style="display: inline-block;">
                                            <label for="" class="font"> Hora Termino : </label>
                                            <label for="" style="color: black;"><?php echo $consultar['Horafin']; ?></label>
                                        </div>
                                    </div>
                                    <br><br><br><br>
                                    <form action="../models/insertar_comentario.php" method="post">
                                        <label class="titulo" style="color:rgb(22, 55, 91)">Escribir comentario : </label><br>
                                        <textarea name="comentario" type="Text" id="comentario" class="c-campos" placeholder="Describa el motivo" maxlength="180" style="height: 100px; font-family: Helvetica; font-size: 12px; padding: 12px; width: 520px" required></textarea>
                                        <br><br>
                                        <input type="submit" class="btn btn-warning btneliminar" id="comentar" name="comentar" value="Comentar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card reg-fond">
                            <div class="card-body">
                                <h5 class="card-title">COMENTARIOS</h5>
                                <div class="table-responsive">
                                    <div class="form-group">
                                        <div class="content-tab">
                                            <table class="table-coment" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="cabecera"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $consultar_comentarios = mysqli_query($conection, "SELECT ca.idactividad as idc, ca.comentario as coment, date_format(ca.hora, '%H:%i') as hora, ca.fecha as fec, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as datos, cc.r as R, cc.g as G, cc.b as B FROM coment_actividades ca, usuario u, persona p, color_coment cc WHERE cc.idcolor=ca.idcolor AND ca.idusuario=u.idusuario AND u.usuario=p.idusuario AND ca.idactividad='$idactiv' ORDER BY ca.fecha, ca.hora ASC");
                                                
                                                    while ($coment = mysqli_fetch_assoc($consultar_comentarios)) { 
                                                    $color_r = $coment['R'];
                                                    $color_g = $coment['G'];
                                                    $color_b = $coment['B'];

                                                    $etiqueta = "rgb(".$color_r.",".$color_g.",".$color_b.")";

                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <label class="contacto" style="background-color:<?php echo $etiqueta; ?>;">&nbsp;&nbsp;&nbsp;<?php echo $coment['datos'] . ' (' . $coment['fec'] . ' - ' . $coment['hora'] . ')'; ?></label><br>
                                                                <textarea class="coment" disabled><?php echo $coment['coment']; ?>
                                                      </textarea>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Row-->

                </div>
                <!--End content-wrapper-->

            </div>
            <!--End wrapper-->

            <!-- Bootstrap core JavaScript-->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/popper.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>

            <!-- simplebar js -->
            <script src="assets/plugins/simplebar/js/simplebar.js"></script>
            <!-- sidebar-menu js -->
            <script src="assets/js/sidebar-menu.js"></script>

            <!-- Custom scripts -->
            <script src="assets/js/app-script.js"></script>


            <!-- jQuery, Popper.js, Bootstrap JS -->
            <script src="jquery/jquery-3.3.1.min.js"></script>
            <!-- datatables JS -->
            <script type="text/javascript" src="datatables/datatables.min.js"></script>

            <!-- para usar botones en datatables JS -->
            <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
            <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>
            <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
            <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
            <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>

            <!-- c車digo JS prop足o-->
            <script type="text/javascript" src="main.js"></script>



</body>

</html>