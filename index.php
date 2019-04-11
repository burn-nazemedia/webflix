
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


<h1>Welcome to WebFlix</h1>
<?php 
	$result = mysqli_query( $con,
	"SELECT *
			 FROM `movie`"
);

	//loop through each row from results
	while ($row=mysqli_fetch_array($result)) {
		
	?>

<a href="movie.php?id=<?php echo $row['movie_id']; ?>">
	<h2>
		<?php echo $row['movie_name']; ?><br/>
	</h2>

	<p>
		<?php echo $row['movie_description']; ?>
	</p>
	<p>Genre:
		<?php echo $row['movie_genre']; ?>
	</p>
</a>
<?php
}
?>
</body>
</html>