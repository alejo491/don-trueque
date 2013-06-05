<?php
	
	class RecuperacionExitosa extends TPage{
		public function onInit($param) { 
		   parent::onInit($param); 
			
		  $this->txt_contr->Text=$this->Request['c']; 

		}

			 public function Inicio_click($sender,$param){
		 	$url=$this->Service->constructUrl('Inicio');
			$this->Response->redirect($url);
		 }
	}



?>