<?php
  //vStart session
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FeedMe</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <!------------------------ Enters two spaces ------------------------>
    <div class="container">
      <br>
      <br>
    </div>
    <!------------------------ End of two spaces ------------------------>
    <div class="container">

      <!--    Begin php script  -->
          <?php 

            require('scripts/dbconnect.php');

            $qry = "SELECT R.name, R.image, R.upvotes FROM " . RESTAURANT_TABLE . " as R";
            $result = @mysql_query($qry);
            // Check result
            // This shows the actual query sent to MySQL, and the error. Useful for debugging.
            if (!$result) {
              $message  = 'Invalid query: ' . mysql_error() . "\n";
              $message .= 'Whole query: ' . $query;
              die($message);
            }

            $i = 0;
            $newRow = false;
            while($row = mysql_fetch_assoc($result)){

              $name = $row['name'];
              $image = $row['image'];
              $upvotes = $row['upvotes'];

              if($i > 3){
                $i = 0;
              }
              if($i == 0){
                echo "<div class=\"row\">";
                echo "<div class =\"col-sm-12\">";
              }

              echo "<div  class=\"col-lg-3 col-md-6\">
              <div class=\"shade2 board-preview\">
                <a>
                  <!--<div class=\"img-wrap\">-->
                  <div class=\"img-wrap max-width\">
                    <img src=\"$image\" class=\"img-responsive\" alt=\"\" width=\"270\">
                    <div class=\"hover-tags\">
                      <div class=\"bottom-tags\">
                        <span>#steak</span>
                        <span>#burgers</span>
                        <span>#highly recommended</span>
                        <span>#cheap prices</span>
                      </div>
                    </div>
                    <div class=\"shop-label h6\">
                      Top Rated
                    </div>
                  </div>
                </a>
                <div class=\"info\">
                  <div class=\"title\" id=\"h7\">
                    <a> <strong>$name</strong> </a>
                    <div class=\"likebutton pull-right\" id=\"h7\">
                      <a><i class=\"glyphicon glyphicon-thumbs-up\"></i></a> $upvotes 
                      <a><i class=\"glyphicon glyphicon-thumbs-down\"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>"; 

              if($i == 3){
                echo "</div>";
                echo "</div>";
                $i = 0;
              }
              $i = $i + 1;   
            }
          ?>
    </div>
    <!-- /container -->
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>