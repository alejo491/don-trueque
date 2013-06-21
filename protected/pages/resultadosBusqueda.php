<?php

	class resultadosBusqueda extends Tpage{
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		public function onLoad($param)
		{
			parent::onLoad($param);
			if($this->Request['ms']=='Masterpage'){
				$this->ad->Text='<a href="?page=Inicio">Inicio</a> > <a href="#">Busqueda</a><br />';
			}
			if($this->Request['ms']=='templateadministrador'){
				$this->ad->Text='<a href="?page=principaladministrador">Inicio</a> > <a href="#">Busqueda</a><br />';
			}
			if($this->Request['ms']=='templateregistrado'){
				$this->ad->Text='<a href="?page=principalRegistrado">Inicio</a> > <a href="#">Busqueda</a><br />';
			}
			
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
		$this->cphCuerpo->controls->add("<h3>No hay resultados</h3>");
		}
	}
 
	
 
	
	public function pageChanged($sender,$param)
	{
		$this->DataList->CurrentPageIndex=$param->NewPageIndex;
		$this->populateData();
	}
		
		
		
		public function buscar(){
				$Datos=array();
				$this->lbl_titulo->Text="Resultados busqueda: ".$this->Request['id'];
						if($this->Request['tipo']=='nombre'){
									//esto es para obtener la respuesta del post 
									$busqueda=$this->Request['id'];
								
									$vector=explode(" ",$busqueda);
									
									$condicion="NOMBRE_PRODUCTO like '%".$vector[0]."%'";
									if ( sizeof($vector)>1)
									{
										for ( $i=1; $i < sizeof($vector) ; $i++ )
										{ 
										$condicion=$condicion."OR NOMBRE_PRODUCTO like '%".$vector[$i]."%'";
										 
										}
										$articulo=articuloRecord::finder()->findAll($condicion." AND DISPONIBILIDAD='Libre'");
										
									}else{
										$articulo=articuloRecord::finder()->findAll("NOMBRE_PRODUCTO like '%".$vector[0]."%' AND DISPONIBILIDAD='Libre'");
										}	
						}else if($this->Request['tipo']=='categoria'){
							//esto es para obtener la respuesta del post 
							$busqueda=$this->Request['id'];
								$articulo=articuloRecord::finder()->findAll("CATEGORIA=? AND DISPONIBILIDAD='Libre'",$busqueda);	
						}else if($this->Request['tipo']=='ava'){
							
							$articulo=articuloRecord::finder()->findAll($this->Request['s']);
						}
						
						
				$i=0;		
				if($articulo!=null){
					
					foreach ($articulo as $i){
						
						$imagen=imagenRecord::finder()->find("ID_IMAGEN=?",$i->ID_IMAGEN);
						$ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$i->ID_UBICACION);
						$usuario=usuarioRecord::finder()->findByPk($i->ID_USUARIO);
						
						$Datos[]=array(
									   'RUTA_IMAGEN'=>$imagen->RUTA_IMAGEN,
									   'PROPIETARIO'=>'<strong>Propietario: </strong>'.$usuario->NICK.' <a href="?page=verPerfil&id='.$usuario->ID_USUARIO.'&ms='.$this->Request['ms'].'">Ver Perfil</a><br />',
									   'NOMBRE'=>"<strong>Nombre: </strong>".$i->NOMBRE_PRODUCTO."<br />",
									   'DESC'=>"<strong>Descripcion: </strong>".utf8_encode($i->DESCRIPCION)."<br />",
									   'UBI'=>"<strong>Ubicacion: </strong>".utf8_encode($ubicacion->CIUDAD)."<br />",
									   'LINK'=>'<a href="?page=VerArticulo&id='.$i->ID_ARTICULO.'&ms='.$this->Request['ms'].'">Ver Detalles</a>',
						
						);
						
						
						}
						
					}else{
						$Datos=null;
					}
					return $Datos;
				}
				
				
		}
				
	
	

?>