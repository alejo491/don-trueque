<?php
	
	class RecuperacionExitosa extends TPage{
		public function onInit($param) { 
		   parent::onInit($param); 
		   Prado::using('Application.phpmailer.PHPMailer');
			$usuario=usuarioRecord::finder()->find("NICK=?",$this->Request['nick']);
		    $this->correo->Text=$usuario->CORREO;
		    $mail = new PHPMailer;

			$mail->IsSMTP();                                     
			$mail->Host = 'smtp.gmail.com'; 
						 
			$mail->SMTPAuth = true;                               
			$mail->Username = 'dontrueque.com';                          
			$mail->Password = 'software3';                         
			                          

			$mail->From = 'dontrueque.com@gmail.com';
			$mail->FromName = 'Administrador Dontrueque';
		 
			$mail->AddAddress($usuario->CORREO,"$usuario->NOMBRE_USUARIO $usuario->APELLIDO_USUARIO");    
			         
			
/*
			$mail->WordWrap = 50;                                
			$mail->AddAttachment('/var/tmp/file.tar.gz');         
			$mail->AddAttachment('/tmp/image.jpg', 'new.jpg'); 
			*/  
			$mail->IsHTML(true);                                 

			$mail->Subject = '[Don Trueque] Recuperar Contrase&ntilde;a';
			$mail->Body    = "<pre>Alguien ha solicitado la contraseña de
la siguiente cuenta:
							  

Nombre de usuario: $usuario->NICK
Contraseña: <h1>$usuario->PASS</h1>
Si ha sido un error, ignora este correo y no pasará nada.

Ahora puedes ingresar a nuestra pagina <a href="."http://localhost/don-trueque/?page=InicioSesion".">Don Trueque</a> e iniciar sesion<pre>";
			$mail->AltBody = 'S';

			if(!$mail->Send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			}

			

		}

			 public function Inicio_click($sender,$param){
		 	$url=$this->Service->constructUrl('Inicio');
			$this->Response->redirect($url);
		 }
	}



?>