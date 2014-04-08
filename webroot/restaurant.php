<?php
  session_start();

  //Check whether the session variable SESS_MEMBER_ID is present or not
  //if(isset($_SESSION['SESS_MEMBER_ID'])) {
  //  header("location: index.php");
  //  exit();
  //}

  function getErrs($field){
    if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ){               $ERRMSG_ARR = $_SESSION['ERRMSG_ARR'];
      if(isset($ERRMSG_ARR[$field])){
        echo " - <font color='red'>" . $ERRMSG_ARR[$field] . "</font>";
      }
    unset($ERRMSG_ARR[$field]);
    //unset($_SESSION['ERRMSG_ARR']);
    }
  }

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
    
  <?php getErrs('test') ?>;

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
                <div class="panel panelResturant">
                </div>
                <div class="name">
                    KFC
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
                                <h1>Atwater's Market</h1>
                                <cite>
                                    815 Frederick Road. Catonsville, Maryland 21228
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                </cite>
                        
                                <p>    
                                <i class="glyphicon glyphicon-envelope"></i>410-747-4120           
                                <br>

                                <i class="glyphicon glyphicon-globe"></i>
                                <a href="http://www.jquery2dotnet.com">
                                    http://www.atwaters.biz/
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
                                This is the message body1
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
                                            <!------------------------ end 5 --------------------------------------->

                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>4
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                        <span class="sr-only">60%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 4 --------------------------------------->
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>3
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                        <span class="sr-only">40%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 3 --------------------------------------->
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>2
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                        <span class="sr-only">20%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 2 --------------------------------------->

                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>1
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                                                        <span class="sr-only">15%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------ end 1 --------------------------------------->
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
    
     <div class="containers" id="resturantBody">
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