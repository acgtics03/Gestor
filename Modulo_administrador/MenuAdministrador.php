<!DOCTYPE HTML>
<?php
    //INICIAR VARIABLES DE SESIÓN
    session_start();

    //CONEXIÓN A BD
    require '../Modulos/conexion.php';

    //VARIABLE DE FECHA
    $factual = date('Y-m-d');
    $fayer = date( "Y-m-d", strtotime( "-1 day", strtotime( $factual ) ) ); 

    //INDICADORES DE ASISTENCIA
        //CONSULTA Total
        $total = mysqli_query($conection, "SELECT COUNT(user) AS total FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.Estado='INGRESO' AND p.idusuario=a.user");
        $totalra = mysqli_fetch_assoc($total);
        
        //CONSULTA A TIEMPO
        $a_tiempo = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS atiempo FROM asistencia a, persona p WHERE a.fregistro='$factual' AND a.Estado='INGRESO' AND p.idusuario=a.user AND a.ingreso<='09:00:00'");
        $a_tiempor = mysqli_fetch_assoc($a_tiempo);

        //CONSULTA TOLERANCIA
        $tolerancia = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tolerancia FROM asistencia a, persona p WHERE a.fregistro='2020-02-12' AND a.Estado='INGRESO' AND p.idusuario=a.user AND a.ingreso>'09:00:00' AND a.ingreso<='09:15:00'");
        $toleranciar = mysqli_fetch_assoc($tolerancia);

        //CONSULTA TARDE
        $tarde = mysqli_query($conection, "SELECT COUNT(a.fregistro) AS tarde FROM asistencia a, persona p  WHERE a.fregistro='$factual' AND a.Estado='INGRESO' AND p.idusuario=a.user AND a.ingreso>='09:15:00'");
        $tarder = mysqli_fetch_assoc($tarde);

    //INDICADORES DE PERMISOS

        //CONSULTA Total
        $total = mysqli_query($conection, "SELECT COUNT(estado) AS total FROM permiso WHERE fsol='$factual' AND estado IN('POR APROBAR', 'APROBADO', 'RECHAZADO')");
        $totalrp = mysqli_fetch_assoc($total);

        //CONSULTA APROBADOS
        $aprobado = mysqli_query($conection, "SELECT COUNT(estado) AS aprobado FROM permiso WHERE fsol='$factual' AND estado='APROBADO'");
        $aprobador = mysqli_fetch_assoc($aprobado);

        //CONSULTA RECHAZADOS
        $rechazado = mysqli_query($conection, "SELECT COUNT(estado) AS rechazado FROM permiso WHERE fsol='$factual' AND estado='RECHAZADO'");
        $rechazador = mysqli_fetch_assoc($rechazado);

        //CONSULTA POR APROBAR
        $pendientes = mysqli_query($conection, "SELECT COUNT(estado) AS pendiente FROM permiso WHERE fsol='$factual' AND estado='POR APROBAR'");
        $pendientesr = mysqli_fetch_assoc($pendientes);

    //INDICADORES DE VISITAS
        //CONSULTA DE VISITAS FECHA ACTUAL, FECHA AYER Y TOTAL DE VISITAS MENSUAL
        $sql2 = mysqli_query($conection, "SELECT COUNT(usuario) AS nvisitas, (SELECT COUNT(usuario) FROM visita WHERE YEAR(FechaCreacion)=YEAR('$factual') AND month(FechaCreacion)=month('$factual')) as nvisitas_mes, (SELECT COUNT(usuario) AS nvisitas_ayer FROM visita WHERE FechaCreacion='$fayer') AS nvisitas_ayer FROM visita WHERE FechaCreacion='$factual' ");
        $nvisitasr = mysqli_fetch_assoc($sql2);

