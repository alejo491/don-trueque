<?php
	class VerArticulo extends Tpage{
			public function onPreInit($param)
				{
				parent::onPreInit($param);		
						$this->setMasterClass($this->Request['ms']);
				}
	
			public function onInit($param){
			if(!isset($_SESSION['id'])){
				$this->btn_solicitud->Enabled="false";
				$this->btn_solicitud->Visible="false";
			}
			$var=$this->Request['id'];
			$Nombre=articuloRecord::finder()->findByPk($var);
			$Img=imagenRecord::finder()->find("ID_IMAGEN=?",$Nombre->ID_IMAGEN);
			$Ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$Nombre->ID_UBICACION);
			
			$this->Lbl_Nombre->Text=$Nombre->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion->Text=utf8_encode($Ubicacion->CIUDAD);
			$this->Lbl_Categoria->Text=$Nombre->CATEGORIA;
			$this->Lbl_Descripcion->Text=$Nombre->DESCRIPCION;
			
			$this->image->imageUrl=$Img->RUTA_IMAGEN;
			
			}
			
			
		
	}


?>