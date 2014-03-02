<?php
  //Start session
  session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <script type="text/javascript">
//<![CDATA[
    (function() {
    var config = {
      kitId: 'xlf7ili',
      scriptTimeout: 3000
    };
    var h = document.getElementsByTagName('html')[0];
    h.className += ' wf-loading';
    var t = setTimeout(function() {
      h.className = h.className.replace(/(\s|^)wf-loading(\s|$)/g, ' ');
      h.className += ' wf-inactive';
    }, config.scriptTimeout);
    var d = false;
    var tk = document.createElement('script');
    tk.src = '//use.typekit.net/' + config.kitId + '.js';
    tk.type = 'text/javascript';
    tk.async = 'true';
    tk.onload = tk.onreadystatechange = function() {
      var rs = this.readyState;
      if (d || rs && rs != 'complete' && rs != 'loaded') return;
      d = true;
      clearTimeout(t);
      try { Typekit.load(config); } catch (e) {}
    };
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(tk, s);
    })();
  //]]>
  </script>
  <link href="./css/light.10423.css" rel="stylesheet" type="text/css" />

  <title></title>
</head>

<body class="" data-base="" id="body">
  <div class="uv-tab uv-slide-right" id="uvTab" style=
  "border-top-width: 1px; border-bottom-width: 1px; 
  border-left-width: 1px; border-style: solid none solid solid; 
  border-top-color: rgb(255, 255, 255); 
  border-bottom-color: rgb(255, 255, 255); 
  border-left-color: rgb(255, 255, 255); 
  border-top-left-radius: 4px; border-top-right-radius: 0px; 
  border-bottom-right-radius: 0px; border-bottom-left-radius: 4px; 
  -webkit-box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; 
  box-shadow: rgba(255, 255, 255, 0.247059) 1px 1px 1px inset, rgba(0, 0, 0, 0.498039) 0px 1px 2px; 
  font-style: normal; font-variant: normal; font-weight: bold; 
  font-size: 14px; line-height: 1em; font-family: Arial, sans-serif;
   position: fixed; right: 0px; top: 50%; z-index: 9999; 
   background-color: rgb(73, 0, 88); margin-top: -47px; 
   background-position: 50% 0px; background-repeat: no-repeat no-repeat;">
  <a href="javascript:return%20false;" id="uvTabLabel" style=
  "background-color: transparent; display:block;padding:10px 5px 10px 5px; text-decoration:none;">

  <img alt="Feedback"
    src="./images/feedback-tab.png" style="border:0; background-color: transparent; padding:0; margin:0;" /></a>
  </div>

    <?php
      // seperated navbar into a seperate file
      // easier to maintain and add to new files
      include_once('navbar.php');
    ?>

    <div class="container" id="main">
      <div class="row">
        <div class="col-span-12">
          <div class="com-header">
            <h1 class="h1"></h1>
          </div>

          <div class="mixed-feed" data-bind="hot-items-feed" data-gender="women" data-scroll="mixed-feed" id=
          "feed">
            <div class="col-span-3" data-hotitem="board,361370">
              <div class="shade2 board-preview">
                <div class="img-wrap">
                  <img alt="" src="./images/five_guys.jpeg" width="270" />

                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span data-link=
                      "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                      "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                      "/Looks/?searchstring=%23fashionblog">#highly
                      recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                      prices</span>
                    </div>
                  </div>

                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>

                <div class="info">
                  <div class="title h3">
                    <a><strong>Five Guys</strong></a>
                  </div>

                  <div class="heart">
                    <span>456</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-span-3" data-hotitem="board,361370">
              <div class="shade2 board-preview">
                <div class="img-wrap">
                  <img alt="" src="./images/chipotle.jpeg" width="270" />

                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span data-link=
                      "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                      "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                      "/Looks/?searchstring=%23fashionblog">#highly
                      recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                      prices</span>
                    </div>
                  </div>

                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>

                <div class="info">
                  <div class="title h3">
                    <a><strong>Chipotle</strong></a>
                  </div>

                  <div class="heart">
                    <span>396</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-span-3" data-hotitem="board,361370">
              <div class="shade2 board-preview">
                <div class="img-wrap">
                  <img alt="" src="./images/taco_bell.jpeg" width="270" />

                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span data-link=
                      "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                      "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                      "/Looks/?searchstring=%23fashionblog">#highly
                      recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                      prices</span>
                    </div>
                  </div>

                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>

                <div class="info">
                  <div class="title h3">
                    <a><strong>Taco Bell</strong></a>
                  </div>

                  <div class="heart">
                    <span>324</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-span-3" data-hotitem="board,361370">
              <div class="shade2 board-preview">
                <div class="img-wrap">
                  <img alt="" src="./images/chick_fil_a.jpeg" width="270" />

                  <div class="hover-tags">
                    <div class="bottom-tags">
                      <span data-link=
                      "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                      "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                      "/Looks/?searchstring=%23fashionblog">#highly
                      recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                      prices</span>
                    </div>
                  </div>

                  <div class="shop-label h6">
                    Top Rated
                  </div>
                </div>

                <div class="info">
                  <div class="title h3">
                    <a><strong>Chick-fil-A</strong></a>
                  </div>

                  <div class="heart">
                    <span>900</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3" data-hotitem="board,361370">
            <div class="shade2 board-preview">
              <div class="img-wrap">
                <img alt="" src="./images/mcdonalds.jpeg" width="270" />

                <div class="hover-tags">
                  <div class="bottom-tags">
                    <span data-link=
                    "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                    "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                    "/Looks/?searchstring=%23fashionblog">#highly
                    recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                    prices</span>
                  </div>
                </div>

                <div class="shop-label h6">
                  Top Rated
                </div>
              </div>

              <div class="info">
                <div class="title h3">
                  <a><strong>Mcdonalds</strong></a>
                </div>

                <div class="heart">
                  <span>968</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3">
            <div class="shade2 board-preview">
              <div class="img-wrap">
                <img alt="" src="./images/jamaican.jpeg" width="270" />

                <div class="hover-tags">
                  <div class="bottom-tags">
                    <span data-link=
                    "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                    "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                    "/Looks/?searchstring=%23fashionblog">#highly
                    recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                    prices</span>
                  </div>
                </div>

                <div class="shop-label h6">
                  Top Rated
                </div>
              </div>

              <div class="info">
                <div class="title h3">
                  <a><strong>Jamaican</strong></a>
                </div>

                <div class="heart">
                  <span>728</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3" data-hotitem="board,361370">
            <div class="shade2 board-preview">
              <div class="img-wrap">
                <img alt="" src="./images/kfc.jpeg" width="270" />

                <div class="hover-tags">
                  <div class="bottom-tags">
                    <span data-link=
                    "/Looks/?searchstring=%23casualook">#steak</span><span data-link=
                    "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                    "/Looks/?searchstring=%23fashionblog">#highly
                    recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                    prices</span>
                  </div>
                </div>

                <div class="shop-label h6">
                  Top Rated
                </div>
              </div>

              <div class="info">
                <div class="title h3">
                  <a><strong>KFC</strong></a>
                </div>

                <div class="heart">
                  <span>789</span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-span-3" data-hotitem="board,361370">
            <div class="shade2 board-preview">
              <div class="img-wrap">
                <img alt="" src="./images/apple_bees.jpeg" width="270" />

                <div class="hover-tags">
                  <div class="bottom-tags">
                    <span data-link="/Looks/?searchstring=%23casualook">#steak</span>
                    <span data-link=
                    "/Looks/?searchstring=%23blondie">#burgers</span><span data-link=
                    "/Looks/?searchstring=%23fashionblog">#highly
                    recommended</span><span data-link="/Looks/?searchstring=%23cool">#cheap
                    prices</span>
                  </div>
                </div>

                <div class="shop-label h6">
                  Top Rated
                </div>
              </div>

              <div class="info">
                <div class="title h3">
                  <a>apple <strong>bee's'</strong></a>
                </div>

                <div class="heart">
                  <span>374</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div id="push">
          <!--//-->
        </div>
      </div>

      <div id="footer">
        <div class="container">
          <div class="row">
            <div class="col-span-12"></div>
          </div>
        </div>

        <div class="modal fade in needsclick" data-bind="modal-wrapper" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content" data-bind="modal-content"></div>
          </div>
        </div><script src="./javascript/nr-100.js" type="text/javascript"></script>

        <div id="fb-root"></div><script src="./other/f635b54a4f" type="text/javascript"></script>
      </div>
    </div>
  </div>
</body>
</html>