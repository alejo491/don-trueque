<?php


	class Estadisticas extends TPage{
		public function onLoad($param) {
		parent::onLoad($param);
 		
		
		
		
		
	}
 	
	public function Consulta_click($sender,$param){
		$tipo=0;
		$Vx=array();
		$Vy=array();
		if($this->radio1->Checked){
			$tipo=1;//grafico barras
		}
		if($this->radio1->Checked){
			$tipo=2;//grafico torta
		}
		$i=0;
		$datos=solicitudRecord::ObtenerPermutas(date('Y-m-d',$this->datedesde->TimeStampFromText),date('Y-m-d',$this->datehasta->TimeStampFromText),'todas');
		
		if($datos!=null){
			foreach($datos as $b){
				$Vx[]=$b['CATEGORIA'];
				
				$Vy[]=$b['NUMERO'];
			
			}
		echo("assets/estadisticas.php?t=$");
		//$this->imgPermuta->ImgeUrl
			
			
		}else{$this->imgPermuta->ImageUrl="assets/images/nodatos.jpg";}
		
	}
		
	
	}

?>