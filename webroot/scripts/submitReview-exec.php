<?php

	require_once('auth.php');
	
	//Include database connection details
	require_once('dbconnect.php');

	//Include password lib
	//require_once('password.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$title = clean($_POST['title']);
	$imglink = clean($_POST['IMGlink']);
	$review = clean($_POST['review']);
	$resid = clean($_POST['resid']);
	
	//Input Validations
	if($title == '') {
		$errmsg_arr['title'] = 'Food items missing';
		$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	//Check to make sure first name only contains alphabetic characters
	//else if(preg_match('/^[A-Za-z]+$/', $title) == 0) {
	//	$errmsg_arr['title'] = 'First name must only contain alphabetic characters';
	//	$errflag = true;
	//} 
	if($imglink == '') {
		$errmsg_arr['imglink'] = 'Image link missing';
		$errmsg_arr['test'] = 'test1';
		$errflag = true;
	}
	//Check to make sure last name only contains alphabetic characters
	//else if(preg_match('/^[A-Za-z]+$/', $imglink) == 0) {
	//	$errmsg_arr['imglink'] = 'Last name must only contain alphabetic characters';
	//	$errflag = true;
	//} 
	if($review == '') {
		$errmsg_arr['review'] = 'Review missing';
		$errmsg_arr['test'] = 'test2';
		$errflag = true;
	}
	//Check to make sure review starts with a letter and only contains alphanumeric characters
	//else if(preg_match('/^[A-Za-z]+[A-Za-z0-9]+$/', $review) == 0) {
	//	$errmsg_arr['review'] = 'review must start with a letter and only contain alphanumeric characters';
	//	$errflag = true;
	//} 
	
	//If there are input validations, redirect back to the restaurant form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../restaurant.php");
		exit();
	}
	$memid = $_SESSION['SESS_MEMBER_ID'];
	$qry = "INSERT INTO " . RES_REVIEWS . " (resid, title, member_id, description, foodimage, helpfulnessscore) VALUES('$resid','$title','$memid', '$review', '$imglink', 0)";
	$result = @mysql_query($qry);
	
	//die($qry);

	//Check whether the query was successful or not
	if($result) {
		$_SESSION['resid'] = $resid;
		header("location: ../restaurant.php");				
		exit();
	}else {
		die("Query failed". $qry);
	}
?>