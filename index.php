
<?php
session_start();
include( 'inc/header.php' );
$id = $_GET[ 'user_id' ];


//if user is not logged in return to register.php
if ( isset( $_SESSION[ 'username' ] ) ) {
	$userLoggedIn = $_SESSION[ 'username' ];
	$user_details_query = mysqli_query( $con, "SELECT * FROM users WHERE username='$userLoggedIn'" ); //fetches user data
	$user = mysqli_fetch_array( $user_details_query );

} else {
	header( "Location: register.php" );


}

?>

	<body class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
  <div class="container-fluid splash-left4">
		<?php include 'inc/nav.php' ?>
	<!--	<?php
		if ( $_SESSION[ 'user_level' ] == 'admin' ) {
			echo '<a class="adminlink" href="admin.php"><h4>Admin - Add Movie</h4></a>';

		}
		?>
		<?php
		if ( $_SESSION[ 'user_id' ] == '4' ) {
			echo '<a class="adminlink" href="admin.php"><h4>userid</h4></a>';

		}
		?>-->
			<h2 id="welcome" class="" data-wow-duration="2s" data-wow-delay="0.9s" style="margin-top: 2em;">
				Welcome to <span class="" data-wow-duration="2s" data-wow-delay="1.2s" id="webflix1">
				<strong>	WEBFLIX </strong>
			</span>&nbsp; <span class="" data-wow-duration="2s" data-wow-delay="1.6s">movie rss feeds & movie database</span></h2>
			<br/>
		<div class="row" style="margin-top: 5em; padding-left: 5%; padding-right: 5%;">



	<?php
		$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`"
	);

		//loop through each row from results
		while ($row=mysqli_fetch_array($result)) {

		?>

		<div class="col-md-4 text-center wow fadeIn"
		style="margin-bottom: 3em; margin-right: 0em;" data-wow-duration="2s" data-wow-delay="1.8s">

		<div class="homeTile text-center" style="border-radius: 25px; ">
<a class="homeLink" href="movie.php?id=<?php echo $row['movie_id']; ?>">

	<img class="listingsthumb img-responsive" src="<?php echo $row['movie_image_main']; ?>" style="width: 70%;
				height: 10em; border-radius: 25px;"/>
	<hr/>
	<h2 class="mtitle">
		<?php echo $row['movie_name']; ?><br/>
	</h2>
<hr/>
	<p>
	    //shorten characters in description
        <?php echo mb_strimwidth($row['movie_description'], 0, 100, "....more info"); ?>
	</p>
	<hr/>
	<p>Genre:
		<?php echo $row['movie_genre']; ?>
	</p>
</a>
</div>

</div>


<?php
}
?>
</div>
<?php include 'inc/footer.php' ?>
</div>

<script>
if('serviceWorker' in navigator) {
  navigator.serviceWorker
           .register('sw.js')
           .then(function() { console.log("Service Worker Registered"); });
}
</script>

<script src="offline/register-sw.js" type="text/javascript"> </script>
</body>
