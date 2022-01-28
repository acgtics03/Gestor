
<?php

//VARIABLE DE SESION
session_start();
// El siguiente key se crea cuando se inicia sesión
require_once 'Database/conexion.php';



$_SESSION["timeout"] = time();
//Establecemos el método GET


//Se crea un conjunto de caracteres predeterminado para los datos usuario y clave
$user = $_SESSION['user'];

//md5 es utilizado para encriptar el registro de la clave del usuario
$pass = $_SESSION['psw'];


//Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$user' AND clave = '$pass' AND estatus = 'Activo'");
//Se cierra la conexion
mysqli_close($conection);
//Se crea una nueva variable que tendra el total de filas de los registros encontrados en el $query
$result = mysqli_num_rows($query);

//verificara si la cantidad de registros es mayor a cero
if ($result > 0) {
    //Si la consulta del $query encuentra mas de 1, los registros se guardarán en un Array
    $data = mysqli_fetch_array($query);
    $_SESSION['active'] = true;
    $_SESSION['idUser'] = $data['idusuario'];
    $_SESSION['user']   = $data['usuario'];
    $_SESSION['rol']    = $data['rol'];
    $_SESSION['estatus']    = $data['estatus'];
    $_SESSION['idPerfil'] = $data['idPerfil'];


    //header('location: menu.html');


    if ($_SESSION['idPerfil'] == '1') {
        //header('location: Modulo_administrador/HomeAdmin.php');
        header('location: Views/index.php');
    }
    if ($_SESSION['idPerfil'] == '2') {
        header('location: Views/index.php');
    }
    if ($_SESSION['idPerfil'] == '3' || $_SESSION['idPerfil'] == '4') {
        header('location: Views/index.php');
    }
} else {

    echo '<script type="text/javascript">';
    echo 'alert("Usuario o clave incorrectos")';
    echo '</script>';

    //final de la sesión
    session_destroy();
}
        
    
       
?>