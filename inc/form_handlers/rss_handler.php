<?php  
if(isset($_POST['update_details'])) {

	$rss_feed_1 = $_POST['user_rss_feed_1'];
	$rss_feed_2 = $_POST['user_rss_feed_2'];
	$rss_feed_3 = $_POST['user_rss_feed_3'];
	$email = $_POST['email'];

	$email_check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
	$row = mysqli_fetch_array($email_check);
	$matched_user = $row['username'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		$message = "Details updated!<br><br>";

		$query = mysqli_query($con, "UPDATE users SET user_rss_feed_1='$rss_feed_1', user_rss_feed_2='$rss_feed_2', user_rss_feed_3='$rss_feed_3' WHERE username='$userLoggedIn'");
	}
	
else 
		$message = "That email is already in use!<br><br>";
}
else 
	$message = "";


?>


</body>
</html>