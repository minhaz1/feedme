<?php

	session_start();

	require_once('scripts/dbconnect.php');

	include_once('scripts/search-exec.php');

	// easily reusable to search any table. just pass in the table name
	// and an array of the columns you watch to search
	$results = search_perform(RES_REVIEWS, array('tags','description','title'), $_GET['q']);
	$num_results = sizeof($results);

?>

<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>FeedMe - Search Results</title>
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
	</head>

<body>

	<!------------------------ Start of Navbar ------------------------>
    <?php include_once('navbar.php') ?>
    
    <div class="container">
	<br>
    <hgroup class="mb20">
		<h1>Search Results</h1>
		<h2 class="lead">
			<strong class="text-danger">
				<?php echo $num_results?>
			</strong> results were found for the search for <strong class="text-danger"><?php echo $_GET['q']?></strong></h2>
	</hgroup>

    <section class="col-xs-12 col-sm-6 col-md-12">
	<br>
		<?php 

			foreach($results as $row){
				$resid = $row['resid'];
				$text = $row['description'];
				$title = $row['title'];
				$tags = explode(",", $row['tags']);
				$image = $row['foodimage'];
				$reviewdate = explode(" ", $row['reviewdate']);
				$date = $reviewdate[0];
				$time = DATE("g:i a", STRTOTIME($reviewdate[1]));

				$tagstring = "";
				foreach($tags as $tag){
					if($tag != "")
						$tagstring .= "<li><i class=\"glyphicon glyphicon-tags\"></i> <span><a href=\"searchResults.php?q=$tag\"> $tag</a></span></li>";
				}
				
				echo 
					"<article class=\"search-result row\">
						<div class=\"col-xs-12 col-sm-12 col-md-3\"><a href=\"$image\" title=\"$title\" class=\"thumbnail\"><img src=\"$image\" alt=\"$title\" /></a></div>
						<div class=\"col-xs-12 col-sm-12 col-md-2\">
							<ul class=\"meta-search\">
								<li><i class=\"glyphicon glyphicon-calendar\"></i> <span>$date</span></li>
								<li><i class=\"glyphicon glyphicon-time\"></i> <span>$time</span></li>
								$tagstring
							</ul>
						</div>
						<div class=\"col-xs-12 col-sm-12 col-md-7 excerpet\">
							<h3><a href=\"restaurant.php?resid=$resid\" title=\"\">$title</a></h3>
							<p>$text</p>
						</div>
						<span class=\"clearfix borda\"></span>
					</article>";

			}

		?>
	</section>
</div>
    
    
</body></html>