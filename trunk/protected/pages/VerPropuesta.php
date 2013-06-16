<?php

class VerPropuesta extends Tpage{
			private $a;
		    private $b;
		
		public function onInit($param){
			parent::onInit($param);
			$this->a=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ID_ARTICULO);
			$this->b=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ART_ID_ARTICULO);
			
			if($this->a->DISPONIBILIDAD="Libre"){
				$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
				$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO;
				$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
				$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
				$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
				if($this->b->DISPONIBILIDAD="Libre"){
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}else{
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
					$this->btn_Aceptar->Visible="false";
					$this->btn_Cancelar->Text="Volver al Inicio";
				}
			}else{
				$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
				$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
				$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
				$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
				$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
				$this->btn_Aceptar->Visible="false";
				$this->btn_Cancelar->Text="Volver al Inicio";
				if($this->b->DISPONIBILIDAD="Libre"){
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}else{
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}
			}
			
			
			
		
			
			
			
		}
		public function Aceptar_Clicked($param){
			
		}
		public function Cancelar_Clicked($param){
		
		}
}

?>