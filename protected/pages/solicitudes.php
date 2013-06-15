<?php

class solicitudes extends TPage{
	public function onInit($param){
		parent::onInit($param);

			
			$this->versolicitudes->DataSource=solicitudRecord::finder()->findAll("USU_ID_USUARIO=?",$_SESSION['id']);
			$this->versolicitudes->DataBind();
			

	}
	
	function aceptar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('solicitudes',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function rechazar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('solicitudes',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
}

?>