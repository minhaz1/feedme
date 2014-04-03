<?php
  //vStart session
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FeedMe</title>
  </head>
  <body>
    <?php include('navbar.php') ?>
    <!------------------------ Enters two spaces ------------------------>
    <div class="container">
      <br>
      <br>
    </div>
    <!------------------------ End of two spaces ------------------------>
    <div class="container">
      <div class="row">
        <div class ="col-sm-12">
          <!------------------------ First Item in row ------------------------> 
          <div  class="col-lg-3 col-md-6">
            <div class="shade2 board-preview">
              <a>
                <!--<div class="img-wrap">-->
                <div class="img-wrap max-width">
                  <img src="./img/five_guys.jpeg" class="img-responsive" alt="" width="270">
                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span>#steak</span>
                      <span>#burgers</span>
                      <span>#highly recommended</span>
                      <span>#cheap prices</span>
                    </div>
                  </div>
                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>
              </a>
              <div class="info">
                <div class="title" id="h7">
                  <a> <strong>Five Guys</strong> </a>
                  <div class="likebutton pull-right" id="h7">
                    <a><i class="glyphicon glyphicon-thumbs-up"></i></a> 87 
                    <a><i class="glyphicon glyphicon-thumbs-down"></i></a>
                  </div>
                </div>
                <!--<div class="heart">
                  <span>324</span>
                  <i class="icon-heart"></i>
                  </div>-->
              </div>
            </div>
          </div>
          <!------------------------ End of First Item ------------------------> 
          <!------------------------ Second Item in row ------------------------> 
          <div class="col-lg-3 col-md-6">
            <div class="shade2 board-preview">
              <a>
                <div class="img-wrap">
                  <img src="./img/chick_fil_a.jpeg" alt="" class="img-responsive" width="270">
                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span>#steak</span>
                      <span>#burgers</span>
                      <span>#highly recommended</span>
                      <span>#cheap prices</span>
                    </div>
                  </div>
                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>
              </a>
              <div class="info">
                <div class="title" id="h7">
                  <a> <strong>Chick-fil-A</strong> </a>
                  <div class="likebutton pull-right" id="h7">
                    <a><i class="glyphicon glyphicon-thumbs-up"></i></a> 65 
                    <a><i class="glyphicon glyphicon-thumbs-down"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!------------------------ End of Second Item ------------------------> 
          <!------------------------ Third Item in row ------------------------> 
          <div class="col-lg-3 col-md-6">
            <div class="shade2 board-preview">
              <a>
                <div class="img-wrap">
                  <img src="./img/taco_bell.jpeg" alt="" class="img-responsive" width="270">
                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span>#steak</span>
                      <span>#burgers</span>
                      <span>#highly recommended</span>
                      <span>#cheap prices</span>
                    </div>
                  </div>
                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>
              </a>
              <div class="info">
                <div class="title" id="h7">
                  <a> <strong>Taco Bell</strong> </a>
                  <div class="likebutton pull-right" id="h7">
                    <a><i class="glyphicon glyphicon-thumbs-up"></i></a> 43 
                    <a><i class="glyphicon glyphicon-thumbs-down"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!------------------------ End of Third Item ------------------------> 
          <!------------------------ Foruth Item in row ------------------------> 
          <div class="col-lg-3 col-md-6">
            <div class="shade2 board-preview">
              <a>
                <div class="img-wrap">
                  <img src="./img/mcdonalds.jpeg" alt="" class="img-responsive" width="270">
                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span>#steak</span>
                      <span>#burgers</span>
                      <span>#highly recommended</span>
                      <span>#cheap prices</span>
                    </div>
                  </div>
                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>
              </a>
              <div class="info">
                <div class="title" id="h7">
                  <a> <strong>Mcdonalds</strong> </a>
                  <div class="likebutton pull-right" id="h7">
                    <a><i class="glyphicon glyphicon-thumbs-up"></i></a> 23 
                    <a><i class="glyphicon glyphicon-thumbs-down"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!------------------------ End of Fourth Item ------------------------> 
        </div>
        <!-- /col-sm-12 -->
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
    <!-- Bootstrap core JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
</html>