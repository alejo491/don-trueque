<?php

class EditarUsuarios extends TPage{
 	public function onInit($param){
		parent::onInit($param);

			$usuario=usuarioRecord::finder()->findByPk($this->Request['id']);
			echo($usuario->NOMBRE_USUARIO);

	}

}

?>