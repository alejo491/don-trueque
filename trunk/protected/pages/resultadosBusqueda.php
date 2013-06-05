<?php

	class resultadosBusqueda extends Tpage{
		public function onPreInit($param)
		{
		parent::onPreInit($param);		
				$this->setMasterClass($this->Request['ms']);
		}
		
		
		public function onInit($param){
			
			$this->buscar($param);
				}
		
		public function buscar($param){
				
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
										$articulo=articuloRecord::finder()->findAll($condicion);
										
									}else{
										$articulo=articuloRecord::finder()->findAll("NOMBRE_PRODUCTO like '%".$vector[0]."%' ");
										}	
						}else if($this->Request['tipo']=='categoria'){
							//esto es para obtener la respuesta del post 
							$busqueda=$this->Request['id'];
								$articulo=articuloRecord::finder()->findAll('CATEGORIA=?',$busqueda);	
						}else if($this->Request['tipo']=='ava'){
							
							$articulo=articuloRecord::finder()->findAll($this->Request['s']);
						}
						
						
				$i=0;		
				if($articulo!=null){
					
					foreach ($articulo as $i){
						
						
			
		
						$imagen=imagenRecord::finder()->find("ID_IMAGEN=?",$i->ID_IMAGEN);
						$ubicacion=ubicacionRecord::finder()->find("ID_UBICACION=?",$i->ID_UBICACION);
						$usuario=usuarioRecord::finder()->findByPk($i->ID_USUARIO);
						$image=new Timage();
						$image->imageUrl=$imagen->RUTA_IMAGEN;
						$image->Width="100px";
						$tabla=new TTable();
						$row=new TTableRow();
						$cell_img=new TTableCell();
						$propietario='<strong>Propietario: </strong>'.$usuario->NICK.' <a href="?page=verPerfil&id='.$usuario->ID_USUARIO.'&ms='.$this->Request['ms'].'">Ver Perfil</a><br />' ;
						$nombre=new TLabel();
						
						$nombre->Text="<strong>Nombre: </strong>".$i->NOMBRE_PRODUCTO."<br />";
						$desc=new TLabel();
						$desc->Text="<strong>Descripcion: </strong>".utf8_encode($i->DESCRIPCION)."<br />";
						$ub=new TLabel();
						$ub->Text="<strong>Ubicacion: </strong>".utf8_encode($ubicacion->CIUDAD)."<br />";
						$link='<a href="?page=VerArticulo&id='.$i->ID_ARTICULO.'&ms='.$this->Request['ms'].'">Ver Detalles</a>';
						$cell_datos=new TTableCell();
						$cell_datos->controls->add($propietario);
						$cell_datos->controls->add($nombre);
						$cell_datos->controls->add($desc);
						$cell_datos->controls->add($ub);
						$cell_datos->controls->add($link);
						$cell_img->controls->add($image);
						$row->controls->add($cell_img);
						$row->controls->add($cell_datos);
						$tabla->controls->add($row);
						$this->cphCuerpo->controls->add($tabla);
						
					
						$b[$i]=$tabla;
						$i=$i+1;
					
						}
						
					}else{
						$error="<h3>No se han encontrado articulos</h3>";
						$this->cphCuerpo->controls->add($error);
					}
					$this->Resultados->DataSource=$b;
					$this->Resultados->DataBind();
				}
				
		}
				
	
	

?>