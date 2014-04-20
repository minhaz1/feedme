<?php


	function sendEmail($to, $subject, $message){
		$headers = 'From: noreply@umbc.edu' . "\r\n" .
	    	'Reply-To: webmaster@example.com' . "\r\n" .
	    	'X-Mailer: PHP/' . phpversion();

		$mail = mail($to, $subject, $message, $headers);
		// return $mail;
	}
	
?>