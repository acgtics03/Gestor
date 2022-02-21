<?php 
session_start();
date_default_timezone_set('America/Lima');
include_once "../../../../../config/configuracion.php";
include_once "../../../../../config/conexion_app.php";
$hora = date("H:i:s", time());;
$fecha = date('Y-m-d'); 

$data = array();
$dataList = array();
	
	

	$commentQuery = "SELECT 
					comta.idcoment_tarea AS id, 
					tar.idtareas AS idtareas, 
					usu.idusuario AS idusuario, 
					comta.comentario,
					comta.nombre, 
					comta.fecha, 
					comta.estado 
					FROM coment_tareas comta
					INNER JOIN usuario AS usu ON usu.idusuario=comta.idusuario
					INNER JOIN tareas AS tar ON tar.idtareas=comta.idtareas
					WHERE comta.estado=1 and comta.idtareas
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
				<div class="chat-msg-text">'.$comentario["comentario"].'</div>
			</div>		
			</div> ';
		//$commentHTML .=getCommentReply($conection, $comentario["id"]);
	}
	echo $commentHTML;

?>