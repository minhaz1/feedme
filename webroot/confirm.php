<?php

	include('dbconnect.php');

	$id = $_GET['id'];

	//Create query
	$qry="SELECT * FROM " . USER_TABLE . " WHERE confirmation='$id'";
	$result=mysql_query($qry);

	// found
	if($result){
		if(mysql_num_rows($result) == 1) {

			$member = mysql_fetch_assoc($result); 
			$member_id = $member['member_id'];
			$qry = "UPDATE " . USER_TABLE . " SET confirmation = '1' WHERE " . USER_TABLE . ".member_id ='$member_id'";
			$result = mysql_query($qry);
			header("location: " . "index.php");
			exit();
			
		}
	}
?>