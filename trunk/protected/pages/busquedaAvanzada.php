<?php
class busquedaAvanzada extends Tpage{
	public function onPreInit($param)
		{
		parent::onPreInit($param);
				
				$this->setMasterClass($this->Request['ms']);
				
		}
	public function onInit($param){
		$this->lst_ciudades->DataSource=ubicacionRecord::consultarCiudades();
			$this->lst_ciudades->DataBind();
	}
		
	public function buscar_click($sender,$param){
		$condiciones=array("","","","");
		$condicion="";
		$busqueda=$this->p_clave->Text;
		if($busqueda!=""){
			
						$condiciones[0]="ARTICULO.NOMBRE_PRODUCTO like '%".$busqueda."%' ";
						
		}
		if($this->lst_categorias->Text!="null"){
			$condiciones[1]="ARTICULO.CATEGORIA = '".$this->lst_categorias->Text."'";
		
		}
		
		if($this->lst_ciudades->Text!="0"){
			$condiciones[2]="ARTICULO.ID_UBICACION = ".$this->lst_ciudades->Text;
		
		}
		
		
			$condiciones[3]="ARTICULO.FECHA_PUBLICACION BETWEEN '".date('Y-m-d',$this->date_desde->TimeStampFromText)."' AND '".date('Y-m-d',$this->date_hasta->TimeStampFromText)."'";
		
		
		$condicion=$condiciones[0];
		$condicion=$condicion." AND ".$condiciones[1];
		$condicion=$condicion." AND ".$condiciones[2];
		$condicion=$condicion." AND ".$condiciones[3];
		
		
		
		$url=$this->Service->constructUrl('resultadosBusqueda',array('tipo'=>'ava','ms'=>$this->Request['ms'],'s'=>$condicion));
			$this->Response->redirect($url);
		
	
	}
}
?>