<?php

	class PreguntaSeguridad extends TPage{
	
		public function onInit($param) { 
		  
		  $var=$this->Request['nick'];
		  
		  $usuario=usuarioRecord::finder()->find("NICK=?", $var);
		  $this->txt_Pregunta->Text=$usuario->PREGUNTA;
		 
		 
		 }
	
		
		public function fin_Clicked($param){
		
			$var=$this->Request['nick'];
			
			$usuario=usuarioRecord::finder()->find("NICK=?", $var);
			
			if( $usuario->RESPUESTA==$this->txt_Resp->Text){
				
				$url=$this->Service->constructUrl('RecuperacionExitosa',array('c'=>$usuario->PASS));
				$this->Response->redirect($url);
				}else{
				
					$url=$this->Service->constructUrl('RecuperarContrasena');
					$this->Response->redirect($url);
				}
		
		
		}
		
	
	}
	
?>