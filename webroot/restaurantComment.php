<!doctype html>
<html><head>
<title>Restaurant View</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <link href="./css/styles.css" rel="stylesheet">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="css/example.css" type="text/css" rel="stylesheet">
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
    // Connect to the database
    include('config.php'); 
    $id_post = "1"; //the post or the page id
    ?>
    
    <div class="containers" id="resturantCommentBody">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-2 col-xs-1 col-md-3 col-sm-3 ">
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-8 col-xs-10 col-md-6 col-sm-6">
            
            
            <div class="cmt-containers" >
                <div class="new-com-post">
                    <button type="button" class="btn btn-primary" id="page1" href="#">Return</button>
            </div>
                <img class="img-responsive" src="./img/kfc_review_2.jpg" />
                <br></br>
            
            <div class="new-com-post">
                            <span class="label label-default">alice</span> 
                            <span class="label label-primary">story</span> 
                            <span class="label label-success">blog</span> 
                            <span class="label label-info">personal</span> 
                            <span class="label label-warning">Warning</span>
                            <span class="label label-danger">Danger</span>
                    </div>
            <div class="new-com-post">
                <span class="badge">Posted by <a style="color:black" href="">Dolan </a> on 2012-08-02 20:47:04</span>
            </div>
            
            <div class="new-com-org-review">
                    <p><br>KFC's Boneless Chicken is a skinless, boneless take on their bone-in Original Recipe fried chicken. According to their research, a majority of people like boneless chicken and this is their effort to appeal to those folks, notwithstanding the fact that they offer chicken strips and have offered a Boneless Filet in the past. a song at the end of the show</b></p>
             </div>
    
    
    <hr>
    <?php 
    $sql = mysql_query("SELECT * FROM comments WHERE id_post = '$id_post'") or die(mysql_error());;
    while($affcom = mysql_fetch_assoc($sql)){ 
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
        $default = "mm";
        $size = 35;
        $grav_url = "http://www.gravatar.com/avatar/".md5(strtolower(trim($email)))."?d=".$default."&s=".$size;

    ?>
    <div class="cmt-cnt new-com-org-review">
        <img src="<?php echo $grav_url; ?>" />
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
    <?php } ?>

    <div class="new-com-org-review">
        <div class="new-com-bt comment-post">
            <span>Write a comment ...</span>
        </div>
        <div class="new-com-cnt">
            <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
            <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" />
            <textarea class="the-new-com"></textarea>
            <div class="bt-add-com">Post comment</div>
            <div class="bt-cancel-com">Cancel</div>
        </div>
    </div>    
        
    <div class="clear"></div>
    </div><!-- end of comments container "cmt-container" -->
            
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-2 col-xs-1 col-md-3 col-sm-3">
      </div><!-- /.row -->
    </div>
</div>

<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('You need to write a comment!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                    data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
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
        

<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>




</body></html>