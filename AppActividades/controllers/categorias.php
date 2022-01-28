<?php

	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'acgsoft_nominas';

	$conection = mysqli_connect($host,$user,$password,$db);

$consul_tdoc = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_TIPO_DOCUMENTO' AND estado='ACTI'");
$consultar_tdr = mysqli_fetch_assoc($consul_tdoc);


$consultar_reg = mysqli_query($conection, "SELECT codigo as ID, nombre as nom FROM region");
$consultar_regr = mysqli_fetch_assoc($consultar_reg);

$consultar_prov = mysqli_query($conection, "SELECT codigo as ID, nombre as nom FROM provincia");
$consultar_provr = mysqli_fetch_assoc($consultar_prov);

$consultar_dist = mysqli_query($conection, "SELECT codigo as ID, nombre as nom FROM distrito");
$consultar_distr = mysqli_fetch_assoc($consultar_dist);

$consultar_reg2 = mysqli_query($conection, "SELECT codigo as ID, nombre as nom FROM region");
$consultar_reg2r = mysqli_fetch_assoc($consultar_reg2);

$consultar_prov2 = mysqli_query($conection, "SELECT codigo as ID, nombre as nom FROM provincia");
$consultar_prov2r = mysqli_fetch_assoc($consultar_prov2);

$consul_nacionalidad = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_NACIONALIDAD' AND estado='ACTI' order by nombre_corto");

$consul_tcontrato = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_TIPO_CONTRATO' AND estado='ACTI' order by nombre_corto");

$consul_rpensionario = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_REGIMEN_PENSIONARIO' AND estado='ACTI' order by nombre_corto");

$consul_cocupacional = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_CATEGORIA OCUPACIONAL' AND estado='ACTI' order by nombre_corto");

$consul_ocupacionsp = mysqli_query($conection, "SELECT idconfig_detalle as ID, nombre_corto as Nombre FROM configuracion_detalle WHERE codigo_tabla='_OCUPACION_SP' AND estado='ACTI' order by nombre_corto");