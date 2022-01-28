<?php


/**
 * 
 */
class get_login{
    
  
    public $CNX;

    public function __construct(){
        try {
            $this->CNX = Conexion::Conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ValidarUsuario($usuario, $password){
  
        $query = "SELECT * FROM usuario WHERE user=:user AND clave=:clave";
        $conec = $this->CNX->prepare($query);
        $conec->bindParam(':user', $usu, PDO::PARAM_STR, 50);
        $conec->bindParam(':clave', $psw, PDO::PARAM_STR, 50);
        $usu = $usuario;
        $psw = sha1($password);
        $conec->execute();
         while($conec->fetch()){
            return 1;
        }
            return 0;

    }
    
    public function VerEmpresas(){

		$consultaMes = "SELECT id as id, nombre as Nombre FROM configuracion_empresas WHERE estado='1' ORDER BY nombre";
		return $this->CNX->query($consultaMes);

	}



}



?>
