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
				
				$url=$this->Service->constructUrl('RecuperacionExitosa',array('nick'=>$this->Request['nick']));
				$this->Response->redirect($url);
				}else{
					
					$this->error->Text="Respuesta incorrecta, por favor intentelo de nuevo.";
				}
		
		
		}
		
	
	}
	
?>