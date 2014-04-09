    <!---Modal ---->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Ate a new dish? Tell us about it</h4>
          </div>
          <div class="modal-body">
               <form role="form" action="./scripts/submitReview-exec.php" id="reviewForm" method="post" name="reviewForm">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Food Items:</label>
                    <input name="title" type="text" id="title" placeholder="Enter the food items">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Image Link:</label><input  type="file" onchange="upload(this.files[0])">
                    <input name="IMGlink" type="link" class="form-control" id="IMGLink" placeholder="Or place image link here" value="">
                  </div>
                  <div>
                    <div  align="center">
                        <textarea style="resize:vertical;width:530px" class="form-control" 
                                  placeholder="Write your item review here...(500 word Limit)" maxlength="500" rows="5"  name="review" required></textarea>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Enter tags here, separated by a space:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
                  </div>

                  <input type="hidden" name="resid" value=<?php echo "\"" .  $_SESSION['resid'] . "\""?>>                   
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>