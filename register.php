<!doctype html>
<?php

include('inc/dbconnect.inc.php');

include('inc/form_handlers/register_handler.php');
include('inc/form_handlers/login_handler.php');



?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to WebFlix</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/webflix.css">
		<link rel="stylesheet" href="assets/css/register.css">
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/register.js"></script>
	<style>
a {
	color: white;
}
hr {
	border-top: 1px solid grey;
}
	</style>

</head>

<body>

	<?php
	if(isset($_POST['register_button'])) {
		echo '
		<script>
			$(document).ready(function() {
				$("#first").hide();
				$("#second").show();
			});

		</script>
		';
	}


	?>

	<div class="container-fluid splash-left5">
		<div class="row" style="">


				<div class="col-md-4 col-md-offset-4 text-center login-box"
				style="background-color: #494949; border: 0 !important; opacity: 0.8; margin-top: 7%; padding-top: 2%;">
				<span class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1.2s" id="webflix2">
					WEBFLIX
				</span>
				<hr/>
					<h2 class="regis-header" style="border-radius: 25px;"><strong>Login or sign up below</strong></h2>
					<hr/>
					<div id="first">
						<form action="register.php" method="POST">
							<input type="email" name="log_email" placeholder="Email address" value="<?php
							if(isset($_SESSION['reg_email'])) {
								echo $_SESSION['reg_email'];
							}
						?>" required>
							<br>
							<input type="password" name="log_password" placeholder="Password">
							<hr>
							<?php if(in_array("Email or password is incorrect<br>", $error_array)) echo "Email or password is incorrect<br>"; ?>
							<input  style="background-color: #ff8d3f; border: 0; color: #494949; width: 30%;" class="reg-btn btn-primary" type="submit" name="login_button" value="Login">
							<br>
							<a href="#" id="signup" class="signup">Need an account? Register here</a>
						</form>
					</div>


					<!--register form-->
					<div id="second">
						<form action="register.php" method="POST">
							<input type="text" name="reg_fname" placeholder="First Name" value="<?php
							if(isset($_SESSION['reg_fname'])) {
								echo $_SESSION['reg_fname'];
							}
						?>" required>
							<br>
							<?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color: white'>Your first name must be between 2 and 25 characters</p><br>"; ?>
							<input type="text" name="reg_lname" placeholder="Last Name" value="<?php
							if(isset($_SESSION['reg_lname'])) {
								echo $_SESSION['reg_lname'];
							}
						?>" required>
							<br>
							<?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "<p style='color: white'>Your last name must be between 2 and 25 characters</p><br>"; ?>
							<input type="email" name="reg_email" placeholder="Email" value="<?php
							if(isset($_SESSION['reg_email'])) {
								echo $_SESSION['reg_email'];
							}

						?>" required>
							<br>
							<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
							if(isset($_SESSION['reg_email2'])) {
								echo $_SESSION['reg_email2'];
							}
						?>" required>
							<br>
							<?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>";
						else if(in_array("Invalid format<br>", $error_array)) echo "Invalid format<br>";
						else if(in_array("Emails do not match<br>", $error_array)) echo "<p style='color: white'>Emails do not match</p><br>"; ?>


							<input type="password" name="reg_password" placeholder="Password" required>
							<br>
							<input type="password" name="reg_password2" placeholder="Confirm Password" required>
							<br>
							<?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>";
						else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "<p style='color: white'>Your password can only contain english characters or numbers</p><br>";
						else if(in_array("Your password must be between 5 and 30 characters<br>", $error_array)) echo "<p style='color: white'>Your password must be between 5 and 30 characters</p><br>"; ?>

							<label><input class="confirm" type="checkbox" name="confirm-check" label="I agree to the terms and conditions" required>&nbsp;I agree to the <a target="_blank" href="terms.php">terms and conditions</a></label>
							<br/>
							<hr/>

							<input style="background-color: #ff8d3f; border: 0; color: #494949; width: 30%;" class="btn-primary" type="submit" name="register_button" value="Register"><br/>

							<?php if(in_array("You are now registered. Please login!<br>", $error_array)) echo "<h2 style='color: white;'>You are now registered. Please login!</h2><br>"; ?>
							<a href="#" id="signin" class="signin">Already have an account? Login here</a>

						</form>
					</div>

				</div>
				
				<div class="space-div"></div>
			</div>
		</div>
	</div>

</body>
</html>
