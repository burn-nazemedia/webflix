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
	<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="assets/js/jquery-1.11.3.min.js"></script>-->
	<script src="js/jquery.cookie.js"></script>

	<link rel="stylesheet" href="css/webflix.css">


	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
	integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">



	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bangers" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah" rel="stylesheet">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="assets/css/register.css">
	<link rel="stylesheet" href="assets/css/register.css">
	<link rel="stylesheet" href="css/jquery-ui.css">

	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/webflix.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script>
					new WOW().init();
					</script>







<script type="text/javascript" src="assets/js/functions.js"></script>

	<title>Welcome to Webflix </title>
</head>

<body>




	<!--<button type="button" onclick="switch_style('black');return false;" name="theme" value="Black Theme" id="black">Black Theme</button>
<button type="button" onclick="switch_style('red');return false;" name="theme" value="red Theme" id="red">Red Theme</button>-->

	<script type="text/javascript" src="assets/js/themes.js"></script>
</body>
</html>
