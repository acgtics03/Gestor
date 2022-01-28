<?php
               session_start();
               
              if(!empty($_POST)){
                
                  require_once "conexion.php";
                  
                  $user = $_POST['username'];
                  $pass = $_POST['password'];


                  //Se generá la consulta a la base de datos del mismo que se tendrá por lo general siempre 1 registro
                  $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario='$user' AND clave = '$pass' AND estatus = 'Activo'");
                  
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


                    if($_SESSION['idPerfil'] == '3' || $_SESSION['idPerfil'] == '4'){  
					header('location: Views/index.php');
		        		}

                  } else {

                      echo '<script type="text/javascript">';
                      echo 'alert("Sin Acceso")';
                      echo '</script>';

                      //final de la sesión
                      session_destroy();
                  }
              }
              ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Actividades</title>
  <!-- loader
  <link href="Views/assets/css/pace.min.css" rel="stylesheet" />
  <script src="Views/assets/js/pace.min.js"></script>-->
  <!--favicon-->
  <link rel="icon" href="Views/assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="Views/assets/css/bootstrap.min.css" rel="stylesheet" />
  <!-- animate CSS-->
  <link href="Views/assets/css/animate.css" rel="stylesheet" type="text/css" />
  <!-- Icons CSS-->
  <link href="Views/assets/css/icons.css" rel="stylesheet" type="text/css" />
  <!-- Custom Style-->
  <link href="Views/assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

  <!-- start loader -->
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <!-- end loader -->

  <form action="" method="post">
    <!-- Start wrapper-->
    <div id="wrapper">

      <div class="loader-wrapper">
        <div class="lds-ring">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
      <div class="card card-authentication1 mx-auto my-5">
        <div class="card-body">
          <div class="card-content p-2">
            <div class="text-center">
              <img src="Views/assets/images/logo-icon.png" alt="logo icon">
            </div>
            <div class="card-title text-uppercase text-center py-3">Sign In</div>
            <form>
              <div class="form-group">
                <label for="exampleInputUsername" class="sr-only">Username</label>
                <div class="position-relative has-icon-right">
                  <input type="text" id="exampleInputUsername" name="username" class="form-control input-shadow" placeholder="Enter Username" required>
                  <div class="form-control-position">
                    <i class="icon-user"></i>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword" class="sr-only">Password</label>
                <div class="position-relative has-icon-right">
                  <input type="password" id="exampleInputPassword" name="password" class="form-control input-shadow" placeholder="Enter Password" required>
                  <div class="form-control-position">
                    <i class="icon-lock"></i>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-6">
                  <div class="icheck-material-white">
                    <input type="checkbox" id="user-checkbox" checked="" />
                    <label for="user-checkbox">Remember me</label>
                  </div>
                </div>
                <div class="form-group col-6 text-right">
                  <a href="reset-password.html">Reset Password</a>
                </div>
              </div>
              
              <input type="submit" class="btn btn-light" id="btnAcceso" name="btnAcceso" value="Acceder">
              
              <div class="text-center mt-3">Sign In With</div>
              <div class="form-row mt-4">
                <div class="form-group mb-0 col-6">
                  <button type="button" class="btn btn-light btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
                </div>
                <div class="form-group mb-0 col-6 text-right">
                  <button type="button" class="btn btn-light btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
                </div>
              </div>

            </form>
          </div>
        </div>
        <div class="card-footer text-center py-3">
          <p class="text-warning mb-0">Do not have an account? <a href="register.html"> Sign Up here</a></p>
        </div>
      </div>

      <!--Start Back To Top Button-->
      <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
      <!--End Back To Top Button-->

    </div>
    <!--wrapper-->
  </form>

  <!-- Bootstrap core JavaScript-->
  <script src="Views/assets/js/jquery.min.js"></script>
  <script src="Views/assets/js/popper.min.js"></script>
  <script src="Views/assets/js/bootstrap.min.js"></script>

  <!-- sidebar-menu js -->
  <script src="Views/assets/js/sidebar-menu.js"></script>

  <!-- Custom scripts -->
  <script src="Views/assets/js/app-script.js"></script>

</body>

</html>