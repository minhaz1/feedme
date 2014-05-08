<?php
	// setting debug flag, will allow non-umbc emails
	$UMBC_FLAG = false;
	$EMAIL_FLAG = true;

	//Start session
	session_start();

	//Include password lib
	require_once('password.php');

	//Include database connection details
	require_once('dbconnect.php');

	// include email function
	include_once('helper.php');

	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
		
	//Sanitize the POST values
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$login = strtolower(clean($_POST['login']));
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	$gender = clean($_POST['gender']);
	$yeararrived = clean($_POST['yeararrived']);

	//Input Validations

	// validate first name	
	if($fname == '') {
		$errmsg_arr['fname'] = 'First name missing';
		$errflag = true;
	}
	//Check to make sure first name only contains alphabetic characters
	else if(preg_match('/^[A-Za-z]+$/', $fname) == 0) {
		$errmsg_arr['fname'] = 'First name must only contain alphabetic characters';
		$errflag = true;
	} 
	if($lname == '') {
		$errmsg_arr['lname'] = 'Last name missing';
		$errflag = true;
	}
	//Check to make sure last name only contains alphabetic characters
	else if(preg_match('/^[A-Za-z]+$/', $lname) == 0) {
		$errmsg_arr['lname'] = 'Last name must only contain alphabetic characters';
		$errflag = true;
	} 
	if($login == '') {
		$errmsg_arr['login'] = 'Login ID missing';
		$errflag = true;
	}
	//Check to make sure login starts with a letter and only contains alphanumeric characters
	else if(preg_match('/^[A-Za-z]+[A-Za-z0-9]+$/', $login) == 0) {
		$errmsg_arr['login'] = 'Login must start with a letter and only contain alphanumeric characters';
		$errflag = true;
	} 
	if($email == ''){
		$errmsg_arr['email'] = 'Email is missing';
		$errflag = true;
	}

	// make sure it is a valid email address with no special chars
	else if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		// grab domain of email
		list($user, $domain) = explode('@', $email);

		if($UMBC_FLAG){
			// if domain is not from umbc, reject
			if (!isset($errmsg_arr['email']) && $domain != 'umbc.edu') {
			    $errmsg_arr['email'] = 'Must be @umbc.edu!';
			    $errflag = true;
			}
		}
	}
	else{
		// invalid, reject
		$errmsg_arr['email'] = 'Invalid email';
		$errflag = true;
	}

	if($password == '') {
		$errmsg_arr['password'] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if(strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr['password'] = 'Passwords do not match';
		$errflag = true;
	}

	// validate gender
	if($gender == ''){
		$errmsg_arr['gender'] = 'Gender missing';
		$errflag = true;
	}
	else if($gender != 'f' && $gender != 'm'){
		
		if($gender == '0'){
			$errmsg_arr['gender'] = "Please select a gender";
		}
		else{
			$errmsg_arr['gender'] = 'Invalid value: ' . $gender;
		}
		
		$errflag = true;
	}

	if($yeararrived == ''){
		$errmsg_arr['yeararrived'] = 'Year Arrived is missing';
		$errflag = true;
	}
	else if($yeararrived < "1980" || $yeararrived > "2014"){
		if($yeararrived == '0'){
			$errmsg_arr['yeararrived'] = "Please select a year.";
		}
		else{
			$errmsg_arr['yeararrived'] = 'Invalid value: ' . $yeararrived;	
		}	
		$errflag = true;
	}

	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM " . USER_TABLE . " WHERE login='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr['login'] = $login . ' is already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			echo $qry;
			die("Query failed");
		}
	}

	// check for duplicate email and from umbc
	if($email != '') {
		$qry = "SELECT * FROM " . USER_TABLE . " WHERE email='$email'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr['email'] = $email . ' is already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../register.php");
		exit();
	}

//	// temp default biography for everyone
//	$biography = "Don't eat me!";

	// email confirmation hash value
	$confirmation = md5($login . $email);
	$confirm_url = "http://" . $_SERVER['HTTP_HOST'] . "/public/confirm.php?id=" . $confirmation;

	$message = "Thank you for signing up for FEEDME!\nPlease click this link to confirm your account: \n$confirm_url";

	//encrypt password before storing
	$hash = password_hash($password, PASSWORD_BCRYPT);

	$qry = "INSERT INTO " . USER_TABLE . " (firstname, lastname, login, email, password, gender, yeararrived, confirmation) VALUES('$fname','$lname','$login', '$email' ,'$hash','$gender','$yeararrived','$confirmation')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if($EMAIL_FLAG){ 
			sendEmail($email, "Please confirm your email.", $message);
			$errmsg_arr['login'] = "Please confirm your email.";
			$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		}
		header("location: ../login.php");				
		exit();
	}else {
		die("Query failed");
	}
?>
