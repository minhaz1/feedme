<?php

	require_once('auth.php');
	
	//Include database connection details
	require_once('dbconnect.php');

	// include email function
	include_once('helper.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Sanitize the POST values
	$title = clean($_POST['title']);
	$imglink = clean($_POST['IMGlink']);
	$review = clean($_POST['review']);
	$resid = clean($_POST['resid']);
	$tags = clean($_POST['tags']);
	
	//Input Validations
	if($title == '') {
		$errmsg_arr['title'] = 'Food items missing';
		$errmsg_arr['test'] = 'test';
		$errflag = true;
	}

	if($imglink == '') {
		$errmsg_arr['imglink'] = 'Image link missing';
		$errmsg_arr['test'] = 'test1';
		$errflag = true;
	}

	//Check to make sure last name only contains alphabetic characters
	if($review == '') {
		$errmsg_arr['review'] = 'Review missing';
		$errmsg_arr['test'] = 'test2';
		$errflag = true;
	}

	//If there are input validations, redirect back to the restaurant form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: ../restaurant.php");
		exit();
	}
	$memid = $_SESSION['SESS_MEMBER_ID'];
	$qry = "INSERT INTO " . RES_REVIEWS . " (resid, tags, title, member_id, description, foodimage, helpfulnessscore) VALUES('$resid','$tags','$title','$memid', '$review', '$imglink', 0)";
	$result = @mysql_query($qry);
	
	//die($qry);

	//Check whether the query was successful or not
	if($result) {
		$_SESSION['resid'] = $resid;
		header("location: " . $_SERVER['HTTP_REFERER']);				
		exit();
	}else {
		die("Query failed". $qry);
	}
?>