<?php

	class DonacionExitosa extends Tpage{
	
		public function onInit($param) { 
		   parent::onInit($param); 
			 
		$time=5;
		  
		$url=$this->Service->constructUrl('principalRegistrado');
		header("Refresh: $time; url=$url");
		   
		 }
	}
?>