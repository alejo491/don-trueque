<?php
	class InicioSesion extends Tpage{
		public function onInit($param) { 
		  
		 
		 }
		 
		 public function iniciarSesion($param){
		 	session_start();
			$u=usuarioRecord::finder()->find("NICK=? and PASS=?",array($this->txt_usuario->Text,md5($this->txt_pass->Text)));
			if($u==null){
			session_write_close();
			$this->lbl_error->Text="Usuario y contrase&ntilde;a incorrectos";
			}else{
			$_SESSION['id']=$u->ID_USUARIO;
			$id=$_SESSION['id'];
			if($u->tipo=='admin'){
				$url=$this->Service->constructUrl('principaladministrador');
				$this->Response->redirect($url);
			}else{
			
				$url=$this->Service->constructUrl('principalRegistrado');
				$this->Response->redirect($url);
			}
			}
		 }
	}

?>