<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$fname = clean($_POST['fname']);
	$lname = clean($_POST['lname']);
	$login = clean($_POST['login']);
	$email = clean($_POST['email']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
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
	if($email == ''){
		$errmsg_arr['email'] = 'Email is missing';
		$errflag = true;
	}

	// make sure it is a valid email address with no special chars
	else if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		// grab domain of email
		list($user, $domain) = explode('@', $email);
		// if domain is not from umbc, reject
		if ($errmsg_arr['email'] == '' && $domain != 'umbc.edu') {
		    $errmsg_arr['email'] = 'Must be @umbc.edu!';
		    $errflag = true;
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
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM users WHERE login='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr['login'] = $login . ' is already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}

	// check for duplicate email and from umbc
	if($email != '') {
		$qry = "SELECT * FROM users WHERE email='$email'";
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

	//encrypt password before storing
	$hash = password_hash($password, PASSWORD_BCRYPT);

	$qry = "INSERT INTO users(firstname, lastname, login, email, passwd) VALUES('$fname','$lname','$login', '$email' ,'$hash')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: ../login.php");				
		exit();
	}else {
		die("Query failed");
	}
?>