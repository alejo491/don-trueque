<?php
	class VerArticulo extends Tpage{
			public function onPreInit($param)
				{
				parent::onPreInit($param);		
						$this->setMasterClass($this->Request['ms']);
				}
	
			public function onInit($param){
				
				
				$var=$this->Request['id'];
				$articulo=articuloRecord::finder()->findByPk($var);
				$Img=imagenRecord::finder()->find("ID_IMAGEN=?",$articulo->ID_IMAGEN);
				$Ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$articulo->ID_UBICACION);
				if(!isset($_SESSION['id'])){
					$this->btn_solicitud->Enabled="false";
					$this->btn_solicitud->Visible="false";
				}else if($_SESSION['id']==$articulo->ID_USUARIO){
					$this->btn_solicitud->Enabled="false";
					$this->btn_solicitud->Visible="false";
					$this->error->Text="Usted es el propietario de este articulo";
				}
				$this->Lbl_Nombre->Text=$articulo->NOMBRE_PRODUCTO;
				$this->Lbl_Ubicacion->Text=utf8_encode($Ubicacion->CIUDAD);
				$this->Lbl_Categoria->Text=$articulo->CATEGORIA;
				$this->Lbl_Descripcion->Text=utf8_encode($articulo->DESCRIPCION);
				
				$this->image->imageUrl=$Img->RUTA_IMAGEN;
			
			}
			
			public function Hacer_propuesta($sender,$param){
				$url=$this->Service->constructUrl('seleccionarProducto',array('id'=>$this->Request['id'],'ms'=>$this->Request['ms']));
				$this->Response->redirect($url);
				
			}
			
		
	}


?>