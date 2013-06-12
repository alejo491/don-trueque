<?php
	class eliminarUsuario extends Tpage{
		private $usuario;
		public function onInit($param){
			parent::onInit($param);
			$id=$this->Request['id'];
			$this->usuario=usuarioRecord::finder()->findByPk($id);
			$this->txtNombre->Text=$this->usuario->NOMBRE_USUARIO;
			$this->txtApell->Text=$this->usuario->APELLIDO_USUARIO;
			$this->txtFecN->Text=$this->usuario->FECHA_N;
			$this->txtTel->Text=$this->usuario->TELEFONO;
			$this->txtCorreo->Text=$this->usuario->CORREO;
			
		}
		
		function btn_eliminar_click ($sender, $param){
			$eliminar1=usuarioRecord::finder()->findByPk($this->usuario->ID_USUARIO);
			$eliminar1->delete();
			$url=$this->Service->constructUrl('listarUsuarios');
			$this->Response->redirect($url);
		}
	
	}
?>
