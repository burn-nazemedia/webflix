<?php
include("inc/header.php");



if(isset($_POST['change_theme_black'])) {
	$theme_query = mysqli_query($con, "UPDATE users SET user_theme='black' WHERE username='$userLoggedIn'");
	$_SESSION['user_theme']=$row['user_theme'];
	session_destroy();
	header("Location: index.php");
	
	
	
}elseif(isset($_POST['change_theme_red'])) {
	$theme_query = mysqli_query($con, "UPDATE users SET user_theme='red' WHERE username='$userLoggedIn'");
	$_SESSION['user_theme']=$row['user_theme'];
	session_destroy();
	header("Location: index.php");
	
	
	
}


?>

<div class="main_column col-md-6 col-md-offset-3 close-account column">

	<h4>Themes</h4>
<p>Choose a colour</p>

	<form action="themes.php" method="POST">
		<input type="submit" name="change_theme_black" id="change_theme_black" value="Black" class="danger settings_submit">
		<input type="submit" name="change_theme_red" id="change_theme_red" value="Red" class="info dont_close settings_submit">
	</form>

</div>