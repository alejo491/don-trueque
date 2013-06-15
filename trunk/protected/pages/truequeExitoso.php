<?php

	class truequeExitoso extends Tpage{
	
	public function Aceptar_Clicked(){
		$url=$this->Service->constructUrl('Donacion');
		$this->Response->redirect($url);
		}
	
	public function Cancelar_Clicked(){
		$url=$this->Service->constructUrl('principalRegistrado');
		$this->Response->redirect($url);
		}
	}
?>