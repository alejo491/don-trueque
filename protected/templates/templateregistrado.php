<?php
	class templateregistrado extends TTemplateControl{
			public function onInit($param){
			parent::onInit($param);
			session_start();
			$usuario=usuarioRecord::finder()->find("ID_USUARIO=?",$_SESSION['id']);
			$this->findControl('lbl_name_user')->Text=$usuario->NICK;
			$this->findControl('link1')->NavigateUrl="?page=editarPerfil";
			}
			
			public function cerrar_sesion($param){
				session_destroy();
				session_write_close();
				$url=$this->Service->constructUrl('Inicio');
				$this->Response->redirect($url);
			}
			public function buscar_Clicked($param){
				
				
				//esto es para pasar valores por post
				$url=$this->Service->constructUrl('resultadosBusqueda',array('id'=>$this->txt_buscar->Text,'tipo'=>'nombre','ms'=>'templateregistrado'));
				$this->Response->redirect($url);
				
		}
	}
?>