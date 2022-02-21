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
					comac.id AS id, 
					act.idactividades AS idactividades, 
					usu.idusuario AS idusuario, 
					comac.comentario,
					comac.nombre, 
					comac.fecha, 
					comac.estado 
					FROM coment_actividades comac
					INNER JOIN usuario AS usu ON usu.idusuario=comac.idusuario
					INNER JOIN actividades AS act ON act.idactividades=comac.idactividades
					WHERE comac.estado = 1 and comac.idactividades
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