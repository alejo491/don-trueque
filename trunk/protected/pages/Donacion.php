<?php

	class Donacion extends Tpage{
	
	public function Aceptar_Clicked($param){
		$_SESSION['nombre']=$this->txtNombre->Text;
		$_SESSION['apellidos']=$this->txtNombre->Text;
		$_SESSION['cedula']=$this->txtCedula->Text;
		$_SESSION['numero']=$this->txtNumero->Text;
		$_SESSION['contrasena']=$this->txtCont->Text;
		$_SESSION['valor']=$this->txtValor->Text;
		
		$url=$this->Service->constructUrl('ConfirmarDonacion');
		$this->Response->redirect($url);
		}
	
	}
?>