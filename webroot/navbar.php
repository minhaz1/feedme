    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">

    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>

    <!-- <?php include_once('createRestaurant.php') ?> -->


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
                  <li><a href="#">Most Active Communities</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Food Types</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Popular</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Random</a></li>
                  <li class="divider"></li>
                  <!--<li><a href="#Submit" data-toggle="modal" data-target="#createrestaurant">Create a Resturant</a></li>
                  <li class="divider"></li> -->
                  <li><a href="profile.php">Profile</a></li>
                </ul>
            </li>
            <li>
                <form method="get" action='searchResults.php' style="padding: 10px 10px 0px 0px !important;">
                    <input type="text" id="q" name="q">
                    <input type="submit" hidden="true" value="Submit">
                </form>
            </li>
            <li>
                <button class="nav btn btn-default navbar-btn">
                            <i class="glyphicon glyphicon-search"></i>
                </button>
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
