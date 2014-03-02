<?php
	session_start();

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

	<script>
<![CDATA[
	var urchinTracker=function(){},_gaq={push:function(){try {if(arguments[0][0]=='_link')window.location.href=arguments[0][1]}catch(er){}}},_gat={_createTracker:function(){}, _getTracker:function(){return{__noSuchMethod__:function(){},_link:function(o){if(o)location.href=o;},_linkByPost:function(){return true;},_getLinkerUrl:function(o){return o;},_trackEvent:function(){}}}};
	]]>
	</script>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

	<title>Join FeedMe</title>
	<link href="./css/sty.10423.css" rel="stylesheet" type="text/css" />
</head>

<body class="" data-base="" id="body">
	<?php
		// show navigation bar
		include_once('navbar.php');

		// for errors
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
			}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
		}
	?>
	<div class="clearpage container" id="wrapper">
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

					<form action="register-exec.php" id="loginForm" method="post" name="loginForm">
						<div class="control-group text-left">
							<label class="control-label" for="email">Email</label> <input class="input-with-feedback"
							id="email" name="email" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="username">Username</label> <input class=
							"input-with-feedback" id="login" name="login" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="fname">First name</label> 
							<input class="input-with-feedback" id="fname" name="fname" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="lname">Lastname</label> <input class=
							"input-with-feedback" id="lname" name="lname" type="text" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="passwd">Password</label> <input class=
							"input-with-feedback" id="password" name="password" type="password" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="passwd">Confirm Password</label> <input class=
							"input-with-feedback" id="cpassword" name="cpassword" type="password" value="" />
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="profileGenderId">Gender</label> <select id="gender" name=
							"profileGenderId">
								<option value="0">
									Select your gender
								</option>

								<option value="3">
									Female
								</option>

								<option value="2">
									Male
								</option>
							</select>
						</div>

						<div class="control-group text-left">
							<label class="control-label" for="umbcsince">When did you first arrive at UMBC?</label>
							<select id="umbcsince" name="profileGenderId">
								<option value="0">
									Select a year
								</option>

								<option value="1980">
									1980
								</option>

								<option value="1981">
									1981
								</option>

								<option value="1982">
									1982
								</option>

								<option value="1983">
									1983
								</option>

								<option value="1984">
									1984
								</option>

								<option value="1985">
									1985
								</option>

								<option value="1986">
									1986
								</option>

								<option value="1987">
									1987
								</option>

								<option value="1988">
									1988
								</option>

								<option value="1989">
									1989
								</option>

								<option value="1990">
									1990
								</option>

								<option value="1991">
									1991
								</option>

								<option value="1992">
									1992
								</option>

								<option value="1993">
									1993
								</option>

								<option value="1994">
									1994
								</option>

								<option value="1995">
									1995
								</option>

								<option value="1996">
									1996
								</option>

								<option value="1997">
									1997
								</option>

								<option value="1998">
									1998
								</option>

								<option value="1999">
									1999
								</option>

								<option value="2000">
									2000
								</option>

								<option value="2001">
									2001
								</option>

								<option value="2002">
									2002
								</option>

								<option value="2003">
									2003
								</option>

								<option value="2004">
									2004
								</option>

								<option value="2005">
									2005
								</option>

								<option value="2006">
									2006
								</option>

								<option value="2007">
									2007
								</option>

								<option value="2008">
									2008
								</option>

								<option value="2009">
									2009
								</option>

								<option value="2010">
									2010
								</option>

								<option value="2011">
									2011
								</option>

								<option value="2012">
									2012
								</option>

								<option value="2013">
									2013
								</option>

								<option value="2014">
									2014
								</option>
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
</body>
</html>