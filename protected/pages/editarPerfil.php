<?php
	class editarPerfil extends Tpage{
	private $usuario;
	public function onInit($param){
		parent::onInit($param);
		$id=$_SESSION['id'];
		$this->usuario=usuarioRecord::finder()->findByPk($id);
		$u=ubicacionRecord::finder()->findByPk($this->usuario->ID_UBICACION);
		$this->txt_nombre->Text=$this->usuario->NOMBRE_USUARIO;
		$this->txt_apellido->Text=$this->usuario->APELLIDO_USUARIO;
		$this->txt_ubicacion->Text=utf8_encode($u->CIUDAD);
		$this->txt_fecha->Text=$this->usuario->	FECHA_N;
		$this->txt_telefono->Text=$this->usuario->TELEFONO;
		$this->txt_correo->Text=$this->usuario->CORREO;
		
		
		}
	
	public function editar_perfil_Clicked($sender,$param){
	  $usuarioeditado=usuarioRecord::finder()->findByPk($this->usuario->ID_USUARIO);
	  $usuarioeditado->NOMBRE_USUARIO=$this->txt_nombre->Text;
      $usuarioeditado->APELLIDO_USUARIO=$this->txt_apellido->Text;
	  $usuarioeditado->FECHA_N=$this->txt_fecha->Text;
	  $usuarioeditado->ID_UBICACION=ubicacionRecord::finder()->find("CIUDAD=?",$this->txt_ubicacion->Text)->ID_UBICACION;
	  $usuarioeditado->TELEFONO=$this->txt_telefono->Text;
	  $usuarioeditado->CORREO=$this->txt_correo->Text;
	  $usuarioeditado->save();
	      		
	
	}	
	
	
	}
	

?>