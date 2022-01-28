<?php
  
   
	 /**
     * 
     */
    include_once "models/Trabajador/get_login.php";
    

    class ControllerLogin{

    	public $mode;

    	public function __construct(){
    		$this->mode = new get_login();
    	}
    	
    	public function login(){
			if(isset($_POST["btnacceder"])){
				if(!empty($_POST['bxempresa'])){
					$variable = $this->mode->ValidarUsuario($_POST["usuario"], $_POST["psw"]);
					if($variable==1){
						session_start();
						$_SESSION['usu']="";
						$_SESSION['empresa']="";
						$_SESSION['usu']=$_POST['usuario'];
						$_SESSION['empresa']=$_POST['bxempresa'];
						include_once "config/usuario_log.php";
						include_once "config/configuracion.php";
						echo "<script>window.location.replace('".$NAME_SERVER."views/home.php');</script>";
					}
					else
						echo "<script>alertify.error('Usuario o contraseña NO válidos!');</script>";

			    }else{
					echo "<script>alertify.error('Error, seleccione Empresa!');</script>";
				}
			}

				include_once "views/login.php";

    	}


		public function VerEmpresas(){

			return $this->mode->VerEmpresas()->fetchAll();
		}
    	
    }

?>