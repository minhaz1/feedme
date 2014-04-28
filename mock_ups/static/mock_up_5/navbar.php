
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>


    <!------------------------ Start of Navbar ------------------------>
    <div class="navbar navbar-inner navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="">FeedMe</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href=""><span>Home</span></a></li>
            <li><a href=""><span>About</span></a></li>
            <li><a href=""><span>Contact</span></a></li>
              
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">FeedMe Quick <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Most Active Communities</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Food Types</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Popular</a></li>
                  <li class="divider"></li>
                  <li><a href="#">Random</a></li>
                    <li class="divider"></li>
                  <li><a href="#Submit" data-toggle="modal" data-target="#myModal"></a></li>   
                </ul>
            </li>
          </ul>
            
          <a href="" class="pull-right navbar-text"><span>Login</span></a>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<!------------------Create Restaurant----------------->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Ate a new dish? Tell us about it</h4>
          </div>
          <div class="modal-body">
               <form role="form">
                  <div class="form-group">
                    <label for="exampleInputText">Food Items:</label>
                    <input type="text" class="form-control" id="exampleInputText" placeholder="Enter the food items">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Image Link:</label><input  type="file" onchange="upload(this.files[0])">
                    <input type="link" class="form-control" id="IMGLink" placeholder="Or place image link here" value="">
                  </div>
                  <div>
                    <div  align="center">
                        <textarea style="resize:vertical;width:530px" class="form-control" 
                                  placeholder="Write your item review here...(500 word Limit)" maxlength="500" rows="5"  name="review" required></textarea>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputText">Enter tags here, sepearated by a space:</label>
                    <input type="text" class="form-control" id="exampleInputText" placeholder="">
                  </div>
                   
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