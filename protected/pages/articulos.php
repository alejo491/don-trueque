<?php
class articulos extends Tpage{
	
	
		public function onLoad($param){
		parent::onLoad($param);
		
		$this->listaarticulo->VirtualItemCount=count($this->ObtenerDatos());
		
			if(!$this->IsPostBack){
			$this->listaarticulo->DataSource=$this->ObtenerColumnasDatos(0,$this->listaarticulo->PageSize);
			$this->listaarticulo->DataBind();
			
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
		return $this->listaarticulo->VirtualItemCount;
	}
	
	
	public function ObtenerDatos(){
		$s=articuloRecord::finder()->findAll("ID_USUARIO=? AND DISPONIBILIDAD='Libre'",$_SESSION['id']);
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
		$this->listaarticulo->CurrentPageIndex=$param->NewPageIndex;
		$offset=$param->NewPageIndex*$this->listaarticulo->PageSize;
		$this->listaarticulo->DataSource=$this->ObtenerColumnasDatos($offset,$this->listaarticulo->PageSize);
		$this->listaarticulo->dataBind();
	}
	
	public function editar_articulo($sender,$param){
		$item=$param->Item;
		$id=$this->listaarticulo->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('editarArticulo',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function borrar_articulo ($sender,$param){
		$item=$param->Item;
		$id=$this->listaarticulo->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('eliminarArticulo',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
}
?>

