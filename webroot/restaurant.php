<?php
  session_start();

  require('scripts/dbconnect.php'); 

  // include helper functions
  include_once('helper.php');

  $resid = "";
   
  if(isset($_GET['resid'])){
    $resid = clean($_GET['resid']);
    $_SESSION['resid'] = $resid;
  }
  else if(!isset($_SESSION['resid'])){
    header("location: index.php");        
    exit();
  }
  else{
    $resid = clean($_SESSION['resid']);
  }

  $_SESSION['resid'] = $resid;

  //Create query
  $qry = "SELECT name, phone, address, url, image FROM " . RESTAURANT_TABLE . " WHERE resid=" . $resid;
  $result=@mysql_query($qry);

  if(!$result) {
    die("Query failed". $qry);
  } 

  $restaurant = mysql_fetch_assoc($result); 

  $name = $restaurant['name'];
  $phone = $restaurant['phone'];
  $address = $restaurant['address'];
  $url = $restaurant['url'];
  $image = $restaurant['image'];

?>

 <!doctype html>
<html><head>
<title>Restaurant View</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <link href="./css/styles.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
     <!-- Optional theme -->
    <link rel="stylesheet" href="bootstrap/css/maf.css">
        <link type="text/css" rel="stylesheet" href="css/example.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.4.min.js" type="text/javascript"></script>

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    
<script type="text/javascript">
		$(document).ready(function(){
            <!-- loads the timeline when the page starts -->
            $('#digital_download').html('Downloading...'); // Show "Downloading..."
                // Do an ajax request
                $.ajax({
                  url: "resturantTimeLine.php?id=resturantTimeLineBody"
                }).done(function(data) { // data what is sent back by the php page
                  $('#resturantBody').html(data); // display data
                }); 
		 });

      $("#reviewForm").submit(function(event) {

      /* stop form from submitting normally */
      event.preventDefault();

      /* get some values from elements on the page: */
      var $form = $( this ),
          url = $form.attr( 'action' );

      /* Send the data using post */
      var posting = $.post( url, { title: $('#title').val(), IMGLink: $('#IMGLink').val(), review: $('#review').val(), resid: $('#resid') } );

      /* Put the results in a div */
      posting.done(function( data ) {
        alert('success');
      });
    });
	</script>
</script>
</head>


<body >
    
    
<!------------------------ Start of Navbar ------------------------>
    <?php include_once('navbar.php') ?>

  
<!------------------------ End of Navbar ------------------------> 
    
    <?php include_once('submitReview.php') ?>

    <!------------------------ Start Resturant Header ------------------------>
    <div class="container">
          
        <div class="container">
	       <div class="row well">
               
            <div class="col-md-12">
                <!--<div class="panel panelResturant"> <img class="panel panelResturant" src=<?php echo "\"" . $image . "\"" ?>> </img>
                </div> -->
                <div class="name">
                    <?php echo $name ?>
                </div>
                
                <br><br><br>
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                      <a href="#info" data-toggle="tab">
                          <i class="fa fa-envelope-o"></i> 
                          Info
                      </a>
                  </li>
                  
                  <li>
                      <a href="#Tags" data-toggle="tab">
                        <i class="fa fa-reply-all"></i> 
                        Tags
                      </a>
                  </li>
                    
                  <li>
                      <a href="#Rating" data-toggle="tab">
                          <i class="fa fa-file-text-o"></i> 
                          Rating
                      </a>
                  </li>
                  <li>
                      <a href="#Submit" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-file-text-o"></i> 
                          Submit Review
                      </a>
                  </li>
                </ul>
                
    
                <div class="tab-content">
                  <div class="tab-pane active" id="info">
                    <span type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                <h1><?php echo $name ?></h1>
                                <cite>
                                    <?php echo $address ?>
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                </cite>
                        
                                <p>    
                                <i class="glyphicon glyphicon-envelope"></i><?php echo $phone ?>          
                                <br>

                                <i class="glyphicon glyphicon-globe"></i>
                                <a href=<?php echo "\"http://" . $url . "\"" ?> >
                                    <?php echo $url ?>
                                </a>
                                <br>
                            </div>
                        </div>
                    </span>
                  </div>


                  <div class="tab-pane " id="Tags">
                    <a type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                    <span class="label label-default">alice</span>
                                    <span class="label label-primary">story</span>
                                    <span class="label label-success">blog</span>
                                    <span class="label label-info">personal</span>
                                    <span class="label label-warning">Warning</span>
                                    <span class="label label-danger">Danger</span>
                                    <span class="label label-default">alice</span>
                                    <span class="label label-primary">story</span>
                                    <span class="label label-success">blog</span>
                                    <span class="label label-info">personal</span>
                                    <span class="label label-warning">Warning</span>
                                    <span class="label label-danger">Danger</span>
                                    <span class="label label-default">alice</span>
                                    <span class="label label-primary">story</span>
                                    <span class="label label-success">blog</span>
                                    <span class="label label-info">personal</span>
                                    <span class="label label-warning">Warning</span>
                                    <span class="label label-danger">Danger</span>
                            </div>
                        </div>
                    </a>
                  </div>


                 <div class="tab-pane" id="Rating">
                    <span type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-lg-6 text-center">
                                        <h1 class="rating-num">4.0</h1>
                                        <div class="rating">
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        </div>
                                        <div>
                                            <span class="glyphicon glyphicon-user"></span>1,050,008 total
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="row rating-desc">
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>5
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                        <span class="sr-only">80%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    </span>
                 </div>

                </div>

            </div>
	       </div>
    
    
          </div>
        </div>
    
     <!-- disabling ajax stuff for now until it's fully functionable -->
     <!-- <div class="containers" id="resturantBody"> -->
     <?php include_once('restaurantTimeLine.php'); ?>
    </div>
        
          

          


    <div class="div-swipe-left" id="swipe-left">
    </div>
    <div class="div-swipe-right" id="swipe-right">
    </div>
    
    <script src="./js/feedme.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui-1.10.4.custom.min.js"></script>
    <link href="./css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
    <script src="./js/jquery.fancybox.pack.js"></script> 
    <link href="./css/jquery.fancybox-buttons.css" rel="stylesheet" type="text/css"></script> 
    <script src="./js/jquery.fancybox-buttons.js"></script> 
    <script src="./js/jquery.fancybox-media.js"></script> 
    <script src="./js/hammer.min.js"></script>
    <script src="./js/jquery.nanogallery.min.js"></script> 
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.js"></script>
  <?php unset($_SESSION['ERRMSG_ARR']); ?>

</body>
</html>