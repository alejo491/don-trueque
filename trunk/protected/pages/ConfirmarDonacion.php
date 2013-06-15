<?php

	class ConfirmarDonacion extends Tpage{
	public function onInit($param){
	$this->lblNombre->Text=$_SESSION['nombre'];
	$this->lblApellidos->Text=$_SESSION['apellidos'];
	$this->lblCedula->Text=$_SESSION['cedula'];
	$this->lblNumero->Text=$_SESSION['numero'];
	$this->lblContrasena->Text=$_SESSION['contrasena'];
	$this->lblValor->Text=$_SESSION['valor'];
	
	}
	public function Aceptar_Clicked($param){
		$url=$this->Service->constructUrl('DonacionExitosa');
		$this->Response->redirect($url);
		}
	
	public function Cancelar_Clicked(){
		$url=$this->Service->constructUrl('principalRegistrado');
		$this->Response->redirect($url);
		}
	}
?>