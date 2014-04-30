
<style type="text/css">
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
</style>

<script>
  function upvote(resid, member_id){
    var val = document.createElement("input");
    val.setAttribute("value", 1);
    processVote(val, resid, member_id);
  }

  function processVote(val, reviewid, member_id){

    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'scripts/vote.php');
    form.style.display = 'hidden';
    
    var action = document.createElement("input");
    action.setAttribute("type", "hidden");
    action.setAttribute("name", "page");
    action.setAttribute("value", "review");

    var id = document.createElement("input");
    id.setAttribute("type", "hidden");
    id.setAttribute("name", "reviewid");
    id.setAttribute("value", reviewid);

    val.setAttribute("type", "hidden");
    val.setAttribute("name", "value");

    form.appendChild(action);
    form.appendChild(id);
    form.appendChild(val);
    document.body.appendChild(form);
    form.submit();
  }

</script>

<script type="text/javascript">
	$(document).ready(function(){

	   $("#reviewIDA").click(function(){
            $('#digital_download').html('Downloading...'); // Show "Downloading..."
            // Do an ajax request
            $.ajax({
              url: "resturantTimeLine.php?id=resturantCommentBody"
            }).done(function(data) { // data what is sent back by the php page
              $('#restaurantTimeLineBody').html(data); // display data
            });
	   });

	   $("#reviewIDB").click(function(){
            $('#digital_download').html('Downloading...'); // Show "Downloading..."
            // Do an ajax requestb
            $.ajax({
              url: "restaurantComment.php?id=resturantCommentBody"
            }).done(function(data) { // data what is sent back by the php page
              $('#restaurantTimeLine').html(data); // display data
            });
	   });
	 });
</script>

<body>
        
    <?php 
        // declaring for moderation stuff
        $reviewid = "";

        if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
            include_once("scripts/moderate_helper.php");     
        }

        // Connect to the database
        include('scripts/dbconnect.php'); 

        $id_post = "1"; //the post or the page id
    ?>

          <div class="container" id="resturantTimeLineBody">

            <ul class="timeline">
                <!-- Start of Review -->
            <?php 
                // $resid = $_SESSION['resid'];

                    //Create query
                $qry = "SELECT R.title, R.flags_count, R.reviewid, R.reviewdate, R.member_id, R.description, 
                        R.foodimage, R.helpfulnessscore, R.tags, U.login FROM " . 
                        RES_REVIEWS . " as R INNER JOIN " . USER_TABLE . 
                        " as U ON R.member_id = U.member_id WHERE resid='$resid' AND R.flags_count < " . REVIEW_FLAGS_LIMIT . " ORDER BY reviewdate DESC LIMIT 10";

                $result=@mysql_query($qry);

                    //Check whether the query was successful or not
                if(!$result) {
                    die("Query failed". $qry);
                }

                $inverted = False;
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $image = $row['foodimage'];
                    $review_text = $row['description'];
                    $username = $row['login'];
                    $date = $row['reviewdate'];
                    $helpfulnessscore = $row['helpfulnessscore'];
                    $tags = $row['tags'];
                    $reviewid = $row['reviewid'];

                    $tags_arr = explode(',', $tags);
                    
                    if($inverted == False){
                        $side = "";
                        $inverted = True;
                    }
                    else{
                        $side = "timeline-inverted";
                        $inverted = False;
                    }

                    echo "<li class=\"" . $side . "\">
                            <div class=\"timeline-badge primary\">
                                <a>
                                    <i class=\"glyphicon glyphicon-record\" rel=\"tooltip\" title=\"" . $date . "\" id=\"\"></i>
                                </a>
                            </div>
                            <div class=\"timeline-panel\">
                                <div class=\"timeline-heading\">
                                    <img class=\"img-responsive\" src=\"" . $image . "\" width=\"100%\" />
                                </div>
                                <div class=\"timeline-body\">
                                    <p>" . $review_text . ".</p>
                                </div>";

                                if(sizeof($tags_arr) != 0){
                                    echo "<div class=\"timeline-regiontags\">";

                                    foreach($tags_arr as $tag){
                                        echo "<a href=\"search.php?q=$tag\"><span class=\"label label-info\">$tag</span></a> ";
                                    }
                                    echo "</div>";
                                }
                                    
                                echo
                                "<div class=\"timeline-info\">
                                    <span class=\"badge\">
                                        Posted by <a style=\"color:black\" href=\"profile.php?userid=" . $username . "\">" . $username . " </a> <span class=\"hidden-xs\">on " . $date . "</span>
                                    </span> </div>
                                <div class=\"timeline-footer\">
                                    <a>";
                                if(isset($_SESSION['SESS_MEMBER_ID']) && $_SESSION['SESS_MEMBER_ID'] != ""){
                                    echo  "<i onclick=\"upvote($reviewid)\" class=\"glyphicon glyphicon-thumbs-up\"></i>" . $helpfulnessscore . "</a>";
                                }
                                else{
                                    echo "<i class=\"glyphicon glyphicon-thumbs-up\"></i>" . $helpfulnessscore . "</a>";
                                }

                                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_ADMIN){
                                  echo "&nbsp;&nbsp;
                                  <a onclick=\"hide_review($reviewid)\" href=\"#\" style=\"font-color: white !important;\">
                                    <i class=\"glyphicon glyphicon-trash\" title=\"Remove review\"> </i>";
                                }
                                if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                                  echo "</a>&nbsp;
                                  <a onclick=\"flag_review($reviewid)\" href=\"#\">
                                      <i class=\"glyphicon glyphicon-flag\" title=\"Flag review\"> </i>
                                  </a>";
                                }

                            echo "<a class=\"pull-right\" id=\"reviewIDB\" href=\"restaurantComment.php?reviewid=$reviewid\">Comment</a>
                                </div>
                            </div>
                        </li>";

                }
            ?>


                <li class="clearfix" style="float: none;"></li>
            </ul>
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