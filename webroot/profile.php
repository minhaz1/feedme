
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
  $editProfile = 0;

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
          $usertype = $member['usertype'];
          $usertags = $member['tags'];

          if($_SESSION['SESS_LOGIN'] == $_GET['userid']){
            $editProfile = 1;
          }
        }
      }
  }
  else if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
    header("location: 404.php");
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
    $usertags = $_SESSION['SESS_TAGS'];
    $editProfile = 1;
  }

  // setting it so that the php knows there are reviews on this page
  $reviewid = "";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
      
      <!-- Stuff for tagging -->
      <link href="./css/jquery.tagit.css" rel="stylesheet" type="text/css">
      <link href="./css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">


      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript" charset="utf-8">        </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-  8"></script>

      <!-- The real deal -->
      <script src="./js/tag-it.js" type="text/javascript" charset="utf-8"></script>

      <!-- including a list of food tags for auto completion -->
      <script src="js/foodtags.js"></script>

<script>
        $(function(){
            // singleFieldTags2 is an INPUT element, rather than a UL as in the other 
            // examples, so it automatically defaults to singleField.
            $('#singleFieldTags1').tagit({
                availableTags: adjectives,
                removeConfirmation: true,
                readOnly: false,
                caseSensitive: false
            });

        });
</script>
      <!-- tagging stuff ends -->

  </head>
  <body class="makeBlue">

    <?php 
      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
        include_once("scripts/moderate_helper.php");     
      }
    ?>
    
    <?php include_once('navbar.php') ?>
    <br>
    <h1></h1>
    <div class="container well" style="width:85%">
      <div class="row">
        <div class="col-sm-3 col-md-3">picture
          <img style="height:100%;width:100%" src=<?php echo "\"$\"" ?> class="img-circle">
          <br>
         <br>
         <?php
          if($editProfile == 1){ 
            echo "<button type=\"modal\" onclick=\"getDesc()\" style=\"width:100%;font-size:15px\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\".pop-up-1\">";
            echo "<strong>Edit Profile</strong>";
            echo "</button>";
          }
        ?>
        </div>
        <div class="col-sm-9 col-md-9">
          <h1 align="center"><?php echo $firstname . " " . $lastname ?>
        
        <font size="5">
        <?php 
                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                  echo "<a onclick=\"flag_user('$login')\" href=\"#\">
                      <i href=\"#\" class=\"glyphicon glyphicon-flag\" title=\"Flag user\"> </i>
                  </a>";
                }

                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_ADMIN){
                  echo "
                  <a onclick=\"ban_user('$login')\" href=\"#\" style=\"font-color: white !important;\">
                    <i href=\"#\" class=\"glyphicon glyphicon-trash\" title\"Ban user\"></i>
                  </a>&nbsp;";
                }
        ?>
      </font>
          </h1>
          <br>
          <h4 align="center">Username: <?php echo $login ?></h4>

          <h4 align="center">Gender: <?php echo $gender ?></h4>
          <h4 align="center">Year Arrived: <?php echo $year ?></h4>
           <br>
            <h4 align="center">Biography: </h4><h4 id="userBio" align="center"><?php echo $biography ?></h4>
            <br>
          <div align="center">
            <h4>Favorite Food Tags:</h4>
            <?php 
              $temp = explode(",", $usertags);
              foreach ($temp as $value) {
                echo "<span class=\"label label-primary label-default\">$value</span>&nbsp";
              } 
            ?>
          </div>

        </div>

      </div>
      <div class="row">
        <br>
        <hr>
        <p style="font-size:30px; color: #000000 !important;">Recent posts:</p><hr>

        <?php 

            $qry = "SELECT R.title, R.reviewid, R.resid, R.reviewdate, R.description, R.foodimage, R.tags, MR.name FROM " 
                    . RES_REVIEWS . " as R INNER JOIN " . RESTAURANT_TABLE 
                    . " as MR ON R.resid = MR.resid WHERE member_id='$member_id' and flags_count < 3 ORDER BY reviewdate DESC LIMIT 5";

            $result=@mysql_query($qry);

            if($result){
              while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $resid = $row['resid'];
                $reviewid = $row['reviewid'];
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
                  "<article class=\"search-result row\">";

                  echo  "<div class=\"col-xs-12 col-sm-12 col-md-3\"><a href=\"$image\" title=\"$title\" class=\"thumbnail\"><img src=\"$image\" alt=\"$title\" /></a></div>
                    <div class=\"col-xs-12 col-sm-12 col-md-2\">
                      <ul class=\"meta-search\">
                        <li><i class=\"glyphicon glyphicon-calendar\"></i> <span>$date</span></li>
                        <li><i class=\"glyphicon glyphicon-time\"></i> <span>$time</span></li>
                        $tagstring";

                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                  echo "<br><a onclick=\"flag_review($reviewid)\" href=\"#\">
                      <i href=\"#\" class=\"glyphicon glyphicon-flag\"> </i>
                  </a>";
                }

                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_ADMIN){
                  echo "
                  <a onclick=\"hide_review($reviewid)\" href=\"#\" style=\"font-color: white !important;\">
                    <i href=\"#\" class=\"glyphicon glyphicon-trash\"> </i>
                  </a>&nbsp;";
                }
                    echo "</ul>
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
        <form action="./scripts/profile-exec.php" id="bioForm" method="post" name="bioForm">
          <label style="color:black">Change profile photo:</label><input  type="file" onchange="upload(this.files[0])">
        <input type="link" class="form-control" name="IMGLink" id="IMGLink" placeholder="Or place image link here" value="<?php echo $picture ?>">
        <label style="color:black">Update Biography:</label>
        <textarea id="editBio" name="editBio" rows="4" style="width:97%;"><?php echo $biography ?></textarea>
        <label style="color:black">Change Gender:</label>
          <select id="gender" name="editGender">
              <option value="<?php echo $gender ?>"><?php echo $gender ?></option>
              <option value="f">Female</option>
              <option value="m">Male</option>
          </select>
        <label style="color:black">Change Favorite Tags(Enter your favorite tags, separated by a space):</label>
        <input name="tags" id="singleFieldTags1" type="hidden" class="form-control" value="<?php echo $usertags ?>">

      <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-default">Save changes</button>
      </div><!-- /.modal-footer -->
         </form>
     </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <hr>
    
   
    <script src = "js/feedme.js"></script>
    <script src = "js/bootstrap.js"></script>
  </body>
</html>