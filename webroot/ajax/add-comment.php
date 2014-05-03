<?php
session_start();

if($_POST['act'] == 'add-com'):
    $comment = $_POST['comment'];
	$reviewid = $_POST['reviewid'];

    // Connect to the database
	include('../scripts/dbconnect.php'); 
	
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/
	$default = "mm";
	$size = 35;

	$member_id = $_SESSION['SESS_MEMBER_ID'];
	$email = $_SESSION['SESS_EMAIL'];
	$login = $_SESSION['SESS_LOGIN'];
	$picture = $_SESSION['SESS_PICTURE'];

	// $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . $default . "&s=" . $size;

	if(strlen($login) <= '1'){ $login = 'Guest';}
    //insert the comment in the database
    mysql_query("INSERT INTO comments (member_id, login, reviewid, comment)VALUES( '$member_id','$login', '$reviewid', '$comment')");
    if(!mysql_errno()){
    	date_default_timezone_set('US/Eastern');
    	$comment_date = explode(" ", DATE('d-m-Y H:i'));
    	$date = $comment_date[0];
    	$time = DATE("g:i a", STRTOTIME($comment_date[1]));
?>

<div class="row" style="padding: 15px !important;">
     <div class="col-xs-2 col-md-2">
          <a href="profile.php?userid=<?php echo $login ?>"><img src="<?php echo $picture ?>" class="img-circle img-responsive" alt="" /></a></div>
     	       <div class="col-xs-10 col-md-10">
                    <div>
              	          <div class="mic-info">
			       By: <a href="profile.php?userid=<?php echo $login ?>"><?php echo $login ?></a> at &nbsp;<?php echo $time . " on " . $date; ?>
                          </div>
                    </div>
		    <div class="comment-text">
       		    	 <?php echo $comment; ?>
                    </div>
               </div>
     </div>
     <hr style="width: 90% !important; margin: 10px !important;">
</div>

<!-- old stuff
    <div class="cmt-cnt">
    	<img src="<?php echo $picture ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $login ?></h5><span  class="com-dt"><?php echo "$time on $date" ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div>
-->
	<?php } ?>
<?php endif; ?>