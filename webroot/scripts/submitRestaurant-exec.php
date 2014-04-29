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
	$name = clean($_POST['resName']);
	$address = clean($_POST['resAddress']);
	$phone = clean($_POST['resPhone']);
	$site = clean($_POST['resLink']);
	$img = clean($_POST['IMGLink']);
	$tags = clean($_POST['tags']);
	
	//Input Validations
	if($name == '') {
		$errmsg_arr['name'] = 'Name missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	if($address == '') {
		$errmsg_arr['address'] = 'Address missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	if($phone == '') {
		$errmsg_arr['phone'] = 'Phone missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	if($site == '') {
		$errmsg_arr['site'] = 'Website missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	if($img == '') {
		$errmsg_arr['img'] = 'Image link missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	if($tags == '') {
		$errmsg_arr['tags'] = 'Tags missing';
		//$errmsg_arr['test'] = 'test';
		$errflag = true;
	}
	//If there are input validations, redirect back to the page the user came from
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: " . $_SERVER['HTTP_REFERER']);
		exit();
	}
	$qry = $qry = "INSERT INTO " . RESTAURANT_TABLE . " (regionid, name, phone, address, url, image, tags) VALUES(1,'$name','$phone','$address', '$site', '$img', '$tags')";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: ../index.php");				
		exit();
	}else {
		die("Query failed ". $qry);
	}
?>