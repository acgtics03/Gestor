<?php 
session_start();
date_default_timezone_set('America/Lima');
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());;
$fecha = date('Y-m-d'); 

$data = array();
$dataList = array();
	
	$idTareas = "";
	$idTareas = $_POST['idTareas'];

	$commentQuery = "SELECT comta.idcoment_tarea AS id, 
					tar.idtareas AS idtareas, 
					usu.idusuario AS idusuario, 
					comta.comentario,
					comta.nombre, 
					comta.fecha, 
					comta.estado,
					color.r as r,
					color.g as g,
					color.b as b
					FROM coment_tareas comta
					INNER JOIN usuario AS usu ON usu.idusuario=comta.idusuario
					INNER JOIN tareas AS tar ON tar.idtareas=comta.idtareas
					INNER JOIN participantes_tareas AS part ON part.participante=comta.idusuario AND part.idactividad=comta.idtareas
					INNER JOIN color_coment AS color ON color.idcolor=part.idcolor
					WHERE comta.estado = 1 and comta.idtareas = '$idTareas'
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