<?php

  require_once "../../../models/get_categorias.php";
	/**
	 * 
	 */
	class ControllerCategorias
	{
		
		public $mo;

		public function __construct()
		{
			$this->mo = new get_categorias();
		}

		public function VerTipoCarpeta(){
			return $this->mo->VerTipoCarpeta()->fetchAll();
		}

		public function VerTiempoEjecutar(){
			return $this->mo->VerTiempoEjecutar()->fetchAll();
		}


		public function VerTipoGeneracion(){
			return $this->mo->VerTipoGeneracion()->fetchAll();
		}


		public function VerMes(){
			return $this->mo->VerMes()->fetchAll();
		}

		public function VerAnio(){
			return $this->mo->VerAnio()->fetchAll();
		}
		
		public function VerClientes(){
			return $this->mo->VerClientes()->fetchAll();
		}

		public function VerTipos(){
			return $this->mo->VerTipos()->fetchAll();
		}

		public function VerHoras(){
			return $this->mo->VerHoras()->fetchAll();
		}

		public function VerMinutos(){
			return $this->mo->VerMinutos()->fetchAll();
		}

		public function VerEstados(){
			return $this->mo->VerEstados()->fetchAll();
		}

		public function VerEstadosTareas(){
			return $this->mo->VerEstadosTareas()->fetchAll();
		}

		public function VerResponsables(){
			return $this->mo->VerResponsables()->fetchAll();
		}


		public function VerEstadosFiltro(){
			return $this->mo->VerEstadosFiltro()->fetchAll();
		}

		public function VerNombreActividades(){
			return $this->mo->VerNombreActividades()->fetchAll();
		}

		public function VerAreas(){
			return $this->mo->VerAreas()->fetchAll();
		}

		public function VerMotivosEliminarActividad(){
			return $this->mo->VerMotivosEliminarActividad()->fetchAll();
		}
}
?>