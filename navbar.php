  <div id="wrapper">
    <div class="navbar active" data-bind="main-nav">
      <div class="container">
        <button class="navbar-toggle collapsed" data-target=".navbar-responsive-collapse" data-toggle=
        "collapse" style="font-weight: bold" type="button">×</button> <!-- Logo
  <img class="hidden-phone" alt="Logo" width="112" height="60">-->

        <div class="nav-collapse navbar-responsive-collapse collapse">
          <ul class="nav">
            <li class="active"><a href="index.php"><h1>FEEDME</h1></a></li>
<!--             <li class="active">
              <a href="index.php">Home</a>
            </li> -->
            <?php
            // if they are not logged in, show login/register
            if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID'])) == '') {
              echo 
              "<li>
              <a href=\"login.php\"> Login </a>
              </li>

              <li>
              <a href=\"register.php\"> Register </a>
              </li>";
            }
            else{
              // if they are logged in, show their name and logout
              echo "<li class=\"pull-right\"><a href=\"logout.php\">Logout</a></li>";
              echo "<li class=\"pull-right\"><a>" . $_SESSION['SESS_FIRST_NAME'] . "</a></li>";
            }

            ?>
          </ul>
        </div><!-- Mobile breadcrumb -->

        <div class="visible-phone" id="current"></div>

        <div id="search">
          <form action="" data-bind="main-search-submit">
            <input autocomplete="off" class="icon-search" data-bind="main-search-box" data-provide=
            "autocompleter" name="searchstring" type="text" />
          </form>
        </div>
      </div>
