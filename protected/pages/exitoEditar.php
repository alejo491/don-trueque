<?php
	class exitoEditar extends Tpage{
	
	public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
	public function onInit($param){
		parent::onInit($param);
		if($this->Request['ms']=="templateadministrador"){
		$url=$this->Service->constructUrl('principaladministrador');
		}else{
		$url=$this->Service->constructUrl('principalregistrado');
		}
		header("Refresh: 5; url=$url");
	}
	}