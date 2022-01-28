
<!-- CONEXION LOCAL -->

<?php

$serverName = 'MATRIX'; //serverName\instanceName
$connectionInfo = array( "Database"=>"PruebaPayroll", "UID"=>"sa", "PWD"=>"acg2021","CharacterSet"=>"UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r(sqlsrv_errors(), true));
}
?>

<!-- CONEXION SERVIDOR -->

<?php
/*
$serverName = "170.239.100.148\WIN_U2PQP8NV95M,1433"; //serverName\instanceName, portNumber (por defecto es 1433)
$connectionInfo = array( "Database"=>"Payroll", "UID"=>"sa", "PWD"=>"acg&123");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}*/
?>
