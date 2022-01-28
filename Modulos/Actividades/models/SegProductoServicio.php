<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Js/popup_ps.js"></script>
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

    require 'conexion.php';
    $username = $_SESSION['user'];
    
    $ver_usu = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
    $usuar = mysqli_fetch_assoc($ver_usu);
      
    $usuario = $usuar['id'];

    //COMPLETAR TABLA 
    
    $ver_cargo = mysqli_query($conection, "SELECT idCargo, idArea FROM persona WHERE idusuario='$username'");
      $cargo = mysqli_fetch_assoc($ver_cargo);
      
      $carg = $cargo['idCargo'];
    
    if($carg=='2' || $carg=='9'){
        
    $consultaAct = mysqli_query($conection, "SELECT p.idps as ID, t.nombre as nombre, p.descripcion as descripcion, p.estado as estado, cc.sDescripcion as empresa, a.Area as area, 
    p.fecinicio as inicio, p.fecfin as final, p.fecinicioReal as inicioReal, p.fecfinReal as finReal, concat(SUBSTRING_INDEX(pr.apellido,' ',1),' ',SUBSTRING_INDEX(pr.nombre,' ',1)) as responsable, p.categoria as tipo, p.empresa as empre, 
    p.area as are, p.responsable as respon FROM producto_servicio p, usuario u, persona pr, area a , centrocosto cc, tipos t WHERE p.nombre=t.idgestion AND p.responsable=u.idusuario AND p.empresa=cc.iCodigo AND u.usuario=pr.idusuario 
    AND p.area=a.idArea AND (pr.idJefeInmediato='$username' OR pr.idusuario='$username') AND p.estado!='ELIMINADO' ORDER BY p.fechaRegistro DESC");
    
    }else{
    
    $consultaAct = mysqli_query($conection, "SELECT p.idps as ID, t.nombre as nombre, p.descripcion as descripcion, p.estado as estado, cc.sDescripcion as empresa, a.Area as area, p.fecinicio as inicio,
    p.fecfin as final, p.fecinicioReal as inicioReal, p.fecfinReal as finReal, concat(SUBSTRING_INDEX(pr.apellido,' ',1),' ',SUBSTRING_INDEX(pr.nombre,' ',1)) as responsable, p.categoria as tipo, p.empresa as empre, p.area as are, p.responsable as respon 
    FROM producto_servicio p, area a, centrocosto cc, usuario u,persona pr, participantes par, tipos t WHERE p.nombre=t.idgestion AND p.area=a.idArea AND p.estado!='ELIMINADO' AND p.empresa=cc.iCodigo AND 
    p.responsable=u.idusuario AND u.usuario=pr.idusuario AND p.idps=par.idps AND (p.responsable='$usuario' OR par.participante='$usuario') GROUP BY p.idps ORDER BY p.fechaRegistro DESC");
    }
    
    
    while ($ps = mysqli_fetch_assoc($consultaAct)) {

        $datos = $ps['ID'] . "||" .
            $ps['tipo'] . "||" .          
            $ps['estado'] . "||" .
            $ps['empre'] . "||" .
            $ps['nombre'] . "||" .
            $ps['descripcion'] . "||" .
            $ps['are'] . "||" .
            $ps['respon'] . "||" .
            $ps['inicio'] . "||" .
            $ps['inicioReal'] . "||" .
            $ps['final'] . "||" .
            $ps['finReal'];
            
           
            $ids= $ps['ID'];
            
            $tip = $ps['tipo'];
            $vinc = $ps['ID'];
            $var_estado=$ps['estado'];
            
            $ver_usu2 = mysqli_query($conection, "SELECT idusuario as id FROM usuario WHERE usuario='$username'");
            $usua2r = mysqli_fetch_assoc($ver_usu2);
            
           $contActividades = mysqli_query($conection, "SELECT * FROM actividades WHERE identificador='$tip' AND vinculo='$vinc' AND estado!='ELIMINADO'");
           $total_Act = mysqli_num_rows($contActividades);
            
           $contActividadesF = mysqli_query($conection, "SELECT * FROM actividades WHERE identificador='$tip' AND vinculo='$vinc' AND (estado='FINALIZADO' OR estado='DETENIDO')");
           $total_ActF = mysqli_num_rows($contActividadesF); 
           
           $indicador1 = "";
           $idres = $usua2r['id'];
            
            $rs = $ps['respon'];
            $espacio = "";
            $parte1='#modalEdicion'; 
            $parte2="Trabajador('$datos')";
            $parte3="Trabajador2('$datos')";
            $parte4='#modalEliminar';
            
            $img = "editar2";
            $img2 = "detalle";
            $img3 = "eliminar";
            $img4 = "btnfinalizado";
            $colorfond = "";

            if($carg=='2' || $carg=='9'){
                $vista='';
                $espacio = "&nbsp;&nbsp;&nbsp;";
                $parte1='#modalEdicion'; 
                $parte2="Trabajador('$datos')";
                $parte3="Trabajador2('$datos')";
                $parte4='#modalEliminar';
                
                if($var_estado=='FINALIZADO'){
                    $parte3="Aviso7()";
                    $parte4='';
                    $img4 = "btnfinalizado2";
                    $img3 = "eliminar2";
                    }else{
                    $parte3="Trabajador2('$datos')";
                    $parte4='#modalEliminar';
                    }
                
               if($total_Act=='0' && $total_ActF=='0'){
                   $indicador2 = "Aviso3()"; // El Producto o Servicio debe tener como mínimo una actividad finalizada.
                    $indicador1 = "#";
               }else{
                   if($total_Act==$total_ActF){
                       if($var_estado=='FINALIZADO'){
                         $indicador1 = "#";
                         $indicador2 = "Aviso8()";   
                         $img4 = "btnfinalizado2";
                       }else{
                         $indicador1 = "../models/finalizar_ps.php?SV=".$ps['ID']."";
                         $indicador2 = "#";
                       }
                   }
                   else{
                       $indicador2 = "Aviso4()"; // aviso: es necesario finalizar las actividades
                       $indicador1 = "#";
                   }
               }
                
            }else{
                if($idres!="$rs"){
                    $parte1=''; 
                    $parte2="Aviso()";
                    $parte3="Aviso2()";
                    $parte4='';
                    
                    $indicador2 = "Aviso5()"; // Usted no esta autorizado para FINALIZAR el registro seleccionado.
                    $indicador1 = "#";
                    
                    $img = "editar22";
                    $img3 = "eliminar2";
                    $img4 = "btnfinalizado2";
                    
                    $colorfond='style="color: rgb(122, 223, 127)"';
                
                }else{
                    $vista='';
                    $espacio = "&nbsp;&nbsp;&nbsp;";
                    
                    if($var_estado=='FINALIZADO'){
                      $parte1=''; 
                      $parte2="Aviso6()";
                       $img4 = "btnfinalizado2";
                      $img = "editar22";
                      
                      $parte3="Aviso7()";
                      $img3 = "eliminar2";
                      $parte4='';
                    }else{
                        $parte1='#modalEdicion'; 
                        $parte2="Trabajador('$datos')";
                        
                        $parte3="Trabajador2('$datos')";
                        $parte4='#modalEliminar';
                    }
                    if($total_Act=='0' && $total_ActF=='0'){
                   $indicador2 = "Aviso3()"; // El Producto o Servicio debe tener como mínimo una actividad finalizada.
                    $indicador1 = "#";
                       }else{
                           if($total_Act==$total_ActF){
                            if($var_estado=='FINALIZADO'){
                                 $indicador1 = "#";
                                 $indicador2 = "Aviso8()";
                                 $img4 = "btnfinalizado2";
                                 $img = "editar22";
                                 $img3 = "eliminar2";
                               }else{
                                 $indicador1 = "../models/finalizar_ps.php?SV=".$ps['ID']."";
                                 $indicador2 = "#";
                               }
                           }
                           else{
                               $indicador2 = "Aviso4()"; // aviso: es necesario finalizar las actividades
                               $indicador1 = "#";
                           }
                       }
                }
            }
            
            
           
    ?>
        <tr>
           <td><a href="" data-toggle="modal" data-target="<?php echo $parte1; ?>" onclick="<?php echo $parte2; ?>"><img src="image/<?php echo $img; ?>.png" width="35px" height="35px" alt=""></a>
                &nbsp;&nbsp;&nbsp;<?php echo "<a href='Seguimiento_ps.php?SV=".$ps['ID']."'><img src='image/".$img2.".png' width='35px' height='35px' alt=''></a>"; ?>
                &nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="<?php echo $parte4; ?>" onclick="<?php echo $parte3; ?>"><img src="image/<?php echo $img3; ?>.png" width="35px" height="35px"></a>
                &nbsp;&nbsp;&nbsp;<?php echo "<a href='".$indicador1."' onclick='".$indicador2."'><img src='image/".$img4.".png' width='35px' height='35px' alt=''></a>"; ?>
            </td>
            <td class="centrar" <?php echo $colorfond; ?>><?php echo $ps['inicio']; ?></td>
            <td class="centrar" <?php echo $colorfond; ?>><?php echo $ps['final']; ?></td>
            <td class="centrar" <?php echo $colorfond; ?>><?php $valorestado=$ps['estado'];
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
            <td <?php echo $colorfond; ?>><?php 
            
            $idp = $ps['tipo'];
            if($idp=="PRODUCTO"){
                $idpp = "PRO";
            }else{
                $idpp = "SER";
            }
            
            echo $total_ActF.'/'.$total_Act.' - '.$idpp; 
            
            ?></td>
            <td <?php echo $colorfond; ?>><?php echo $ps['empresa']; ?></td>
            <td <?php echo $colorfond; ?>><?php echo $ps['nombre']; ?></td>
            <td <?php echo $colorfond; ?>><?php echo $ps['responsable']; ?></td>
        </tr>
    <?php }
    ?>

    <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content ach">
             <form action="" method="post">
                <div class="modal-header">
                   
                    <h4 class="modal-title t-titulo" id="myModalLabel">Actualizar datos &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-warning" id="actualizardatos" data-dismiss="modal" style="background-color: rgb(26, 133, 196);  border-color: rgb(26, 133, 196);">Actualizar</button>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">

                    <input type="text" hidden="" id="ID" name="ID">
                    
                    
                    <div style="display: inline-block">
                        <label class="titulo">Tipo</label><br>
                        <select name="tipo" id="tipo" class="combo-box">
                            <option  class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <option class="f-box">PRODUCTO</option>
                            <option class="f-box">SERVICIO</option>
                        </select>
                    </div>
                    &nbsp;&nbsp;
                    
                    
                     <div style="display: inline-block">
                        <label class="titulo">Estado</label><br>
                        <select name="bxestado" id="bxestado" class="combo-box">
                            <option  class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php 
                              
                              
                              
                              $ValId = $ps['ID'] ;
                              
                              $verestado = mysqli_query($conection, "SELECT count(*) as contador FROM actividades WHERE vinculo='$ValId'");
                              $verestador = mysqli_fetch_assoc($verestado);
                              
                               $verestado2 = mysqli_query($conection,"SELECT count(*) as contadorE FROM actividades WHERE vinculo='$ValId' AND estado='FINALIZADO'");
                              $verestado2r = mysqli_fetch_assoc($verestado2);
                              
                              $variable1 = $verestador['contador'];
                              $variable2 = $verestado2r['contadorE'];
                              $total = $variable1-$variable2;
                              
                              $ocultar= "";
                              if($total!="0"){
                                  $ocultar='hidden';
                              }
                            ?>
                            <option class="f-box">PLANIFICADO</option>
                            <option class="f-box">PROCESO</option>
                            <option class="f-box">DETENIDO</option> 
                            
                        </select>
                    </div>
                    <br><br>
                    <div>
                        <label class="titulo">Cliente</label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT iCodigo as ID, sDescripcion as nombre FROM centrocosto WHERE iEstado='1' ORDER BY sDescripcion ASC"); ?>
                        <select name="boxempresa" id="boxempresa" class="combo-box cam-empresa" style="width: 360px">
                            <option  class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($empresa = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $empresa['ID'] ?>">
                                    <?php echo $empresa['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <br>
                    <div style="display: inline-block">
                        <label class="titulo">Nombre</label><br>
                        <div style="display: inline-block">
                                <label style="color: blue; font-size: 10px">Actual</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;&nbsp;
                                <input type="text" id="nombres" name="nombres" style="width: 270px" disabled>
                                
                                 <script>
                                    	$(function(){
                                      	$(document).on('change','#nombre',function(){ //detectamos el evento change
                                        	var value = $(this).val();//sacamos el valor del select
                                          $('#nombres').val(value);//le agregamos el valor al input (notese que el input debe tener un ID para que le caiga el valor)
                                        });
                                      });
                                    
                                </script>
                                
                         </div>
                         <br>
                        <div style="display: inline-block">
                               <label style="color: blue; font-size: 10px">Cambiar por</label>&nbsp;&nbsp;
                               <select id="nombre" name="nombre" class="combo-box" style="width: 270px">
                                   <option value="" class="f-box" selected="true">- Seleccione un tipo -</option>
                        </select>
                         </div>
                    </div>
                    
                    <script type="text/javascript">
                          $(document).ready(function(){
                            var nombre = $('#nombre');
                            var nombre_sel = $('#nombre_sel');
                    
                            $('#tipo').change(function(){
                              var tipo_id = $(this).val(); //obtener el id seleccionado
                    
                              if(tipo_id !== ''){ //verificar haber seleccionado una opcion valida
                    
                                /*Inicio de llamada ajax*/
                                $.ajax({
                                  data: {tipo_id:tipo_id}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
                                  dataType: 'html', //tipo de datos que esperamos de regreso
                                  type: 'POST', //mandar variables como post o get
                                  url: '../models/get_nombres.php' //url que recibe las variables
                                }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             
                    
                                  nombre.html(data); //establecemos el contenido html de nombres con la informacion que regresa ajax             
                                  nombre.prop('disabled', false); //habilitar el select
                                });
                                /*fin de llamada ajax*/
                    
                              }else{ //en caso de seleccionar una opcion no valida
                                nombre.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
                                nombre.prop('disabled', true); //deshabilitar el select
                              }    
                            });
                    
                    
                            //mostrar una leyenda con el nombre seleccionado
                            $('#nombre').change(function(){
                              $('#nombre_sel').html($(this).val() + ' - ' + $('#nombre option:selected').text());
                            });
                    
                          });
                        </script>  
                    
                    <br>
                    <div style="display: inline-block">
                        <label class="titulo">Descripcion</label><br>
                        <textarea name="descripcion" type="Text" id="descripcion" class="c-campos"></textarea>
                    </div>
                    <br>
                    <div style="display: inline-block">
                        <label class="titulo">Área</label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT * FROM area ORDER BY Area ASC"); ?>
                        <select name="boxArea" id="boxArea" class="combo-box">
                            <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $datos['idArea'] ?>">
                                    <?php echo $datos['Area']; ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="titulo">Responsable</label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT u.idusuario as ID, concat(p.apellido,' ',p.nombre) as datos FROM persona p , usuario u WHERE p.idusuario=u.usuario ORDER BY apellido ASC"); ?>
                        <select name="boxResponsable" id="boxResponsable" class="combo-box">
                            <option class="f-box" selected="true" disabled="disabled">Seleccione...</option>
                            <?php while ($datos = mysqli_fetch_assoc($consulta)) { ?>
                                <option class="f-box" value="<?php echo $datos['ID'] ?>">
                                    <?php echo $datos['datos']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Fecha inicio</label><br>
                        <input class="cam-fecha" name="fecinicio" type="Date" id="fecinicio" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="titulo">Fecha inicio real</label><br>
                        <input class="cam-fecha" name="fecinicioreal" type="Date" id="fecinicioreal" placeholder="yy-mm-dd">
                    </div>
                    <br><br>
                    <div style="display: inline-block">
                        <label class="titulo">Fecha termino</label><br>
                        <input class="cam-fecha" name="fecfinal" type="Date" id="fecfinal" placeholder="yy-mm-dd">
                    </div>
                    &nbsp;&nbsp;
                    <div style="display: inline-block">
                        <label class="titulo">Fecha termino real</label><br>
                        <input class="cam-fecha" name="fecfinalreal" type="Date" id="fecfinalreal" placeholder="yy-mm-dd">
                    </div>
        
                    <br><br>
                </div>

               </form> 
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content ach">
                <div class="modal-header">
                    <h4 class="modal-title t-titulo" id="myModalLabel">Eliminar Producto/Servicio
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                   
                    <input type="text" hidden=""  id="IDs" name="">
                    <label class="titulo">Tipo : </label>
                    <input type="text" id="tiposs" name="tiposs" style="border: none; width: 90px" disabled> <br>
                    <label class="titulo">Nombre : </label><br>
                    <input type="text" id="nombree" name="nombree" style="border: none; font-size:12px; width: 100%" disabled>
                    <br><br>
                    <p style="color:red; font-size: 11px;">Para eliminar el registro seleccionado le pedimos complete los <br> siguientes campos para justificar la razon por la que se eliminará <br> el registro.</p>
                    <div>
                        <label class="titulo">Motivo : </label><br>
                        <?php $consulta = mysqli_query($conection, "SELECT idmeps as id, motivo as motivo FROM motivos_eliminaps WHERE estado='ACTIVO' ORDER BY motivo ASC"); ?>
                        <select name="boxmotivo" id="boxmotivo" class="combo-box cam-empresa" style="width: 360px" required>
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
                        <textarea name="descripcion2" type="Text" id="descripcion2" class="c-campos" placeholder="Describa el motivo" required></textarea>
                    </div>
                    <br><br>
                    
                    <button type="button"  class="btn btn-warning btneliminar" id="eliminardatos" data-dismiss="modal">Eliminar</button>
                   
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="../Js/popup.js"></script>

</body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#guardarnuevo').click(function(){
         
        });


        $('#actualizardatos').click(function() {
            actualizarDatos();
        });
        
        $('#eliminardatos').click(function() {
            EliminarDatos();
        });

    });
</script>