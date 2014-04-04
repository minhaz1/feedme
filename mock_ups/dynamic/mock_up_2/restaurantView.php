<!doctype html>
<html><head>
<title>Restaurant View</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FeedME CSS -->
    <link href="./css/feedme.css" rel="stylesheet" type="text/css">
    <link href="./css/styles.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/style.css">
        <link type="text/css" rel="stylesheet" href="css/example.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
</head>


<body>
    
    
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
                </ul>
            </li>
          </ul>
            
          <a href="" class="pull-right navbar-text"><span>Login</span></a>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <!------------------------ End of Navbar ------------------------> 
    
    <!-- Modal -->
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
                    <label for="exampleInputEmail1">Food Items:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Image Link:</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div>
                    <div  align="center">
                        <textarea style="resize:vertical;width:530px" class="form-control" 
                                  placeholder="Write your item review here...(500 word Limit)" maxlength="500" rows="5"  name="review" required></textarea>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputEmail1">Enter tags here, sepearated by a space:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="">
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

    <!------------------------ Start Resturant Header ------------------------>
    <div class="container">
          
        <div class="container">
	       <div class="row well">
               
            <div class="col-md-12">
                <div class="panel panelResturant">
                </div>
                <div class="name">
                    KFC
                </div>
                
                <br><br><br>
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active">
                      <a href="#info" data-toggle="tab">
                          <i class="fa fa-envelope-o"></i> 
                          Info
                      </a>
                  </li>
                  
                  <li>
                      <a href="#Tags" data-toggle="tab">
                        <i class="fa fa-reply-all"></i> 
                        Tags
                      </a>
                  </li>
                    
                  <li>
                      <a href="#Rating" data-toggle="tab">
                          <i class="fa fa-file-text-o"></i> 
                          Rating
                      </a>
                  </li>
                  <li>
                      <a href="#Submit" data-toggle="modal" data-target="#myModal">
                          <i class="fa fa-file-text-o"></i> 
                          Submit Review
                      </a>
                  </li>
                </ul>
                
    
                <div class="tab-content">
                  <div class="tab-pane active" id="info">
                    <span type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                <h1>Atwater's Market</h1>
                                <cite>
                                    815 Frederick Road. Catonsville, Maryland 21228
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                </cite>
                        
                                <p>    
                                <i class="glyphicon glyphicon-envelope"></i>410-747-4120           
                                <br>

                                <i class="glyphicon glyphicon-globe"></i>
                                <a href="http://www.jquery2dotnet.com">
                                    http://www.atwaters.biz/
                                </a>
                                <br>
                            </div>
                        </div>
                    </span>
                  </div>


                  <div class="tab-pane " id="Tags">
                    <a type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                This is the message body1
                            </div>
                        </div>
                    </a>
                  </div>


                 <div class="tab-pane" id="Rating">
                    <span type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm resturant-sub" 
                             role="toolbar"  style="margin:0px;">
                            <div id="a1" class="btn-group col-md-12">
                                
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-lg-6 text-center">
                                        <h1 class="rating-num">4.0</h1>
                                        <div class="rating">
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star"></span>
                                            <span class="glyphicon glyphicon-star-empty"></span>
                                        </div>
                                        <div>
                                            <span class="glyphicon glyphicon-user"></span>1,050,008 total
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">
                                        <div class="row rating-desc">
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>5
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress progress-striped">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                        <span class="sr-only">80%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------ end 5 --------------------------------------->

                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>4
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                        <span class="sr-only">60%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 4 --------------------------------------->
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>3
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                        <span class="sr-only">40%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 3 --------------------------------------->
                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>2
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                        <span class="sr-only">20%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!------------------------ end 2 --------------------------------------->

                                            <div class="col-xs-3 col-md-3 text-right">
                                                <span class="glyphicon glyphicon-star"></span>1
                                            </div>
                                            <div class="col-xs-8 col-md-9">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                                                        <span class="sr-only">15%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------------------ end 1 --------------------------------------->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    </span>
                 </div>

                </div>

            </div>
	       </div>
    
    
          </div>
        </div>
        
          

          
        <div class="container">

            <ul class="timeline">
                <!-- Start of Review -->
                <li>
                  <div class="timeline-badge primary">
                      <a>
                        <i class="glyphicon glyphicon-record" rel="tooltip" title="11 hours ago via Twitter" id="">
                        </i>
                      </a>
                  </div>
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <img class="img-responsive" src="./img/kfc_review_1.jpg" />

                    </div>
                    <div class="timeline-body">
                      <p>KFC's Boneless Chicken is a skinless, boneless take on their bone-in Original Recipe fried chicken. According to their research, a majority of people like boneless chicken and this is their effort to appeal to those folks, notwithstanding the fact that they offer chicken strips and have offered a Boneless Filet in the past. a song at the end of the show).</p>

                    </div>

                    <div class="timeline-regiontags">
                            <span class="label label-default">alice</span> 
                            <span class="label label-primary">story</span> 
                            <span class="label label-success">blog</span> 
                            <span class="label label-info">personal</span> 
                            <span class="label label-warning">Warning</span>
                            <span class="label label-danger">Danger</span>
                    </div>
                      
                    <div class="timeline-info">
                        <span class="badge">Posted by <a style="color:black" href="">Dolan </a> on 2012-08-02 20:47:04</span>
                    </div>
                      
                   <div class="timeline-footer">
                        <a><i class="glyphicon glyphicon-thumbs-up"></i> 233</a>
                        <a class="pull-right">Comment</a>
                    </div>
                  </div>
                </li>

                <!-- Start of Review -->
                <li  class="timeline-inverted">
                  <div class="timeline-badge primary"><a><i class="glyphicon glyphicon-record invert" rel="tooltip" title="11 hours ago via Twitter" id=""></i></a></div>
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <img class="img-responsive" src="./img/kfc_review_2.jpg" />

                    </div>
                    <div class="timeline-body">
                      <p>The white meat Boneless Chicken is pretty much the spiritual successor to the Boneless Filet. The breading is not as greasy and noticeably drier than its bone-in counterpart. The lack of fatty skin accounts for the breading's dry aspect. On the plus side, unlike bone-in fried chicken, it's unlikely that you'll have any grease on your face afterwards.</p>

                    </div>
                      
                    <div class="timeline-regiontags">
                            <span class="label label-default">alice</span> 
                            <span class="label label-primary">story</span> 
                            <span class="label label-success">blog</span> 
                            <span class="label label-info">personal</span> 
                            <span class="label label-warning">Warning</span>
                            <span class="label label-danger">Danger</span>
                    </div>
                      
                    <div class="timeline-info">
                        <span class="badge">Posted by <a style="color:black" href="">Dolan </a> on 2012-08-02 20:47:04</span>
                    </div>
                      
                   <div class="timeline-footer">
                        <a><i class="glyphicon glyphicon-thumbs-up"></i> 344</a> 
                        <a class="pull-right">Comment</a>
                    </div>
                  </div>
                </li>

                <li class="clearfix" style="float: none;"></li>
            </ul>
        </div>
    
    <?php 
