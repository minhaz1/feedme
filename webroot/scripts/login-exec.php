<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');

	require_once('password.php');
	
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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr['login'] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr['password'] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../login.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM users WHERE login='$login'";
	$result=mysql_query($qry);
	
	// check if query succeeded
	if($result) {
		// verify that only 1 row is returned
		if(mysql_num_rows($result) == 1) {
			//Get value from $results array.
			$member = mysql_fetch_assoc($result);

			foreach($member as $key => $value) {
    				       echo "Key: $key; Value: $value\n";
			}   

			// check password match
			if(password_verify($password, $member['passwd'])){
				//Login Successful
				session_regenerate_id();
				$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
				$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
				$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
				session_write_close();
				header("location: ../index.php");
				exit();
			}
		}
		//Login failed
		$errmsg_arr['login'] = "Wrong Username or Password";
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../login.php");
		exit();
	}
	else {
		die("Query failed");
	}
?>