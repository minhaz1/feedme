<?php
    session_start();
?>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>404 Not Found!</title>
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
	</head>

<body>
<?php include('navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template" style="padding: 40px 15px;text-align: center;">
                <h1 style="font-size:70px;color:black">
                    Oops!</h1>
                <h2 style="font-size:70px;color:black">
                    404 Not Found</h2><br><br>
                <h2 class="error-details" style="font-size:30px;color:black">
                    Sorry, Seymour has eaten the developer of the page you are requesting.
                </h2>  
                
                <div class="container">
                    <div class="centered">
                        <img class="img-responsiveimg-center" src="./img/feedme1.png">
                    </div>
                </div>
                
                <div class="error-actions" style="margin-top:50px;">
                    <a style="width:80%;" href="index.php" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Take Me Home </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body></html>