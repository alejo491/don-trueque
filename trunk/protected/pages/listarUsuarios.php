<?php

class listarUsuarios extends TPage{
	
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
		$s=usuarioRecord::finder()->findAll();
		$Datos=array();
		$i=0;
		if($s!=null){
		foreach ($s as $x){
			
			
			$Datos[$i]=array('ID_USUARIO'=>$x->ID_USUARIO,
							'ID_UBICACION'=>$x->ID_UBICACION,
							'NOMBRE_USUARIO'=>$x->NOMBRE_USUARIO,
							'APELLIDO_USUARIO'=>$x->APELLIDO_USUARIO,
							'FECHA_N'=>$x->FECHA_N,
							'TELEFONO'=>$x->TELEFONO,
							'PREGUNTA'=>$x->PREGUNTA,
							'RESPUESTA'=>$x->RESPUESTA,
							'CORREO'=>$x->CORREO,
							'NICK'=>$x->NICK,
							'PASS'=>$x->PASS,
							'tipo'=>$x->tipo,
							
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
		$url=$this->Service->constructUrl('editarUsuario',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function borrar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('eliminarUsuario',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
 
	
	
	
}

?>