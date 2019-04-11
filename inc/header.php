<!doctype html>
<?php
session_start();
include( 'inc/dbconnect.inc.php' );
include( "inc/classes/User.php" );

//if user is not logged in return to register.php
if ( isset( $_SESSION[ 'username' ] ) ) {
	$userLoggedIn = $_SESSION[ 'username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM users WHERE username='$userLoggedIn'" ); //fetches user data
	$user = mysqli_fetch_array( $user_details_query );

} else {
	header( "Location: register.php" );
}
?>


<html>
<head>
	<meta charset="utf-8">
	<!--theme choice is taken from session variable-->
	<?php
	if ( $_SESSION[ 'user_theme' ] == 'black' ) {
		echo '<link rel="stylesheet" type="text/css" title="black" href="assets/css/black.css">';
	} elseif ( $_SESSION[ 'user_theme' ] == 'red' ) {

		echo '<link rel="stylesheet" type="text/css" title="red" href="assets/css/red.css">';
	}
	?>

<script type="text/javascript" src="assets/js/functions.js"></script>
<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>
	<title>Welcome to Webflix</title>
</head>

<body>

	<a href="inc/handlers/logout.php">
		<p>Log Out</p>
	</a>

	<ul>
		<li><a href="index.php">Home</a>
		</li>
		<li><a href="listings.php">Movies</a>
		</li>
		<li><a href="settings.php">Settings</a>
		</li>
		<li><a href="themes.php">Themes</a>
		</li>
		<li><a href="admin_rss.php">Rss Admin</a>
		</li>
		<li><a href="rss_listings.php">Rss Feeds</a>
		</li>
		<li><a href="subscriptions.php">Subscribe!!</a>
		</li>
		<li><a href="<?php echo $userLoggedIn; ?>">Profile</a>
		</li>


	</ul>
	<!--<button type="button" onclick="switch_style('black');return false;" name="theme" value="Black Theme" id="black">Black Theme</button>
<button type="button" onclick="switch_style('red');return false;" name="theme" value="red Theme" id="red">Red Theme</button>-->

	<script type="text/javascript" src="assets/js/themes.js"></script>