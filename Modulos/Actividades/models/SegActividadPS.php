<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Js/actividadps.js"></script>
    <script src="../Js/aviso_principal.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
     <link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" type="text/css" href="../librerias/select2/css/select2.css">
	<script src="../librerias/alertifyjs/alertify.js"></script>
    <script src="../librerias/select2/js/select2.js"></script>
    
</head>

<body>

    <?php

    require '../conexion.php';
    $username = $_SESSION['user'];
    $vercontrol = mysqli_query($conection, "SELECT * FROM control WHERE user='$username'");
    $vercontrolrr = mysqli_fetch_assoc($vercontrol);
    
     $resultadps = $vercontrolrr['valor'];
     $variable = $resultadps;

    //COMPLETAR TABLA 
    $consultaAct2 = mysqli_query($conection, "SELECT a.idactividades as ID,a.descripcion as descripcion, t.nombre as nombre, a.fecha as fecha , a.Horaini as hini, a.fechafin as fechafin, 
    a.Horafin as hfin, a.estado as estado, concat(SUBSTRING_INDEX(p.apellido,' ',1),' ',SUBSTRING_INDEX(p.nombre,' ',1)) as responsable , a.responsable as responsab , p.idusuario as responsa, a.nombre as nom FROM actividades a, persona p, usuario u , tipos t
    WHERE t.idgestion=a.nombre AND p.idusuario=u.usuario and a.responsable=u.idusuario AND a.estado!='ELIMINADO' AND a.vinculo='$variable'");
    while ($ps2 = mysqli_fetch_assoc($consultaAct2)) {

        $datos = $ps2['ID'] . "||" .
            $ps2['nom'] . "||" .
            $ps2['descripcion'] . "||" .
            $ps2['responsab'] . "||" .
            $ps2['estado'] . "||" .
            $ps2['fecha'] . "||" .
            $ps2['hini'] . "||" .
            $ps2['fechafin'] . "||" .
            $ps2['hfin'];
            
            $padre = $_SESSION['re'];
            $accion = "";
            if($ps2['responsa']!="$username" && $padre!="$username"){
               $accion='hidden=""';
            }
            
            $idss = $_SESSION[idds];
            
          $img = "editar2";
          $img2 = "eliminar";  
            
          $ver_cargo = mysqli_query($conection, "SELECT idCargo, idArea FROM persona WHERE idusuario='$username'");
          $cargo = mysqli_fetch_assoc($ver_cargo);
          
          $carg = $cargo['idCargo'];
          $area = $cargo['idArea'];
          
          $ips=$ps2['responsab'];
          
          $colorf='';
        
          if($carg=='2' || $carg=='9'){
              $part1 = "#modalEdicion";
              $part2 = "Trabajador('$datos')";
              
              $part3 = "#modalEliminar";
              $part4 = "Trabajador2('$datos')";
          }else{
                    $ver1 = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
                    $ver11 = mysqli_fetch_assoc($ver1);
                          
                    $ips2 = $ver11['id'];
   
                    if($ips!=$ips2){
                         $part1 = '';
                         $part2 = "Aviso9()";
                         $img = "editar22";
                         $img2 = "eliminar2";
                         $part3 = "";
                         $part4 = "Aviso10()";
                         
                         $colorf = 'style="color: rgb(122, 223, 127)"';
                         
                    }else{
                       $part1 = "#modalEdicion";
                       $part2 = "Trabajador('$datos')"; 
                       
                       $part3 = "#modalEliminar";
                       $part4 = "Trabajador2('$datos')";
                    }
          }

    ?>
        <tr style="font-size: 12px;">
            <td <?php echo $colorf; ?> ><a href="" data-toggle="modal" data-target="<?php echo $part1; ?>" onclick="<?php echo $part2; ?>"><img src="image/<?php echo $img; ?>.png" width="35px" height="35px" alt=""></a>
            &nbsp;&nbsp;<a href="" data-toggle="modal" data-target="<?php echo $part3; ?>" onclick="<?php echo $part4; ?>"><img src="image/<?php echo $img2; ?>.png" width="35px" height="35px" alt=""></a>
            </td>
            <td <?php echo $colorf; ?> ><?php echo $ps2['fecha'].' / '.$ps2['hini']; ?></td>
            <td <?php echo $colorf; ?> ><?php echo $ps2['fechafin'].' / '.$ps2['hfin']; ?></td>
            <td class="centrar" <?php echo $colorf; ?> ><?php $valorestado=$ps2['estado'];
                if($valorestado=='PLANIFICADO'){
                   echo '<img src="../Views/image/planificado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                }else{
                    if($valorestado=='PROCESO'){
                    echo '<img src="../Views/image/proceso.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                }else{
                    if($valorestado=='FINALIZADO'){
                    echo '<img src="../Views/image/finalizado.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                }else{
                    if($valorestado=='DETENIDO'){
                    echo '<img src="../Views/image/detenido.png" width="15px" height="15px" alt=""><p style="font-size: 0px;">'.$valorestado.'</p>';
                }
                }}}
            ?></td>
            <td <?php echo $colorf; ?>><?php echo $ps2['nombre']; ?></td>
            <td <?php echo $colorf; ?>><?php echo $ps2['descripcion']; ?></td>
            <td <?php echo $colorf; ?>><?php echo $ps2['responsable']; ?></td>
        </tr>
    <?php }
    ?>

    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content ach">
                <div class="modal-header">
                    <h4 class="modal-title t-titulo" id="myModalLabel">Actualizar datos</h4>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <input type="text" hidden="" id="ID" name="ID">
                    <div style="display: inline-block">
                        <label class="titulo">Nombre</label><br>
                        <?php
                   
                    require 'conexion.php';
                    $username = $_SESSION['user'];
    
                          $ver_area = mysqli_query($conection, "SELECT a.idArea as id FROM persona p, area a WHERE p.idArea=a.idArea AND p.idusuario='$username'");
                          $ver_arear = mysqli_fetch_assoc($ver_area);
                          
                          $idar = $ver_arear['id'];
                          
                          $noms = mysqli_query($conection, "SELECT idgestion as id ,nombre as nombre FROM tipos WHERE estado='Activo' AND (((categoria='ACTIVIDAD' AND area='$idar') OR (categoria='Todos' AND area='Todos')) OR (categoria='ACTIVIDAD' AND area='Todos'))");
                          ?>
                          <select name="nombre2" id="nombre2" class="c-campos" required>
                            <option selected="true" class="f-box" disabled="disabled">Ninguno</option>
                            <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                              <option class="f-box" value="<?php echo $val['id']; ?>">
                                <?php echo $val['nombre']; ?>
                              </option>
                            <?php } ?>
                          </select>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Descripcion</label><br>
                        <textarea name="descripcion2" type="Text" id="descripcion2" class="c-campos"></textarea>
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Responsable</label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p ,usuario u WHERE p.idusuario=u.usuario AND p.estatus='Activo' AND p.EstadoCuenta='REGISTRADO' ORDER BY p.apellido ASC"); ?>
                        <select name="bxResp" id="bxResp" class="combo-box">
                            <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                    <?php echo $datos['datos']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div style="display: inline-block; margin-left: 5%">
                        <label class="titulo">Estado</label><br>
                        <select name="boxestado" id="boxestado" class="combo-box">
                            <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                                <option class="f-box">PLANIFICADO</option>
                                <option class="f-box">PROCESO</option>
                                <option class="f-box">FINALIZADO</option>
                                <option class="f-box">DETENIDO</option>
                        </select>
                    </div>
                    
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Fecha inicio</label><br>
                        <input class="cam-fecha" name="fecinicio" type="Date" id="fecinicio" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="titulo">Hora inicio</label><br>
                        <input class="cam-fecha" name="horainicio" type="Time" id="horainicio" placeholder="yy-mm-dd">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Fecha termino</label><br>
                        <input class="cam-fecha" name="fecfinal" type="Date" id="fecfinal" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="titulo">Hora termino</label><br>
                        <input class="cam-fecha" name="horafinal" type="Time" id="horafinal" placeholder="yy-mm-dd">
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content ach">
                <div class="modal-header">
                    <h4 class="modal-title t-titulo" id="myModalLabel">Eliminar actividad
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                   
                    <input type="text" hidden=""  id="ID_act" name="ID_act">
                    
                    <label class="titulo">Nombre : </label>
                    <?php
                   
                    require 'conexion.php';
                    $username = $_SESSION['user'];
    
                          $ver_area = mysqli_query($conection, "SELECT a.idArea as id FROM persona p, area a WHERE p.idArea=a.idArea AND p.idusuario='$username'");
                          $ver_arear = mysqli_fetch_assoc($ver_area);
                          
                          $idar = $ver_arear['id'];
                          
                          $noms = mysqli_query($conection, "SELECT idgestion as id ,nombre as nombre FROM tipos WHERE estado='Activo' AND (((categoria='ACTIVIDAD' AND area='$idar') OR (categoria='Todos' AND area='Todos')) OR (categoria='ACTIVIDAD' AND area='Todos'))");
                          ?>
                          <select name="nombre_act" id="nombre_act" class="c-campos" style="width: 250px" disabled>
                            <option selected="true" class="f-box" disabled="disabled">Ninguno</option>
                            <?php while ($val = mysqli_fetch_assoc($noms)) { ?>
                              <option class="f-box" value="<?php echo $val['id']; ?>">
                                <?php echo $val['nombre']; ?>
                              </option>
                            <?php } ?>
                          </select>
                    <br>
                    <label class="titulo">Descripcion : </label><br>
                    <textarea id="descripcion_act" name="descripcion_act" style="border: none; font-size:12px; width: 350px" disabled></textarea>
                    <br><br>
                    <p style="color:red; font-size: 11px;">Para eliminar el registro seleccionado le pedimos complete los <br> siguientes campos para justificar la razon por la que se eliminará <br> la actividad.</p>
                    <div>
                        <label class="titulo">Motivo : </label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT idmeps as id, motivo as motivo FROM motivos_eliminaps WHERE estado='ACTIVO' ORDER BY motivo ASC"); ?>
                        <select name="bxm" id="bxm" class="combo-box cam-empresa" style="width: 360px" required>
                            <option  class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($m = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $m['id'] ?>">
                                    <?php echo $m['motivo']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div style="display: inline-block">
                        <label class="titulo">Descripcion : </label><br>
                        <textarea name="desc" type="Text" id="desc" class="c-campos" placeholder="Describa el motivo" required></textarea>
                    </div>
                    <br><br>
                    
                    <button type="button"  class="btn btn-warning btneliminar" id="eliminardatos" data-dismiss="modal">Eliminar</button>
                   
                </div>
            </div>
        </div>
    </div>
    
    

</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
         
        });


        $('#actualizadatos').click(function() {
            actualizarDatos();
        });
        
         $('#eliminardatos').click(function() {
            EliminarDatos();
        });

    });
</script>