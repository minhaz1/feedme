
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
    
    <!-- ----------------------------- -->  
    <!-- Need for the new profile page -->
    <!-- ----------------------------- -->  
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./font-awesome-4.0.3/css/font-awesome.css">
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){ 
            $("#myTab a").click(function(e){
                e.preventDefault();
                $(this).tab('show');
            });
        });
    </script>
          

  </head>
  <body class="makeBlue">

    <?php 
      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
        include_once("scripts/moderate_helper.php");     
      }
    ?>
    
    <?php include_once('navbar.php') ?>
    <br>

<div class="container">
    <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
          <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading">Profile&nbsp;
              </div>

              <!-- List group -->
              <ul class="list-group">
                  <li class="list-group-item"><center><img title="profile image" class="img-circle img-responsive" src=<?php echo "\"$picture\"" ?>>
         <?php
          if($editProfile == 1){ 
            echo "<button type=\"modal\" onclick=\"getDesc()\" style=\"width:100%;font-size:12px\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\".pop-up-1\">";
            echo "<strong>Edit Profile</strong>";
            echo "</button>";
          }
        ?>



            </center></li>
           <li class="list-group-item text-right"><span class="pull-left"><strong>User name</strong></span> <?php echo $login ?></li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Gender: </strong></span> <?php echo $gender ?></li>
           <li class="list-group-item text-right"><span class="pull-left"><strong>Year Arrived: </strong></span> <?php echo $year ?></li>
          <li class="list-group-item text-right"><span class="pull-left"><strong>Real name</strong></span> <?php echo $firstname . " " . $lastname ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Biography: </strong></span> <?php echo $biography ?></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Food Tags: </strong></span>
              <?php 
                $temp = explode(",", $usertags);
                foreach ($temp as $value) {
                  echo "<a href=\"search.php?q=$value\"><span class=\"label label-primary label-default\">$value</span></a>&nbsp ";
                } 
              ?>
            </li>
        </ul>
      </div> 
      
               
          <div class="panel panel-default">
            <div class="panel-heading">Social Media</div>
            <div class="panel-body">
            	<i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
            </div>
          </div>
          
        </div><!--/col-3-->
    	<div class="col-sm-9">
          
          <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#home" data-toggle="tab">Home</a></li>

          </ul>
              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
              
              <hr>
              
              <h4>Recent Activity</h4>
                
              <div>
                <table class="table table-hover">
                  <tbody>
                
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
                $count = 0;
                foreach($tags as $tag){
                  if($tag != "" && $count < 3)
                    $tagstring .= "<li><i class=\"fa fa-tags\"></i> <span><a href=\"search.php?q=$tag\"> $tag</a></span</li>";
                    $count = $count + 1;
                }

                  echo"<tr><td>
                        <div class=\"search-result row\">
                            <div class=\"col-xs-4 col-sm-4 col-md-4\">
                                <a href=\"$image\" title=\"$title\" class=\"thumbnail\">
                                <img src=\"$image\" alt=\"$title\" />
                                </a>
                            </div>
                            <div class=\"col-sm-4 col-md-2 hidden-xs\" style=\"padding: 0px; border-right:0px;\">
                              <ul class=\"meta-search\" style=\"padding: 2px; list-style: none;\">
                                <li><i class=\"fa fa-calendar\"></i> <span>$date</span></li>
                                <li><i class=\"fa fa-clock-o\"></i> <span>$time</span></li>
                                $tagstring
                              </ul>";

                      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                        echo "<a onclick=\"flag_review($reviewid)\" href=\"#\">
                            <i href=\"#\" class=\"glyphicon glyphicon-flag\"> </i>
                        </a>";
                      }

                      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_ADMIN){
                        echo "
                        <a onclick=\"hide_review($reviewid)\" href=\"#\" style=\"font-color: white !important;\">
                          <i href=\"#\" class=\"glyphicon glyphicon-trash\"> </i>
                        </a>&nbsp;";
                      }

                       echo "</div><div class=\"col-xs-8 col-sm-4 col-md-6\" style=\"padding-left: 0px;\">
                            <h3 style=\"padding-top: 0px; margin-top:0px;\">
                              <a href=\"restaurant.php?resid=6\" title=\"\">
                                  $title
                              </a>
                            </h3>
                            <p class=\"hidden-xs hidden-sm\">$text</p>
                          </div>
                            
                        </div>
                    </td>
                  </tr>";


                
                }
              }
          ?>
                       
                  </tbody>
                </table>
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
                            <option value="<?php echo $gender ?>"><?php if($gender == 'm'){echo "Male";}else{echo "Female";} ?></option>
                            <option value="f"><?php if($gender == 'm'){echo "Female";}else{echo "Male";} ?></option>
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

          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
    
<script src = "js/feedme.js"></script>
    <script src = "js/bootstrap.js"></script>

</body>
</html>