<?php
  //verify they are logged in, if not redirect them to home
  require('scripts/auth.php');
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
        </div>
        <div class="col-sm-9 col-md-9">
          <h1 align="center"><?php echo $_SESSION['SESS_FIRST_NAME'] . " " . $_SESSION['SESS_LAST_NAME'] ?></h1>
          <br>
          <h5>Username: Spiderman123</h5>
          <h5>Gender: Male</h5>
          <h5>Year Arrived: 2011</h5>
          <h5>Biography: You're not going to believe me. My name is Peter Parker and I am the Spiderman. I live in Queens, NY. I am a science-whiz, and I live with my Uncle Ben and Aunt May. Oh, I dont eat food. I'm not quite sure why I'm here.</h5>
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
    <script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src = "js/bootstrap.js"></script>
  </body>
</html>