<?php

  //Start session
  session_start();

  // require('scripts/auth.php');
    
  $login = "";

  if(!isset($_GET['userid'])){

    // if user is getting to profile.php without params or being logged in, redirect
    if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
      header("location: index.php");
      exit();
    }

    $firstname = $_SESSION['SESS_FIRST_NAME'];
    $lastname = $_SESSION['SESS_LAST_NAME'];
    $login = $_SESSION['SESS_LOGIN'];
    $biography = $_SESSION['SESS_BIO'];
    $gender = $_SESSION['SESS_GENDER'];
    $year = $_SESSION['SESS_YEAR_ARRIVED'];
    $member_id = $_SESSION['SESS_MEMBER_ID'];
  }
  else{
      // connect to db
      require('scripts/dbconnect.php');
      // set variable for which user's info to get
      $login = $_GET['userid'];
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
        }
      }
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
          <img style="height:100%;width:100%" src="https://pbs.twimg.com/profile_images/3778529164/544b976dc018444e4547dad4d5aabe7b.jpeg" class="img-circle">
         <br>
        <button type="modal" onclick="getDesc()" style="width:100%;font-size:15px" class="btn btn-default" data-toggle="modal" data-target=".pop-up-1"><strong>Edit Profile</strong></button>
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
            <span class="label label-default">Vegan</span> <span class="label label-primary label-default">Soup</span> <span class="label label-success">Spiders</span>
          </div>
        </div>
      </div>
      <div class="row">
        <br>
        <hr>
        <p style="font-size:30px">Recent posts:</p>
        <div>
          <span class="badge">Posted  on <a style="color:black" href="">Atwater's Catonsville,MD </a> on 2012-08-02 20:47:04</span>
        </div>
        <h1>Chicken Salad</h1>
        <p>Where do I start. This chicken salad is fantastic! The way the chicken meets the salad and the salad meets the chicken I indescribable! I almost felt like I was becoming one with the salad! Great job!</p>
        <hr>
        <span class="badge">Posted  on <a style="color:black" href="">KFC Towson,MD </a> on 2012-08-02 20:47:04</span>
        <h1>Drum Stick</h1>
        <p>I was extremely dissapointed in the Drum Sticks. I was playing the drums last week and broke my last drum stick. Worried, I went to KFC to get some more, but instead I was given a chicken leg. All I wanted was a new drum stick! AVOID!</p>
      </div>
    </div>
      
      <div class="modal fade pop-up-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Update Biography:</h4>
      </div>
      <div class="modal-body">
        <textarea id="editBio" rows="4" style="width:97%"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="updateBio()">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <hr>
    
    <script type="text/javascript">
function getDesc(){
  var x =document.getElementById("userBio");
  //alert(x.innerHTML); 
    document.getElementById('editBio').innerHTML = x.innerHTML;
}
        //updateBio will be done by server
  function updateBio(){
  var y =document.getElementById("editBio");
  //alert(y.innerHTML); 
    document.getElementById('userBio').innerHTML = y.innerHTML;
}      
        
        
</script>
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>
  </body>
</html>