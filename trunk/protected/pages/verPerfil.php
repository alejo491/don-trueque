<?php
	class verPerfil extends Tpage{
	public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
	public function onInit($param){
		parent::onInit($param);
		
		$id=$this->Request['id'];
		$usuario=usuarioRecord::finder()->findByPk($id);
		$this->lbl_name_user->Text=$usuario->NICK;
		$this->lbl_txt_nombre->Text=$usuario->NOMBRE_USUARIO;
		$this->lbl_txt_apellido->Text=$usuario->APELLIDO_USUARIO;
		$this->lbl_txt_fecha->Text=$usuario->FECHA_N;
		$this->lbl_txt_ubicacion->Text=utf8_encode(ubicacionRecord::finder()->findByPk($usuario->ID_UBICACION)->CIUDAD);
		$this->lbl_txt_telefono->Text=$usuario->TELEFONO;
		$this->lbl_txt_correo->Text=$usuario->CORREO;
		
		}	
	
	
	}
	

?>