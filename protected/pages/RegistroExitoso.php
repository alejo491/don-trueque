<?php
	class RegistroExitoso extends Tpage{
	
	public function onInit($param) { 
		   parent::onInit($param); 
			 
		$time=3;
		  
		$url=$this->Service->constructUrl('Inicio');
		header("Refresh: $time; url=$url");
		   
		 }
		
	
	
	
}
	
?>