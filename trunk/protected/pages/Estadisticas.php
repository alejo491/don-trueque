<?php


	class Estadisticas extends TPage{
		public function onLoad($param) {
		parent::onLoad($param);
 		
		
		
		
		
	}
 	
	public function Consulta_click($sender,$param){
		
		$Vx=array();
		$Vy=array();
		$Vy1=array();
		
			$datos=solicitudRecord::ObtenerPermutas(date('Y-m-d',$this->datedesde->TimeStampFromText),date('Y-m-d',$this->datehasta->TimeStampFromText),'todas');
				
			if($datos!=null){
					foreach($datos as $b){
						$Vx[]=$b['CATEGORIA'];
						
						$Vy[]=$b['NUMERO'];
					
					}
					$t=0;
					foreach($Vy as $a){
						$t=$t+$a;
					}
					
					foreach($Vy as $c){
						$Vy1[]=($c*100/$t);
					}
					if($this->radio1->Checked){
					$this->t1->Text="Solicitudes de trueque entre ".date('Y-m-d',$this->datedesde->TimeStampFromText)." y ".date('Y-m-d',$this->datehasta->TimeStampFromText);
					$this->imgPermuta->ImageUrl="assets/estadisticas_barra.php?x=".implode(',',$Vx)."&y=".implode(',',$Vy1)."";
					}
					if($this->radio2->Checked){
						$this->t1->Text="Solicitudes de trueque entre ".date('Y-m-d',$this->datedesde->TimeStampFromText)." y ".date('Y-m-d',$this->datehasta->TimeStampFromText);
						$this->imgPermuta->ImageUrl="assets/estadisticas_pie.php?x=".implode(',',$Vx)."&y=".implode(',',$Vy1)."";
					}
			
			}else{
			$this->imgPermuta->ImageUrl="assets/images/nodatos.jpg";
			}
		
		
		
		
	}
	
	public function Otras_Clicked($sender,$param){
	
		if($this->tipo_consulta->Text="PA"){
			$datos=solicitudRecord::ObtenerPermutas(date('Y-m-d',$this->datedesd->TimeStampFromText),date('Y-m-d',$this->datehast->TimeStampFromText),'todas');
			$this->t2->Text="Publicacion de articulos entre ".date('Y-m-d',$this->datedesd->TimeStampFromText)." y ".date('Y-m-d',$this->datehast->TimeStampFromText);
		}
		if($this->tipo_consulta->Text=""){
		
		}
			$Vx=array();
			$Vy=array();
			$Vy1=array();
			
				
					
				if($datos!=null){
						foreach($datos as $b){
							$Vx[]=$b['CATEGORIA'];
							
							$Vy[]=$b['NUMERO'];
						
						}
						$t=0;
						foreach($Vy as $a){
							$t=$t+$a;
						}
						
						foreach($Vy as $c){
							$Vy1[]=($c*100/$t);
						}
						if($this->radio1->Checked){
						
						$this->imgPermuta->ImageUrl="assets/estadisticas_barra.php?x=".implode(',',$Vx)."&y=".implode(',',$Vy1)."";
						}
						if($this->radio2->Checked){
							
							$this->imgPermuta->ImageUrl="assets/estadisticas_pie.php?x=".implode(',',$Vx)."&y=".implode(',',$Vy1)."";
						}
				
				}else{
				$this->imgPermuta->ImageUrl="assets/images/nodatos.jpg";
				}
	}
		
	
	}

?>