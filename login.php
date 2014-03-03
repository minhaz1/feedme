<?php
	session_start();

		//Check whether the session variable SESS_MEMBER_ID is present or not
	if(isset($_SESSION['SESS_MEMBER_ID'])) {
		header("location: index.php");
		exit();
	}

	function getErrs($field){
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ){								$ERRMSG_ARR = $_SESSION['ERRMSG_ARR'];
			if(isset($ERRMSG_ARR[$field])){
				echo " - <font color='red'>" . $ERRMSG_ARR[$field] . "</font>";
			}
		unset($ERRMSG_ARR[$field]);
		// unset($_SESSION['ERRMSG_ARR']);
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html class=
"wf-futurapt-n4-active wf-futurapt-n7-active wf-keplerstd-n4-active wf-keplerstd-n7-active wf-museosans-n3-active wf-museosans-n7-active wf-active"
xmlns="http://www.w3.org/1999/xhtml">
<head>

	<script>
<![CDATA[
	var urchinTracker=function(){},_gaq={push:function(){try {if(arguments[0][0]=='_link')window.location.href=arguments[0][1]}catch(er){}}},_gat={_createTracker:function(){}, _getTracker:function(){return{__noSuchMethod__:function(){},_link:function(o){if(o)location.href=o;},_linkByPost:function(){return true;},_getLinkerUrl:function(o){return o;},_trackEvent:function(){}}}};
	]]>
	</script>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

	<title>Login to FeedMe</title>
	<link href="./css/sty.10423.css" rel="stylesheet" type="text/css" />
</head>

<body class="" data-base="" id="body">
	<?php
	    include_once('navbar.php');
	?>
	
	<div class="clearpage container" id="wrapper">
		<div class="row clearpage-box">
			<div class="col-span-6 col-offset-3">
				<div class="com-header">
					<div class="h1">
						Login to FeedMe
					</div>
				</div>

				<div class="text-center">
					<div class="mt-large">
						<div class="btn btn-fb btn-icon btn-block btn-large icon-left" data-bind="facebook-signin">
							Facebook Login
						</div>
					</div>

					<div class="divider-stroked">
						<div class="divider"></div>

						<div class="h6">
							or
						</div>
					</div>

					<form action="./scripts/login-exec.php" data-bind="login-form" id="loginForm" method="post" name="loginForm"
					novalidate="novalidate">
						<div class="control-group text-left">
							<label class="control-label" for="username">Username
								<?php getErrs('login'); // check for errs?>
							</label> 
							<input class="input-with-feedback" id="login" name="login" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="passwd">Password 
								<?php getErrs('password'); // check for errs?>
							</label> 
							<input class="input-with-feedback" id="password" name="password" type="password" />

						</div><input id="ret" name="ret" type="hidden" value="" />

						<input class="btn btn-large btn-block mt" type="submit" value="Login!" />
					</form>

					<div class="h5 mt">
						<a href="register.php">Not a member? Join us!</a><br />
						<a>Forgotten your password?</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="push tiny"></div>

	<div class="modal fade in needsclick" data-bind="modal-wrapper" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content" data-bind="modal-content"></div>
		</div>
	</div>
	<?php unset($_SESSION['ERRMSG_ARR']); ?>
</body>
</html>