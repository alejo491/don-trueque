<?php

class solicitudes extends TPage{
	public function onInit($param){
		parent::onInit($param);

			
			$this->CargarDatos($param);
			
			

	}
	public function CargarDatos($param){
		foreach($this->ObtenerDatos($param) as $i){
			
			$row= new TTableRow();
			$cell_a=new TTableCell();
			$cell_b=new TTableCell();
			$cell_c=new TTableCell();
			$img1=new TImage();
			$img1->ImageUrl=$i['ID_ARTICULO'];
			$img1->Width="150px";
			$cell_a->controls->add("<h3><strong>".$i['ID_USUARIO']."</strong> Ofrece </h3>");
			$cell_a->controls->add($img1);
			$cell_b->controls->add("POR");
			$img2=new TImage();
			$img2->ImageUrl=$i['ART_ID_ARTICULO'];
			$img2->Width="150px";
			$cell_c->controls->add("<br />");
			$cell_c->controls->add($img2);
			$row->controls->add($cell_a);
			$row->controls->add($cell_b);
			$row->controls->add($cell_c);
			$row2=new TTableRow();
			$cell2=new TTableCell();
			$cell2->controls->add("<a href="."?page=VerPropuesta&id=".$i['ID_SOLICITUD'].">Ver Propuesta</a>");
			$row2->controls->add($cell2);
		
			$this->verDatos->Controls->add($row);
			$this->verDatos->Controls->add($row2);
		}
	}
	
	public function ObtenerDatos($param){
		$s=solicitudRecord::finder()->findAll("USU_ID_USUARIO=?",$_SESSION['id']);
		$Datos=array();
		$i=0;
		foreach ($s as $x){
			$a=articuloRecord::finder()->findByPk($x->ID_ARTICULO);
			$b=articuloRecord::finder()->findByPk($x->ART_ID_ARTICULO);
			
			$Datos[$i]=array('ID_SOLICITUD'=>$x->ID_SOLICITUD,
							'ID_USUARIO'=>usuarioRecord::finder()->findByPk($x->ID_USUARIO)->NICK,
							'ID_ARTICULO'=>imagenRecord::finder()->findByPk($a->ID_IMAGEN)->RUTA_IMAGEN,
							
							'ART_ID_ARTICULO'=>imagenRecord::finder()->findByPk($b->ID_IMAGEN)->RUTA_IMAGEN,
							'MENSAJE'=>$x->MENSAJE
							);
			$i=$i+1;
		}
		return $Datos;
		
	}
	
	
	function aceptar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('solicitudes',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	public function rechazar_click($sender,$param){
		$item=$param->Item;
		$id=$this->ver->DataKeys[$item->ItemIndex];
		$url=$this->Service->constructUrl('solicitudes',array('id'=>$id));
		$this->Response->redirect($url);
	}
	
	
}

?>