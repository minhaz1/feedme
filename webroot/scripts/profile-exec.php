<?php

	require_once('auth.php');
	
	//Include database connection details
	require_once('dbconnect.php');

	// include helper functions
	include_once('helper.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Sanitize the POST values
	$bio = clean($_POST['editBio']);
	
	//Input Validations
	if($bio == '') {
		$errmsg_arr['bio'] = 'Bio missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the restaurant form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../profile.php");
		exit();
	}
	$memid = $_SESSION['SESS_MEMBER_ID'];
	$qry = "UPDATE " . USER_TABLE . " SET biography = '$bio' WHERE " . USER_TABLE . ".member_id ='$memid'";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$_SESSION['SESS_BIO'] = $bio;
		header("location: ../profile.php");				
		exit();
	}else {
		die("Query failed ". $qry);
	}
?>