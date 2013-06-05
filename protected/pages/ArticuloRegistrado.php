<?php

	class ArticuloRegistrado extends Tpage{
	
	public function onInit($param){
		parent::onInit($param);
		
		$time=3;
		
		$url=$this->Service->constructUrl('articulos');
		header("Refresh: $time; url=$url");
	}

}

?>