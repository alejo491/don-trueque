<?php

class listarUsuarios extends TPage{
 	public function onInit($param){
		parent::onInit($param);

			
			$this->ver->DataSource=$usuario=usuarioRecord::finder()->findAll();
			$this->ver->DataBind();
			

	}
	
	function editar_click($sender,$param){
	
	}
	
	
}

?>