<?php
	class Inicio extends Tpage{
		public function onInit($param) { 
		   parent::onInit($param); 
		   Prado::using('Application.phpmailer.PHPMailer');
		   $mail = new PHPMailer;

			$mail->IsSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com'; 
						 // Specify main and backup server
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'dontrueque.com';                            // SMTP username
			$mail->Password = 'software3';                           // SMTP password
			//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

			$mail->From = 'alejo491@gmail.com';
			$mail->FromName = 'Administrador Dontrueque';
			//$mail->AddAddress('josh@example.net', 'Josh Adams');  // Add a recipient
			$mail->AddAddress('alejo491@gmail.com');    
			$mail->AddAddress('alejo491@hotmail.es');             // Name is optional
			//$mail->AddReplyTo('info@example.com', 'Information');
			//$mail->AddCC('cc@example.com');
			//$mail->AddBCC('bcc@example.com');

			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->AddAttachment('/var/tmp/file.tar.gz');         // Add attachments
			$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->IsHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->Send()) {
			   echo 'Message could not be sent.';
			   echo 'Mailer Error: ' . $mail->ErrorInfo;
			   exit;
			}

			echo 'Message has been sent';
		 	
		 }
	}

?>