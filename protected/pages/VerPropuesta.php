<?php

class VerPropuesta extends Tpage{
			private $a;
		    private $b;
		
		public function onInit($param){
			parent::onInit($param);
			$this->a=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ID_ARTICULO);

			$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
			$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
			
			$this->b=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ART_ID_ARTICULO);
		
			$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
			$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
			
			
		}
		public function Propuesta_Click ($sender,$param){
			$u=new solicitudRecord();
			$u->ID_USUARIO=$this->b->ID_USUARIO;
			$u->ID_ARTICULO=$this->b->ID_ARTICULO;
			$u->USU_ID_USUARIO=$this->a->ID_USUARIO;
			$u->ART_ID_ARTICULO=$this->a->ID_ARTICULO;
			$u->MENSAJE=$this->mensaje->Text;
			$u->save();
			$url=$this->Service->constructUrl('envioExitoso',array('ms'=>$this->Request['ms']));
			$this->Response->redirect($url);
		}
}

?>