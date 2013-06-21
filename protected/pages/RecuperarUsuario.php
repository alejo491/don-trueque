<?php
class RecuperarUsuario extends Tpage{
	public function onInit($param) { 
		   parent::onInit($param); 
		   
				  

		 }
	public function siguiente($sender,$param){
			
			$usuario=usuarioRecord::finder()->find("CORREO=?", $this->txt_correo->Text);
			
		  if($usuario!=null){
			Prado::using('Application.phpmailer.PHPMailer');
			
			
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

			$mail->Subject = '[Don Trueque] Recuperar Contraseña';
			$mail->Body    = "<pre>Alguien ha solicitado tu nombre de usuario en DonTruque

							  

Nombre de usuario: $usuario->NICK

Si ha sido un error, ignora este correo y no pasará nada.

Ahora puedes ingresar a nuestra pagina <a href="."http://localhost/don-trueque/?page=InicioSesion".">Don Trueque</a> e iniciar sesion<pre>";
			$mail->AltBody = 'S';

			if(!$mail->Send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			}
			$url=$this->Service->constructUrl('RUsuarioExitoso',array('correo'=>$this->txt_correo->Text));
			$this->Response->redirect($url);
		  }else{
			$this->error->Text="No hay usuario con esta cuenta de correo";
		  }
			
		}

}


?>