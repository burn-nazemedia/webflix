<?php
include("inc/header.php");
include("inc/form_handlers/settings_handler.php");
?>

<style>
input {
	color: black;
}
i {
	float: right;
}
.cross {
	color: red;
	font-size: 20px;

}
.fa-plus-circle {
	color: white;
}
.themechoice {
	margin-right: 1em;
	opacity: 0.7;
}
.themechoice:hover {
	opacity: 1;
	transition: 0.7s;
	text-decoration: none;
}
</style>
<div class="container-fluid splash-left5 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
	<?php include 'inc/nav.php' ?>
	<h1 class="splash-msg wow fadeIn" data-wow-duration="1s" data-wow-delay="0.8s" style="margin-left: 10%; margin-top: 3%; margin-bottom: 3%;">Account Settings</h1>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
	<!--Close account form-->
	<h2 class="set-head" style="border-radius: 25px; padding: 2%; margin-bottom: 4%; text-align: center; opacity: 0.7;">
		<strong>Special Edition Themes</strong><a href="#" id="show4"><i class="fas fa-plus-circle"></i></a></h2>
		<div id="themes" style="display: none; padding: 2%;" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">

			<a class="themechoice" href="#" rel="css/marvel.css">
					<span style="color: white; background-color: red;
					font-size: 25px; padding: 1.5%; border-radius: 25px;
					 width: 50%; ">
						<strong>Marvel</strong></span>
					</a>
					<a class="themechoice" href="#" rel="css/dc.css">
							<span style="color: white; background-color: blue; font-size: 25px; padding: 1.5%; border-radius: 25px; width: 50%;">
								<strong>DC</strong></span>
							</a>
							<a class="themechoice" href="#" rel="css/webflix.css">
									<span style="color: #ff8d3f; background-color: #494949; font-size: 25px; padding: 1.5%; border-radius: 25px; width: 50%;">
										<strong>WEBFLIX</strong></span>
									</a>


											<a class="themechoice" href="#" rel="css/gangsta.css">
													<span style="color: white; background-color: black; font-size: 25px;
													 padding: 1.5%; border-radius: 25px; width: 50%;">
														<strong>Gangsta Theme</strong></span>
													</a>
													<br/>
													<br/>

													<a class="themechoice" href="#" rel="css/romance.css">
															<span style="color: white; background-color: purple; font-size: 25px;
															 padding: 1.5%; border-radius: 25px; width: 50%; margin-left: 30%;">
																<strong>Love Theme</strong></span>
															</a>




				<!--<li><a href="#" rel="css/dc.css">DC</a></li>
					<li><a href="#" rel="css/kids.css">Kids</a></li>
					<li><a href="#" rel="css/webflix.css">WEBFLIX</a></li>-->

				 <a href="#" id="hide4" title="Close"><i class="fas fa-times-circle cross"></i></a>
			</div>
	</div>
</div>
	<div class="row">

		<div class="col-md-4 "></div>
