<?php

class envioExitoso extends Tpage{
	public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
	
	public function onInit($param){
		parent::onInit($param);
		
	}
	public function Aceptar_Clicked(){
		$url=$this->Service->constructUrl('Donacion');
		$this->Response->redirect($url);
		}
	
	public function Cancelar_Clicked(){
		$url=$this->Service->constructUrl('principalRegistrado');
		$this->Response->redirect($url);
		}
	
}