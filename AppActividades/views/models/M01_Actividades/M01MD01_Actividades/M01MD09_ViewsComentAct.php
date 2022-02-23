<?php 
session_start();
date_default_timezone_set('America/Lima');
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());;
$fecha = date('Y-m-d'); 

$data = array();
$dataList = array();
	
	$idactividad = "";
	$idactividad = $_POST['idActividad'];

	$commentQuery = "SELECT comac.id AS id, 
					act.idactividades AS idactividades, 
					usu.idusuario AS idusuario, 
					comac.comentario,
					comac.nombre, 
					comac.fecha, 
					comac.estado,
					color.r as r,
					color.g as g,
					color.b as b
					FROM coment_actividades comac
					INNER JOIN usuario AS usu ON usu.idusuario=comac.idusuario
					INNER JOIN actividades AS act ON act.idactividades=comac.idactividades
					INNER JOIN participantes_tareas AS part ON part.participante=comac.idusuario AND part.idactividad=comac.idactividades
					INNER JOIN color_coment AS color ON color.idcolor=part.idcolor
					WHERE comac.estado = 1 and comac.idactividades='$idactividad'
					ORDER BY id ASC";
	$commentsResult = mysqli_query($conection, $commentQuery) or die("database error:".mysqli_error($conection));
	$commentHTML = '';

	while($comentario = mysqli_fetch_assoc($commentsResult)){
		$commentHTML .='
			
			<div class="chat-msg">	
			<div class="chat-msg-profile">										
				<div class="chat-msg-date"><span class="color-autor">'.$comentario["nombre"].'</span> &nbsp; &nbsp; <i>'.$comentario["fecha"].'</i></div>
			</div>
			<div class="chat-msg-content">
				<div class="chat-msg-text" style="background-color: rgb('.$comentario["r"].','.$comentario["g"].','.$comentario["b"].')">'.$comentario["comentario"].'</div>
			</div>		
			</div> ';
		//$commentHTML .=getCommentReply($conection, $comentario["id"]);
	}
	echo $commentHTML;

?>