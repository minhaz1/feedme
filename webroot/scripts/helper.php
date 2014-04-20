<?php

	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}


	// this function sends an email with the specified args
	function sendEmail($to, $subject, $message){
		$headers = 'From: noreply@feedme.com' . "\r\n" .
	    	'Reply-To: noreply@feedme.com' . "\r\n" .
	    	'X-Mailer: PHP/' . phpversion();

		$mail = mail($to, $subject, $message, $headers);
	}


	// given a field name, returns the error message associated with it
	function getErrs($field){
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ){								$ERRMSG_ARR = $_SESSION['ERRMSG_ARR'];
			if(isset($ERRMSG_ARR[$field])){
				echo " - <font color='red'>" . $ERRMSG_ARR[$field] . "</font>";
			}
		unset($ERRMSG_ARR[$field]);
		}
	}

	
?>