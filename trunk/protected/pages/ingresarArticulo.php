<?php

	class ingresarArticulo extends TPage{
		
		
		public function onInit($param){
			parent::onInit($param);
			$this->Ciudades->DataSource=ubicacionRecord::consultarCiudades();
	 		$this->Ciudades->DataBind();
		}
		
		
		public function agregarArticulo($param){
				   $imagen=new imagenRecord();
					
					$imagen->RUTA_IMAGEN=$this->image->imageUrl;
					
					$imagen->save();
					$id=imagenRecord::finder()->find('RUTA_IMAGEN=?',$this->image->imageUrl);
					
					
					
					$articulo = new articuloRecord();
					
					$articulo->NOMBRE_PRODUCTO=$this->txtNombre->Text;
					$articulo->DESCRIPCION=$this->TxtDesc->Text;
					$articulo->CATEGORIA=$this->Productos->Text;
					
					$articulo->ID_UBICACION=$this->Ciudades->Text;
					$articulo->ID_IMAGEN=$id->ID_IMAGEN;
					$articulo->ID_USUARIO=$_SESSION['id'];
					$articulo->FECHA_PUBLICACION=date("Y-m-d",time());
					$articulo->save();
					$url=$this->service->constructUrl('ArticuloRegistrado');
					$this->Response->redirect($url);	
		}
		
		
		public function Subir_imagen($sender,$param){
				
			if(is_uploaded_file($this->subir->LocalName)) { // verifica haya sido cargado el archivo
				$ruta= 'assets/images/articulos/'.$this->subir->FileName;
			
				move_uploaded_file($this->subir->LocalName, $ruta);
				$this->image->imageUrl=$ruta;
				$this->image->focus();
												
			}
			
			
		}
		
		
		
		
		
		
	}


?>