<div class="col-md-4 setting-field">


	<br>

		<h2 class="set-head" style=" border-radius: 25px;
		 	padding: 2%; margin-bottom: 5%; text-align: center; opacity: 0.7;" class="wow fadeIn"  data-wow-duration="1s" data-wow-delay="1.2s">
			<strong>Change Profile Image</strong><a href="#" id="show"><i class="fas fa-plus-circle"></i></a></h2>
			<div id="profimg" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">

	<?php
	echo "<img width='200px' class='img-responsive' src='" . $user['profile_pic'] ."' id='small_profile_pics'>";//display current profile picture
	?>
	<br>




	<br>
       <!--upload new picture to folder and change url in users table-->
	<?php
	if ( isset( $_POST[ 'post' ] ) ) {

	$uploadOk = 1;
	$imageName = $_FILES[ 'fileToUpload' ][ 'name' ]; //set image name to variable
	$errorMessage = "";

	if ( $imageName != "" ) {
		$targetDir = "images/profile_pics/"; //set target directory
		$imageName = $targetDir . uniqid() . basename( $imageName ); //set target path and filename. uniqid gives each file a unique name to avoid duplicates
		$imageFileType = pathinfo( $imageName, PATHINFO_EXTENSION );

		if ( $_FILES[ 'fileToUpload' ][ 'size' ] > 10000000 ) {
			$errorMessage = "Sorry your file is too large";//check max file size
			$uploadOk = 0;
		}

		if ( strtolower( $imageFileType ) != "jpeg" && strtolower( $imageFileType ) != "png" && strtolower( $imageFileType ) != "jpg" ) {//change filename to lower case
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if ( $uploadOk ) {
			if ( move_uploaded_file( $_FILES[ 'fileToUpload' ][ 'tmp_name' ], $imageName ) ) {
				//image uploaded okay
			} else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}


		//Insert image into database
		$insert_pic_query = mysqli_query($con, "UPDATE users SET profile_pic='$imageName' WHERE username='$userLoggedIn'");
		header("Location: ".$userLoggedIn);

	if ( $uploadOk ) {
		$post = new Post( $con, $userLoggedIn );
		$post->submitPost( $_POST[ 'post_text' ], 'none', $imageName );
	} else {
		echo "<div style='text-align:center;' class='alert alert-danger'>
				$errorMessage
			</div>";
	}

}
    //set varibale names so we can fetch current user data
	$user_data_query = mysqli_query($con, "SELECT first_name, last_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
	$email = $row['email'];
	$profilePic = $row['profile_pic']

	?>

	<!--Form to submit profile pic-->
	<form action="settings.php" method="POST" enctype="multipart/form-data">


			<input style="background-color: #494949; color: white; border: 0;" type="file" name="fileToUpload" class="fileToUpload" id="fileToUpload">

			<input style="background-color: #14f702; color: white; border: 0;" type="submit" name="post" id="post_button" value="Change Picture">
			<hr>
 <a href="#" id="hide" title="Close"><i class="fas fa-times-circle cross"></i></a>


		</form>
	</div>
	</div>
</div>
<!--Form to change account details-->




		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4 setting-field" style="color: black;">
				<h2 class="set-head" style=" border-radius: 25px; padding: 2%;
				     margin-bottom: 3%; text-align: center; opacity: 0.7;" class="wow fadeIn"  data-wow-duration="1s" data-wow-delay="1.5 s">
					<strong>Change Account Details</strong><a href="#" id="show1"><i class="fas fa-plus-circle"></i></a></h2>
				</div>
			</div>

					<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4 setting-field wow fadeIn" data-wow-duration="1s" data-wow-delay="1s" id="acdets" style="color: black;">
<form action="settings.php" method="POST">
								<span class="setform">First Name </span> <br/><br/><input  type="text" name="first_name" value="<?php echo $first_name; ?>">
							<br/>	<br/><span class="setform">Last Name </span><br/><br/>
								<input type="text" name="last_name" value="<?php echo $last_name; ?>">
								<br/>	<br/><span class="setform">Email </span><br/><br/>
								<input type="text" name="email" value="<?php echo $email; ?>">
       <br/>
			<?php echo $message; ?>
<br/>
			<input style="background-color: #14f702; color: white; border: 0;" type="submit" name="update_details" id="save_details" value="Update Details">
     <hr/><a href="#" id="hide1"><i class="fas fa-times-circle cross"></i></a>
		 </form>
		</div>
	</div>

<br/>



		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h2 class="set-head" style=" border-radius: 25px; padding: 2%;
				 margin-bottom: 4%; text-align: center; opacity: 0.8;">
					<strong>Change Password</strong><a href="#" id="show2"><i class="fas fa-plus-circle"></i></a></h2>
</div>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" id="acdets2">
		<form action="settings.php" method="POST">
			<span class="setform">	Old Password</span> <br/> <br/><input type="password" name="old_password">
		<br/>	<br/><span class="setform">	New Password</span> <br/> <br/>
			<input type="password" name="new_password_1"><br/><br/>
			<span class="setform">Confirm	New Password</span> <br/> <br/><input type="password" name="new_password_2">
			<?php echo $password_message; ?>
<br/><br/>
			<input style="background-color: #14f702; color: white; border: 0;" type="submit" name="update_password" id="save_details" value="Update Password"><br>
<br/><a href="#" id="hide2"><i class="fas fa-times-circle cross"></i></a>
		</div>

		</div>






	</form>

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
	<!--Close account form-->
	<h2 class="set-head" style="border-radius: 25px; padding: 2%; margin-bottom: 4%; text-align: center; opacity: 0.7;">
		<strong>Close Your Account</strong><a href="#" id="show3"><i class="fas fa-plus-circle"></i></a></h2>
		<div id="close" class="wow fadeIn" data-wow-duration="1s" data-wow-delay="1s">
	<form action="settings.php" method="POST">
		<p style="color: white;">Click the button to close your <span style="color: #ff8d3f;"><strong>WEBFLIX</strong></span> account. Your account will be deactivated but you can log back into your account anytime to re-activate your account.</p>

		<input style="background-color: red; color: white; border: 0;" type="submit" name="close_account" id="close_account" value="Close Account">
		<br/><a href="#" id="hide3"><i class="fas fa-times-circle cross"></i></a>

	</form>
</div>
</div>
</div>
	<br>
<br>
<?php include 'inc/footer.php' ?>
</div>
