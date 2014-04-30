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
    <link href="./css/feedme_subcomment.css" rel="stylesheet">
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

     <div class="container" style="padding-top: 20px; max-width: 500px !important;">
        <div class="row">
            <div class="panel panel-default widget bom">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span>
                    <h3 class="panel-title">
                        Recent Comments</h3>
                    
                    <a href="<?php echo "restaurant.php?resid=$resid"?>">
                        <button type="button" class="label label-info btn btn-primary" href="">Return
                        </button>
                      </a>
                </div>
                
                <div class="panel-heading">
                    <img class="img-responsive" style="width: 100% !important;" src="<?php echo $image ?>" />
                </div>
                
                <div class="panel-body" style="background-color: white !important; padding: 20px !important;">
                    <?php echo $review_text ?>
                </div>
                
                <div class="panel-body timeline-regiontags" style="background-color:#f4f4f4 !important; padding: 20px !important;">
                    <?php 

                        if(sizeof($tags_arr) != 0){
                            foreach($tags_arr as $tag){
                                echo "<a href=\"search.php?q=$tag\"><span class=\"label label-info pull-left\" style=\"margin:2px !important;\">$tag</span></a> ";
                            }
                        }
                    ?>
                    
                    <br>
                    <br>
                    
                    <span class="badge">Posted by 
                            <a style="color:black" href="profile.php?userid=<?php echo $username ?>"><?php echo $username ?> 
                            </a> <?php echo $date ?>
                    </span>
                </div>

                <div class="panel-body">
                        <?php 
                        require('scripts/dbconnect.php');
                        
                        $sql = mysql_query("SELECT C.comment, C.date, C.member_id, C.login, U.picture FROM comments as C INNER JOIN users AS U ON C.member_id = U.member_id WHERE reviewid='$reviewid'") or die(mysql_error());


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
                        <?php } ?>
                        
                        
                        <?php if(isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] != ""){ ?>                        
                            <div style="padding: 20px !important;">
                                    <div class="new-com-bt comment-post">
                                        <span>Write a comment ...</span>
                                    </div>
                                    
                                    <div class="new-com-cnt">
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