<?php

include_once "../../../../config/conexion.php";
header('Content-Type: text/html; charset=UTF-8');

 /**
  * Usuario model
  */
 class get_categorias{

 	public $con;

 	public function __construct(){
 		try {
				$this->con = Conexion::Conectar();
			} catch (Exception $e) {
				die($e->getMessage());
			}
 	}
 	
 	public function VerClientes(){

		$consultaBS= "SELECT iCodigo as ID, sDescripcion as Nombre FROM centrocosto WHERE iEstado ='1' ORDER BY sDescripcion ASC";
		return $this->con->query($consultaBS);

	}

	public function VerTipos(){

		$consultaBS= "SELECT idArea as ID, Area as Nombre FROM area ORDER BY Area ASC";
		return $this->con->query($consultaBS);

	}

	public function VerHoras(){

		$consultaBS= "SELECT valor as ID, valor as Nombre FROM actividades_horas ORDER BY id ASC";
		return $this->con->query($consultaBS);

	}


	public function VerMinutos(){

		$consultaBS= "SELECT valor as ID, valor as Nombre FROM actividades_minutos ORDER BY id ASC";
		return $this->con->query($consultaBS);

	}


	public function VerEstados(){

		$consultaBS= "SELECT idgestione as ID, nombre as Nombre FROM gestion_estados WHERE nombre!='FINALIZADO' AND nombre!='ELIMINADO' ORDER BY idgestione ASC";
		return $this->con->query($consultaBS);

	}

	public function VerEstadosTareas(){

		$consultaBS= "SELECT idgestione as ID, nombre as Nombre FROM gestion_estados WHERE nombre!='ELIMINADO' ORDER BY idgestione ASC";
		return $this->con->query($consultaBS);

	}


	public function VerResponsables(){

		$consultaBS= "SELECT usu.idusuario as ID, concat(SUBSTRING_INDEX(per.nombre,' ',1),' ',SUBSTRING_INDEX(per.apellido,' ',1)) as Nombre FROM usuario usu, persona per WHERE usu.usuario=per.idusuario AND per.estatus='Activo' ORDER BY per.nombre ASC";
		return $this->con->query($consultaBS);

	}

	public function VerEstadosFiltro(){

		$consultaBS= "SELECT idgestione as ID, nombre as Nombre FROM gestion_estados WHERE nombre!='ELIMINADO' ORDER BY idgestione ASC";
		return $this->con->query($consultaBS);

	}


	public function VerNombreActividades(){

		$consultaBS= "SELECT idgestion as ID, nombre as Nombre FROM tipos WHERE estado='Activo' ORDER BY idgestion ASC";
		return $this->con->query($consultaBS);

	}


	public function VerAreas(){

		$consultaBS= "SELECT idArea as ID, Area as Nombre FROM area ORDER BY Area ASC";
		return $this->con->query($consultaBS);

	}


	public function VerMotivosEliminarActividad(){

		$consultaBS= "SELECT idmotivo_eliminar as ID, motivo as Nombre FROM motivos_eliminar ORDER BY motivo ASC";
		return $this->con->query($consultaBS);

	}



 }

 