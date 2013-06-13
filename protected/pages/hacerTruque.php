<?php

class hacerTruque extends Tpage{
		private $a;
		private $b;
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		public function onInit($param){
			$this->a=articuloRecord::finder()->findByPk($this->Request['id']);
		    $this->pro->Text=usuarioRecord::finder()->findByPk($this->a->ID_USUARIO)->NICK;
			$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
			$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
			
			$this->b=articuloRecord::finder()->findByPk($this->Request['id2']);
		
			$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
			$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
			
			
		}
		//Propuesta_Click
}

?>