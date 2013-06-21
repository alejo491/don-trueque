<?php

	class seleccionarProducto extends Tpage{
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		public function onLoad($param)
		{
			parent::onLoad($param);
			$a=articuloRecord::finder()->find("ID_ARTICULO=?",$this->Request['id']);
		
			$this->img_ar->ImageUrl=imagenRecord::finder()->findByPk($a->ID_IMAGEN)->RUTA_IMAGEN;
			$this->Lbl_Nombre->Text=$a->NOMBRE_PRODUCTO;
			$this->Lbl_Ubicacion->Text=utf8_encode(ubicacionRecord::finder()->findByPk($a->ID_UBICACION)->CIUDAD);
			$this->Lbl_Categoria->Text=$a->CATEGORIA;
			$this->Lbl_Descripcion->Text=utf8_encode($a->DESCRIPCION);
			if(!$this->IsPostBack)
			{
				$this->DataList->VirtualItemCount=count($this->buscar());
				$this->populateData();
			}
		}
		
		
		
		
		 protected function getDataItemCount()
		{
			return $this->DataList->VirtualItemCount;
		}
 
	
	protected function getData($offset,$limit)
	{
		$data=$this->buscar();
		if($data!=null){
		return array_slice($data,$offset,$limit);
		}else{return null;}
	}
 
	
	protected function populateData()
	{
		$offset=$this->DataList->CurrentPageIndex*$this->DataList->PageSize;
		$limit=$this->DataList->PageSize;
		if($offset+$limit>$this->DataList->VirtualItemCount)
			$limit=$this->DataList->VirtualItemCount-$offset;
		$data=$this->getData($offset,$limit);
		if($data!=null){
		$this->DataList->DataSource=$data;
		$this->DataList->dataBind();
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
 
	
 
	
	public function pageChanged($sender,$param)
	{
		$this->DataList->CurrentPageIndex=$param->NewPageIndex;
		$this->populateData();
	}
		
		
		
		public function buscar(){
				$Datos=array();
				$articulo=articuloRecord::finder()->findAll("ID_USUARIO=?  AND DISPONIBILIDAD='Libre'",$_SESSION['id']);
						
						
				$i=0;		
				if($articulo!=null){
					
					foreach ($articulo as $i){
						
						$imagen=imagenRecord::finder()->find("ID_IMAGEN=?",$i->ID_IMAGEN);
						$ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$i->ID_UBICACION);
						$usuario=usuarioRecord::finder()->findByPk($i->ID_USUARIO);
						
						$Datos[]=array(
									   'RUTA_IMAGEN'=>$imagen->RUTA_IMAGEN,
									   'NOMBRE'=>"<strong>Nombre: </strong>".$i->NOMBRE_PRODUCTO."<br />",
									   'DESC'=>"<strong>Descripcion: </strong>".utf8_encode($i->DESCRIPCION)."<br />",
									   'UBI'=>"<strong>Ubicacion: </strong>".utf8_encode($ubicacion->CIUDAD)."<br />",
									   'LINK'=>'<h3><a href="?page=hacerTruque&id='.$this->Request['id'].'&id2='.$i->ID_ARTICULO.'&ms='.$this->Request['ms'].'">Seleccionar</a></h3>',
						
						);
						
						
						}
						
					}else{
						$Datos=null;
					}
					return $Datos;
				}
				
		}
				
	
	

?>