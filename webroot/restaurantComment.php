<?php
    session_start();
?>

<!doctype html>
<html><head>
<title>Restaurant View</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <!-- <link href="./css/styles.css" rel="stylesheet"> -->
    <!-- <link href="./css/style.css" type="text/css" rel="stylesheet"> -->
    <link href="./css/example.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    
    <script type="text/javascript">
		$(document).ready(function(){
    
		   $("#page1").click(function(){
                $('#digital_download').html('Downloading...'); // Show "Downloading..."
                // Do an ajax request
                $.ajax({
                  url: "resturantTimeLine.php?id=resturantTimeLineBody"
                }).done(function(data) { // data what is sent back by the php page
                  $('#resturantCommentBody').html(data); // display data
                });
		   });
		 });
	</script>
    
</head>


<body>
        
    
    <?php 
    // include navbar 
    include('navbar.php');

    // Connect to the database
    include('scripts/dbconnect.php'); 
    $id_post = "1"; //the post or the page id
    ?>

                    <!-- Start of Review -->
            <?php 
                $reviewid = $_GET['reviewid'];

                    //Create query
                $qry = "SELECT R.title, R.resid, R.reviewdate, R.member_id, R.description, R.foodimage, R.helpfulnessscore, R.tags, U.login
                        FROM " . RES_REVIEWS . " as R INNER JOIN " . USER_TABLE . " as U ON R.member_id = U.member_id WHERE R.reviewid='$reviewid'";

                $result=@mysql_query($qry);

                    //Check whether the query was successful or not
                if(!$result) {
                    echo "died";
                    die("Query failed". $qry);
                }

                $row = mysql_fetch_array($result, MYSQL_ASSOC);
                $image = $row['foodimage'];
                $review_text = $row['description'];
                $username = $row['login'];
                $date = $row['reviewdate'];
                $helpfulnessscore = $row['helpfulnessscore'];
                $tags = $row['tags'];
                $resid = $row['resid'];

                $tags_arr = explode(',', $tags);
     
            ?>

            <div class="com">
                  <div class="new-com-post">
                    <a href="<?php echo "restaurant.php?resid=$resid"?>">
                        <button type="button" class="btn btn-primary" href="">Return
                        </button>
                      </a>
                  </div>
                
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <img class="img-responsive" style="width: 100% !important;" src="<?php echo $image ?>" />

                    </div>
                    <div class="timeline-body">
                      <p><br><?php echo $review_text ?></b></p>

                    </div>

                    <div class="timeline-regiontags">
                    <?php 

                        if(sizeof($tags_arr) != 0){
                            foreach($tags_arr as $tag){
                                echo "<a href=\"searchResults.php?q=$tag\"><span class=\"label label-info\">$tag</span></a> ";
                            }
                        }
                    ?>
                    </div>
                      
                    <div class="timeline-info">
                        <span class="badge">Posted by 
                            <a style="color:black" href="profile.php?userid=<?php echo $username ?>"><?php echo $username ?> 
                            </a> <?php echo $date ?>
                        </span>
                    </div>
                      
                   <div class="timeline-footer">
                       <hr>
                        <?php 
                        require('scripts/dbconnect.php');

                        $sql = mysql_query("SELECT C.comment, C.date, C.member_id, C.login, U.picture FROM comments as C INNER JOIN users AS U ON C.member_id = U.member_id WHERE reviewid='$reviewid'") or die(mysql_error());;

                        while($affcom = mysql_fetch_assoc($sql)){ 
                            $comment = $affcom['comment'];
                            $reviewdate = explode(" ", $affcom['date']);
                            $member_id = $affcom['member_id'];
                            $login = $affcom['login'];
                            // $email = $_SESSION['SESS_EMAIL'];
                            $picture = $affcom['picture'];
                            $date = $reviewdate[0];
                            $time = DATE("g:i a", STRTOTIME($reviewdate[1]));
                        ?>
                            <div class="cmt-cnt new-com-org-review">
                                <a href="profile.php?userid=<?php echo $login ?>"><img src="<?php echo $picture ?>" /></a>
                                <div class="thecom">
                                    <a href="profile.php?userid=<?php echo $login ?>"><h5><?php echo $login ?></h5></a><span data-utime="1371248446" class="com-dt">&nbsp;<?php echo $time . " on " . $date; ?></span>
                                    <br/>
                                    <p><?php echo $comment; ?></p>
                                </div>
                            </div><!-- end "cmt-cnt" -->
                        <?php } ?>
                        
                        <?php if(isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] != ""){ ?>
                        <div class="new-com-org-review">
                            <div class="new-com-bt comment-post">
                                <span>Write a comment ...</span>
                            </div>
                            <div class="new-com-cnt">
                    <!--             <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
                                <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" /> -->
                                <textarea name="comment" id="comment" class="comment" placeholder="Write a comment ..."></textarea>
                                <br><br>
                                <div class="bt-add-com">Post comment</div>
                                <div class="bt-cancel-com">Cancel</div>
                            </div>
                        </div>    

                        <div class="clear"></div>
                        <?php } ?>
                    </div>
                  </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#comment').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.comment').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.comment').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.comment');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&reviewid='+<?php echo $reviewid; ?>+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>
    




</body>
</html>
        

<!-- <script src="./js/jquery.min.js"></script> -->
<script src="./js/bootstrap.js"></script>




</body></html>