// Connect to the database
include('config.php'); 
$id_post = "1"; //the post or the page id
?>
    



        
<div class="cmt-container" >
<img class="img-responsive" src="./img/kfc_review_2.jpg" />
    <br></br>
    <span class="badge">Posted by <a style="color:black" href="">Dolan </a> on 2012-08-02 20:47:04</span>
    
          <p><br>KFC's Boneless Chicken is a skinless, boneless take on their bone-in Original Recipe fried chicken. According to their research, a majority of people like boneless chicken and this is their effort to appeal to those folks, notwithstanding the fact that they offer chicken strips and have offered a Boneless Filet in the past. a song at the end of the show</b></p>

    
    
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
    <div class="cmt-cnt">
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


    <div class="new-com-bt">
        <span>Write a comment ...</span>
    </div>
    <div class="new-com-cnt">
        <input type="text" id="name-com" name="name-com" value="" placeholder="Your name" />
        <input type="text" id="mail-com" name="mail-com" value="" placeholder="Your e-mail adress" />
        <textarea class="the-new-com"></textarea>
        <div class="bt-add-com">Post comment</div>
        <div class="bt-cancel-com">Cancel</div>
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->


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
        
    
    <button id="hide">Hide</button>
<button id="show">Show</button>


<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.js"></script>




</body></html>