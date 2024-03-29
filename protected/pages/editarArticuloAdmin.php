<?php
	class editarArticuloAdmin extends Tpage{
		private $articulo;
		public function onInit($param){
			parent::onInit($param);
			$this->list_ciudad->DataSource=ubicacionRecord::consultarCiudades();
			$this->list_ciudad->DataBind();
			$id=$this->Request['id'];
			$this-> articulo=articuloRecord::finder()->findByPk($id);
			$imagen=imagenRecord::finder()->findByPk($this->articulo->ID_IMAGEN);
			$this->txtNombre->Text=$this->articulo->NOMBRE_PRODUCTO;
			$this->TxtDesc->Text=$this->articulo->DESCRIPCION;
			$this->list_ciudad->Text=$this->articulo->ID_UBICACION;
			$this->Productos->Text=$this->articulo->CATEGORIA;
			
			$this->image->imageUrl=$imagen->RUTA_IMAGEN;
		}
		
		public function Subir_imagen($sender,$param){
				
			if(is_uploaded_file($this->subir->LocalName)) { // verifica haya sido cargado el archivo
				$ruta= 'assets/images/articulos/'.$this->subir->FileName;
			
				move_uploaded_file($this->subir->LocalName, $ruta);
				$this->image->imageUrl=$ruta;
				$this->image->focus();
												
			}
		}
		function btn_modificar_click($sender,$param){
			$modificar=articuloRecord::finder()->findByPk($this->articulo->ID_ARTICULO);
			$imagen=imagenRecord::finder()->findByPk($this->articulo->ID_IMAGEN);
			$imagen->RUTA_IMAGEN=$this->image->imageUrl;
			$imagen->save();
			$modificar->NOMBRE_PRODUCTO=$this->txtNombre->Text;
			$modificar->DESCRIPCION=$this->TxtDesc->Text;
			$modificar->ID_UBICACION=$this->list_ciudad->Text;
			if($this->Productos->Text!="null"){
			$modificar->CATEGORIA=$this->Productos->Text;
			}
			$modificar->save();
			$url=$this->Service->constructUrl('administrarArticulos');
			$this->Response->redirect($url);
		}
	}
?>