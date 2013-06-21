<?php

class VerPropuesta extends Tpage{
			private $a;
		    private $b;
		
		public function onInit($param){
			parent::onInit($param);
			$this->a=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ID_ARTICULO);
			$this->b=articuloRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ART_ID_ARTICULO);
			
			if($this->a->DISPONIBILIDAD=="Libre"){
				$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
				$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO;
				$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
				$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
				$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
				if($this->b->DISPONIBILIDAD=="Libre"){
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}else{
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
					$this->btn_Aceptar->Visible="false";
					$this->btn_Cancelar->Text="Volver al Inicio";
				}
			}else{
				$this->img_ar1->ImageUrl=imagenRecord::finder()->findByPk($this->a->ID_IMAGEN)->RUTA_IMAGEN;
				$this->Lbl_Nombre1->Text=$this->a->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
				$this->Lbl_Ubicacion1->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->a->ID_UBICACION)->CIUDAD);
				$this->Lbl_Categoria1->Text=$this->a->CATEGORIA;
				$this->Lbl_Descripcion1->Text=utf8_encode($this->a->DESCRIPCION);
				$this->btn_Aceptar->Visible="false";
				$this->btn_Cancelar->Text="Volver al Inicio";
				if($this->b->DISPONIBILIDAD=="Libre"){
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO;
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}else{
					$this->img_ar2->ImageUrl=imagenRecord::finder()->findByPk($this->b->ID_IMAGEN)->RUTA_IMAGEN;
					$this->Lbl_Nombre2->Text=$this->b->NOMBRE_PRODUCTO." <strong>ESTE ARTICULO YA NO ESTA DISPONIBLE</strong>";
					$this->Lbl_Ubicacion2->Text=utf8_encode(ubicacionRecord::finder()->findByPk($this->b->ID_UBICACION)->CIUDAD);
					$this->Lbl_Categoria2->Text=$this->b->CATEGORIA;
					$this->Lbl_Descripcion2->Text=$this->b->DESCRIPCION;
				}
			}
			echo(usuarioRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ID_USUARIO)->CORREO);
		}
		
		public function Aceptar_Clicked($param){
			$x=solicitudRecord::finder()->findByPk($this->Request['id']);
			$x->ESTADO='Aceptado';
			$x->FECHA_RESPUESTA=date("y-m-d", time());
		
			$this->a->DISPONIBILIDAD='TRUEQUEADO';
			$this->b->DISPONIBILIDAD='TRUEQUEADO';
			$x->save();
			$this->a->save();
			$this->b->save();
			$this->enviar_mail('Aceptado');
			$url=$this->Service->constructUrl('truequeExitoso');
			$this->Response->redirect($url);
			
		}
		
		public function Cancelar_Clicked($param){
			$x=solicitudRecord::finder()->findByPk($this->Request['id']);
			
			$x->ESTADO='CANCELADO';
			$x->save();
			$this->enviar_mail('Cancelado');
			$url=$this->Service->constructUrl('solicitudes');
			$this->Response->redirect($url);
		}
		
		public function enviar_mail($tipo){
			Prado::using('Application.phpmailer.PHPMailer');
			$usuario=usuarioRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->ID_USUARIO);
			$z=usuarioRecord::finder()->findByPk(solicitudRecord::finder()->findByPk($this->Request['id'])->USU_ID_USUARIO);
			
			$mail = new PHPMailer;

			$mail->IsSMTP();                                     
			$mail->Host = 'smtp.gmail.com'; 
						 
			$mail->SMTPAuth = true;                               
			$mail->Username = 'dontrueque.com';                          
			$mail->Password = 'software3';                         
									  

			$mail->From = 'dontrueque.com@gmail.com';
			$mail->FromName = 'Administrador Dontrueque';
		    
			$mail->AddAddress($usuario->CORREO,"$usuario->NOMBRE_USUARIO $usuario->APELLIDO_USUARIO");    
					 
	
		 
			$mail->IsHTML(true);                                 

			$mail->Subject = '[Don Trueque] Respuesta Propuesta';
			$mail->Body    = "<pre>Señor $usuario->NOMBRE_USUARIO $usuario->APELLIDO_USUARIO 
			
Usted envio al usuario $z->NICK la siguiente propuesta de trueque:
			
Usted ofrece: ".$this->b->NOMBRE_PRODUCTO."		
Por:		  ".$this->a->NOMBRE_PRODUCTO."
			
</pre>";
			
if($tipo=='Aceptado'){
$mail->Body=$mail->Body."<pre>El usuario ha aceptado tu propuesta de truque,
estos son los datos de contacto de $z->NICK:
			 
Nombre:	$z->NOMBRE_USUARIO
Telefono:	$z->TELEFONO
Correo:	$z->CORREO
			 
</pre>";
}
			
if($tipo=='Cancelado'){
$mail->Body=$mail->Body."<pre>El usuario ha rechazado tu propuesta de truque</pre>";
}
			$mail->AltBody = 'S';

			if(!$mail->Send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			}
		}
}

?>