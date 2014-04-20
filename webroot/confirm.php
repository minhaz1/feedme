<?php

	include('scripts/dbconnect.php');
	include_once('scripts/helper.php');

	$id = clean($_GET['id']);

	// attempt to find user with this confirmation id
	$qry="SELECT * FROM " . USER_TABLE . " WHERE confirmation='$id'";

	$result=mysql_query($qry);

	// if he is found
	if($result){
		if(mysql_num_rows($result) == 1) {

			// once found update confirmation field to 0 so they can log in
			$member = mysql_fetch_assoc($result); 
			$member_id = $member['member_id'];
			$qry = "UPDATE " . USER_TABLE . " SET confirmation = '0' WHERE " . USER_TABLE . ".member_id ='$member_id'";
			$result = mysql_query($qry);
			header("location: " . "index.php");
			exit();
		}
	}
?>