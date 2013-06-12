<?php

class administrarArticulos extends TPage{
	public function onInit($param){
		parent::onInit($param);

			
			$this->ver->DataSource=articuloRecord::finder()->findAll();
			$this->ver->DataBind();
			

	}
	
	function editar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('editarArticuloAdmin',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function borrar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('eliminarArticuloAdmin',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
}

?>