<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"  href="../../img/icon.png" type="image/png" />
	<?php 
	require_once "../../config/configuracion.php"; 
	require_once "../../models/M02_Accesos/M02MD01_SelectorSuperAdmin.php";
	?>
	<title><?php echo $NOM_APP; ?></title>
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">	
	<link rel="stylesheet" type="text/css" href="../../css/estilo.min.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../../css/estilo_app.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">

			<h3 class="titulo-h">SELECCIONAR PERFIL</h3><br><br>

			<button type="submit" class="form-control btn btn-info col-8 tb" id="btnOperativo" name="btnOperativo"><i class="fas fa-users"></i>&nbsp; OPERATIVO</button><br><br>

            <button type="submit" class="form-control btn btn-info col-8 tb" id="btnAdmin" name="btnAdmin"><i class="fas fa-address-card"></i>&nbsp; ADMINISTRADOR</button><br><br>
			
			<div style="display: inline">               
                <div style="display: inline-block">
                  <a href="<?php echo $HOST; ?>"><img class="close" src="../../img/cerrar.png" alt="Salir del sistema" title="Cerrar sesión"></a>
                </div>
            </div>
			

			<!-- Mostrar cuenta de usuario activo -->
			<div id="pie">
				<?php include_once "../../resources/MGeneral/MG02_PiePagina.php"; ?>
			</div>
			
		</form>

	</section>

</body>
</html>