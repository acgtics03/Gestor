<?php 
   session_start();
   date_default_timezone_set('America/Lima');
   include_once "../../../../../config/configuracion.php";
   include_once "../../../../../config/conexion_app.php";
   $hora = date("H:i:s", time());;
   $fecha = date('Y-m-d'); 
   
   $data = array();
   $dataList = array();

   $username = $_SESSION['usu'];
    $consulta_id = mysqli_query($conection, "SELECT idusuario FROM usuario WHERE usuario='$username'");
    $consulta_idr = mysqli_fetch_assoc($consulta_id);
    $ids = $consulta_idr['idusuario'];

$commentQuery = "SELECT id, parent_id, comentario, nombre, fecha FROM coment_actividades WHERE parent_id = '0' ORDER BY id ASC";
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
	$commentHTML .=getCommentReply($conection, $comentario["id"]);
}
echo $commentHTML;

function getCommentReply($conection, $parentId = 0, $marginLeft = 0){
	$commentHTML = '';
	$commentQuery = "SELECT id, parent_id, comentario, nombre, fecha FROM coment_actividades WHERE parent_id = '".$parentId."'";
	$commentsResult = mysqli_query($conection, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0){
		$marginLeft = 0;
	}else{
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0){
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
			$commentHTML .= getCommentReply($conection, $comentario["id"], $marginLeft);
		}
		
	}
	return $commentHTML;
}

?>