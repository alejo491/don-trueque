<?php

	class seleccionarProducto extends Tpage{
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		
		public function onInit($param){
			
			
			$a=articuloRecord::finder()->findByPk($this->Request['id']);
		
			$this->img_ar->ImageUrl=imagenRecord::finder()->findByPk($a->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre->Text=$a->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion->Text=utf8_encode(ubicacionRecord::finder()->findByPk($a->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria->Text=$a->CATEGORIA;
			$this->Lbl_Descripcion->Text=$a->DESCRIPCION;
			
			$this->Articulos_usuario($param);
			}
		
		public function Articulos_usuario($param){
						
				$articulo=articuloRecord::finder()->findAll("ID_USUARIO=?",$_SESSION['id']);
					
				if($articulo!=null){
					
					foreach ($articulo as $i){
						
						
			
						echo($i->ID_IMAGEN);
						
						$ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$i->ID_UBICACION);
						
						$image=new Timage();
						
						$image->imageUrl=imagenRecord::finder()->find("ID_IMAGEN=?",$i->ID_IMAGEN)->RUTA_IMAGEN;
						$image->Width="100px";
						$tabla=new TTable();
						$row=new TTableRow();
						$cell_img=new TTableCell();
						
						$nombre=new TLabel();
						
						$nombre->Text="<strong>Nombre: </strong>".$i->NOMBRE_PRODUCTO."<br />";
						$desc=new TLabel();
						$desc->Text="<strong>Descripcion: </strong>".utf8_encode($i->DESCRIPCION)."<br />";
						$ub=new TLabel();
						$ub->Text="<strong>Ubicacion: </strong>".utf8_encode($ubicacion->CIUDAD)."<br />";
						
						$sel='<h3><a href="?page=hacerTruque&id='.$this->Request['id'].'&id2='.$i->ID_ARTICULO.'&ms='.$this->Request['ms'].'">Seleccionar</a></h3>';
						$cell_datos=new TTableCell();
						
						$cell_datos->controls->add($nombre);
						$cell_datos->controls->add($ub);
						$cell_datos->controls->add($desc);
						$cell_datos->controls->add($sel);
						
						
						$cell_img->controls->add($image);
						$row->controls->add($cell_img);
						$row->controls->add($cell_datos);
						$tabla->controls->add($row);
						$this->cphCuerpo->controls->add($tabla);
						
					
					
						}
						
					}else{
						$error="<h3>Usted no tiene articulos para poder hacer trueque<br /> por favor vuelva al Inicio</h3>";
						if($this->Request['ms']=="templateadministrador"){
							$error=$error."<br /><h1><a href="."?page=principaladministrador".">Inicio</a></h1>";
						}else{
							$error=$error."<br /><h1><a href="."?page=principalRegistrado".">Inicio</a></h1>";
						}
						$this->cphCuerpo->controls->add($error);
						
					}
				}
				
		}
				
	
	

?>