?>
<html>
	<head>
		<title>Landing - Forty by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<!-- Note: The "styleN" class below should match that of the banner element. -->
					<header id="header" class="alt style2">
						<a href="index.html" class="logo"><strong>ACG</strong> <span>SOFT</span></a>
						<nav>
							<a href="#menu">Menu</a>
						</nav>
					</header>

				<!--------------------- MENU SISTEM ------------------------->
     <?php
 
    include('php/menu.php');

    ?>
    <!-- --------------------------------------------------- -->
				<!-- Banner -->
				<!-- Note: The "styleN" class below should match that of the header element. -->
					<section id="banner" style="Background-color: #001843">
						<div class="inner">
							<span class="image">
								<img src="../images/pic07.jpg" alt="" />
							</span>
							<!--<header class="major">
								<h1>Landing</h1>
							</header>-->
                        <div class="content" >
                           <div id="asistencia" style="display: inline-block; margin-bottom: 10px; Background-color: #bfbfc0; width: 100%;border-radius: 19px 19px 19px 19px;"><br>
                                <center>
                                <div>
                                    <label id="campo0a" for="" style="font-size: 100%; font-family: 'Arial'; color: black">Asistencia</label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="font-size: 26px; color: green; font-family: 'Arial';" id="campo1" for=""><?php echo $a_tiempor['atiempo'] ;?>
                                    <label style=" font-size: 8px; font-weight: bold; font-family: 'Arial'; color:black;" id="campo4" for="">Perfecta</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 20px; font-size: 25.8px; color: blue ; font-family: 'Arial';" id="campo2" for=""><?php echo $toleranciar['tolerancia'] ;?>
                                    <label style=" font-size: 8px; font-weight: bold ; font-family: 'Arial'; color: black;" id="campo5" for="">Aceptable</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 23px; font-size: 25.8px; color: red; font-family: 'Arial';" id="campo3" for=""><?php echo $tarder['tarde'] ;?>
                                    <label style=" margin-right:5px; font-size: 8px; font-weight: bold; font-family: 'Arial'; color: black;" id="campo5" for="">Inaceptable</label></label>
                                </div>
                                </center>
                            </div>
                            <div id="permisos" style="display: inline-block; margin-bottom: 10px; Background-color: #bfbfc0; width: 100%;border-radius: 19px 19px 19px 19px;"><br>
                                <center>
                                <div>
                                    <label id="campo0p" for="" style="font-size: 100%; font-family: 'Arial'; color: black">Permisos</label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="font-size: 26px; color: green; font-family: 'Arial';" id="campo1" for=""><?php echo $aprobador['aprobado'] ;?>
                                    <label style="font-size: 8px; font-weight: bold; font-family: 'Arial'; color: black" id="campo3" for="">Aprobadas</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 28px; font-size: 25.8px; color: blue ; font-family: 'Arial';" id="campo2" for=""><?php echo $rechazador['rechazado'] ;?>
                                    <label style="font-size: 8px; font-weight: bold ; font-family: 'Arial'; color: black;" for="">Rechazadas</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 23px; font-size: 25.8px; color: red; font-family: 'Arial';" id="campo3" for=""><?php echo $pendientesr['pendiente'] ;?>
                                    <label style=" margin-right:5px; font-size: 8px; font-weight: bold; font-family: 'Arial'; color: black;" for="">Por aprobar</label></label>
                                </div>
                                </center>    
                            </div>
                            <div id="visitas" style="display: inline-block; margin-bottom: 10px; Background-color: #bfbfc0; width: 100%;border-radius: 19px 19px 19px 19px;"><br>
                                <center>
                                <div>
                                    <label id="campo0v" for="" style="font-size: 100%;  font-family: 'Arial'; color: black;">Visitas</label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="font-size: 26px; color: green; font-family: 'Arial';" id="campo1" for=""><?php echo $nvisitasr['nvisitas_ayer'] ;?>
                                    <label style="font-size: 10px; font-weight: bold; font-family: 'Arial'; color: black" id="campo3" for="">Ayer</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 28px; font-size: 25.8px; color: blue ; font-family: 'Arial';" id="campo2" for=""><?php echo $nvisitasr['nvisitas'] ;?>
                                    <label style="font-size: 10px; font-weight: bold ; font-family: 'Arial'; color: black" id="campo4v" for="">Hoy</label></label>
                                </div>
                                <div style="display: inline-block">
                                    <label style="margin-left: 23px; font-size: 25.8px; color: red; font-family: 'Arial';" id="campo2" for=""><?php echo $nvisitasr['nvisitas_mes'] ;?>
                                    <label style=" margin-right:5px; font-size: 8px; font-weight: bold; font-family: 'Arial'; color:black" id="campo4v" for="">Total mes</label></label>
                                </div>
                                </center>
                            </div>
                        </div> 
                </section>

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
								<div class="inner"><center>
									<header class="major">
                                    <script language="JavaScript">
                                        function mueveReloj(){
                                            momentoActual = new Date()
                                            hora = momentoActual.getHours()
                                            minuto = momentoActual.getMinutes()
                                            segundo = momentoActual.getSeconds()

                                            horaImprimible = hora + " : " + minuto + " : " + segundo

                                            document.form_reloj.reloj.value = horaImprimible

                                            setTimeout("mueveReloj()",1000)
                                        }
                                        </script>

                                            <body onload="mueveReloj()">
                                            <form name="form_reloj">
                                            <input type="text" style="text-align: center; font-size: 30px" name="reloj" size="40">
                                            </form>

                                            </body>

									</header>
									<p></p>
								</div>
							</section>


					</div>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>