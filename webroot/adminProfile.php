<?php

  //Start session
  session_start();

  // require('scripts/auth.php')
  require_once('scripts/params.php');
    
  // connect to db
  require('scripts/dbconnect.php');

  // include helper functions
  include_once('scripts/helper.php');

  $login = "";

  if(isset($_GET['userid'])){

      // set variable for which user's info to get
      $login = clean($_GET['userid']);
      // query to get data for user
      $qry="SELECT * FROM " . USER_TABLE . " WHERE login='$login'";

      $result=@mysql_query($qry);

      // if succeeded, set variables for the user
      if($result) {

        // verify that only 1 row is returned
        if(mysql_num_rows($result) == 1) {
          $member = mysql_fetch_assoc($result); 
          $firstname = $member['firstname'];
          $lastname = $member['lastname'];
          $login = $member['login'];
          $biography = $member['biography'];
          $gender = $member['gender'];
          $year = $member['yeararrived'];
          $member_id = $member['member_id'];
          $picture = $member['picture'];
        }
      }
  }
  else if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
    header("location: index.php");
    exit();
  }
  else{
    $firstname = $_SESSION['SESS_FIRST_NAME'];
    $lastname = $_SESSION['SESS_LAST_NAME'];
    $login = $_SESSION['SESS_LOGIN'];
    $biography = $_SESSION['SESS_BIO'];
    $gender = $_SESSION['SESS_GENDER'];
    $year = $_SESSION['SESS_YEAR_ARRIVED'];
    $member_id = $_SESSION['SESS_MEMBER_ID'];
    $picture = $_SESSION['SESS_PICTURE'];
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
  </head>
  <body class="makeBlue">
    
    <?php include_once('navbar.php') ?>
    <br>
    <h1></h1>
    <div class="container well" style="width:85%">
      <div class="row">
        <div class="col-sm-3 col-md-3">
          <img style="height:100%;width:100%" src=<?php echo "\"$picture\"" ?> class="img-circle">
          <br>
         <br>
        <button type="modal" onclick="getDesc()" style="width:100%;font-size:15px" class="btn btn-default" data-toggle="modal" data-target=".pop-up-1">
          <strong>Edit Profile
          </strong>
        </button>
        </div>
        <div class="col-sm-9 col-md-9">
          <h1 align="center"><?php echo $firstname . " " . $lastname ?></h1>
          <br>
          <h5>Username: <?php echo $login ?></h5>
          <h5>Gender: <?php echo $gender ?></h5>
          <h5>Year Arrived: <?php echo $year ?></h5>
           <br>
            <h5>Biography: </h5><h5 id="userBio"><?php echo $biography ?></h5>
            <br>
            <br>
          <div class="pull-left">
            <h6>Favorite Food Tags:</h6>
            <span class="label label-default">Vegan</span> 
            <span class="label label-primary label-default">Soup</span> 
            <span class="label label-success">Spiders</span>
          </div>
        </div>
      </div>
        
        
      <div class="row">
        <br>
        <hr>
        <p style="font-size:30px; color: #000000 !important;">Dashboard:</p><hr>
          
          
        
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter" style="background-color: white !important">
                <thead>
                  <tr>
                    <th>First Name: <i class="fa fa-sort"></i></th>
                    <th>Last Name: <i class="fa fa-sort"></i></th>
                    <th>Recent Post: <i class="fa fa-sort"></i></th>
                    <th>Flag: <i class="fa fa-sort"></i></th>
                    <th>Delete: <i class="fa fa-sort"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                  <tr>
                    <td>Sean</td>
                    <td>Last</td>
                    <td>KFC</td>
                    <td>
                        <span class="label label-warning">
                            <i class="glyphicon glyphicon-flag"> </i>
                        </span>
                    </td>
                    <td>
                        <span class="label label-danger">
                            <i class="glyphicon glyphicon-remove-circle"> </i>
                        </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>             
      </div>
        
        
      <div class="row">
        <br>
        <hr>
        <p style="font-size:30px; color: #000000 !important;">Recent posts:</p><hr>

        <?php 

            $qry = "SELECT R.title, R.resid, R.reviewdate, R.description, R.foodimage, R.tags, MR.name FROM " 
                    . RES_REVIEWS . " as R INNER JOIN " . RESTAURANT_TABLE 
                    . " as MR ON R.resid = MR.resid WHERE member_id='$member_id' ORDER BY reviewdate DESC LIMIT 5";

            $result=@mysql_query($qry);

            if($result){
              while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $resid = $row['resid'];
                $title = $row['title'];
                $name = $row['name'];
                $text = $row['description'];
                $reviewdate = explode(" ", $row['reviewdate']);
                $date = $reviewdate[0];
                $time = DATE("g:i a", STRTOTIME($reviewdate[1]));
                $image = $row['foodimage'];
                $tags = explode(",", $row['tags']);


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
            }
        ?>
      </div>
    </div>
      
<div class="modal fade pop-up-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Your Profile:</h4>
      </div>
      <div class="modal-body" style="font-size:18px">
          <label style="color:black">Change profile photo:</label><input  type="file" onchange="upload(this.files[0])">
        <input type="link" class="form-control" id="IMGLink" placeholder="Or place image link here" value="">
        <label style="color:black">Update Biography:</label>
        <form action="./scripts/profile-exec.php" id="bioForm" method="post" name="bioForm">
        <textarea id="editBio" name="editBio" rows="4" style="width:97%;"><?php echo $biography ?></textarea>
      <div class="modal-footer">
            <button type="button" class="btn btn-default" >Close</button>
             <button type="submit" class="btn btn-default">Save changes</button>
      </div><!-- /.modal-footer -->
         </form>
     </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <hr>
    
   
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/feedme.js"></script>
    <script src = "js/bootstrap.js"></script>
  </body>
</html>