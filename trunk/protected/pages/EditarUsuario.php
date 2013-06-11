<?php

class EditarUsuario extends TPage{
	private $usuario;
	public function onInit($param){
		parent::onInit($param);

		$this->usuario=usuarioRecord::finder()->findByPk($this->Request['id']);
		
		$this->TxtNNombre->Text=$this->usuario->NOMBRE_USUARIO;
		$this->TxtNApellido->Text=$this->usuario->APELLIDO_USUARIO;
		$this->TxtNUsuario->Text=$this->usuario->NICK;
		
		$this->TxtNTelefono->Text=$this->usuario->TELEFONO;
		$this->TxtNCorreo->Text=$this->usuario->CORREO;
		
		
		}
	
	public function editar_perfil_Clicked($sender,$param){
	
	  $usuario=usuarioRecord::finder()->find("NICK=?",$this->TxtNUsuario->Text);
	  $usuarioeditado=usuarioRecord::finder()->findByPk($this->usuario->ID_USUARIO);
	  $url=$this->Service->constructUrl('listarUsuarios');
	  if($usuario==null){
	   
	  	$usuarioeditado->NOMBRE_USUARIO=$this->TxtNNombre->Text;
	  	$usuarioeditado->APELLIDO_USUARIO=$this->TxtNApellido->Text;
	  	$usuarioeditado->NICK=$this->TxtNUsuario->Text;
	  	$usuarioeditado->TELEFONO=$this->TxtNTelefono->Text;
	  	$usuarioeditado->CORREO=$this->TxtNCorreo->Text;
	  	$usuarioeditado->save();
		$this->Response->redirect($url);
	  }else if($usuario->NICK==$usuarioeditado->NICK){
	  	$usuarioeditado->NOMBRE_USUARIO=$this->TxtNNombre->Text;
		$usuarioeditado->APELLIDO_USUARIO=$this->TxtNApellido->Text;
		$usuarioeditado->NICK=$this->TxtNUsuario->Text;
		$usuarioeditado->TELEFONO=$this->TxtNTelefono->Text;
		$usuarioeditado->CORREO=$this->TxtNCorreo->Text;
		$usuarioeditado->save();
		$this->Response->redirect($url);
	  }else{
	  $this->error->Text="El nombre de usuario ya existe por favor intente con otro";
	  
	  }
	  
	  
				
	
	}

}

?>