<?php

	class RecuperarContrasena extends TPage{
	
		public function siguiente($sender,$param){
			
			$usuario=usuarioRecord::finder()->find("NICK=?", $this->txt_NombreU->text);
			
		  if($usuario!=null){
		  	
			$url=$this->Service->constructUrl('PreguntaSeguridad',array('nick'=>$usuario->NICK));
			$this->Response->redirect($url);
		  }else{
		  	$this->error->Text="No existe este nombre de usuario, por favor intentelo de nuevo";
		  }
			
		}
	
	
	}
	
?>