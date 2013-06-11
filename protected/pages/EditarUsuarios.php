<?php

class EditarUsuarios extends TPage{
 	public function onInit($param){
		parent::onInit($param);

			$this->ver->DataSource=$usuario=usuarioRecord::finder()->findAll();
			$this->ver->DataBind();

	}

}

?>