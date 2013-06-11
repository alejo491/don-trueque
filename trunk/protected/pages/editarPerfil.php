<?php
	class editarPerfil extends Tpage{
	private $usuario;
	public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
	public function onInit($param){
		parent::onInit($param);
		$this->list_ciudad->DataSource=ubicacionRecord::consultarCiudades();
			$this->list_ciudad->DataBind();
		$id=$_SESSION['id'];
		$this->usuario=usuarioRecord::finder()->findByPk($id);
		
		$this->txt_nombre->Text=$this->usuario->NOMBRE_USUARIO;
		$this->txt_apellido->Text=$this->usuario->APELLIDO_USUARIO;
		$this->list_ciudad->Text=$this->usuario->ID_UBICACION;
		$this->txt_fecha->Text=$this->usuario->	FECHA_N;
		$this->txt_telefono->Text=$this->usuario->TELEFONO;
		$this->txt_correo->Text=$this->usuario->CORREO;
		
		
		}
	
	public function editar_perfil_Clicked($sender,$param){
	  $usuarioeditado=usuarioRecord::finder()->findByPk($this->usuario->ID_USUARIO);
	  $usuarioeditado->NOMBRE_USUARIO=$this->txt_nombre->Text;
      $usuarioeditado->APELLIDO_USUARIO=$this->txt_apellido->Text;
	  $usuarioeditado->FECHA_N=$this->txt_fecha->Text;
	  $usuarioeditado->ID_UBICACION=$this->list_ciudad->Text;
	  $usuarioeditado->TELEFONO=$this->txt_telefono->Text;
	  $usuarioeditado->CORREO=$this->txt_correo->Text;
	  $usuarioeditado->save();
	  $url=$this->Service->constructUrl('exitoEditar',array('ms'=>$this->Request['ms']));
	  $this->Response->redirect($url);
	      		
	
	}	
	
	
	}
	

?>