<!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">

  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>


<script>
//callback handler for form submit
$("#reviewForm").submit(function(e)
{
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData
    });
    e.preventDefault(); //STOP default action
    e.unbind(); //unbind. to stop multiple form submit.
});
 
$("#reviewForm").submit(); //Submit  the FORM
</script>

<?php 
  $title = "";
  if(!isset($_SESSION['SESS_MEMBER_ID'])){
    $title = "Please Login to post a review!";
  }
  else{
    $title = "Ate a new dish? Tell us about it";
  }
?>

    <!---Modal ---->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $title ?></h4>
          </div>
          <div class="modal-body">
          
          <?php 

            if(!isset($_SESSION['SESS_MEMBER_ID'])) {
              // Display a login dialog for the user if they are not logged in.
              echo 
                "<form action=\"./scripts/login-exec.php\" data-bind=\"login-form\" id=\"loginForm\" method=\"post\" name=\"loginForm\"novalidate=\"novalidate\">
                  <div class=\"control-group text-left\">
                    <label class=\"control-label\" for=\"username\">Username</label>
                    <input class=\"input-with-feedback\" id=\"login\" name=\"login\" type=\"text\" value=\"\" />
                  </div>
                  <div class=\"control-group text-left\">
                    <label class=\"control-label\" for=\"passwd\">Password</label>
                    <input class=\"input-with-feedback\" id=\"password\" name=\"password\" type=\"password\" />
                  </div>
                  <input id=\"ret\" name=\"ret\" type=\"hidden\" value=\"\" />
                </div>
                <div class=\"modal-footer\">
                <input class=\"btn btn-large btn-block mt\" type=\"submit\" value=\"Login!\" />
              </form>"; 
            }
            else{
              // user is logged in, so let them submit review
              echo "
                <form role=\"form\" action=\"./scripts/submitReview-exec.php\" id=\"reviewForm\" method=\"POST\" name=\"reviewForm\">
                  <div class=\"form-group model-test-feedme\">
                    <label for=\"exampleInputEmail1\"><h5>Title:</h5></label>
                    <input name=\"title\" type=\"text\" placeholder=\"e.g. The food was delicous\">
                  </div>
                  <div class=\"form-group\">
                    <label for=\"exampleInputPassword1\"><h5>Image Link:</h5></label>
                    <input  type=\"file\" onchange=\"upload(this.files[0])\">
                    <input name=\"IMGlink\" type=\"link\" class=\"form-control\" id=\"IMGLink\" placeholder=\"Or place image link here\" value=\"\">
                  </div>
                  <div>
                    <div align=\"center\">
                      <textarea style=\"resize:vertical;width:530px\" class=\"form-control\" placeholder=\"Write your item review here...(250 word Limit)\" maxlength=\"1000\" rows=\"5\"  name=\"review\" required></textarea>
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label for=\"exampleInputText\"><h5>Enter tags here, separated by a space:</h5></label>
                    <input type=\"text\" class=\"form-control\" id=\"exampleInputText\" placeholder=\"\">
                  </div>
                  <input type=\"hidden\" name=\"resid\" value=\"" . $_SESSION['resid'] . "\">
                  <button type=\"submit\" class=\"btn btn-default\">Submit</button>
                  <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>

                </form>";
            }

          ?>
          </div>
        </div>
      </div>
    </div>