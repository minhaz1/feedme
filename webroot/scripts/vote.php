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

	$page = clean($_POST['page']);
	$value = clean($_POST['value']);

	if($value < 0){
		$value = -1;
	}
	else if($value > 0){
		$value = 1;
	}
	else{
		$value = 0;
	}

	if($page == "restaurant"){
		$resid = clean($_POST['resid']);

		$qry = "SELECT * FROM " . RESTAURANT_VOTES . " WHERE member_id=$SESS_MEMBER_ID AND resid=$resid";
		$result = mysql_query($qry);

		if($result && mysql_num_rows($result) == 0){
			$qry = "INSERT INTO " . RESTAURANT_VOTES . " (resid, member_id, value) VALUES($resid, $SESS_MEMBER_ID, $value)";
			$result = mysql_query($qry);
			
			if($result){
				$qry = "UPDATE " . RESTAURANT_TABLE . " SET upvotes = upvotes + $value WHERE resid ='$resid'";
				$result = mysql_query($qry);
			}
		}

	}



	header("location: " . $_SERVER['HTTP_REFERER']);



?>