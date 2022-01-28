<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php

    $account = $_SESSION['user'];
 
		//Ver nombre de usuario
	$consultar_nombre =  mysqli_query($conection, "SELECT concat(SUBSTRING_INDEX(nombre,' ',1),' ',SUBSTRING_INDEX(apellido,' ',1)) as usuario FROM persona WHERE idusuario='$account'");
	$consultar_nombrer = mysqli_fetch_assoc($consultar_nombre);
	$nombre_usuario = $consultar_nombrer['usuario'];

	?>

	<label for="" style="font-size: 11.5px"><?php echo '' . 'Usuario: ' .$nombre_usuario ;?></label>
    <label for="" style="font-size: 11.5px">v.1.0</label>

</body>
</html>