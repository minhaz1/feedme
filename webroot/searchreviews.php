<?php 

// easily reusable to search any table. just pass in the table name
// and an array of the columns you watch to search
$results = search_perform(RES_REVIEWS, array('tags','description','title'), $_GET['q']);
$num_results = sizeof($results);
$reviewid = "";
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
    <div>
                <table class="table table-hover">
                  <tbody>
                
                <?php 

            foreach($results as $row){
			if($row['flags_count'] >= REVIEW_FLAGS_LIMIT){
				continue;
			}

            $resid = $row['resid'];
			$reviewid = $row['reviewid'];
			$text = $row['description'];
			$title = $row['title'];
			$tags = explode(",", $row['tags']);
			$image = $row['foodimage'];
			$reviewdate = explode(" ", $row['reviewdate']);
			$date = $reviewdate[0];
			$time = DATE("g:i a", STRTOTIME($reviewdate[1]));


                $tagstring = "";
                $count = 0;
                foreach($tags as $tag){
                  if($tag != "" && $count < 3)
                    $tagstring .= "<li><i class=\"fa fa-tags\"></i> <span><a href=\"search.php?q=$tag\"> $tag</a></span</li>";
                    $count = $count + 1;
                }

                  echo"<tr><td>
                        <div class=\"search-result row\">
                            <div class=\"col-xs-4 col-sm-4 col-md-4\">
                                <a href=\"$image\" title=\"$title\" class=\"thumbnail\">
                                <img src=\"$image\" alt=\"$title\" />
                                </a>
                            </div>
                            <div class=\"col-sm-4 col-md-2 hidden-xs\" style=\"padding: 0px; border-right:0px;\">
                              <ul class=\"meta-search\" style=\"padding: 2px; list-style: none;\">
                                <li><i class=\"fa fa-calendar\"></i> <span>$date</span></li>
                                <li><i class=\"fa fa-clock-o\"></i> <span>$time</span></li>
                                $tagstring
                              </ul>";

                      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_MOD){
                        echo "<a onclick=\"flag_review($reviewid)\" href=\"#\">
                            <i href=\"#\" class=\"glyphicon glyphicon-flag\"> </i>
                        </a>";
                      }

                      if($_SESSION['SESS_USERTYPE'] >= USERTYPE_ADMIN){
                        echo "
                        <a onclick=\"hide_review($reviewid)\" href=\"#\" style=\"font-color: white !important;\">
                          <i href=\"#\" class=\"glyphicon glyphicon-trash\"> </i>
                        </a>&nbsp;";
                      }

                       echo "</div><div class=\"col-xs-8 col-sm-4 col-md-6\" style=\"padding-left: 0px;\">
                            <h3 style=\"padding-top: 0px; margin-top:0px;\">
                              <a href=\"restaurant.php?resid=6\" title=\"\">
                                  $title
                              </a>
                            </h3>
                            <p class=\"hidden-xs hidden-sm\">$text</p>
                          </div>
                            
                        </div>
                    </td>
                  </tr>";

}?>
                       
                  </tbody>
                </table>
              </div>
</div>