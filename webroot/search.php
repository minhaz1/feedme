<?php

	session_start();

	require_once('scripts/dbconnect.php');

	include_once('scripts/search-exec.php');

	// easily reusable to search any table. just pass in the table name
	// and an array of the columns you watch to search
	$results = search_perform(RES_REVIEWS, array('tags','description','title'), $_GET['q']);
	$num_results = sizeof($results);
	$reviewid = "";
?>

<html>

    <head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>FeedMe - Search Results</title>
	</head>

	<body>
	    <?php 
	      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
	        include_once("scripts/moderate_helper.php");     
	      }
	    ?>


		<!------------------------ Start of Navbar ------------------------>
	    <?php include_once('navbar.php');


	    	// check the request and forward it
	    	
		    if(!isset($_GET['filter']) || $_GET['filter'] == "reviews"){
		    	include("searchreviews.php");
		    }
		    else if($_GET['filter'] == "users"){
		    	include("searchusers.php");
		    }
		    else if($_GET['filter'] == "restaurants"){
		    	include("searchrestaurants.php");
		    }

	    ?>
	    
	</body>

    <script src="./js/bootstrap.min.js"></script>
</html>