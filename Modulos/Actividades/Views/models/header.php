<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!--Start topbar header-->
    <header class="topbar-nav">
      <nav class="navbar navbar-expand fixed-top" style="background-color: #16375B;">
        <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link toggle-menu" href="javascript:void();">
              <i class="icon-menu menu-icon"></i>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
          
          <li class="nav-item">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
              <span class="user-profile"><img src="image/cuenta.png" class="img-circle" ></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right" style="background-color: #16375B;">
              <li class="dropdown-item user-details">
                <a href="javaScript:void();">
                  <div class="media">
                    <div class="avatar"><img class="align-self-start mr-3" src="image/cuenta.png"></div>
                    <div class="media-body">
                    <?php 
                    
                        date_default_timezone_set('America/Lima');
                        session_start();
                        require 'conexion.php';
                        $username = $_SESSION['user'];
                        
                        $consulta_user = mysqli_query($conection, "SELECT concat(nombre,'',apellido) AS datos
                                                                   FROM persona WHERE idusuario='$username'");
                        $consulta_userr = mysqli_fetch_assoc($consulta_user);
                    
                    ?>
                      <h6 class="mt-2 user-title"><?php echo $consulta_userr['datos']; ?></h6>
                      <p class="user-subtitle"><?php echo $username; ?></p>
                    </div>
                  </div>
                </a>
              </li>
              <!--<li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>-->
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><i class="icon-power mr-2"></i><a href="../../../index.php">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <!--End topbar header-->
</body>
</html>