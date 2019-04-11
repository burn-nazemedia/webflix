<?php 
include("inc/header.php");
include("inc/form_handlers/settings_handler.php");
?>


<div class="main-wrap col-md-12">
<div class="main_column column settings-div col-md-6 col-md-offset-3">

	<h1 style="color:#1f1f1f">Account Settings</h1>
	<br>
	<h3>Change Profile Picture</h3>
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
	<form action="settings.php" method="POST" encType="multipart/form-data">

			
			<input type="file" name="fileToUpload" class="fileToUpload" id="fileToUpload">
			
			<input type="submit" name="post" id="post_button" value="Change Picture">
			<hr>



		</form>
<!--Form to change account details-->
<h3>Change Account Details</h3>
	<form action="settings.php" method="POST">
		
		
		<div class="row">
			<div class="col-md-2"><p class="setting-place">First Name:</p></div>
			<div class="col-md-6 setting-field"><input type="text" name="first_name" value="<?php echo $first_name; ?>"></div>
		
		</div>
		<br>
		<div class="row">
			<div class="col-md-2"><p class="setting-place">Last Name:</p></div>
			<div class="col-md-6 setting-field"><input type="text" name="last_name" value="<?php echo $last_name; ?>"></div>
		
		</div>
		<br>
		<div class="row">
			<div class="col-md-2"><p class="setting-place">Email:</p></div>
			<div class="col-md-6 setting-field"><input type="text" name="email" value="<?php echo $email; ?>"></div>
		
		</div>
		<br>
		
	
		<?php echo $message; ?>
		
		<!--change password form-->
<div class="col-md-2 col-md-offset-4">
		<input type="submit" name="update_details" id="save_details" value="Update Details"><br>
	</form>
</div>
	<br>
	<br>
	<h4>Change Password</h4>
	<form action="settings.php" method="POST">
		
		<div class="row">
			<div class="col-md-2"><p class="setting-place">Old Password:</p></div>
			<div class="col-md-6 setting-field"><input type="password" name="old_password"></div>
		
		</div>
		<br>
		<div class="row">
			<div class="col-md-2"><p class="setting-place">New Password:</p></div>
			<div class="col-md-6 setting-field"><input type="password" name="new_password_1"></div>
		
		</div>
		<br>
		<div class="row">
			<div class="col-md-2"><p class="setting-place">Confirm New Password:</p></div>
			<div class="col-md-6 setting-field"><input type="password" name="new_password_2"></div>
		
		</div>
		
		
		<?php echo $password_message; ?>
		<div class="col-md-2 col-md-offset-4">
		<input type="submit" name="update_password" id="save_details" value="Update Password"><br>
	</form>
		</div>
	<br>
	<br>
	
	<!--Close account form-->
	<h4>Close Account</h4>
	<form action="settings.php" method="POST">
		<p>Click the button to close your WebFlix account. Your account will be deactivated but you can log back into your account anytime to re-activate your account.</p>
		<div class="col-md-2 col-md-offset-4">
		<input type="submit" name="close_account" id="close_account" value="Close Account">
		</div>
	</form>

	</div>
	<br> 
<br>
</div>
<br> 
<br>