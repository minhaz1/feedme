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
?>

    <div class="cmt-cnt">
    	<img src="<?php echo $picture ?>" alt="" />
		<div class="thecom">
	        <h5><?php echo $login ?></h5><span  class="com-dt"><?php echo date('d-m-Y H:i'); ?></span>
	        <br/>
	       	<p><?php echo $comment; ?></p>
	    </div>
	</div><!-- end "cmt-cnt" -->

	<?php } ?>
<?php endif; ?>