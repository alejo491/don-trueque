<?php
class articulos extends Tpage{
	public function onInit($param){
		parent::onInit($param);
		
		$this->listaarticulo->DataSource=articuloRecord::finder()->findAll("ID_USUARIO=? AND DISPONIBILIDAD='Libre'",$_SESSION['id']);
		$this->listaarticulo->DataBind();
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
	/*
	public function changePage($sender,$param)
	{
		$this->DataGrid->CurrentPageIndex=$param->NewPageIndex;
		$this->DataGrid->DataSource=$this->Data;
		$this->DataGrid->dataBind();
	}*/
 
	public function pagerCreated($sender,$param)
	{
		$param->Pager->Controls->insertAt(0,'Page: ');
	}
 /*
	
 
	*/
}
?>

