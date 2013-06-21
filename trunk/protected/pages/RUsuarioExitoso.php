<?php
	
	class RUsuarioExitoso extends TPage{
		public function onInit($param) { 
		   parent::onInit($param); 
		   $this->correo->Text=$this->Request['correo'];

			

		}

			 public function Inicio_click($sender,$param){
			$url=$this->Service->constructUrl('Inicio');
			$this->Response->redirect($url);
		 }
	}



?>