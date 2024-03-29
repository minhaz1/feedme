<?php
	session_start();

	// contains helper function
	include_once('scripts/helper.php');

	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(isset($_SESSION['SESS_MEMBER_ID'])) {
		header("location: index.php");
		exit();
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html class=
"wf-futurapt-n4-active wf-futurapt-n7-active wf-keplerstd-n4-active wf-keplerstd-n7-active wf-museosans-n3-active wf-museosans-n7-active wf-active"
xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

	<title>Join FeedMe</title>
	<link href="./css/sty.10423.css" rel="stylesheet" type="text/css" />
</head>

<body class="" data-base="" id="body">
	<?php
		// show navigation bar
		include_once('navbar.php');
	?>
	<div class="clearpage container" id="wrapper" style="font-size:155% !important;">
		<div class="row clearpage-box">
			<div class="col-span-6 col-offset-3">
				<div class="com-header">
					<div class="h1">
						Join FeedMe
					</div>

					<div class="h4">
						Discover what eating around UMBC is like.
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

					<form action="./scripts/register-exec.php" id="loginForm" method="post" name="loginForm">
						<div class="control-group text-left">
							<label class="control-label" for="email"> Email
							<?php getErrs('email'); // check for errs?>
							</label> <input class="input-with-feedback"
							id="email" name="email" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="username">Username
								<?php getErrs('login'); // check for errs?>
							</label> <input class="input-with-feedback" id="login" name="login" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="fname">First name
								<?php getErrs('fname'); // check for errs?>
							</label> 
							<input class="input-with-feedback" id="fname" name="fname" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="lname">Lastname
								<?php getErrs('lname'); // check for errs?>
							</label> <input class=
							"input-with-feedback" id="lname" name="lname" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="passwd">Password
								<?php getErrs('password'); // check for errs?>
							</label> <input class=
							"input-with-feedback" id="password" name="password" type="password" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="passwd">Confirm Password</label> <input class=
							"input-with-feedback" id="cpassword" name="cpassword" type="password" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="profileGenderId">Gender <?php getErrs('gender'); // check for errs?></label> <select id="gender" name=
							"gender">
								<option value="0">
									Select your gender
								</option>

								<option value="f">
									Female
								</option>

								<option value="m">
									Male
								</option>
							</select>
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="umbcsince">When did you first arrive at UMBC?</label>
							<select id="umbcsince" name="yeararrived">
								<option value="0">Select a year</option>
								<?php 
									for($i = 2014; $i >= 1980; $i--){
										echo "<option value=\"$i\">$i</option>";
									}
								?>
	
							</select>
						</div><label class="checkbox text-left"><input id="newsletter" name="newsletter" type=
						"checkbox" value="true" /><input id="__checkbox_newsletter" name="__checkbox_newsletter" type=
						"hidden" value="true" /> Send me occasional emails with great food tips</label> <input class=
						"btn btn-block mt btn-large" name="Submit" type="submit" value="Register by email" />
					</form>

					<div class="h5 mt">
						Already a member?<br />
						<a href="login.php">Login</a>
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
<script src="./js/bootstrap.min.js"></script>
</html>