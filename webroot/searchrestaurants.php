<?php 

// easily reusable to search any table. just pass in the table name
// and an array of the columns you watch to search
$results = search_perform(RESTAURANT_TABLE, array('name','address','url','phone'), $_GET['q']);
$num_results = sizeof($results);
?>


<div class="container">
<br>
<hgroup class="mb20">
    <h1>Search Results</h1>
    <h2 class="lead">
        <strong class="text-danger">
            <?php echo $num_results?>
        </strong> results were found for the search for <strong class="text-danger"><?php echo $_GET['q']?></strong></h2>
</hgroup>

    <div class="container">

      <!--    Begin php script  -->
          <?php 

            $i = 0;
            $newRow = false;
            foreach($results as $row){

              $resid = $row['resid'];
              $name = $row['name'];
              $image = $row['image'];
              $upvotes = $row['upvotes'];

              if($i > 3){
                $i = 0;
              }
              if($i == 0){
                echo "<div class=\"row\">";
                echo "<div class =\"col-sm-12\">";
              }

              echo "<div  class=\"col-lg-3 col-md-6 col-sm-6 col-xs-12 \">
              <div class=\"shade2 board-preview\">
                <a href=\"restaurant.php?resid=$resid\">
                  <!--<div class=\"img-wrap\">-->
                  <div class=\"img-wrap max-width img-index\">
                    <img src=\"$image\" class=\"img-responsive\" alt=\"\">
                    <!--<div class=\"hover-tags\">
                      <div class=\"bottom-tags\">
                        <span>#steak</span>
                        <span>#burgers</span>
                        <span>#highly recommended</span>
                        <span>#cheap prices</span>
                      </div>
                    </div> -->
                    <div class=\"shop-label h6\">
                      Top Rated
                    </div>
                  </div>
                </a>
                <div class=\"info\">
                  <div class=\"title\" id=\"h7\">
                    <a> <strong>$name</strong> </a>
                    <div class=\"likebutton pull-right\" id=\"h7\">
                      <a><i class=\"glyphicon glyphicon-thumbs-up\"></i></a> $upvotes 
                      <a><i class=\"glyphicon glyphicon-thumbs-down\"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>"; 

              if($i == 3){
                echo "</div>";
                echo "</div>";
                $i = 0;
              }
              $i = $i + 1;   
            }
          ?>
          <!-- end PHP script -->
    </div>