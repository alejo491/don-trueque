<?php

class hacerTruque extends Tpage{
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		public function onInit($param){
			$a=articuloRecord::finder()->findByPk($this->Request['id']);
		    $this->pro->Text=usuarioRecord::finder()->findByPk($a->ID_USUARIO)->NICK;
			$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($a->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre1->Text=$a->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($a->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria1->Text=$a->CATEGORIA;
			$this->Lbl_Descripcion1->Text=utf8_encode($a->DESCRIPCION);
			
			$b=articuloRecord::finder()->findByPk($this->Request['id2']);
		
			$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($b->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre2->Text=$b->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($b->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria2->Text=$b->CATEGORIA;
			$this->Lbl_Descripcion2->Text=$b->DESCRIPCION;
			
			
		}
}

?>