<?php

class administrarArticulos extends TPage{
	
	
	public function onLoad($param){
		parent::onLoad($param);
		
		$this->ver->VirtualItemCount=count($this->ObtenerDatos());
		
			if(!$this->IsPostBack){
			$this->ver->DataSource=$this->ObtenerColumnasDatos(0,$this->ver->PageSize);
			$this->ver->DataBind();
			
			}

	}
	
	protected function ObtenerColumnasDatos($offset,$rows){
		$data=$this->ObtenerDatos();
		$page=array();
		for($i=0;$i<$rows;$i++){
			if($offset+$i<$this->obtenerColumnas()){
				$page[$i]=$data[$offset+$i];
			}
		}
		return $page;
	
	}
	
	
	protected function obtenerColumnas()
	{
		return $this->ver->VirtualItemCount;
	}
	
	
	public function ObtenerDatos(){
		$s=articuloRecord::finder()->findAll();
		$Datos=array();
		$i=0;
		if($s!=null){
		foreach ($s as $x){
			
	
	

			
			$Datos[$i]=array('ID_ARTICULO'=>$x->ID_ARTICULO,
							'ID_USUARIO'=>$x->ID_USUARIO,
							'ID_UBICACION'=>$x->ID_UBICACION,
							'ID_IMAGEN'=>$x->ID_IMAGEN,
							'NOMBRE_PRODUCTO'=>$x->NOMBRE_PRODUCTO,
							'CATEGORIA'=>$x->CATEGORIA,
							'DESCRIPCION'=>$x->DESCRIPCION,
							'FECHA_PUBLICACION'=>$x->FECHA_PUBLICACION,
							'DISPONIBILIDAD'=>$x->DISPONIBILIDAD,
							
							
							);
			$i=$i+1;
		}
		}
		else{
			$Datos=null;
		}
		return $Datos;
		
	}
	
	
	public function changePage($sender,$param)
	{
		$this->ver->CurrentPageIndex=$param->NewPageIndex;
		$offset=$param->NewPageIndex*$this->ver->PageSize;
		$this->ver->DataSource=$this->ObtenerColumnasDatos($offset,$this->ver->PageSize);
		$this->ver->dataBind();
	}
	
	function editar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('editarArticuloAdmin',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function borrar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('eliminarArticuloAdmin',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
}

?>