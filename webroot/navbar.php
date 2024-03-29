<?php include_once('scripts/params.php'); ?>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">

<!-- Stuff for tagging -->
      <link href="./css/jquery.tagit.css" rel="stylesheet" type="text/css">
      <link href="./css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">


      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8">        </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-  8"></script>

      <!-- The real deal -->
      <script src="./js/tag-it.js" type="text/javascript" charset="utf-8"></script>

      <!-- including a list of food tags for auto completion -->
      <script src="js/foodtags.js"></script>

      <!-- for uploading an image to imgur -->
      <script src = "js/feedme.js"></script>

      <script>
              $(function(){
                  // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
                  // examples, so it automatically defaults to singleField.
                  $('#singleFieldTags3').tagit({
                      availableTags: adjectives,
                      removeConfirmation: true,
                      readOnly: false,
                      caseSensitive: false
                  });

              });
      </script>
      <!-- tagging stuff ends -->

      <!-- Script for search filter dropdown -->
<script>
  function changeText(text) { 
    if(text == "Restaurants"){
      document.getElementById("filter").setAttribute("value", "restaurants");
    }
    else if(text == "Reviews"){
      document.getElementById("filter").setAttribute("value", "reviews"); 
    }
    else if(text == "Users"){
      document.getElementById("filter").setAttribute("value", "users");
    }

    document.getElementById("search_concept").innerHTML=text; //Change "Filter By" to the selected filter
    document.getElementById("search_concept").searchBy =text; //Change the searchBy attribute to the new selected filter(cannot be seen)
  } 
</script>

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <!------------------------ Start of Navbar ------------------------>
    <div class="navbar navbar-inner navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>  
          <a class="navbar-brand" href="index.php">FEEDME</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><span>Home</span></a></li>
             <!-- <li><a href=""><span>About</span></a></li> -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">FeedMe Quick <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="index.php?q=popular">Popular</a></li>
                  <li class="divider"></li>
                  <li><a href="restaurant.php?resid=random">Random</a></li>
                  <li class="divider"></li>
                  <!--<li><a href="#Submit" data-toggle="modal" data-target="#createrestaurant">Create a Resturant</a></li>
                  <li class="divider"></li> -->
                  <li><a href="profile.php">Profile</a></li>
                  <?php 
                    if((isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] != "") && $_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                      echo "<li class=\"divider\"></li>";
                      echo "<li><a href=\"#Submit\" data-toggle=\"modal\" data-target=\"#myModal2\">Create Restaurant</a></li>";
                    }
                  ?>   
                
                </ul>
            </li>
            <li>
                <form method="get" action='search.php' style="padding: 10px 10px 0px 0px !important;">
                    <input type="text" id="q" name="q" placeholder="Search">
                    <input type="hidden" id="filter" name="filter" value="reviews">
                    <input type="submit" hidden="true" value="Submit">
                </form>
            </li>
              <li class="col-xs-1" style="padding: 12px 10px 0px 0px !important;">
            <button  type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown">
            	<span id="search_concept" searchBy="">Reviews</span> <span class="caret"></span>
            </button>
            <ul id="searchFilter" class="dropdown-menu" role="menu" >
              <li onclick="changeText('Reviews')"><a>Reviews</a></li>
              <li onclick="changeText('Restaurants')"><a>Restaurants</a></li>
              <li onclick="changeText('Users')"><a>Users</a></li>
            </ul>             
	       </li>
          </ul>
            
        
            
          <ul class="nav navbar-nav navbar-right">
          <?php
            // if they are not logged in, show login/register
            if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID'])) == '') {
              echo 
              "<li><a href=\"login.php\"><span> Login </span></a></li>
              <li><a href=\"register.php\"><span> Register </span></a></li>";
            }
            else{
              // if they are logged in, show their name and logout
              echo "<li><a href=\"profile.php\">" . $_SESSION['SESS_FIRST_NAME'] . " " . $_SESSION['SESS_LAST_NAME'] . "</a></li>";
              echo "<li><a href=\"logout.php\">Logout</a></li>";
            }

          ?>  

          </ul>
       </div><!--/.nav-collapse -->
      </div>
    </div>
    <!------------------------ End of Navbar ------------------------>  
<!-- Modal For Creating a Restaurant -->

    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Tried out a new restaurant? Tell us about it!</h4>
          </div>
          <div class="modal-body">
               <form action="./scripts/submitRestaurant-exec.php" id="resForm" method="post" name="resForm">
                  <div class="form-group">
                    <label for="exampleInputText">Name of place:</label>
                    <input type="text" class="form-control" id="resName" name="resName" placeholder="Enter the name of the restaurant" required>
                      <label for="exampleInputText">Address:</label>
                    <input type="text" class="form-control" id="resAddress" name="resAddress" placeholder="Enter the address of the restaurant" required>
                      <label for="exampleInputText">Phone Number:</label>
                    <input type="text" class="form-control" id="resPhone" name="resPhone" placeholder="Enter the phone number of the restaurant" required>
                      <label for="exampleInputText">Website Link:</label>
                    <input type="text" class="form-control" id="resLink" name="resLink" placeholder="Enter the restaurant's website URL" required>
                      <label style="color:black">Restaurant Photo:</label><input  type="file" onchange="uploadnav(this.files[0])">
                    <input type="link" class="form-control" name="IMGLink" id="IMGLinknav" placeholder="Or place image link here" required>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputText">Enter tags here, sepearated by a space:</label>
                    <input name="tags" id="singleFieldTags3" type="hidden" class="form-control" required>

                  </div>
                   
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            
          </div>
        </div>
      </div>
    </div>
<!-- End Creating restaurant Modal--->