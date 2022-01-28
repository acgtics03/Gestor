<?php

  session_start();
  
  function accion(){
  
  $_SESSION['userr']=$_POST['username'];
  $_SESSION['psw']=$_POST['password'];
  
  header('location: ../../../gestion/application/controllers/Administrador.php');
  
  echo 'login();';
  
  }
  
?>