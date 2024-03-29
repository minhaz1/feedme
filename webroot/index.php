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

<script>
  function upvote(resid){
    var val = document.createElement("input");
    val.setAttribute("value", 1);
    processVote(val, resid);
  }

  function downvote(resid){
    var val = document.createElement("input");
    val.setAttribute("value", -1);
    processVote(val, resid);
  }

  function processVote(val, resid){

    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'scripts/vote.php');
    form.style.display = 'hidden';
    
    var action = document.createElement("input");
    action.setAttribute("type", "hidden");
    action.setAttribute("name", "page");
    action.setAttribute("value", "restaurant");

    var id = document.createElement("input");
    id.setAttribute("type", "hidden");
    id.setAttribute("name", "resid");
    id.setAttribute("value", resid);

    val.setAttribute("type", "hidden");
    val.setAttribute("name", "value");

    form.appendChild(action);
    form.appendChild(id);
    form.appendChild(val);
    document.body.appendChild(form);
    form.submit();
  }

</script>

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
            $qry = "";
            require('scripts/dbconnect.php');
            if(isset($_GET['q']) && $_GET['q'] == "popular"){
              $qry = "SELECT R.resid, R.name, R.image, R.upvotes FROM " . RESTAURANT_TABLE . " as R ORDER BY R.upvotes DESC";
            }
            else{
              $qry = "SELECT R.resid, R.name, R.image, R.upvotes FROM " . RESTAURANT_TABLE . " as R";
            }

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

              $resid = $row['resid'];
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

              echo "<div  class=\"col-lg-3 col-md-6 col-sm-6 col-xs-12 \">
              <div class=\"shade2 board-preview\">
                <a href=\"restaurant.php?resid=$resid\">
                  <!--<div class=\"img-wrap\">-->
                  <div class=\"img-wrap max-width img-index\">
                    <img src=\"$image\" class=\"img-responsive\" alt=\"\">
                  </div>
                </a>
                <div class=\"info\">
                  <div class=\"title\" id=\"h7\">
                    <a> <strong>$name</strong> </a>
                      <div class=\"likebutton pull-right\" id=\"h7\">";

                      if(isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] != ""){
                        // $member_id = $_SESSION['SESS_MEMBER_ID'];
                        echo "<a><i onclick=\"upvote('$resid')\" class=\"glyphicon glyphicon-thumbs-up\"></i></a> $upvotes 
                        <a><i onclick=\"downvote('$resid')\" class=\"glyphicon glyphicon-thumbs-down\"></i></a>";
                      }
                      else{
                        echo "<a><i class=\"glyphicon glyphicon-thumbs-up\"></i></a> $upvotes";
                      }
                        
                      echo
                    "</div>
                  </div>
                </div>
              </div>
            </div>"; 

              if($i == 3){
                $i = 0;
              }
              $i = $i + 1;   
            }
          ?>
          <!-- end PHP script -->
        </div>
      </div>
    </div>
    <!-- /container -->
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>