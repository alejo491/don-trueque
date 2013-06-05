<?php
	class eliminarArticulo extends Tpage{
		private $articulo;
		private $imagen;
		public function onInit($param){
			parent::onInit($param);
			$id=$this->Request['id'];
			$this->articulo=articuloRecord::finder()->findByPk($id);
			$this->imagen=imagenRecord::finder()->findByPk($this->articulo->ID_IMAGEN);
			$this->txtNombre->Text=$this->articulo->NOMBRE_PRODUCTO;
			$this->TxtDesc->Text=$this->articulo->DESCRIPCION;
			$this->lbl_cat->Text=$this->articulo->CATEGORIA;
			$this->image->imageUrl=$this->imagen->RUTA_IMAGEN;
			$this->lbl_fec->Text=$this->articulo->FECHA_PUBLICACION;
			
		}
		
		function btn_eliminar_click ($sender, $param){
			$eliminar1=articuloRecord::finder()->findByPk($this->articulo->ID_ARTICULO);
			$eliminar2=imagenRecord::finder()->findByPk($this->imagen->ID_IMAGEN);
			$eliminar1->delete();
			unlink($eliminar2->RUTA_IMAGEN);
			$eliminar2->delete();
			$url=$this->Service->constructUrl('articulos');
			$this->Response->redirect($url);
		}
	
	}
?>