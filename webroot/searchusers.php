<?php 
// easily reusable to search any table. just pass in the table name
// and an array of the columns you watch to search
$results = search_perform(USER_TABLE, array('email','firstname','lastname','login'), $_GET['q']);
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

<!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

 <!-- FeedME CSS -->
    <link href="./css/feedme_usersearch.css" rel="stylesheet" type="text/css">

        <div class="container">
            <div class="row">
    
            <?php 

            foreach($results as $row){
                // // normal users can't find banned users
                // if((!isset($_SESSION['SESS_USERTYPE']) || $_SESSION['SESS_USERTYPE'] == USERTYPE_NORMAL) && $row['flags_count'] >= REVIEW_FLAGS_LIMIT){
                //     continue;
                // }
                $login = $row['login'];
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $gender = $row['gender'];
                $yeararrived = $row['yeararrived'];
                $picture = $row['picture'];

                if($gender == ""){
                    $gender = "Not specified";
                }
                
            ?>

            <div class="col-xs-12 col-md-6">
                <div class="thumbnail clearfix">  
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="wrapper ">
                                <img href="index.php" src="<?php echo $picture;?>" class="img-responsive imageClip"  class="pull-left span2 clearfix" style='margin-right:10px'>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="caption" class="pull-left">
                                <h4>      
                                    <a href="profile.php?userid=<?php echo $login; ?>"><?php echo $firstname . " " . $lastname; ?></a>
                                </h4>
                                <medium class="hidden-xs"><b>Username: </b><?php echo $login; ?></medium><br class="hidden-xs" />
                                <medium class="hidden-xs"><b>Gender: </b><?php echo $gender; ?></medium><br class="hidden-xs" />
                                <medium class="hidden-xs"><b>Year Arrived: </b><?php echo $yeararrived; ?></medium><br class="hidden-xs" />
                            </div>
                        </div>
                    </div>
                </div> 
            </div>


            <?php } ?>


      
        </div>
    </div>
</div>