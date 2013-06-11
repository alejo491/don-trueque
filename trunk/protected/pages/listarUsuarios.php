<?php

class listarUsuarios extends TPage{
 	public function onInit($param){
		parent::onInit($param);

			
			$this->ver->DataSource=usuarioRecord::finder()->findAll();
			$this->ver->DataBind();
			

	}
	
	function editar_click($sender,$param){
	
	
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('editarUsuarios',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function borrar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('eliminarUsuarios',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
}

?>