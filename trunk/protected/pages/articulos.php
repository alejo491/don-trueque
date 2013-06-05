<?php
class articulos extends Tpage{
	public function onInit($param){
		parent::onInit($param);
		
		$this->listaarticulo->DataSource=articuloRecord::finder()->findAll("ID_USUARIO=?",$_SESSION['id']);
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
}
?>

