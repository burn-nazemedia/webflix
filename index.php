
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


<?php
if ( $_SESSION[ 'user_level' ] == 'admin' ) {
	echo '<a class="adminlink" href="admin.php"><h3>Admin</h3></a>';

}
?>
<?php
if ( $_SESSION[ 'user_id' ] == '4' ) {
	echo '<a class="adminlink" href="admin.php"><h3>userid</h3></a>';

}
?>





	<body class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
  <div class="container-fluid" id="splash-left4">
		<?php include 'inc/nav.php' ?>
			<h2 id="welcome" class="wow fadeIn" data-wow-duration="2s" data-wow-delay="0.9s">
				Welcome to <span class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1.2s" id="webflix1">
					WEBFLIX
				</span>&nbsp; <span class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1.6s"> movie database, movie rss feeds & more...</span></h2>
			<hr/>
		<div class="row" style="margin-top: 5em;">
			<div class="col-md-1"></div>


	<?php
		$result = mysqli_query( $con,
		"SELECT *
				 FROM `movie`"
	);

		//loop through each row from results
		while ($row=mysqli_fetch_array($result)) {

		?>
		<div class="col-md-3 text-center homeTile wow fadeIn" data-wow-duration="2s" data-wow-delay="1.8s">
<a class="homeLink" href="movie.php?id=<?php echo $row['movie_id']; ?>">
	<img class="listingsthumb img-responsive" src="<?php echo $row['movie_image_main']; ?>" style="width: 70%;
				height: 10em; border-radius: 25px;"/>
	<hr/>
	<h2>
		<?php echo $row['movie_name']; ?><br/>
	</h2>
<hr/>
	<p>
		<?php echo $row['movie_description']; ?>
	</p>
	<hr/>
	<p>Genre:
		<?php echo $row['movie_genre']; ?>
	</p>
</a>
</div>

<?php
}
?>
</div>
</div>
</body>
