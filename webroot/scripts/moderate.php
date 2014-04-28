<?php

	session_start();
	
	// make sure user is logged in
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') 
		|| $_SESSION['SESS_USERTYPE'] < 1) {
		header("location: ../404.php");
		exit();
	}

	include("helper.php");
	include("dbconnect.php");

	$SESS_MEMBER_ID = $_SESSION['SESS_MEMBER_ID'];
	$SESS_USERTYPE = $_SESSION['SESS_USERTYPE'];

	$action = clean($_POST['action']);
	
	if($SESS_USERTYPE == USERTYPE_ADMIN){
		if($action == "ban_user"){
			$login = clean($_POST['id']);
			$qry = "UPDATE " . USER_TABLE . " SET flags_count = flags_count + " . USER_FLAGS_LIMIT . " WHERE login ='$login'";
			$result=mysql_query($qry);
		}
		else if($action == "hide_review"){
			$reviewid = clean($_POST['id']);
			$qry = "UPDATE " . RES_REVIEWS . " SET flags_count = flags_count " . REVIEW_FLAGS_LIMIT . " WHERE reviewid ='$reviewid'";
			$result=mysql_query($qry);
		}		
	}

	if($action == "flag_user"){
		$login = clean($_POST['id']);

		$qry = "UPDATE " . USER_TABLE . " SET flags_count = flags_count + 1 WHERE login ='$login'";
		$result=mysql_query($qry);
	}

	else if($action == "flag_review"){
		$reviewid = clean($_POST['id']);
		$qry = "UPDATE " . RES_REVIEWS . " SET flags_count = flags_count + 1 WHERE reviewid ='$reviewid'";
		$result=mysql_query($qry);
	}


	header("location: " . $_SERVER['HTTP_REFERER']);



?>