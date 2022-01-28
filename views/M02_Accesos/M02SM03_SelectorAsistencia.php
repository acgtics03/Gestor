<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link  rel="icon"  href="../../img/icon.png" type="image/png" />
	<?php 
	require_once "../../config/configuracion.php"; 
	require_once "../../models/M02_Accesos/M02MD03_SelectorAsistencia.php";
	?>
	<title><?php echo $NOM_APP; ?></title>
	<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../../css/estilo_app.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../../css/estilo.min.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js
" type="text/javascript"></script>

	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<!-- Mostrar cuenta de usuario activo -->
			<h3 class="titulo-h">CONTROL ASISTENCIA</h3><br>

            <div hidden="">
                <!-- DATOS DE LATITUD Y LONGITUD -->
                <input type="text" id="txtlongitud" name="txtlongitud">
                <input type="text" id="txtlatitud" name="txtlatitud">

                <p hidden="">
                    <button onclick="geoFindMe()">Show my location</button>
                </p>
                <div id="out"></div>
            </div>

            <button type="submit" class="form-control btn btn-info col-8 tb" id="btnIrAsistencia" name="btnIrAsistencia"><i class="fas fa-calendar-check"></i>&nbsp; REGISTRAR ASISTENCIA</button><br><br>

            <button type="submit" class="form-control btn btn-info col-8 tb" id="btnIrPermiso" name="btnIrPermiso"><i class="fas fa-calendar-check"></i>&nbsp; SOLICITAR PERMISO</button><br><br>

            <button type="submit" <?php echo $ocultar; ?> class="form-control btn btn-info col-8 tb" id="btnIrAutorizar" name="btnIrAutorizar"><i class="fas fa-calendar-check"></i>&nbsp; AUTORIZAR PERMISO</button><br><br>

            <!-- Notificación de acción -->
            <div class="alert" hidden><?php echo isset($alert) ? $alert : ''; ?></div>
            <br>
            <div style="display: inline; margin-top: 2%;">
                <div style="display: inline-block">
                    <a href="M02SM01_SelectorColaborador.php"><img class="close" src="../../img/atras.png" alt="Volver atras" title="Volver atras"></a>
                </div>
                <div style="display: inline-block; margin-left: 2%;">
                    <a href="<?php echo $HOST; ?>"><img class="close" src="../../img/cerrar.png" alt="Salir del sistema" title="Cerrar sesión"></a>
                </div>
            </div>

            <!-- Mostrar cuenta de usuario activo -->
			<div id="pie">
				<?php include_once "../../resources/MGeneral/MG02_PiePagina.php"; ?>
			</div>


        
		</form>

	</section>
	
	<script>
        geoFindMe();
        function geoFindMe() {
        var output = document.getElementById("out");
    
        if (!navigator.geolocation){
            output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
            return;
        }
    
        function success(position) {
            var latitude  = position.coords.latitude;
            var longitude = position.coords.longitude;
    
                document.getElementsByName("txtlongitud")[0].value = longitude;
                document.getElementsByName("txtlatitud")[0].value = latitude;
            /*
            output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>';
            
            var img = new Image();
            img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";
    
            output.appendChild(img);*/
        };
    
        function error() {
            output.innerHTML = "Unable to retrieve your location";
        };
    
        output.innerHTML = "<p>Locating…</p>";
    
        navigator.geolocation.getCurrentPosition(success, error);
        }
    </script>
    

</body>
</html>